<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpkAlternative;
use App\Models\SpkCriterion;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SpkDummyImport;

class SPKDummyController extends Controller
{
    /* =====================================================
     * HALAMAN SPK DUMMY
     * ===================================================== */
    public function index()
    {
        $dummyRankings = SpkAlternative::orderByDesc('nilai_preferensi')->get();

        return view('admin.spk.dummy', compact('dummyRankings'));
    }

    /* =====================================================
     * IMPORT EXCEL DATA DUMMY
     * ===================================================== */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        SpkAlternative::truncate();

        Excel::import(new SpkDummyImport, $request->file('file'));

        $this->hitungSAWDummy();

        return redirect()
            ->route('admin.spk.dummy')
            ->with('success', 'Data dummy SPK berhasil diimport & dihitung.');
    }

    /* =====================================================
     * SAW DATA DUMMY
     * ===================================================== */
    private function hitungSAWDummy()
    {
        $criteria = SpkCriterion::all()->keyBy('kode');
        $data = SpkAlternative::all();

        if ($data->isEmpty() || $criteria->isEmpty()) return;

        $pembagi = [
            'K1' => max($data->max('k1'), 1),
            'K2' => max($data->max('k2'), 1),
            'K3' => max($data->where('k3', '>', 0)->min('k3'), 1),
            'K4' => max($data->max('k4'), 1),
            'K5' => max($data->max('k5'), 1),
        ];

        foreach ($data as $row) {
            if ($row->k3 <= 0) {
                $row->update(['nilai_preferensi' => 0]);
                continue;
            }

            $preferensi =
                ($row->k1 / $pembagi['K1']) * ($criteria['K1']->bobot ?? 0) +
                ($row->k2 / $pembagi['K2']) * ($criteria['K2']->bobot ?? 0) +
                ($pembagi['K3'] / $row->k3) * ($criteria['K3']->bobot ?? 0) +
                ($row->k4 / $pembagi['K4']) * ($criteria['K4']->bobot ?? 0) +
                ($row->k5 / $pembagi['K5']) * ($criteria['K5']->bobot ?? 0);

            $row->update([
                'nilai_preferensi' => round($preferensi, 6)
            ]);
        }
    }
}
