<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->timestamp('tanggal_kembali')->nullable()->after('status_pengembalian');
            $table->string('kondisi_kembali')->nullable()->after('tanggal_kembali');
            $table->text('keterangan_kembali')->nullable()->after('kondisi_kembali');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->dropColumn(['tanggal_kembali', 'kondisi_kembali', 'keterangan_kembali']);
        });
    }
};