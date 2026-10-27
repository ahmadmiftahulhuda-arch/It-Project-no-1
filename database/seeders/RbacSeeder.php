<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class RbacSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Daftar permissions RBAC Approval + PINTER
        $permissions = [
            // RBAC Core
            'manage users',
            'manage roles',
            'view audit logs',

            // Approval Transaksi (Maker-Checker-Approver)
            'view transactions',
            'create transactions',
            'edit transactions',
            'delete transactions',
            'submit transactions',
            'check transactions',
            'approve transactions',
            'reject transactions',

            // Peminjaman Sarpras PINTER
            'view peminjaman',
            'create peminjaman',
            'approve peminjaman',
            'reject peminjaman',
            'view sarana',
            'manage sarana',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Daftar Roles
        $roleNames = [
            'Superadmin',
            'Administrator',
            'Admin',
            'Dosen',
            'Mahasiswa',
            'Inputer',
            'Checker',
            'Approver',
            'User',
        ];

        foreach ($roleNames as $roleName) {
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        }

        $superadmin = Role::findByName('Superadmin', 'web');
        $admin = Role::findByName('Administrator', 'web');
        $adminAlias = Role::findByName('Admin', 'web');
        $dosen = Role::findByName('Dosen', 'web');
        $mahasiswa = Role::findByName('Mahasiswa', 'web');
        $inputer = Role::findByName('Inputer', 'web');
        $checker = Role::findByName('Checker', 'web');
        $approver = Role::findByName('Approver', 'web');

        // Berikan permissions
        $superadmin->syncPermissions($permissions);

        $adminPermissions = [
            'manage users',
            'manage roles',
            'view audit logs',
            'view transactions',
            'create transactions',
            'edit transactions',
            'delete transactions',
            'submit transactions',
            'view peminjaman',
            'create peminjaman',
            'approve peminjaman',
            'reject peminjaman',
            'view sarana',
            'manage sarana',
        ];
        $admin->syncPermissions($adminPermissions);
        $adminAlias->syncPermissions($adminPermissions);

        $dosen->syncPermissions([
            'view peminjaman',
            'create peminjaman',
            'view sarana',
        ]);

        $mahasiswa->syncPermissions([
            'view peminjaman',
            'create peminjaman',
            'view sarana',
        ]);

        $inputer->syncPermissions([
            'view transactions',
            'create transactions',
            'edit transactions',
            'submit transactions',
            'view peminjaman',
            'create peminjaman',
        ]);

        $checker->syncPermissions([
            'view transactions',
            'check transactions',
            'view peminjaman',
        ]);

        $approver->syncPermissions([
            'view transactions',
            'approve transactions',
            'reject transactions',
            'view peminjaman',
            'approve peminjaman',
            'reject peminjaman',
        ]);

        $userRole = Role::findByName('User', 'web');
        $userRole->syncPermissions([
            'view peminjaman',
            'view sarana',
        ]);

        // Buat akun khusus untuk pengujian Alur 3 Tahap (Inputer - Checker - Approver)
        $testAccounts = [
            [
                'name'     => 'Staf Inputer',
                'email'    => 'inputer@politala.ac.id',
                'password' => bcrypt('password123'),
                'peran'    => 'Inputer',
                'status'   => 'Aktif',
                'verified' => 1,
                'role'     => 'Inputer',
            ],
            [
                'name'     => 'Staf Checker',
                'email'    => 'checker@politala.ac.id',
                'password' => bcrypt('password123'),
                'peran'    => 'Checker',
                'status'   => 'Aktif',
                'verified' => 1,
                'role'     => 'Checker',
            ],
            [
                'name'     => 'Kepala Lab (Approver)',
                'email'    => 'approver@politala.ac.id',
                'password' => bcrypt('password123'),
                'peran'    => 'Approver',
                'status'   => 'Aktif',
                'verified' => 1,
                'role'     => 'Approver',
            ],
        ];

        foreach ($testAccounts as $account) {
            $assignedRole = $account['role'];
            unset($account['role']);
            $createdUser = User::firstOrCreate(['email' => $account['email']], $account);
            $createdUser->syncRoles([$assignedRole]);
        }

        // Sinkronkan seluruh pengguna yang ada di MySQL dengan Spatie Roles berdasarkan kolom `peran`
        $users = User::all();
        foreach ($users as $user) {
            $peran = trim($user->peran ?? '');
            if (strcasecmp($peran, 'Administrator') === 0 || strcasecmp($peran, 'Admin') === 0) {
                $user->syncRoles(['Administrator', 'Superadmin', 'Admin']);
            } elseif (strcasecmp($peran, 'Dosen') === 0) {
                $user->syncRoles(['Dosen']);
            } elseif (strcasecmp($peran, 'Mahasiswa') === 0) {
                $user->syncRoles(['Mahasiswa']);
            } elseif (strcasecmp($peran, 'Inputer') === 0) {
                $user->syncRoles(['Inputer']);
            } elseif (strcasecmp($peran, 'Checker') === 0) {
                $user->syncRoles(['Checker']);
            } elseif (strcasecmp($peran, 'Approver') === 0) {
                $user->syncRoles(['Approver']);
            }
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
