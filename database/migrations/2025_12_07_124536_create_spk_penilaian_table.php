<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('spk_penilaian', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('peminjaman_id');
            $table->unsignedBigInteger('criterion_id');
            $table->double('nilai');

            // sesuaikan dengan tabel kamu: 'peminjamans'
            $table->foreign('peminjaman_id')
                ->references('id')->on('peminjamans')
                ->onDelete('cascade');

            $table->foreign('criterion_id')
                ->references('id')->on('spk_criteria')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spk_penilaian');
    }
};
