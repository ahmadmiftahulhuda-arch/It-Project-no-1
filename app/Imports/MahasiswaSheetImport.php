<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MahasiswaSheetImport implements ToModel, WithStartRow
{
    private $kelas_id;

    public function __construct($kelas_id)
    {
        $this->kelas_id = $kelas_id;
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2; // Data starts from the second row
    }

    public function model(array $row)
    {
        return new Mahasiswa([
            'nim'           => $row[0],
            'nama'          => $row[1],
            'jenis_kelamin' => $row[2],
            'kelas_id'      => $this->kelas_id,
        ]);
    }
}
