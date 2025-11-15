<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = Pengguna::with('user')->latest()->get();
            
            $jurusanList = [
                'Teknik Informatika',
                'Sistem Informasi',
                'Teknik Komputer',
                'Teknik Elektro',
                'Manajemen Informatika'
            ];

            return view('admin.pengguna.index', compact('users', 'jurusanList'));
        } catch (\Exception $e) {
            Log::error('Error in PenggunaController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data pengguna.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('pengguna.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nim' => 'nullable|string|max:20|unique:penggunas,nim',
            'email' => 'required|email|unique:penggunas,email|unique:users,email',
            'no_hp' => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'peran' => 'required|in:Admin Lab,Asisten,Mahasiswa',
            'jurusan' => 'required|string|max:255',
            'status' => 'required|in:Aktif,Non-Aktif',
            'tanggal_bergabung' => 'required|date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('pengguna.index')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi. Silakan periksa data yang dimasukkan.');
        }

        try {
            $validatedData = $validator->validated();

            // 1. Simpan data ke tabel 'penggunas'
            $pengguna = Pengguna::create([
                'nama' => $validatedData['nama'],
                'nim' => $validatedData['nim'],
                'email' => $validatedData['email'],
                'peran' => $validatedData['peran'],
                'jurusan' => $validatedData['jurusan'],
                'status' => $validatedData['status'],
                'tanggal_bergabung' => $validatedData['tanggal_bergabung'],
            ]);
            
            // 2. Buat data login di tabel 'users'
            User::create([
                'name' => $validatedData['nama'],
                'email' => $validatedData['email'],
                'no_hp' => $validatedData['no_hp'],
                'password' => Hash::make($validatedData['password']),
            ]);

            return redirect()->route('pengguna.index')
                ->with('success', 'Pengguna baru berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error storing user: ' . $e->getMessage());
            return redirect()->route('pengguna.index')
                ->with('error', 'Gagal menambahkan pengguna: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $user = Pengguna::with('user')->findOrFail($id);
            return view('admin.pengguna.show', compact('user'));
        } catch (\Exception $e) {
            Log::error('Error showing user: ' . $e->getMessage());
            return redirect()->route('pengguna.index')->with('error', 'Pengguna tidak ditemukan.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $pengguna = Pengguna::with('user')->findOrFail($id);
            
            // Untuk AJAX request - return JSON
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'id' => $pengguna->id,
                        'nama' => $pengguna->nama,
                        'email' => $pengguna->email,
                        'nim' => $pengguna->nim,
                        'jurusan' => $pengguna->jurusan,
                        'peran' => $pengguna->peran,
                        'status' => $pengguna->status,
                        'tanggal_bergabung' => $pengguna->tanggal_bergabung ? $pengguna->tanggal_bergabung->format('Y-m-d') : '',
                        'user' => [
                            'no_hp' => $pengguna->user->no_hp ?? ''
                        ]
                    ]
                ]);
            }

            // Untuk non-AJAX request (fallback)
            $jurusanList = [
                'Teknik Informatika',
                'Sistem Informasi',
                'Teknik Komputer',
                'Teknik Elektro',
                'Manajemen Informatika'
            ];

            $user = User::where('email', $pengguna->email)->first();
            return view('admin.pengguna.edit', compact('pengguna', 'user', 'jurusanList'));
            
        } catch (\Exception $e) {
            Log::error('Error editing user: ' . $e->getMessage());
            
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan'
                ], 404);
            }
            
            return redirect()->route('pengguna.index')->with('error', 'Pengguna tidak ditemukan.');
        }
    }

    /**
     * Method khusus untuk AJAX edit
     */
    public function editAjax($id)
    {
        try {
            $pengguna = Pengguna::with('user')->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $pengguna->id,
                    'nama' => $pengguna->nama,
                    'email' => $pengguna->email,
                    'nim' => $pengguna->nim,
                    'jurusan' => $pengguna->jurusan,
                    'peran' => $pengguna->peran,
                    'status' => $pengguna->status,
                    'tanggal_bergabung' => $pengguna->tanggal_bergabung ? $pengguna->tanggal_bergabung->format('Y-m-d') : '',
                    'user' => [
                        'no_hp' => $pengguna->user->no_hp ?? ''
                    ]
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error in editAjax: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $pengguna = Pengguna::findOrFail($id);
            $user = User::where('email', $pengguna->email)->first();

            $validator = Validator::make($request->all(), [
                'nama' => 'required|string|max:255',
                'nim' => 'nullable|string|max:20|unique:penggunas,nim,' . $id,
                'email' => 'required|email|unique:penggunas,email,' . $id . '|unique:users,email,' . ($user ? $user->id : 'NULL'),
                'no_hp' => 'nullable|string|max:20',
                'password' => 'nullable|string|min:6|confirmed',
                'peran' => 'required|in:Admin Lab,Asisten,Mahasiswa',
                'jurusan' => 'required|string|max:255',
                'status' => 'required|in:Aktif,Non-Aktif',
                'tanggal_bergabung' => 'required|date',
            ]);

            if ($validator->fails()) {
                return redirect()->route('pengguna.index')
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Terjadi kesalahan validasi. Silakan periksa data yang dimasukkan.');
            }

            $validatedData = $validator->validated();

            // Update tabel 'penggunas'
            $pengguna->update([
                'nama' => $validatedData['nama'],
                'nim' => $validatedData['nim'],
                'email' => $validatedData['email'],
                'peran' => $validatedData['peran'],
                'jurusan' => $validatedData['jurusan'],
                'status' => $validatedData['status'],
                'tanggal_bergabung' => $validatedData['tanggal_bergabung'],
            ]);

            // Update atau buat data di tabel 'users'
            if ($user) {
                $userData = [
                    'name' => $validatedData['nama'],
                    'email' => $validatedData['email'],
                    'no_hp' => $validatedData['no_hp'],
                ];
                
                if (!empty($validatedData['password'])) {
                    $userData['password'] = Hash::make($validatedData['password']);
                }
                
                $user->update($userData);
            } else {
                // Buat user baru jika tidak ditemukan
                User::create([
                    'name' => $validatedData['nama'],
                    'email' => $validatedData['email'],
                    'no_hp' => $validatedData['no_hp'],
                    'password' => Hash::make($validatedData['password'] ?? 'password123'),
                ]);
            }
            
            return redirect()->route('pengguna.index')
                ->with('success', 'Pengguna berhasil diperbarui');
                
        } catch (\Exception $e) {
            Log::error('Error updating user: ' . $e->getMessage());
            return redirect()->route('pengguna.index')
                ->with('error', 'Gagal memperbarui pengguna: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $pengguna = Pengguna::findOrFail($id);
            $userName = $pengguna->nama;

            // Hapus data user terkait
            User::where('email', $pengguna->email)->delete();
            
            // Hapus data pengguna
            $pengguna->delete();
            
            return redirect()->route('pengguna.index')
                ->with('success', "Pengguna '{$userName}' berhasil dihapus");
                
        } catch (\Exception $e) {
            Log::error('Error deleting user: ' . $e->getMessage());
            return redirect()->route('pengguna.index')
                ->with('error', 'Gagal menghapus pengguna: ' . $e->getMessage());
        }
    }

    /**
     * Get user data for AJAX requests
     */
    public function getUserData($id)
    {
        try {
            $pengguna = Pengguna::with('user')->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $pengguna->id,
                    'nama' => $pengguna->nama,
                    'email' => $pengguna->email,
                    'nim' => $pengguna->nim,
                    'jurusan' => $pengguna->jurusan,
                    'peran' => $pengguna->peran,
                    'status' => $pengguna->status,
                    'tanggal_bergabung' => $pengguna->tanggal_bergabung ? $pengguna->tanggal_bergabung->format('Y-m-d') : '',
                    'user' => [
                        'no_hp' => $pengguna->user->no_hp ?? ''
                    ]
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error in getUserData: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }
    }
}