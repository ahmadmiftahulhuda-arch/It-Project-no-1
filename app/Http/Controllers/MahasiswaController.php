<?php
namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|numeric|unique:mahasiswa',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
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
            'jenis_kelamin' => 'required',
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
}
