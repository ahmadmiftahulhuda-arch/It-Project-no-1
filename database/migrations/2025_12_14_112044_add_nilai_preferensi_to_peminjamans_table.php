<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->double('nilai_preferensi')->nullable()->after('status'); // sesuaikan after()
        });
    }

    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            $table->dropColumn('nilai_preferensi');
        });
    }
};
