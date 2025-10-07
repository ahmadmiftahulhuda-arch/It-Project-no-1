<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('jadwal_perkuliahan', function (Blueprint $table) {
            $table->string('kode_matkul')->nullable()->change();
            $table->string('nama_matkul')->nullable()->change();
            $table->string('kelas')->nullable()->change();
            $table->string('hari')->nullable()->change();
            $table->string('waktu')->nullable()->change();
            $table->string('ruangan')->nullable()->change();
            $table->string('semester')->nullable()->change();
            $table->string('keterangan')->nullable()->change();
            $table->string('dosen')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('jadwal_perkuliahan', function (Blueprint $table) {
            $table->string('kode_matkul')->nullable(false)->change();
            $table->string('nama_matkul')->nullable(false)->change();
            $table->string('kelas')->nullable(false)->change();
            $table->string('hari')->nullable(false)->change();
            $table->string('waktu')->nullable(false)->change();
            $table->string('ruangan')->nullable(false)->change();
            $table->string('semester')->nullable(false)->change();
            $table->string('keterangan')->nullable(false)->change();
            $table->string('dosen')->nullable(false)->change();
        });
    }
};
