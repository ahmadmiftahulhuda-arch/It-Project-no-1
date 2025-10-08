<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        // Perintah ini akan mengubah definisi ENUM pada kolom 'status'
        // untuk menyertakan 'proses-pengembalian' dan 'selesai'
        DB::statement("ALTER TABLE peminjamans CHANGE COLUMN status status ENUM('pending', 'disetujui', 'ditolak', 'proses-pengembalian', 'selesai') NOT NULL DEFAULT 'pending'");
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        // Perintah ini akan mengembalikan definisi ENUM ke keadaan semula
        // jika suatu saat kita perlu membatalkan (rollback) migrasi ini.
        DB::statement("ALTER TABLE peminjamans CHANGE COLUMN status status ENUM('pending', 'disetujui', 'ditolak') NOT NULL DEFAULT 'pending'");
    }
};