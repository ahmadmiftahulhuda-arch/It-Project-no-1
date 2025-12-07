<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            // Tambahkan default value untuk kolom ruang dan proyektor yang lama
            $table->string('ruang')->default('')->change();
            $table->boolean('proyektor')->default(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->string('ruang')->change();
            $table->boolean('proyektor')->change();
        });
    }
};
