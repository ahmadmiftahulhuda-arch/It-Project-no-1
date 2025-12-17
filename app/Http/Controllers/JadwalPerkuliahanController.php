<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPerkuliahan;
use App\Models\MataKuliah;
use App\Models\Kelas;
use App\Models\SlotWaktu;
use App\Models\Ruangan;
use App\Imports\JadwalPerkuliahanImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Exports\JadwalPerkuliahanExport;

class JadwalPerkuliahanController extends Controller
{
    /**
     * Tampilkan daftar jadwal perkuliahan dengan filter dan pagination
     */
    public function index(Request $request)
    {
        // Filter input
        $filters = [
            'search' => $request->search,
            'hari' => $request->hari,
            'ruangan' => $request->ruangan,
            'ruangan_id' => $request->ruangan_id ?? $request->ruangan, // accept either
            'nama_kelas' => $request->nama_kelas,
            'sistem_kuliah' => $request->sistem_kuliah,
            'sort' => $request->sort ?? 'hari',
        ];

        // Query dasar dengan filter dinamis
        $jadwal = JadwalPerkuliahan::query();

        // Pencarian umum
        if ($filters['search']) {
            $jadwal->where(function ($q) use ($filters) {
                $q->where('kode_matkul', 'like', "%{$filters['search']}%")
                    ->orWhere('nama_kelas', 'like', "%{$filters['search']}%")
                    ->orWhere('ruangan', 'like', "%{$filters['search']}%")
                    ->orWhere('hari', 'like', "%{$filters['search']}%");
            });
        }

        // Filter spesifik
        if (!empty($filters['hari'])) {
            $jadwal->where('hari', $filters['hari']);
        }

        // filter by ruangan_id (preferred) or ruangan name
        if (!empty($filters['ruangan_id'])) {
            $room = Ruangan::find($filters['ruangan_id']);
            if ($room) {
                $jadwal->where('ruangan', $room->nama_ruangan ?? $room->name ?? $room->ruangan);
            }
        } elseif (!empty($filters['ruangan'])) {
            $jadwal->where('ruangan', $filters['ruangan']);
        }

        if (!empty($filters['nama_kelas'])) {
            $jadwal->where('nama_kelas', $filters['nama_kelas']);
        }

        if (!empty($filters['sistem_kuliah'])) {
            $jadwal->where('sistem_kuliah', $filters['sistem_kuliah']);
        }

        // Sorting data
        switch ($filters['sort']) {
            case 'matkul':
                $jadwal->orderBy('kode_matkul');
                break;
            case 'kelas':
                $jadwal->orderBy('nama_kelas');
                break;
            default:
                $jadwal->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat')")
                    ->orderBy('jam_mulai');
                break;
        }

        // Pagination
        $jadwal = $jadwal->paginate(10);

        // Data dropdown filter
        $hariList = JadwalPerkuliahan::distinct()->pluck('hari');
        $ruanganList = JadwalPerkuliahan::distinct()->pluck('ruangan');
        $sistemKuliahList = JadwalPerkuliahan::distinct()->pluck('sistem_kuliah');
        $mataKuliahs = MataKuliah::all();
        $kelas = Kelas::all();
        // provide slot and ruangan collections for modals
        $slotwaktu = SlotWaktu::orderBy('waktu')->get();
        $ruangan = Ruangan::orderBy('nama_ruangan')->get();

        // ==========================
        // STATISTIK JADWAL
        // ==========================
        $totalCount = JadwalPerkuliahan::count();

        $hariCounts = JadwalPerkuliahan::select(
            DB::raw('TRIM(hari) as hari'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy(DB::raw('TRIM(hari)'))
            ->pluck('total', 'hari');

        // Mapping ke variabel Blade (WAJIB)
        $seninCount  = $hariCounts['Senin']  ?? 0;
        $selasaCount = $hariCounts['Selasa'] ?? 0;
        $rabuCount   = $hariCounts['Rabu']   ?? 0;
        $kamisCount  = $hariCounts['Kamis']  ?? 0;
        $jumatCount  = $hariCounts['Jumat']  ?? 0;


        return view('admin.jadwal-perkuliahan.index', compact(
            'jadwal',
            'hariList',
            'ruanganList',
            'sistemKuliahList',
            'totalCount',
            'seninCount',
            'selasaCount',
            'rabuCount',
            'kamisCount',
            'jumatCount',
            'filters',
            'mataKuliahs',
            'kelas',
            'slotwaktu',
            'ruangan'
        ));
    }

    /**
                    $slotList = SlotWaktu::orderBy('waktu')->get();
                    // Provide variables matching other views
                    $slotwaktu = $slotList;
                    $ruangan = Ruangan::all();
     */
    public function create()
    {
        $mataKuliahs = MataKuliah::all();
        $kelas = Kelas::all();
        return view('admin.jadwal-perkuliahan.create', compact('mataKuliahs', 'kelas'));
    }

    /**
     * Simpan data baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_matkul' => 'required|string',
            'sistem_kuliah' => 'nullable|string',
            'nama_kelas' => 'required|string',
            'kelas_mahasiswa' => 'nullable|string',
            'sebaran_mahasiswa' => 'nullable|string',
            'hari' => 'required|string',
            'jam_mulai' => 'required|string',
            'jam_selesai' => 'required|string',
            'ruangan_id' => 'required|exists:ruangan,id',
            'daya_tampung' => 'nullable|integer',
        ]);

        // map ruangan_id to ruangan name for existing schema
        $room = Ruangan::find($validated['ruangan_id']);
        $validated['ruangan'] = $room->nama_ruangan ?? $room->name ?? '';
        unset($validated['ruangan_id']);

        JadwalPerkuliahan::create($validated);

        return redirect()->route('jadwal-perkuliahan.index')
            ->with('success', 'Jadwal perkuliahan berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit
                        'slotwaktu',
                        'ruangan'
     */
    public function edit(JadwalPerkuliahan $jadwalPerkuliahan)
    {
        return view('admin.jadwal-perkuliahan.edit', compact('jadwalPerkuliahan'));
    }

    /**
     * Update data jadwal yang sudah ada
     */
    public function update(Request $request, JadwalPerkuliahan $jadwalPerkuliahan)
    {
        $validated = $request->validate([
            'kode_matkul' => 'required|string',
            'sistem_kuliah' => 'nullable|string',
            'nama_kelas' => 'required|string',
            'kelas_mahasiswa' => 'nullable|string',
            'sebaran_mahasiswa' => 'nullable|string',
            'hari' => 'required|string',
            'jam_mulai' => 'required|string',
            'jam_selesai' => 'required|string',
            'ruangan_id' => 'required|exists:ruangan,id',
            'daya_tampung' => 'nullable|integer',
        ]);

        $room = Ruangan::find($validated['ruangan_id']);
        $validated['ruangan'] = $room->nama_ruangan ?? $room->name ?? '';
        unset($validated['ruangan_id']);

        $jadwalPerkuliahan->update($validated);

        return redirect()->route('jadwal-perkuliahan.index')
            ->with('success', 'Jadwal perkuliahan berhasil diperbarui.');
    }

    /**
     * Hapus satu jadwal
     */
    public function destroy(JadwalPerkuliahan $jadwalPerkuliahan)
    {
        $jadwalPerkuliahan->delete();

        return redirect()->route('jadwal-perkuliahan.index')
            ->with('success', 'Jadwal perkuliahan berhasil dihapus.');
    }

    /**
     * Import data dari file Excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        try {
            Excel::import(new JadwalPerkuliahanImport, $request->file('file'));
            return redirect()->route('jadwal-perkuliahan.index')
                ->with('success', 'Data jadwal perkuliahan berhasil diimpor dari Excel.');
        } catch (\Exception $e) {
            return redirect()->route('jadwal-perkuliahan.index')
                ->with('error', 'Gagal mengimpor data: ' . $e->getMessage());
        }
    }

    /**
     * Hapus semua data jadwal
     */
    public function deleteAll()
    {
        try {
            JadwalPerkuliahan::truncate();
            return redirect()->route('jadwal-perkuliahan.index')
                ->with('success', 'Semua data jadwal berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('jadwal-perkuliahan.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
    public function export(Request $request)
    {
        $filters = [
            'search' => $request->search,
            'hari' => $request->hari,
            'ruangan' => $request->ruangan,
            'sistem_kuliah' => $request->sistem_kuliah,
        ];

        return Excel::download(
            new JadwalPerkuliahanExport($filters),
            'jadwal_perkuliahan.xlsx'
        );
    }
}
