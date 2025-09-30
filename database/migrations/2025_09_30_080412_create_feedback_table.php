<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id('id_feedback'); // Primary Key
            $table->unsignedBigInteger('id_peminjaman'); // Foreign Key
            $table->text('komentar');
            $table->date('tgl_feedback');
            $table->timestamps();
            $table->integer('rating')->default(0);
            $table->enum('status', ['Draft', 'Dipublikasikan'])->default('Dipublikasikan');

            // Relasi ke tabel peminjaman
            $table->foreign('id_peminjaman')->references('id_peminjaman')->on('peminjaman')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
