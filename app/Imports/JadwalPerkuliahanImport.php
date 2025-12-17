<?php

namespace App\Imports;

use App\Models\JadwalPerkuliahan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class JadwalPerkuliahanImport implements ToModel, SkipsEmptyRows
{
    public function model(array $row)
    {
        // ===============================
        // 1️⃣ Lewati header
        // ===============================
        if (
            isset($row[0]) &&
            trim($row[0]) === 'Kode MK (Isian Lihat Daftar MK Kurikulum)'
        ) {
            return null;
        }

        // ===============================
        // 2️⃣ FILTER BARIS KOSONG (INI KUNCI UTAMA)
        // ===============================
        if (
            empty($row[0]) && // kode_matkul
            empty($row[5]) && // hari
            empty($row[6]) && // jam_mulai
            empty($row[7]) && // jam_selesai
            empty($row[8])    // ruangan
        ) {
            return null;
        }

        // ===============================
        // 3️⃣ SIMPAN DATA
        // ===============================
        return new JadwalPerkuliahan([
            'kode_matkul'       => trim($row[0]),
            'sistem_kuliah'     => $row[1] ?? null,
            'nama_kelas'        => trim($row[2]),
            'kelas_mahasiswa'   => $row[3] ?? null,
            'sebaran_mahasiswa' => $row[4] ?? null,
            'hari'              => trim($row[5]),
            'jam_mulai'         => trim($row[6]),
            'jam_selesai'       => trim($row[7]),
            'ruangan'           => trim($row[8]),
            'daya_tampung'      => $row[9] ?? null,
        ]);
    }
}
