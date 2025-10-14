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
                'kode_matkul'        => 'TIF301',
                'sistem_kuliah'      => 'Tatap Muka',
                'nama_kelas'         => 'TI-3A',
                'kelas_mahasiswa'    => 'TI-3A',
                'sebaran_mahasiswa'  => 'TI-3A',
                'hari'               => 'Senin',
                'jam_mulai'          => '07:00',
                'jam_selesai'        => '08:40',
                'ruangan'            => 'Lab TIK 1',
                'daya_tampung'       => 30,
            ],
            [
                'kode_matkul'        => 'TIF302',
                'sistem_kuliah'      => 'Tatap Muka',
                'nama_kelas'         => 'TI-3B',
                'kelas_mahasiswa'    => 'TI-3B',
                'sebaran_mahasiswa'  => 'TI-3B',
                'hari'               => 'Senin',
                'jam_mulai'          => '08:40',
                'jam_selesai'        => '10:20',
                'ruangan'            => 'Lab TIK 2',
                'daya_tampung'       => 30,
            ],
            [
                'kode_matkul'        => 'TIF303',
                'sistem_kuliah'      => 'Online',
                'nama_kelas'         => 'TI-3C',
                'kelas_mahasiswa'    => 'TI-3C',
                'sebaran_mahasiswa'  => 'TI-3C',
                'hari'               => 'Selasa',
                'jam_mulai'          => '09:00',
                'jam_selesai'        => '10:40',
                'ruangan'            => 'Zoom Room A',
                'daya_tampung'       => 25,
            ],
        ];

        foreach ($jadwal as $data) {
            JadwalPerkuliahan::create($data);
        }
    }
}
