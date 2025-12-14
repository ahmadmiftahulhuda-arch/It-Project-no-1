<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('spk_alternatives', function (Blueprint $table) {
            $table->id();

            // Data dummy dari Excel
            $table->string('nama');

            // Nilai kriteria
            $table->float('k1'); // Keperluan
            $table->float('k2'); // Tanggal
            $table->float('k3'); // Jam (menit)
            $table->float('k4'); // Catatan riwayat
            $table->float('k5'); // Sarana prasarana

            // Hasil SAW
            $table->float('nilai_preferensi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spk_alternatives');
    }
};

