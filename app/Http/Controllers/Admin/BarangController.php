<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Barang::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_barang', 'like', "%{$search}%")
                    ->orWhere('nama_barang', 'like', "%{$search}%")
                    ->orWhere('model_barang', 'like', "%{$search}%")
                    ->orWhere('merek_barang', 'like', "%{$search}%")
                    ->orWhere('keterangan_barang', 'like', "%{$search}%");
            });
        }

        if ($request->has('status_barang') && $request->status_barang != '') {
            $query->where('status_barang', $request->status_barang);
        }

        if ($request->has('merek_barang') && $request->merek_barang != '') {
            $query->where('merek_barang', $request->merek_barang);
        }

        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'kode':
                $query->orderBy('kode_barang', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

        $barangs = $query->paginate(10);

        $totalCount = Barang::count();
        $tersediaCount = Barang::where('status_barang', 'tersedia')->count();
        $dipinjamCount = Barang::where('status_barang', 'dipinjam')->count();
        $rusakCount = Barang::where('status_barang', 'rusak')->count();

        $mereks = Barang::distinct()->pluck('merek_barang')->toArray();

        return view('admin.barangs.index', compact(
            'barangs',
            'totalCount',
            'tersediaCount',
            'dipinjamCount',
            'rusakCount',
            'mereks'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.barangs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required|unique:barangs',
            'nama_barang' => 'required',
            'model_barang' => 'required',
            'merek_barang' => 'required',
            'status_barang' => 'required|in:tersedia,dipinjam,rusak',
            'keterangan_barang' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Barang::create($request->all());

        return redirect()->route('barangs.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        return redirect()->route('barangs.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return view('admin.barangs.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required|unique:barangs,kode_barang,' . $barang->id,
            'nama_barang' => 'required',
            'model_barang' => 'required',
            'merek_barang' => 'required',
            'status_barang' => 'required|in:tersedia,dipinjam,rusak',
            'keterangan_barang' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $barang->update($request->all());

        return redirect()->route('barangs.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        try {
            $barang->delete();
            return redirect()->route('barangs.index')
                ->with('success', 'Barang berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('barangs.index')
                ->with('error', 'Gagal menghapus barang: ' . $e->getMessage());
        }
    }
}
