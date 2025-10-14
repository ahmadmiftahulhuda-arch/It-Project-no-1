<?php
// database/migrations/2024_01_01_000000_create_jadwal_perkuliahan_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jadwal_perkuliahan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_matkul');                 // Required
            $table->string('sistem_kuliah')->nullable();   // Optional (Online / Offline)
            $table->string('nama_kelas');                  // Required
            $table->string('kelas_mahasiswa')->nullable(); // Optional
            $table->string('sebaran_mahasiswa')->nullable(); // Optional
            $table->string('hari');                        // Required (Senin, Selasa, dst)
            $table->string('jam_mulai');                   // Required (07:00)
            $table->string('jam_selesai');                 // Required (08:40)
            $table->string('ruangan');                     // Required
            $table->integer('daya_tampung')->nullable();   // Optional
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_perkuliahan');
    }
};
