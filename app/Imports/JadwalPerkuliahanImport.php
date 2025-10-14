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
            'kode_matkul'       => $row['kode_mk_isian_lihat_daftar_mk_kurikulum'] ?? null,
            'sistem_kuliah'     => $row['sistem_kuliah_isian_lihat_daftar_sistem_kuliah_gunakan_pemisah_koma_untuk_mendatakan_sebaran_sistem_kuliah'] ?? null,
            'nama_kelas'        => $row['nama_kelas_isian'] ?? null,
            'kelas_mahasiswa'   => $row['kelas_mahasiswa'] ?? null,
            'sebaran_mahasiswa' => $row['sebaran_mahasiswa'] ?? null,
            'hari'              => $row['hari'] ?? null,
            'jam_mulai'         => $row['jam_mulai'] ?? null,
            'jam_selesai'       => $row['jam_selesai'] ?? null,
            'ruangan'           => $row['ruangan'] ?? null,
            'daya_tampung'      => $row['daya_tampung'] ?? null,
        ]);
    }
}
