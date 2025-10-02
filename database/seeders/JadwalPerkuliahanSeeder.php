<?php
// database/seeders/JadwalPerkuliahanSeeder.php

namespace Database\Seeders;

use App\Models\JadwalPerkuliahan;
use Illuminate\Database\Seeder;

class JadwalPerkuliahanSeeder extends Seeder
{
    public function run()
    {
        $jadwal = [
            [
                'hari' => 'Senin',
                'waktu' => '07:00 - 08:40',
                'kode_matkul' => 'TIF301',
                'nama_matkul' => 'Pemrograman Web',
                'dosen' => 'Dr. Ahmad Fauzi, M.Kom',
                'kelas' => 'TI-3A',
                'ruangan' => 'Lab TIK 1',
                'semester' => '3',
                'keterangan' => 'Praktikum'
            ],
            [
                'hari' => 'Senin',
                'waktu' => '08:40 - 10:20',
                'kode_matkul' => 'TIF302',
                'nama_matkul' => 'Basis Data',
                'dosen' => 'Dr. Siti Aminah, M.Kom',
                'kelas' => 'TI-3B',
                'ruangan' => 'Lab TIK 2',
                'semester' => '3',
                'keterangan' => 'Praktikum'
            ],
            // Tambahkan data lainnya...
        ];

        foreach ($jadwal as $data) {
            JadwalPerkuliahan::create($data);
        }
    }
}