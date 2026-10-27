<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;
use App\Models\AuditLog;

class RbacController extends Controller
{
    public function index()
    {
        abort_unless(
            auth()->user()->can('manage roles') || auth()->user()->hasRole('Administrator') || auth()->user()->peran === 'Administrator',
            403,
            'Kamu tidak memiliki izin mengakses manajemen RBAC.'
        );

        $roles = Role::with('permissions')->get();
        $permissions = Permission::all();
        $users = User::with('roles')->orderBy('name')->get();

        return view('admin.rbac.index', compact('roles', 'permissions', 'users'));
    }

    /**
     * Sinkronkan seluruh pengguna di tabel users dengan Spatie roles berdasarkan kolom `peran`
     */
    public function syncAll()
    {
        abort_unless(
            auth()->user()->can('manage roles') || auth()->user()->hasRole('Administrator') || auth()->user()->peran === 'Administrator',
            403,
            'Kamu tidak memiliki izin melakukan sinkronisasi peran.'
        );

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $users = User::all();
        $syncedCount = 0;

        foreach ($users as $user) {
            $peran = trim($user->peran ?? '');
            if (empty($peran)) {
                $peran = 'Mahasiswa';
                $user->peran = 'Mahasiswa';
                $user->save();
            }

            if (strcasecmp($peran, 'Administrator') === 0 || strcasecmp($peran, 'Admin') === 0) {
                $user->syncRoles(['Administrator', 'Superadmin', 'Admin']);
                $syncedCount++;
            } elseif (strcasecmp($peran, 'Dosen') === 0) {
                $user->syncRoles(['Dosen']);
                $syncedCount++;
            } elseif (strcasecmp($peran, 'Mahasiswa') === 0) {
                $user->syncRoles(['Mahasiswa']);
                $syncedCount++;
            } elseif (strcasecmp($peran, 'Inputer') === 0) {
                $user->syncRoles(['Inputer']);
                $syncedCount++;
            } elseif (strcasecmp($peran, 'Checker') === 0) {
                $user->syncRoles(['Checker']);
                $syncedCount++;
            } elseif (strcasecmp($peran, 'Approver') === 0) {
                $user->syncRoles(['Approver']);
                $syncedCount++;
            } else {
                $user->syncRoles(['User']);
                $syncedCount++;
            }
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        AuditLog::record('RBAC_SYNC', "Administrator melakukan sinkronisasi masal peran RBAC untuk {$syncedCount} pengguna.");

        return redirect()->route('admin.rbac.index')
            ->with('success', "Berhasil mensinkronisasi peran RBAC untuk {$syncedCount} pengguna!");
    }

    /**
     * Ubah peran (role) pengguna secara spesifik
     */
    public function assignRole(Request $request)
    {
        abort_unless(
            auth()->user()->can('manage roles') || auth()->user()->hasRole('Administrator') || auth()->user()->peran === 'Administrator',
            403,
            'Kamu tidak memiliki izin mengubah peran pengguna.'
        );

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|string|exists:roles,name',
        ]);

        $user = User::findOrFail($request->user_id);
        $newRole = $request->role;
        $oldRole = $user->peran ?? 'None';

        // Update kolom `peran` di tabel users
        $user->peran = $newRole;
        $user->save();

        // Sync Spatie role
        if (in_array($newRole, ['Administrator', 'Admin', 'Superadmin'])) {
            $user->syncRoles(['Administrator', 'Superadmin', 'Admin']);
        } else {
            $user->syncRoles([$newRole]);
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        AuditLog::record('RBAC_ASSIGN', "Peran pengguna '{$user->name}' ({$user->email}) diubah dari '{$oldRole}' menjadi '{$newRole}'.");

        return redirect()->route('admin.rbac.index')
            ->with('success', "Peran pengguna {$user->name} berhasil diubah menjadi {$newRole}.");
    }
}
