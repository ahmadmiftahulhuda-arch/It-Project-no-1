<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\User; // Ditambahkan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Ditambahkan
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data dari database menggunakan model Pengguna
        $users = Pengguna::latest()->get();
        
        return view('admin.pengguna.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusanList = [
            'Teknik Informatika',
            'Sistem Informasi',
            'Teknik Komputer',
            'Teknik Elektro',
            'Manajemen Informatika'
        ];

        return view('admin.pengguna.create', compact('jurusanList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nim' => 'nullable|string|max:20|unique:penggunas,nim',
            'email' => 'required|email|unique:penggunas,email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'peran' => 'required|in:Admin Lab,Asisten,Mahasiswa',
            'jurusan' => 'nullable|string|max:255',
            'status' => 'required|in:Aktif,Non-Aktif',
            'tanggal_bergabung' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // 1. Simpan data ke tabel 'penggunas'
            $pengguna = Pengguna::create($validator->validated());
            
            // 2. Buat data login di tabel 'users'
            User::create([
                'name' => $pengguna->nama,
                'email' => $pengguna->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('pengguna.index')
                ->with('success', 'Pengguna berhasil ditambahkan dengan data login.');
        } catch (\Exception $e) {
            return redirect()->route('pengguna.create')
                ->with('error', 'Gagal menambahkan pengguna: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Menampilkan detail pengguna
        $user = Pengguna::findOrFail($id);
        return view('admin.pengguna.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Pengguna::findOrFail($id);
        
        $jurusanList = [
            'Teknik Informatika',
            'Sistem Informasi',
            'Teknik Komputer',
            'Teknik Elektro',
            'Manajemen Informatika'
        ];

        return view('admin.pengguna.edit', compact('user', 'jurusanList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pengguna = Pengguna::findOrFail($id);

        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nim' => 'nullable|string|max:20|unique:penggunas,nim,' . $id,
            'email' => 'required|email|unique:penggunas,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'peran' => 'required|in:Admin Lab,Asisten,Mahasiswa',
            'jurusan' => 'nullable|string|max:255',
            'status' => 'required|in:Aktif,Non-Aktif',
            'tanggal_bergabung' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $validatedData = $validator->validated();

            // Cari user login berdasarkan email LAMA
            $user = User::where('email', $pengguna->email)->first();

            // Update tabel 'penggunas'
            $pengguna->update($validatedData);

            // Jika ada data user login yang cocok
            if ($user) {
                $user->name = $validatedData['nama'];
                $user->email = $validatedData['email'];
                
                // Jika admin mengisi password baru
                if (!empty($validatedData['password'])) {
                    $user->password = Hash::make($validatedData['password']);
                }
                
                $user->save();
            }
            
            return redirect()->route('pengguna.index')
                ->with('success', 'Pengguna berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('pengguna.edit', $id)
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
            $user = Pengguna::findOrFail($id);
            $userName = $user->nama;
            $user->delete();
            
            return redirect()->route('pengguna.index')
                ->with('success', "Pengguna '{$userName}' berhasil dihapus");
        } catch (\Exception $e) {
            return redirect()->route('pengguna.index')
                ->with('error', 'Gagal menghapus pengguna: ' . $e->getMessage());
        }
    }
}