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
            $table->string('hari'); // Senin, Selasa, Rabu, Kamis, Jumat
            $table->string('waktu'); // 07:00-08:40, 08:40-10:20, dll
            $table->string('kode_matkul');
            $table->string('nama_matkul');
            $table->string('dosen');
            $table->string('kelas');
            $table->string('ruangan');
            $table->string('semester');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_perkuliahan');
    }
};