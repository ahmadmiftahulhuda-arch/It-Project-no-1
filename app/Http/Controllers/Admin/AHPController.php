<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AHPController extends Controller
{
    public function index()
    {
        return view('admin.ahp.index');
    }

    public function store(Request $request)
    {
        $matrix = $request->matrix;     // pairwise matrix
        $n = count($matrix);            // jumlah kriteria

        // 1. JUMLAH PER KOLOM
        $colSum = array_fill(0, $n, 0);
        for ($j = 0; $j < $n; $j++) {
            for ($i = 0; $i < $n; $i++) {
                $colSum[$j] += $matrix[$i][$j];
            }
        }

        // 2. NORMALISASI
        $normalized = [];
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $normalized[$i][$j] = $matrix[$i][$j] / $colSum[$j];
            }
        }

        // 3. EIGENVECTOR (rata-rata per baris)
        $eigenvector = [];
        for ($i = 0; $i < $n; $i++) {
            $eigenvector[$i] = array_sum($normalized[$i]) / $n;
        }

        // 4. HITUNG λMAX
        $lambdaMax = 0;
        for ($i = 0; $i < $n; $i++) {
            $rowSum = 0;
            for ($j = 0; $j < $n; $j++) {
                $rowSum += $matrix[$i][$j] * $eigenvector[$j];
            }
            $lambdaMax += $rowSum / $eigenvector[$i];
        }
        $lambdaMax = $lambdaMax / $n;

        // 5. CI
        $CI = ($lambdaMax - $n) / ($n - 1);

        // 6. RI TABLE
        $RI_TABLE = [
            1 => 0.00,
            2 => 0.00,
            3 => 0.58,
            4 => 0.90,
            5 => 1.12,
            6 => 1.24,
            7 => 1.32,
            8 => 1.41,
            9 => 1.45,
            10 => 1.49
        ];

        $RI = $RI_TABLE[$n];
        $CR = $CI / $RI;

        return back()->with([
            'success' => 'Perhitungan AHP Berhasil!',
            'matrix' => $matrix,
            'normalized' => $normalized,
            'eigenvector' => $eigenvector,
            'lambdaMax' => $lambdaMax,
            'CI' => $CI,
            'CR' => $CR,
            'status' => $CR < 0.1 ? "KONSISTEN" : "TIDAK KONSISTEN"
        ]);
    }
}
