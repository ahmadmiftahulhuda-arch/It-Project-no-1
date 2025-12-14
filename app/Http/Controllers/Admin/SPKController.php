<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpkCriterion;
use App\Models\SpkPenilaian;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SPKController extends Controller
{
    /**
     * Halaman SPK (AHP + SAW)
     */
    public function index()
    {
        $criteria = SpkCriterion::orderBy('kode')->get();

        $peminjamans = Peminjaman::whereRaw(
            "LOWER(COALESCE(status,'')) = ?",
            ['disetujui']
        )->get();

        // Nilai lama
        $scores = [];
        $penilaian = SpkPenilaian::whereIn(
            'peminjaman_id',
            $peminjamans->pluck('id')
        )->get();

        foreach ($penilaian as $p) {
            $scores[$p->peminjaman_id][$p->criterion_id] = $p->nilai;
        }

        // Ranking jika sudah ada
        $rankings = Peminjaman::whereNotNull('nilai_preferensi')
            ->orderByDesc('nilai_preferensi')
            ->get();

        return view('admin.spk.index', compact(
            'criteria',
            'peminjamans',
            'scores',
            'rankings'
        ));
    }

    /**
     * Simpan nilai alternatif & hitung SAW
     */
    public function storeScores(Request $request)
    {
        $request->validate([
            'scores' => 'required|array'
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->scores as $peminjaman_id => $criterias) {
                foreach ($criterias as $criterion_id => $nilai) {
                    SpkPenilaian::updateOrCreate(
                        [
                            'peminjaman_id' => $peminjaman_id,
                            'criterion_id'  => $criterion_id,
                        ],
                        [
                            'nilai' => (float) $nilai
                        ]
                    );
                }
            }

            $this->hitungDanSimpanSAW();
        });

        return back()->with('success', 'Penilaian tersimpan & SAW berhasil dihitung.');
    }

    /**
     * PROSES INTI SAW
     */
    private function hitungDanSimpanSAW(): void
    {
        $criteria = SpkCriterion::orderBy('kode')->get();
        $peminjamans = Peminjaman::with('spkPenilaian')->get();

        // ===============================
        // 1. Pembagi normalisasi
        // ===============================
        $pembagi = [];

        foreach ($criteria as $c) {
            $values = [];

            foreach ($peminjamans as $p) {
                $nilai = optional(
                    $p->spkPenilaian
                        ->where('criterion_id', $c->id)
                        ->first()
                )->nilai;

                if ($nilai !== null) {
                    $values[] = (float) $nilai;
                }
            }

            if (empty($values)) {
                $pembagi[$c->id] = 1.0;
            } else {
                $pembagi[$c->id] = $c->tipe === 'benefit'
                    ? max($values)
                    : min($values);

                if ($pembagi[$c->id] == 0) {
                    $pembagi[$c->id] = 1.0;
                }
            }
        }

        // ===============================
        // 2. Hitung nilai preferensi
        // ===============================
        foreach ($peminjamans as $p) {
            $preferensi = 0.0;

            foreach ($criteria as $c) {
                $nilai = optional(
                    $p->spkPenilaian
                        ->where('criterion_id', $c->id)
                        ->first()
                )->nilai;

                if ($nilai === null) continue;

                $nilai = (float) $nilai;

                $normalisasi = $c->tipe === 'benefit'
                    ? $nilai / $pembagi[$c->id]
                    : ($nilai != 0 ? $pembagi[$c->id] / $nilai : 0);

                $preferensi += $normalisasi * (float) $c->bobot;
            }

            $p->nilai_preferensi = round($preferensi, 8);
            $p->save();
        }
    }
}
