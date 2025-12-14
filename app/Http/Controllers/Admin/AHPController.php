<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SpkCriterion;
use Carbon\Carbon;

class AHPController extends Controller
{
    /**
     * Halaman AHP
     */
    public function index()
    {
        $criteria = SpkCriterion::orderBy('kode')->get();
        return view('admin.spk.index', compact('criteria'));
    }

    /**
     * Hitung AHP & simpan bobot
     * SESUAI PYTHON & EXCEL
     */
    public function store(Request $request)
    {
        $matrix = $request->input('matrix', []);
        $n = count($matrix);

        $criteria = SpkCriterion::orderBy('kode')->get();

        /* ================= VALIDASI DASAR ================= */
        if ($n < 3) {
            return back()->with('error', 'Minimal 3 kriteria untuk perhitungan AHP.');
        }

        if ($criteria->count() !== $n) {
            return back()->with('error', 'Jumlah kriteria tidak sesuai dengan matriks AHP.');
        }

        /* ========= VALIDASI DIAGONAL & RESIPROKAL ========= */
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {

                if ($i === $j && (float)$matrix[$i][$j] !== 1.0) {
                    return back()->with('error', 'Nilai diagonal matriks AHP harus 1.');
                }

                if ($i !== $j) {
                    $expected = 1 / (float)$matrix[$j][$i];
                    if (abs((float)$matrix[$i][$j] - $expected) > 0.0001) {
                        return back()->with('error', 'Matriks AHP harus bersifat resiprokal.');
                    }
                }
            }
        }

        /* ================= 1. JUMLAH KOLOM ================= */
        $colSum = array_fill(0, $n, 0.0);
        for ($j = 0; $j < $n; $j++) {
            for ($i = 0; $i < $n; $i++) {
                $colSum[$j] += (float)$matrix[$i][$j];
            }
        }

        /* ================= 2. NORMALISASI ================= */
        $normalized = [];
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $normalized[$i][$j] = (float)$matrix[$i][$j] / $colSum[$j];
            }
        }

        /* ================= 3. EIGENVECTOR ================= */
        // (mean per baris) — SAMA DENGAN PYTHON
        $eigenvector = [];
        for ($i = 0; $i < $n; $i++) {
            $eigenvector[$i] = array_sum($normalized[$i]) / $n;
        }

        /* ================= 4. LAMBDA MAX ================= */
        // Python: Aw = matrix @ weight, lambda = mean(Aw / weight)
        $Aw = [];
        for ($i = 0; $i < $n; $i++) {
            $Aw[$i] = 0;
            for ($j = 0; $j < $n; $j++) {
                $Aw[$i] += (float)$matrix[$i][$j] * $eigenvector[$j];
            }
        }

        $lambdaValues = [];
        for ($i = 0; $i < $n; $i++) {
            $lambdaValues[$i] = $Aw[$i] / $eigenvector[$i];
        }

        $lambdaMax = array_sum($lambdaValues) / $n;

        /* ================= 5. CI & CR ================= */
        $CI = ($lambdaMax - $n) / ($n - 1);

        $RI_TABLE = [
            1 => 0.00, 2 => 0.00, 3 => 0.58, 4 => 0.90, 5 => 1.12,
            6 => 1.24, 7 => 1.32, 8 => 1.41, 9 => 1.45, 10 => 1.49
        ];

        $RI = $RI_TABLE[$n] ?? 0;
        $CR = ($RI > 0) ? ($CI / $RI) : 0;

        /* ================= 6. SIMPAN BOBOT ================= */
        foreach ($criteria as $i => $c) {
            $c->update([
                'bobot' => $eigenvector[$i]
            ]);
        }

        /* ================= RESPONSE ================= */
        return back()->with([
            'success'     => 'Perhitungan AHP berhasil dan bobot tersimpan.',
            'matrix'      => $matrix,
            'normalized'  => $normalized,
            'eigenvector' => $eigenvector,
            'lambdaMax'   => $lambdaMax,
            'CI'          => $CI,
            'CR'          => $CR,
            'status'      => $CR < 0.1 ? 'KONSISTEN' : 'TIDAK KONSISTEN'
        ]);
    }
}
