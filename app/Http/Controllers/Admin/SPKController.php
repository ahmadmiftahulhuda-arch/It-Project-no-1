<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpkCriterion;
use App\Models\SpkPenilaian;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class SPKController extends Controller
{
    /**
     * Halaman SPK (AHP + SAW)
     */
    public function index()
    {
        // 1. Ambil kriteria + bobot AHP
        $criteria = SpkCriterion::orderBy('kode')->get();

        // 2. Ambil peminjaman yang disetujui
        $peminjamans = Peminjaman::with(['ruangan', 'projector', 'user', 'spkPenilaian'])
            ->whereRaw("LOWER(COALESCE(status,'')) = ?", ['disetujui'])
            ->get();


        // 3. Ambil nilai penilaian lama (jika ada)
        $scores = [];
        $penilaian = SpkPenilaian::whereIn(
            'peminjaman_id',
            $peminjamans->pluck('id')
        )->get();

        foreach ($penilaian as $p) {
            $scores[$p->peminjaman_id][$p->criterion_id] = $p->nilai;
        }

        // 4. Ambil hasil ranking SAW (INI YANG SEBELUMNYA HILANG)
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
     * Simpan penilaian & hitung SAW
     */
    public function storeScores(Request $request)
    {
        $scores = $request->input('scores', []);

        // 1. Simpan nilai penilaian
        foreach ($scores as $peminjaman_id => $criterias) {
            foreach ($criterias as $criterion_id => $nilai) {
                SpkPenilaian::updateOrCreate(
                    [
                        'peminjaman_id' => $peminjaman_id,
                        'criterion_id'  => $criterion_id,
                    ],
                    [
                        'nilai' => (float)$nilai
                    ]
                );
            }
        }

        // 2. Hitung SAW
        $this->hitungSAW();

        return redirect()
            ->route('admin.spk.index')
            ->with('success', 'Penilaian tersimpan & SAW berhasil dihitung.');
    }

    /**
     * ==========================
     * INTI PERHITUNGAN SAW
     * (SAMA DENGAN PYTHON)
     * ==========================
     */
    private function hitungSAW(): void
    {
        $criteria = SpkCriterion::orderBy('kode')->get();

        // Ambil peminjaman + penilaian
        $peminjamans = Peminjaman::with('spkPenilaian')->get();

        /**
         * 1. Hitung pembagi normalisasi
         * BENEFIT → max
         * COST    → min
         */
        $pembagi = [];

        foreach ($criteria as $c) {
            $values = [];

            foreach ($peminjamans as $p) {
                $nilai = optional(
                    $p->spkPenilaian->where('criterion_id', $c->id)->first()
                )->nilai;

                if ($nilai !== null) {
                    $values[] = (float)$nilai;
                }
            }

            if (count($values) === 0) {
                $pembagi[$c->id] = 1;
            } else {
                $pembagi[$c->id] = ($c->tipe === 'cost')
                    ? min($values)
                    : max($values);
            }

            if ($pembagi[$c->id] == 0) {
                $pembagi[$c->id] = 1;
            }
        }

        /**
         * 2. Hitung nilai preferensi
         * normalisasi × bobot
         */
        foreach ($peminjamans as $p) {
            $preferensi = 0;

            foreach ($criteria as $c) {
                $nilai = optional(
                    $p->spkPenilaian->where('criterion_id', $c->id)->first()
                )->nilai;

                if ($nilai === null) {
                    continue;
                }

                $nilai = (float)$nilai;

                // Normalisasi (SAMA DENGAN PYTHON)
                if ($c->tipe === 'cost') {
                    $normalisasi = $pembagi[$c->id] / $nilai;
                } else {
                    $normalisasi = $nilai / $pembagi[$c->id];
                }

                $preferensi += $normalisasi * (float)$c->bobot;
            }

            $p->nilai_preferensi = round($preferensi, 8);
            $p->save();
        }
    }
}
