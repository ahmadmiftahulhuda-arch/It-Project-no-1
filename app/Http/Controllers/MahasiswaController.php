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
            'nim' => 'required|unique:mahasiswa',
            'nama' => 'required',
            'program_studi' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        Mahasiswa::create($request->all());
        return redirect()->back()->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa,nim,'.$mahasiswa->id,
            'nama' => 'required',
            'program_studi' => 'required',
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
}
