<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
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
            'email' => 'required|email|unique:penggunas,email',
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
            // Simpan data baru
            Pengguna::create($validator->validated());
            
            return redirect()->route('pengguna.index')
                ->with('success', 'Pengguna berhasil ditambahkan');
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
        $user = Pengguna::findOrFail($id);

        // Validasi data
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nim' => 'nullable|string|max:20|unique:penggunas,nim,' . $id,
            'email' => 'required|email|unique:penggunas,email,' . $id,
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
            $user->update($validator->validated());
            
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