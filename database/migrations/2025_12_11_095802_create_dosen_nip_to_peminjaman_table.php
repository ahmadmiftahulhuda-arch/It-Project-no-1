<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            // nullable karena pilihan opsional
            $table->string('dosen_nip', 20)->nullable()->after('keperluan');

            // tambahkan foreign key jika tabel dosens sudah ada
            if (Schema::hasTable('dosens')) {
                $table->foreign('dosen_nip')->references('nip')->on('dosens')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            if (Schema::hasColumn('peminjamans', 'dosen_nip')) {
                $table->dropForeign([ 'dosen_nip' ]);
                $table->dropColumn('dosen_nip');
            }
        });
    }
};