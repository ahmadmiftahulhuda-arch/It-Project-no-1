<?php

namespace App\Imports;

use App\Models\SpkAlternative;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SpkDummyImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new SpkAlternative([
            'nama' => $row['nama'] ?? null,

            'k1' => (float) ($row['keperluan'] ?? 0),

            'k2' => (float) ($row['tanggal_pinjam'] ?? 0),

            // 🔥 JAM AMAN (TIDAK AKAN 0 JIKA EXCEL ANGKA)
            'k3' => is_numeric($row['jam'])
                ? (float) $row['jam']
                : 0,

            'k4' => (float) ($row['catatan_riwayat'] ?? 0),

            'k5' => (float) ($row['sarana_prasarana'] ?? 0),
        ]);
    }
}
