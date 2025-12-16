<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\SpkCriterion;
use App\Models\SpkPenilaian;
use Illuminate\Http\Request;

class SPKController extends Controller
{
    /* =====================================================
     * HALAMAN SPK UTAMA (AHP + SAW PEMINJAMAN ASLI)
     * ===================================================== */
    public function index(Request $request)
    {
        // Ambil tanggal yang dipilih (default adalah hari ini)
        $filterDate = $request->input('filter_date', date('Y-m-d'));

        // Ambil kriteria SPK
        $criteria = SpkCriterion::orderBy('kode')->get();

        // Ambil data peminjaman dengan filter berdasarkan tanggal
        $peminjamans = Peminjaman::with([
            'user',
            'ruangan',
            'projector',
            'spkPenilaian',
            'feedback'
        ])
            ->where('status', 'pending')
            ->whereDate('tanggal', $filterDate) // Filter berdasarkan tanggal
            ->get();

        $scores = [];
        foreach ($peminjamans as $p) {
            foreach ($p->spkPenilaian as $sp) {
                $scores[$p->id][$sp->criterion_id] = $sp->nilai;
            }
        }

        // Urutkan berdasarkan nilai preferensi setelah dihitung
        $this->hitungSAWPeminjaman($peminjamans, $criteria);

        $rankings = Peminjaman::whereNotNull('nilai_preferensi')
            ->where('status', 'pending')
            ->whereDate('tanggal', $filterDate) // Filter berdasarkan tanggal
            ->orderByDesc('nilai_preferensi')
            ->get();

        return view('admin.spk.index', compact(
            'criteria',
            'peminjamans',
            'scores',
            'rankings',
            'filterDate'
        ));
    }


    /* =====================================================
     * SIMPAN NILAI SPK PEMINJAMAN ASLI
     * ===================================================== */
    public function storeScores(Request $request)
    {
        if (!$request->has('scores')) {
            return back()->with('error', 'Tidak ada data penilaian.');
        }

        $criteria = SpkCriterion::all();

        // Ambil data peminjaman yang relevan
        $peminjamans = Peminjaman::with([
            'user',
            'ruangan',
            'projector',
            'spkPenilaian',
            'feedback'
        ])
            ->where('status', 'pending')
            ->get();

        // Simpan penilaian
        foreach ($request->scores as $peminjamanId => $nilaiInput) {
            foreach ($criteria as $c) {
                if (!isset($nilaiInput[$c->kode])) continue;

                SpkPenilaian::updateOrCreate(
                    [
                        'peminjaman_id' => $peminjamanId,
                        'criterion_id'  => $c->id,
                    ],
                    [
                        'nilai' => (float) $nilaiInput[$c->kode]
                    ]
                );
            }
        }

        // Panggil hitungSAWPeminjaman dengan parameter yang tepat
        $this->hitungSAWPeminjaman($peminjamans, $criteria);

        return redirect()
            ->route('admin.spk.index')
            ->with('success', 'Penilaian SPK & SAW peminjaman berhasil dihitung.');
    }

    /* =====================================================
     * SAW PEMINJAMAN ASLI
     * ===================================================== */
    private function hitungSAWPeminjaman($peminjamans, $criteria)
    {
        if ($peminjamans->isEmpty() || $criteria->isEmpty()) return;

        $pembagi = [];

        // Hitung pembagi untuk setiap kriteria (AHP)
        foreach ($criteria as $c) {
            $nilai = $peminjamans->pluck('spkPenilaian')
                ->flatten()
                ->where('criterion_id', $c->id)
                ->pluck('nilai')
                ->filter(fn($v) => $v > 0)
                ->toArray();

            $pembagi[$c->id] = empty($nilai)
                ? 1
                : ($c->tipe === 'cost' ? min($nilai) : max($nilai));
        }

        // Hitung nilai preferensi untuk setiap peminjaman (SAW)
        foreach ($peminjamans as $p) {
            $preferensi = 0;

            foreach ($criteria as $c) {
                $nilai = optional(
                    $p->spkPenilaian->where('criterion_id', $c->id)->first()
                )->nilai;

                if (!$nilai || $nilai <= 0) continue;

                $normalisasi = ($c->tipe === 'cost')
                    ? $pembagi[$c->id] / $nilai
                    : $nilai / $pembagi[$c->id];

                $preferensi += $normalisasi * ($c->bobot ?? 0);
            }

            $p->update([
                'nilai_preferensi' => round($preferensi, 6)
            ]);
        }
    }
}
