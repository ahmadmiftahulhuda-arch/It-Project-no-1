<?php

namespace App\Imports;

use App\Models\JadwalPerkuliahan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JadwalPerkuliahanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new JadwalPerkuliahan([
            'kode_matkul'          => $row['kode_mk'] ?? null,
            'sistem_kuliah'        => $row['sistem_kuliah'] ?? null,
            'nama_kelas'           => $row['nama_kelas'] ?? null,
            'kelas_mahasiswa'      => $row['kelas_mahasiswa'] ?? null,
            'sebaran_mahasiswa'    => $row['sebaran_kelas_mahasiswa'] ?? null,
            'hari'                 => $row['hari'] ?? null,
            'jam_mulai'            => $row['jam_mulai'] ?? null,
            'jam_selesai'          => $row['jam_selesai'] ?? null,
            'ruangan'              => $row['ruangan'] ?? null,
            'daya_tampung'         => $row['daya_tampung'] ?? null,
        ]);
    }
}
