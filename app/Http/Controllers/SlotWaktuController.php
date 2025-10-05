<?php

namespace App\Http\Controllers;

use App\Models\SlotWaktu;
use Illuminate\Http\Request;

class SlotWaktuController extends Controller
{
    public function index()
    {
        $slotWaktu = SlotWaktu::all();
        return view('slotwaktu.index', compact('slotWaktu'));
    }

    public function create()
    {
        return view('slotwaktu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_slot' => 'required|unique:slot_waktus,id_slot',
            'waktu' => 'required',
        ]);

        SlotWaktu::create($request->all());
        return redirect()->route('slotwaktu.index')->with('success', 'Slot waktu berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $slot = SlotWaktu::findOrFail($id);
        return view('slotwaktu.edit', compact('slot'));
    }

    public function update(Request $request, $id)
    {
        $slot = SlotWaktu::findOrFail($id);

        $request->validate([
            'id_slot' => 'required|unique:slot_waktus,id_slot,' . $slot->id,
            'waktu' => 'required',
        ]);

        $slot->update($request->all());
        return redirect()->route('slotwaktu.index')->with('success', 'Slot waktu berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $slot = SlotWaktu::findOrFail($id);
        $slot->delete();
        return redirect()->route('slotwaktu.index')->with('success', 'Slot waktu berhasil dihapus.');
    }
}
