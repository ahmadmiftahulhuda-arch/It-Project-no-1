<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('penggunas', function (Blueprint $table) {
            $table->id();
            $table->string('nama'); // Sesuai $request->nama di controller
            $table->string('nim', 20)->nullable()->unique(); // Sesuai validasi unique:penggunas,nim
            $table->string('email')->unique();
            $table->enum('peran', ['Admin Lab', 'Asisten', 'Mahasiswa'])->default('Mahasiswa');
            $table->string('jurusan')->nullable();
            $table->enum('status', ['Aktif', 'Non-Aktif'])->default('Aktif');
            $table->date('tanggal_bergabung')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse (rollback) migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunas');
    }
};
