<?php

namespace App\Http\Controllers;

use App\Models\Projector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Projector::query();
        
        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kode_proyektor', 'like', "%{$search}%")
                  ->orWhere('merk', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%")
                  ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }
        
        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Filter berdasarkan merk
        if ($request->has('merk') && $request->merk != '') {
            $query->where('merk', $request->merk);
        }
        
        // Sorting
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'kode':
                $query->orderBy('kode_proyektor', 'asc');
                break;
            default:
                $query->latest();
                break;
        }
        
        $projectors = $query->paginate(10);
        
        // Hitung statistik
        $totalCount = Projector::count();
        $tersediaCount = Projector::where('status', 'tersedia')->count();
        $dipinjamCount = Projector::where('status', 'dipinjam')->count();
        $rusakCount = Projector::where('status', 'rusak')->count();
        
        // Ambil daftar merk untuk filter
        $merks = Projector::distinct()->pluck('merk')->toArray();
        
        return view('admin.projectors.index', compact(
            'projectors', 
            'totalCount',
            'tersediaCount',
            'dipinjamCount',
            'rusakCount',
            'merks'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projectors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_proyektor' => 'required|unique:projectors',
            'merk' => 'required',
            'model' => 'required',
            'status' => 'required|in:tersedia,dipinjam,rusak',
            'keterangan' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Projector::create($request->all());

        return redirect()->route('projectors.index')
            ->with('success', 'Proyektor berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Projector $projector)
    {
        return view('admin.projectors.show', compact('projector'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projector $projector)
    {
        return view('admin.projectors.edit', compact('projector'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projector $projector)
    {
        $validator = Validator::make($request->all(), [
            'kode_proyektor' => 'required|unique:projectors,kode_proyektor,' . $projector->id,
            'merk' => 'required',
            'model' => 'required',
            'status' => 'required|in:tersedia,dipinjam,rusak',
            'keterangan' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $projector->update($request->all());

        return redirect()->route('projectors.index')
            ->with('success', 'Proyektor berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projector $projector)
    {
        try {
            $projector->delete();
            return redirect()->route('projectors.index')
                ->with('success', 'Proyektor berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('projectors.index')
                ->with('error', 'Gagal menghapus proyektor: ' . $e->getMessage());
        }
    }
}