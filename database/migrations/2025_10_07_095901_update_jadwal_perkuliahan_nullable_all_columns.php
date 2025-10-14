<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_perkuliahan', function (Blueprint $table) {
            // Semua kolom diubah jadi nullable (boleh kosong)
            $table->string('kode_matkul')->nullable()->change();
            $table->string('sistem_kuliah')->nullable()->change();
            $table->string('nama_kelas')->nullable()->change();
            $table->string('kelas_mahasiswa')->nullable()->change();
            $table->string('sebaran_mahasiswa')->nullable()->change();
            $table->string('hari')->nullable()->change();
            $table->string('jam_mulai')->nullable()->change();
            $table->string('jam_selesai')->nullable()->change();
            $table->string('ruangan')->nullable()->change();
            $table->integer('daya_tampung')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_perkuliahan', function (Blueprint $table) {
            // Jika rollback, semua kolom dikembalikan jadi NOT NULL (tidak boleh kosong)
            $table->string('kode_matkul')->nullable(false)->change();
            $table->string('sistem_kuliah')->nullable(false)->change();
            $table->string('nama_kelas')->nullable(false)->change();
            $table->string('kelas_mahasiswa')->nullable(false)->change();
            $table->string('sebaran_mahasiswa')->nullable(false)->change();
            $table->string('hari')->nullable(false)->change();
            $table->string('jam_mulai')->nullable(false)->change();
            $table->string('jam_selesai')->nullable(false)->change();
            $table->string('ruangan')->nullable(false)->change();
            $table->integer('daya_tampung')->nullable(false)->change();
        });
    }
};
