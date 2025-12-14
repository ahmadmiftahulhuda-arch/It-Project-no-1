<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\SpkCriterion;
use App\Models\SpkPenilaian;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SPKController extends Controller
{
    /**
     * ===============================
     * HALAMAN SPK (AHP + SAW)
     * ===============================
     */
    public function index()
    {
        // Semua kriteria (sudah punya bobot dari AHP)
        $criteria = SpkCriterion::orderBy('kode')->get();

        // Peminjaman yang sudah disetujui
        $peminjamans = Peminjaman::with(['user', 'ruangan', 'projector', 'spkPenilaian'])
            ->where('status', 'disetujui')
            ->get();

        // Nilai penilaian sebelumnya
        $scores = [];
        foreach ($peminjamans as $p) {
            foreach ($p->spkPenilaian as $sp) {
                $scores[$p->id][$sp->criterion_id] = $sp->nilai;
            }
        }

        // Ranking SAW
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
     * ===============================
     * SIMPAN NILAI SPK
     * ===============================
     */
    public function storeScores(Request $request)
    {
        $criteria = SpkCriterion::all();

        foreach ($request->scores as $peminjaman_id => $inputScores) {

            $peminjaman = Peminjaman::findOrFail($peminjaman_id);

            foreach ($criteria as $c) {

                /**
                 * ===============================
                 * K3 (JAM) → OTOMATIS
                 * ===============================
                 * Rumus Excel / Python:
                 * menit = jam * 60 + menit
                 */
                if ($c->kode === 'K3') {
                    $jamInput = Carbon::parse($peminjaman->created_at);
                    $nilai = ($jamInput->hour * 60) + $jamInput->minute;
                } else {
                    $nilai = $inputScores[$c->id] ?? null;
                }

                if ($nilai !== null) {
                    SpkPenilaian::updateOrCreate(
                        [
                            'peminjaman_id' => $peminjaman_id,
                            'criterion_id'  => $c->id,
                        ],
                        [
                            'nilai' => (float) $nilai
                        ]
                    );
                }
            }
        }

        // Hitung SAW
        $this->hitungSAW();

        return redirect()
            ->route('admin.spk.index')
            ->with('success', 'Penilaian SPK & SAW berhasil dihitung.');
    }

    /**
     * ===============================
     * PROSES SAW (SESUAI EXCEL)
     * ===============================
     */
    private function hitungSAW()
    {
        $criteria = SpkCriterion::all();
        $peminjamans = Peminjaman::with('spkPenilaian')->get();

        /**
         * ===============================
         * LANGKAH 1: PEMBAGI NORMALISASI
         * ===============================
         */
        $pembagi = [];

        foreach ($criteria as $c) {
            $nilai = $peminjamans
                ->pluck('spkPenilaian')
                ->flatten()
                ->where('criterion_id', $c->id)
                ->pluck('nilai')
                ->toArray();

            if (empty($nilai)) {
                $pembagi[$c->id] = 1;
            } else {
                $pembagi[$c->id] = ($c->tipe === 'cost')
                    ? min($nilai)
                    : max($nilai);
            }
        }

        /**
         * ===============================
         * LANGKAH 2: NORMALISASI + BOBOT
         * ===============================
         */
        foreach ($peminjamans as $p) {
            $preferensi = 0;

            foreach ($criteria as $c) {
                $penilaian = $p->spkPenilaian
                    ->where('criterion_id', $c->id)
                    ->first();

                if (!$penilaian) continue;

                $nilai = $penilaian->nilai;

                // Normalisasi SAW
                $normalisasi = ($c->tipe === 'cost')
                    ? $pembagi[$c->id] / $nilai
                    : $nilai / $pembagi[$c->id];

                // Bobot dari AHP
                $preferensi += $normalisasi * $c->bobot;
            }

            /**
             * ===============================
             * LANGKAH 3: SIMPAN HASIL
             * ===============================
             */
            $p->update([
                'nilai_preferensi' => round($preferensi, 4)
            ]);
        }
    }
}
