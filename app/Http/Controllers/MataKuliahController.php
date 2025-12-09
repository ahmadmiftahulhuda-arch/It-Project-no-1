<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use App\Exports\MataKuliahExport;
use App\Imports\MataKuliahImport;
use Maatwebsite\Excel\Facades\Excel;

class MataKuliahController extends Controller
{
    public function index(Request $request)
    {
        $query = MataKuliah::query();

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%'.$request->search.'%')
                  ->orWhere('kode', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->semester) {
            $query->where('semester', $request->semester);
        }

        $mataKuliahs = $query->paginate(10);

        return view('admin.mata_kuliah.index', compact('mataKuliahs'));
    }

    public function create()
    {
        return view('admin.mata_kuliah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:mata_kuliahs',
            'nama' => 'required',
            'semester' => 'required|integer',
        ]);

        MataKuliah::create($request->all());
        return redirect()->route('mata_kuliah.index')->with('success', 'Mata Kuliah berhasil ditambahkan');
    }

    public function edit(MataKuliah $mata_kuliah)
    {
        return view('admin.mata_kuliah.edit', compact('mata_kuliah'));
    }

    public function update(Request $request, MataKuliah $mata_kuliah)
    {
        $request->validate([
            'kode' => 'required|unique:mata_kuliahs,kode,' . $mata_kuliah->id,
            'nama' => 'required',
            'semester' => 'required|integer',
        ]);

        $mata_kuliah->update($request->all());
        return redirect()->route('mata_kuliah.index')->with('success', 'Mata Kuliah berhasil diupdate');
    }

    public function destroy(MataKuliah $mata_kuliah)
    {
        $mata_kuliah->delete();
        return redirect()->route('mata_kuliah.index')->with('success', 'Mata Kuliah berhasil dihapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new MataKuliahImport, $request->file('file'));

        return redirect()->route('mata_kuliah.index')->with('success', 'Data mata kuliah berhasil diimport.');
    }

    public function export()
    {
        return Excel::download(new MataKuliahExport, 'mata_kuliah.xlsx');
    }
}