<?php

namespace App\Imports;

use App\Models\JadwalPerkuliahan;
use Maatwebsite\Excel\Concerns\ToModel;

class JadwalPerkuliahanSheetImport implements ToModel
{
    public function model(array $row)
    {
        // Lewati header
        if ($row[0] === 'Kode MK (Isian Lihat Daftar MK Kurikulum)') {
            return null;
        }

        return new JadwalPerkuliahan([
            'kode_matkul'       => $row[0] ?? null, // kolom A
            'sistem_kuliah'     => $row[1] ?? null, // kolom B
            'nama_kelas'        => $row[2] ?? null, // kolom C
            'kelas_mahasiswa'   => $row[3] ?? null, // kolom D
            'sebaran_mahasiswa' => $row[4] ?? null, // kolom E
            'hari'              => $row[5] ?? null, // kolom F
            'jam_mulai'         => $row[6] ?? null, // kolom G
            'jam_selesai'       => $row[7] ?? null, // kolom H
            'ruangan'           => $row[8] ?? null, // kolom I
            'daya_tampung'      => $row[9] ?? null, // kolom J
        ]);
    }
}
