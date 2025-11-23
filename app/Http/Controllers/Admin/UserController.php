<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = User::query();

            $filter = $request->get('filter');
            $search = $request->get('cari');

            if ($filter == 'borrowers') {
                $query->whereHas('peminjaman');
            } elseif ($filter == 'verified') {
                $query->where('verified', true);
            } elseif ($filter == 'not_verified') {
                $query->where('verified', false);
            }

            // Apply search filter if 'cari' is present
            if ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%')
                      ->orWhere('nim', 'like', '%' . $search . '%');
                });
            }

            $users = $query->latest()->get();
            
            $jurusanList = ['Teknik Informatika', 'Sistem Informasi', 'Teknik Komputer', 'Teknik Elektro', 'Manajemen Informatika'];

            return view('admin.users.index', compact('users', 'jurusanList', 'filter'));
        } catch (\Exception $e) {
            Log::error('Error in UserController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data pengguna.');
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nim' => 'nullable|string|max:20|unique:users,nim',
            'email' => 'required|email|unique:users,email',
            'no_hp' => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'peran' => 'nullable|in:Admin Lab,Asisten,Mahasiswa',
            'jurusan' => 'nullable|string|max:255',
            'status' => 'nullable|in:Aktif,Non-Aktif',
            'tanggal_bergabung' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.users.index')->withErrors($validator)->withInput()->with('error', 'Terjadi kesalahan validasi.');
        }

        try {
            $validatedData = $validator->validated();
            $validatedData['password'] = Hash::make($validatedData['password']);
            
            User::create($validatedData);

            return redirect()->route('admin.users.index')->with('success', 'Pengguna baru berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error storing user: ' . $e->getMessage());
            return redirect()->route('admin.users.index')->with('error', 'Gagal menambahkan pengguna.');
        }
    }

    public function edit(User $user)
    {
        return response()->json(['success' => true, 'data' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nim' => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'no_hp' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
            'peran' => 'nullable|in:Admin Lab,Asisten,Mahasiswa',
            'jurusan' => 'nullable|string|max:255',
            'status' => 'nullable|in:Aktif,Non-Aktif',
            'tanggal_bergabung' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.users.index')->withErrors($validator)->withInput()->with('error', 'Terjadi kesalahan validasi.');
        }

        try {
            $validatedData = $validator->validated();
            
            if (!empty($validatedData['password'])) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            } else {
                unset($validatedData['password']);
            }
            
            $user->update($validatedData);
            
            return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return redirect()->route('admin.users.index')->with('error', 'Gagal memperbarui pengguna.');
        }
    }

    public function destroy(User $user)
    {
        try {
            $userName = $user->name;
            $user->delete();
            
            return redirect()->route('admin.users.index')->with('success', "Pengguna '{$userName}' berhasil dihapus");
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->route('admin.users.index')->with('error', 'Gagal menghapus pengguna.');
        }
    }

    public function verify(Request $request, User $user)
    {
        try {
            $user->verified = true;
            $user->save();

            return redirect()->route('admin.users.index')->with('success', 'User berhasil diverifikasi.');
        } catch (\Exception $e) {
            Log::error('Error verifying user: ' . $e->getMessage());
            return redirect()->route('admin.users.index')->with('error', 'Gagal memverifikasi user.');
        }
    }
}