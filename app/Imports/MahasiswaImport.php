<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MahasiswaImport implements WithMultipleSheets
{
    private $kelas_id;

    public function __construct($kelas_id)
    {
        $this->kelas_id = $kelas_id;
    }

    public function sheets(): array
    {
        return [
            0 => new MahasiswaSheetImport($this->kelas_id),
        ];
    }
}
