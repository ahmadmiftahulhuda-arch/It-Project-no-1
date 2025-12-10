<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Imports\DosenImport;
use Maatwebsite\Excel\Facades\Excel;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        $query = Dosen::query();
        
        if ($search) {
            $query->where('nip', 'like', '%' . $search . '%')
                  ->orWhere('nama_dosen', 'like', '%' . $search . '%');
        }
        
        $dosens = $query->orderBy('nama_dosen')->get();

        return view('admin.dosen.index', compact('dosens'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required|string|max:20|unique:dosens,nip',
            'nama_dosen' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal menambahkan dosen. Periksa kembali data yang diinput.');
        }

        try {
            Dosen::create([
                'nip' => $request->nip,
                'nama_dosen' => $request->nama_dosen
            ]);

            return redirect()->route('dosen.index')
                ->with('success', 'Data dosen berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dosen = Dosen::where('nip', $id)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'nama_dosen' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal memperbarui data dosen.');
        }

        try {
            $dosen->update([
                'nama_dosen' => $request->nama_dosen
            ]);

            return redirect()->route('dosen.index')
                ->with('success', 'Data dosen berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $dosen = Dosen::where('nip', $id)->firstOrFail();
            $dosen->delete();

            return redirect()->route('dosen.index')
                ->with('success', 'Data dosen berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('dosen.index')
                ->with('error', 'Gagal menghapus data dosen: ' . $e->getMessage());
        }
    }

    /**
     * Import dosen from uploaded Excel file
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv'
        ]);

        try {
            $file = $request->file('file');
            Excel::import(new DosenImport, $file);
            return redirect()->route('dosen.index')->with('import_success', 'Import Dosen selesai.');
        } catch (\Exception $e) {
            return redirect()->route('dosen.index')->with('import_error', 'Import gagal: ' . $e->getMessage());
        }
    }
}
