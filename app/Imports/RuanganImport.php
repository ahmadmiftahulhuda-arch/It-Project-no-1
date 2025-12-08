<?php

namespace App\Imports;

use App\Models\Ruangan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RuanganImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Ruangan([
            'kode_ruangan' => $row['kode_ruangan'] ?? ($row['kode'] ?? null),
            'nama_ruangan' => $row['nama_ruangan'] ?? ($row['nama'] ?? null),
            'kapasitas' => isset($row['kapasitas']) ? intval($row['kapasitas']) : null,
            'status' => $row['status'] ?? 'Tersedia',
            'keterangan' => $row['keterangan'] ?? null,
        ]);
    }
}
