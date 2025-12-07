<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spk_criteria', function (Blueprint $table) {
            $table->id();
            $table->string('kode', 10);        // contoh: K1, K2, K3
            $table->string('nama');            // contoh: Keperluan, Tanggal, Durasi
            $table->enum('tipe', ['benefit','cost'])->default('benefit');
            $table->float('bobot')->nullable(); // hasil AHP disimpan di sini
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spk_criteria');
    }
};
