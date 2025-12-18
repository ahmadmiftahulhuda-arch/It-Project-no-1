<?php
namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswa',
            'nama' => 'required',
            'kordinator' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        Mahasiswa::create($request->all());
        return redirect()->back()->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswa,nim,'.$mahasiswa->id,
            'nama' => 'required',
            'kordinator' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $mahasiswa->update($request->all());
        return redirect()->back()->with('success', 'Data mahasiswa berhasil diupdate');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();
        return redirect()->back()->with('success', 'Mahasiswa berhasil dihapus');
    }

    public function destroyAllByKelas($kela_id)
    {
        Mahasiswa::where('kelas_id', $kela_id)->delete();
        return redirect()->back()->with('success', 'Semua data mahasiswa di kelas ini berhasil dihapus.');
    }

    // =========== FUNGSI BARU UNTUK PENCARIAN ===========
    
    /**
     * API untuk pencarian mahasiswa berdasarkan kelas
     * Digunakan untuk pencarian AJAX/real-time
     */
    public function searchByKelas(Request $request, $kelas_id)
    {
        $searchTerm = $request->input('search', '');
        
        $mahasiswa = Mahasiswa::where('kelas_id', $kelas_id)
            ->when($searchTerm, function ($query) use ($searchTerm) {
                return $query->where(function ($q) use ($searchTerm) {
                    $q->where('nim', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('nama', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('kordinator', 'LIKE', "%{$searchTerm}%");
                });
            })
            ->orderBy('nama')
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $mahasiswa,
            'count' => $mahasiswa->count()
        ]);
    }
    
    /**
     * Fungsi untuk menampilkan halaman detail dengan filter
     * (Alternatif: mengganti route detail untuk menerima parameter search)
     */
    public function showDetailWithSearch(Request $request, $kelas_id)
    {
        $kelas = Kelas::findOrFail($kelas_id);
        $searchTerm = $request->input('search', '');
        
        $mahasiswa = Mahasiswa::where('kelas_id', $kelas_id)
            ->when($searchTerm, function ($query) use ($searchTerm) {
                return $query->where(function ($q) use ($searchTerm) {
                    $q->where('nim', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('nama', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('kordinator', 'LIKE', "%{$searchTerm}%");
                });
            })
            ->orderBy('nama')
            ->get();
        
        return view('admin.kelas.detail', [
            'kela' => $kelas,
            'mahasiswa' => $mahasiswa,
            'searchTerm' => $searchTerm
        ]);
    }
}