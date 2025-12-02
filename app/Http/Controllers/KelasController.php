<?php
namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mahasiswa; 
use Illuminate\Http\Request;
use App\Imports\MahasiswaImport;
use Maatwebsite\Excel\Facades\Excel;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::withCount('mahasiswa')->get();

        // Hitung total mahasiswa keseluruhan
        $totalMahasiswa = Mahasiswa::count();

        // Hitung total kelas
        $totalKelas = $kelas->count();

        // Hitung rata-rata
        $rataRata = $totalKelas > 0 ? round($totalMahasiswa / $totalKelas, 2) : 0;

        return view('admin.kelas.index', compact('kelas', 'totalMahasiswa', 'totalKelas', 'rataRata'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50'
        ]);

        Kelas::create($request->all());
        return redirect()->back()->with('success', 'Kelas berhasil ditambahkan');
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50'
        ]);

        $kela->update($request->all());
        return redirect()->back()->with('success', 'Kelas berhasil diupdate');
    }

    public function destroy(Kelas $kela)
    {
        $kela->delete();
        return redirect()->back()->with('success', 'Kelas berhasil dihapus');
    }

    public function show(Kelas $kela)
    {
        $mahasiswa = $kela->mahasiswa;
        return view('admin.kelas.detail', compact('kela', 'mahasiswa'));
    }

    public function importMahasiswa(Request $request, $kelas_id)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        Excel::import(new MahasiswaImport($kelas_id), $request->file('file'));

        return redirect()->back()->with('success', 'Data mahasiswa berhasil diimport');
    }
}
