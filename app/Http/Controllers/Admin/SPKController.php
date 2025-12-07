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
        $peminjamans = Peminjaman::where('status', 'Menunggu')->get();

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

    public function saw()
    {
        $criteria = SpkCriterion::all();
        $peminjamans = Peminjaman::with('spkPenilaian')->get();

        // --- NORMALISASI SAW ---
        $normal = [];
        foreach ($criteria as $k) {
            $col = $peminjamans->pluck('spkPenilaian')->map(function($p) use ($k){
                return optional($p->where('criterion_id',$k->id)->first())->nilai;
            });

            if ($k->jenis == 'benefit') {
                $max = $col->max();
                $normal[$k->id] = $col->map(fn($v) => $v/$max);
            } else {
                $min = $col->min();
                $normal[$k->id] = $col->map(fn($v) => $min/$v);
            }
        }

        // --- HITUNG RANKING ---
        $hasil = [];
        foreach ($peminjamans as $p) {
            $total = 0;
            foreach ($criteria as $k) {
                $n = $normal[$k->id][$p->id] ?? 0;
                $w = 1 / count($criteria);  // nanti diganti bobot AHP
                $total += $n * $w;
            }
            $hasil[$p->id] = $total;
        }

        arsort($hasil);

        return view('admin.spk.hasil', compact('hasil','criteria','peminjamans'));
    }
}
