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

            // Handle search
            if ($request->filled('cari')) {
                $search = $request->cari;
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%')
                      ->orWhere('nim', 'like', '%' . $search . '%');
                });
            }

            // Handle role filter
            if ($request->filled('peran') && $request->peran != 'Semua') {
                $query->where('peran', $request->peran);
            }

            // Handle status filter
            if ($request->filled('status') && $request->status != 'Semua') {
                $query->where('status', $request->status);
            }

            // Handle verification filter
            if ($request->filled('verifikasi') && $request->verifikasi != 'Semua') {
                if ($request->verifikasi == 'Terverifikasi') {
                    $query->where('verified', true);
                } elseif ($request->verifikasi == 'Belum') {
                    $query->where('verified', false);
                }
            }

            $users = $query->latest()->paginate(15)->withQueryString();
            
            return view('admin.users.index', compact('users'));

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
            'peran' => 'required|in:Mahasiswa,Dosen,Administrator',
            'status' => 'required|in:Aktif,Nonaktif',
            'tanggal_bergabung' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $validatedData = $validator->validated();
            $validatedData['password'] = Hash::make($validatedData['password']);
            $validatedData['verified'] = true; // Automatically verify users created by admin

            User::create($validatedData);

            return response()->json(['success' => 'Pengguna baru berhasil ditambahkan.']);

        } catch (\Exception $e) {
            Log::error('Error storing user: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal menambahkan pengguna.'], 500);
        }
    }

    public function edit(User $user)
    {
        // This method is used by the frontend AJAX call to get user data
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
            'peran' => 'required|in:Mahasiswa,Dosen,Administrator',
            'status' => 'required|in:Aktif,Nonaktif',
            'verified' => 'required|boolean',
            'tanggal_bergabung' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $validatedData = $validator->validated();
            
            if (!empty($validatedData['password'])) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            } else {
                unset($validatedData['password']);
            }
            
            $user->update($validatedData);
            
            return response()->json(['success' => 'Pengguna berhasil diperbarui.']);

        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal memperbarui pengguna.'], 500);
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