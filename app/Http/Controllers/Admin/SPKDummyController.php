<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\SpkCriterion;
use App\Models\Dosen;
use App\Models\Mahasiswa;

class SPKDummyController extends Controller
{
    // cari kolom nama yang paling mungkin ada
    private function detectNameColumn(string $table): ?string
    {
        $candidates = [
            'nama', 'nama_lengkap', 'nama_dosen', 'nama_mahasiswa',
            'nm', 'nm_dosen', 'nm_mahasiswa',
            'name', 'full_name',
            'dosen', 'mahasiswa'
        ];

        foreach ($candidates as $col) {
            if (Schema::hasColumn($table, $col)) return $col;
        }

        // fallback: ambil kolom string pertama
        $cols = Schema::getColumnListing($table);
        foreach ($cols as $col) {
            // abaikan id/timestamp umum
            if (in_array($col, ['id', 'created_at', 'updated_at', 'deleted_at'])) continue;
            // kita coba saja pakai kolom pertama (lebih aman daripada error)
            return $col;
        }

        return null;
    }

    public function index(Request $request)
    {
        $criteria = SpkCriterion::orderBy('kode')->get();

        // pastikan kriteria K1..K5 ada
        $required = ['K1','K2','K3','K4','K5'];
        foreach ($required as $rk) {
            if (!$criteria->firstWhere('kode', $rk)) {
                return back()->with('error', "Kriteria {$rk} belum ada di tabel spk_criteria.");
            }
        }

        // =========================
        // DROPDOWN ALTERNATIF (DOSEN + MAHASISWA)
        // tanpa asumsi kolom "nama"
        // =========================
        $alternatifList = collect();

        $dosenNameCol = $this->detectNameColumn((new Dosen)->getTable());
        $mhsNameCol   = $this->detectNameColumn((new Mahasiswa)->getTable());

        if ($dosenNameCol) {
            foreach (Dosen::query()->select($dosenNameCol)->get() as $d) {
                $nm = trim((string)($d->{$dosenNameCol} ?? ''));
                if ($nm !== '') $alternatifList->push("Dosen - ".$nm);
            }
        }

        if ($mhsNameCol) {
            foreach (Mahasiswa::query()->select($mhsNameCol)->get() as $m) {
                $nm = trim((string)($m->{$mhsNameCol} ?? ''));
                if ($nm !== '') $alternatifList->push("Mahasiswa - ".$nm);
            }
        }

        $alternatifList = $alternatifList->unique()->values();

        // belum submit -> tampil form saja
        if (!$request->has('nilai')) {
            return view('admin.spk.dummy', compact('criteria', 'alternatifList'));
        }

        // =========================
        // AMBIL INPUT
        // nilai[index][nama], nilai[index][K1..K5]
        // =========================
        $input = $request->input('nilai', []);
        $input = array_values(array_filter($input, function ($row) {
            return isset($row['nama']) && trim($row['nama']) !== '';
        }));

        if (count($input) < 1) {
            return back()->with('error', 'Minimal pilih 1 alternatif untuk dihitung.');
        }

        // =========================
        // STEP 1 – MATRIX KEPUTUSAN (X)
        // =========================
        $matrixX = collect();

        foreach ($input as $row) {
            $r = ['nama' => $row['nama']];

            foreach ($criteria as $c) {
                if (!in_array($c->kode, $required)) continue;

                $val = (float)($row[$c->kode] ?? 0);

                // wajib >0 agar tidak division by zero
                if ($val <= 0) $val = 1;

                $r[$c->kode] = $val;
            }

            $matrixX->push($r);
        }

        // =========================
        // STEP 2 – MAX & MIN
        // =========================
        $max = [];
        $min = [];

        foreach ($required as $k) {
            $max[$k] = (float)$matrixX->max($k);
            $min[$k] = (float)$matrixX->min($k);

            if ($max[$k] <= 0) $max[$k] = 1;
            if ($min[$k] <= 0) $min[$k] = 1;
        }

        // =========================
        // STEP 3 – NORMALISASI (R)
        // benefit: x/max
        // cost   : min/x
        // =========================
        $matrixR = $matrixX->map(function ($row) use ($criteria, $max, $min, $required) {
            $r = ['nama' => $row['nama']];

            foreach ($criteria as $c) {
                if (!in_array($c->kode, $required)) continue;

                $x = (float)$row[$c->kode];
                if ($x <= 0) $x = 1;

                $tipe = strtolower((string)$c->tipe);

                if ($tipe === 'benefit') {
                    $r[$c->kode] = $x / $max[$c->kode];
                } else {
                    $r[$c->kode] = $min[$c->kode] / $x;
                }
            }

            return $r;
        });

        // =========================
        // STEP 4 – NILAI PREFERENSI (V)
        // V = Σ (w_j * r_ij)
        // =========================
        $hasil = $matrixR->map(function ($row) use ($criteria, $required) {
            $total = 0;

            foreach ($criteria as $c) {
                if (!in_array($c->kode, $required)) continue;

                $w = (float)$c->bobot;
                $total += $w * (float)$row[$c->kode];
            }

            return [
                'nama' => $row['nama'],
                'preferensi' => round($total, 6),
            ];
        });

        // =========================
        // STEP 5 – RANKING
        // =========================
        $ranking = $hasil->sortByDesc('preferensi')->values();

        return view('admin.spk.dummy', compact(
            'criteria',
            'alternatifList',
            'matrixX',
            'matrixR',
            'hasil',
            'ranking'
        ));
    }
}
