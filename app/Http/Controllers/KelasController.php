<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Imports\MahasiswaImport;
use App\Exports\MahasiswaExport;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class KelasController extends Controller
{
    /**
     * Tampilkan daftar kelas
     */
    public function index(Request $request)
    {
        // Query utama
        $query = Kelas::withCount('mahasiswa');

        // 🔍 Search nama kelas
        if ($request->filled('search')) {
            $query->where('nama_kelas', 'like', '%' . $request->search . '%');
        }

        // 📄 Pagination
        $kelas = $query->paginate(10)->withQueryString();

        // 📊 Statistik GLOBAL
        $totalMahasiswa = Mahasiswa::count();
        $totalKelas = Kelas::count();

        $rataRata = $totalKelas > 0
            ? round($totalMahasiswa / $totalKelas, 2)
            : 0;

        return view('admin.kelas.index', compact(
            'kelas',
            'totalMahasiswa',
            'totalKelas',
            'rataRata'
        ));
    }

    /**
     * Simpan kelas baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50|unique:kelas,nama_kelas',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()->back()->with('success', 'Kelas berhasil ditambahkan');
    }

    /**
     * Update data kelas
     */
    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama_kelas' => [
                'required',
                'string',
                'max:50',
                Rule::unique('kelas')->ignore($kela->id),
            ],
        ]);

        $kela->update([
            'nama_kelas' => $request->nama_kelas,
        ]);

        return redirect()->back()->with('success', 'Kelas berhasil diperbarui');
    }

    /**
     * Hapus kelas
     */
    public function destroy(Kelas $kela)
    {
        $kela->delete();
        return redirect()->back()->with('success', 'Kelas berhasil dihapus');
    }

    /**
     * Detail kelas & mahasiswa
     */
    public function show(Kelas $kela)
    {
        $mahasiswa = $kela->mahasiswa()->orderBy('nama')->get();

        return view('admin.kelas.detail', compact(
            'kela',
            'mahasiswa'
        ));
    }

    /**
     * Import mahasiswa ke kelas tertentu
     */
    public function importMahasiswa(Request $request, $kelas_id)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx',
        ]);

        Excel::import(
            new MahasiswaImport($kelas_id),
            $request->file('file')
        );

        return redirect()->back()->with('success', 'Data mahasiswa berhasil diimport');
    }

    /**
     * Export mahasiswa per kelas
     */
    public function exportMahasiswa(Kelas $kela)
    {
        return Excel::download(
            new MahasiswaExport($kela->id),
            'mahasiswa-' . $kela->nama_kelas . '.xlsx'
        );
    }
}
