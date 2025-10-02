<?php

namespace Database\Seeders;

use App\Models\Projector;
use Illuminate\Database\Seeder;

class ProjectorSeeder extends Seeder
{
    public function run()
    {
        $projectors = [
            [
                'kode_proyektor' => 'PROJ-001',
                'merk' => 'Epson',
                'model' => 'EB-X41',
                'keterangan' => 'Proyektor dengan brightness 3600 lumens, cocok untuk ruangan besar',
                'status' => 'tersedia',
            ],
            [
                'kode_proyektor' => 'PROJ-002',
                'merk' => 'BenQ',
                'model' => 'MH535',
                'keterangan' => 'Resolusi HD 1080p, contrast ratio 15,000:1',
                'status' => 'dipinjam',
            ],
            [
                'kode_proyektor' => 'PROJ-003',
                'merk' => 'Epson',
                'model' => 'EB-W42',
                'keterangan' => 'Wireless projection, 3LCD technology',
                'status' => 'tersedia',
            ],
            [
                'kode_proyektor' => 'PROJ-004',
                'merk' => 'ViewSonic',
                'model' => 'PA503S',
                'keterangan' => 'SVGA, 3800 lumens, lampu hemat energi',
                'status' => 'rusak',
            ],
            [
                'kode_proyektor' => 'PROJ-005',
                'merk' => 'LG',
                'model' => 'PH450UG',
                'keterangan' => 'Proyektor portable, HD, built-in battery',
                'status' => 'tersedia',
            ],
            [
                'kode_proyektor' => 'PROJ-006',
                'merk' => 'BenQ',
                'model' => 'GS2',
                'keterangan' => 'Proyektor outdoor, waterproof, portable',
                'status' => 'dipinjam',
            ],
            [
                'kode_proyektor' => 'PROJ-007',
                'merk' => 'Sony',
                'model' => 'VPL-DW255',
                'keterangan' => 'Proyektor laser, 6000 lumens, tahan lama',
                'status' => 'tersedia',
            ],
            [
                'kode_proyektor' => 'PROJ-008',
                'merk' => 'NEC',
                'model' => 'NP-PA803UL',
                'keterangan' => 'Proyektor ultra short throw, 8000 lumens',
                'status' => 'tersedia',
            ],
        ];

        foreach ($projectors as $projector) {
            Projector::create($projector);
        }
    }
}