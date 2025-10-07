<?php

namespace App\Http\Controllers;

use App\Models\SlotWaktu;
use Illuminate\Http\Request;

class SlotWaktuController extends Controller
{
    /**
     * Menampilkan semua data slot waktu dengan fitur pencarian
     */
    public function index(Request $request)
    {
        $query = SlotWaktu::query();
        
        // Pencarian berdasarkan input pengguna
        if ($request->has('cari') && !empty($request->cari)) {
            $searchTerm = $request->cari;
            
            // Tentukan jenis pencarian
            $searchType = $request->get('search_type', 'jam'); // default ke pencarian jam
            
            if ($searchType == 'id') {
                // Pencarian berdasarkan ID slot
                $query->where('id_slot', 'LIKE', '%' . $searchTerm . '%');
            } else {
                // Pencarian berdasarkan jam/waktu
                $query->where('waktu', 'LIKE', '%' . $searchTerm . '%');
            }
        }
        
        $slotwaktu = $query->get();
        
        return view('admin.slotwaktu.index', compact('slotwaktu'));
    }

    /**
     * Menampilkan form tambah slot waktu
     */
    public function create()
    {
        return view('admin.slotwaktu.create');
    }

    /**
     * Menyimpan data slot waktu baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_slot' => 'required|unique:slot_waktus,id_slot',
            'waktu' => 'required',
        ], [
            'id_slot.required' => 'ID Slot wajib diisi.',
            'id_slot.unique' => 'ID Slot sudah digunakan.',
            'waktu.required' => 'Waktu wajib diisi.',
        ]);

        SlotWaktu::create([
            'id_slot' => $request->id_slot,
            'waktu' => $request->waktu,
        ]);

        return redirect()->route('admin.slotwaktu.index')->with('success', 'Slot waktu berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit untuk slot waktu tertentu
     */
    public function edit($id)
    {
        $slot = SlotWaktu::findOrFail($id);
        return view('admin.slotwaktu.edit', compact('slot'));
    }

    /**
     * Memperbarui data slot waktu
     */
    public function update(Request $request, $id)
    {
        $slot = SlotWaktu::findOrFail($id);

        $request->validate([
            'id_slot' => 'required|unique:slot_waktus,id_slot,' . $slot->id,
            'waktu' => 'required',
        ], [
            'id_slot.required' => 'ID Slot wajib diisi.',
            'id_slot.unique' => 'ID Slot sudah digunakan.',
            'waktu.required' => 'Waktu wajib diisi.',
        ]);

        $slot->update([
            'id_slot' => $request->id_slot,
            'waktu' => $request->waktu,
        ]);

        return redirect()->route('admin.slotwaktu.index')->with('success', 'Slot waktu berhasil diperbarui.');
    }

    /**
     * Menghapus data slot waktu
     */
    public function destroy($id)
    {
        $slot = SlotWaktu::findOrFail($id);
        $slot->delete();

        return redirect()->route('admin.slotwaktu.index')->with('success', 'Slot waktu berhasil dihapus.');
    }
}