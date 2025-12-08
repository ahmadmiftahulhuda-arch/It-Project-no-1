<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RuanganImport;

class RuanganController extends Controller
{
    public function index(Request $request)
    {
        $query = Ruangan::query();

        // Filter status
        if ($request->status && $request->status != 'Semua') {
            $query->where('status', $request->status);
        }

        // Pencarian
        if ($request->cari) {
            $query->where(function($q) use ($request) {
                $q->where('kode_ruangan', 'like', "%{$request->cari}%")
                ->orWhere('nama_ruangan', 'like', "%{$request->cari}%");
            });
        }

        // Filter kapasitas
        if ($request->kapasitas) {
            $query->where('kapasitas', '>=', $request->kapasitas);
        }

        // Urutkan berdasarkan kode ruangan
        $ruangan = $query->orderBy('kode_ruangan', 'asc')->get();

        // Hitung statistik untuk cards
        $tersediaCount = Ruangan::where('status', 'Tersedia')->count();
        $digunakanCount = Ruangan::where('status', 'Sedang Digunakan')->count();
        $maintenanceCount = Ruangan::where('status', 'Maintenance')->count();
        $totalCount = Ruangan::count();

        return view('admin.ruangan.index', compact(
            'ruangan', 
            'tersediaCount', 
            'digunakanCount', 
            'maintenanceCount', 
            'totalCount'
        ));
    }

    public function create()
    {
        return view('admin.ruangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_ruangan' => 'required|unique:ruangan,kode_ruangan',
            'nama_ruangan' => 'required',
            'kapasitas' => 'required|integer|min:1',
            'status' => 'required|in:Tersedia,Sedang Digunakan,Maintenance',
        ]);

        Ruangan::create($request->all());

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function edit(Ruangan $ruangan)
    {
        return view('admin.ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'kode_ruangan' => 'required|unique:ruangan,kode_ruangan,' . $ruangan->id,
            'nama_ruangan' => 'required',
            'kapasitas' => 'required|integer|min:1',
            'status' => 'required|in:Tersedia,Sedang Digunakan,Maintenance',
        ]);

        $ruangan->update($request->all());

        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        return redirect()->route('admin.ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new RuanganImport, $request->file('file'));
            return redirect()->route('admin.ruangan.index')->with('import_success', 'Data ruangan berhasil diimport.');
        } catch (\Exception $e) {
            return redirect()->route('admin.ruangan.index')->with('import_error', 'Import gagal: ' . $e->getMessage());
        }
    }
}