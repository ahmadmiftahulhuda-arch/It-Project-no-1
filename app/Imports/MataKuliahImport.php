<?php

namespace App\Imports;

use App\Models\MataKuliah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MataKuliahImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        if (empty($row['nama'])) {
            return null; // skip baris rusak
        }

        return new MataKuliah([
            'nama'     => trim($row['nama']),
            'kode'     => $row['kode'],
            'semester' => $row['semester'],
        ]);
    }
}
