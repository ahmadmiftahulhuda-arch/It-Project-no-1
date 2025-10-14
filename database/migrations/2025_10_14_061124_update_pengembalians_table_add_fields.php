<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengembalians', function (Blueprint $table) {
            // Tambahkan user_id jika belum ada
            if (!Schema::hasColumn('pengembalians', 'user_id')) {
                $table->foreignId('user_id')->after('peminjaman_id')->constrained()->onDelete('cascade');
            }

            // Ubah tipe tanggal_pengembalian ke datetime (lebih akurat)
            $table->dateTime('tanggal_pengembalian')->change();

            // Tambah kolom kondisi dan catatan tambahan
            if (!Schema::hasColumn('pengembalians', 'kondisi_ruang')) {
                $table->enum('kondisi_ruang', ['baik', 'rusak_ringan', 'rusak_berat'])->nullable()->after('tanggal_pengembalian');
            }

            if (!Schema::hasColumn('pengembalians', 'kondisi_proyektor')) {
                $table->enum('kondisi_proyektor', ['baik', 'rusak_ringan', 'rusak_berat'])->nullable()->after('kondisi_ruang');
            }

            if (!Schema::hasColumn('pengembalians', 'catatan')) {
                $table->text('catatan')->nullable()->after('kondisi_proyektor');
            }

            // Ubah status supaya konsisten dengan sistem (pending, selesai, ditolak)
            $table->enum('status', ['pending', 'selesai', 'ditolak'])->default('pending')->change();
        });
    }

    public function down(): void
    {
        Schema::table('pengembalians', function (Blueprint $table) {
            $table->dropColumn(['user_id', 'kondisi_ruang', 'kondisi_proyektor', 'catatan']);
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending')->change();
            $table->date('tanggal_pengembalian')->change();
        });
    }
};
