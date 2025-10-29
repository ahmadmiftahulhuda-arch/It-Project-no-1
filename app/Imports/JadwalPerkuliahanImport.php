<?php

namespace App\Imports;

use App\Models\JadwalPerkuliahan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class JadwalPerkuliahanImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Format Isian' => new JadwalPerkuliahanSheetImport(), // baca hanya sheet ini
        ];
    }
}
