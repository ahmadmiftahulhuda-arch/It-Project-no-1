<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpkCriterion;
use App\Models\SpkPenilaian;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class SPKController extends Controller
{
    public function index()
    {
        $criteria = SpkCriterion::ordered()->get();
        // Use approved bookings as alternatives for ranking (adjust as needed)
        $peminjamans = Peminjaman::whereRaw("LOWER(COALESCE(status,'')) = ?", ['disetujui'])->get();

        return view('admin.spk.index', compact('criteria','peminjamans'));
    }

    public function storePenilaian(Request $request)
    {
        foreach ($request->nilai as $peminjaman_id => $criterias) {
            foreach ($criterias as $criterion_id => $nilai) {
                SpkPenilaian::updateOrCreate(
                    [
                        'peminjaman_id' => $peminjaman_id,
                        'criterion_id' => $criterion_id
                    ],
                    ['nilai' => $nilai]
                );
            }
        }

        return back()->with('success','Penilaian tersimpan!');
    }

    // New method to match route name `storeScores`
    public function storeScores(Request $request)
    {
        // Expecting input structure: scores[peminjaman_id][criterion_id] = value
        $scores = $request->input('scores', []);
        foreach ($scores as $peminjaman_id => $criterias) {
            foreach ($criterias as $criterion_id => $nilai) {
                SpkPenilaian::updateOrCreate(
                    [
                        'peminjaman_id' => $peminjaman_id,
                        'criterion_id' => $criterion_id
                    ],
                    ['nilai' => $nilai]
                );
            }
        }

        return back()->with('success', 'Penilaian tersimpan!');
    }

    public function saw()
    {
        $criteria = SpkCriterion::all();
        $peminjamans = Peminjaman::with('spkPenilaian')->get();
        // --- AMBIL BOBOT AHP (jika ada) ---
        $ahpSettings = \App\Models\AHPSetting::all()->pluck('weight','criteria')->toArray();

        // --- NORMALISASI SAW (kunci by peminjaman id) ---
        $normal = [];
        foreach ($criteria as $k) {
            // build associative array peminjaman_id => nilai
            $col = [];
            foreach ($peminjamans as $p) {
                $val = optional($p->spkPenilaian->where('criterion_id', $k->id)->first())->nilai;
                $col[$p->id] = $val !== null ? (float)$val : 0.0;
            }

            if ($k->jenis == 'benefit') {
                $max = max($col) ?: 1;
                foreach ($col as $pid => $v) {
                    $normal[$k->id][$pid] = $max > 0 ? ($v / $max) : 0;
                }
            } else {
                // cost-type
                $min = min(array_filter($col, fn($x) => $x > 0)) ?: 1;
                foreach ($col as $pid => $v) {
                    $normal[$k->id][$pid] = ($v > 0) ? ($min / $v) : 0;
                }
            }
        }

        // --- HITUNG RANKING DENGAN BOBOT AHP ---
        $hasil = [];
        $totalCriteria = max(1, count($criteria));
        foreach ($peminjamans as $p) {
            $total = 0;
            foreach ($criteria as $k) {
                $n = $normal[$k->id][$p->id] ?? 0;
                // try to find weight by kode or nama in ahp settings
                $weight = null;
                if (isset($ahpSettings[$k->kode ?? ''])) $weight = (float)$ahpSettings[$k->kode];
                if ($weight === null && isset($ahpSettings[$k->nama ?? ''])) $weight = (float)$ahpSettings[$k->nama];
                if ($weight === null) $weight = 1 / $totalCriteria;
                $total += $n * $weight;
            }
            $hasil[$p->id] = $total;
        }

        arsort($hasil);

        return view('admin.spk.hasil', compact('hasil','criteria','peminjamans'));
    }
}
