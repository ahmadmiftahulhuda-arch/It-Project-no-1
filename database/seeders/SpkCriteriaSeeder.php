<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpkCriteriaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('spk_criteria')->insert([
            ['kode' => 'K1', 'nama' => 'Keperluan', 'tipe' => 'benefit'],
            ['kode' => 'K2', 'nama' => 'Tanggal Peminjaman', 'tipe' => 'cost'],
            ['kode' => 'K3', 'nama' => 'Durasi', 'tipe' => 'cost'],
        ]);
    }
}
