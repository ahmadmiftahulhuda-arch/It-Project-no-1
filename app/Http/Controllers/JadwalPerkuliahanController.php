<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPerkuliahan;
use App\Imports\JadwalPerkuliahanImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class JadwalPerkuliahanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter dari request
        $filters = [
            'search' => $request->search,
            'hari' => $request->hari,
            'ruangan' => $request->ruangan,
            'semester' => $request->semester,
            'sort' => $request->sort ?? 'hari'
        ];

        // Query dengan filter
        $jadwal = JadwalPerkuliahan::filter($filters);

        // Sorting
        if ($request->sort == 'waktu') {
            $jadwal->orderBy('waktu');
        } elseif ($request->sort == 'matakuliah') {
            $jadwal->orderBy('nama_matkul');
        } else {
            $jadwal->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat')")
                   ->orderBy('waktu');
        }

        $jadwal = $jadwal->paginate(10);

        // Data untuk filter
        $hariList = JadwalPerkuliahan::distinct()->pluck('hari');
        $ruanganList = JadwalPerkuliahan::distinct()->pluck('ruangan');
        $semesterList = JadwalPerkuliahan::distinct()->pluck('semester');

        // Hitung statistik
        $totalCount = JadwalPerkuliahan::count();
        $seninCount = JadwalPerkuliahan::where('hari', 'Senin')->count();
        $selasaCount = JadwalPerkuliahan::where('hari', 'Selasa')->count();
        $rabuCount = JadwalPerkuliahan::where('hari', 'Rabu')->count();
        $kamisCount = JadwalPerkuliahan::where('hari', 'Kamis')->count();
        $jumatCount = JadwalPerkuliahan::where('hari', 'Jumat')->count();

        return view('admin.jadwal-perkuliahan.index', compact(
            'jadwal', 
            'hariList', 
            'ruanganList', 
            'semesterList',
            'totalCount',
            'seninCount',
            'selasaCount',
            'rabuCount',
            'kamisCount',
            'jumatCount',
            'filters'
        ));
    }

    public function create()
    {
        return view('admin.jadwal-perkuliahan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required|string',
            'waktu' => 'required|string',
            'kode_matkul' => 'required|string',
            'nama_matkul' => 'required|string',
            'dosen' => 'required|string',
            'kelas' => 'required|string',
            'ruangan' => 'required|string',
            'semester' => 'required|string',
        ]);

        JadwalPerkuliahan::create($request->all());

        return redirect()->route('jadwal-perkuliahan.index')
                         ->with('success', 'Jadwal perkuliahan berhasil ditambahkan.');
    }

    public function show(JadwalPerkuliahan $jadwalPerkuliahan)
    {
        return view('admin.jadwal-perkuliahan.show', compact('jadwalPerkuliahan'));
    }

    public function edit(JadwalPerkuliahan $jadwalPerkuliahan)
    {
        return view('admin.jadwal-perkuliahan.edit', compact('jadwalPerkuliahan'));
    }

    public function update(Request $request, JadwalPerkuliahan $jadwalPerkuliahan)
    {
        $request->validate([
            'hari' => 'required|string',
            'waktu' => 'required|string',
            'kode_matkul' => 'required|string',
            'nama_matkul' => 'required|string',
            'dosen' => 'required|string',
            'kelas' => 'required|string',
            'ruangan' => 'required|string',
            'semester' => 'required|string',
        ]);

        $jadwalPerkuliahan->update($request->all());

        return redirect()->route('jadwal-perkuliahan.index')
                         ->with('success', 'Jadwal perkuliahan berhasil diperbarui.');
    }

    public function destroy(JadwalPerkuliahan $jadwalPerkuliahan)
    {
        $jadwalPerkuliahan->delete();

        return redirect()->route('jadwal-perkuliahan.index')
                         ->with('success', 'Jadwal perkuliahan berhasil dihapus.');
    }
    public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls'
    ]);

    Excel::import(new JadwalPerkuliahanImport, $request->file('file'));

    return redirect()->route('jadwal-perkuliahan.index')
        ->with('success', 'Data jadwal perkuliahan berhasil diimport dari Excel.');
}
public function deleteAll(Request $request)
{
    try {
        \App\Models\JadwalPerkuliahan::truncate();
        
        return redirect()->route('jadwal-perkuliahan.index')
            ->with('success', 'Semua data berhasil dihapus!');
    } catch (\Exception $e) {
        return redirect()->route('jadwal-perkuliahan.index')
            ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
    }
}
}