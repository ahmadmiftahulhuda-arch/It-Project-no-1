<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            // Tambahkan foreign key untuk ruangan
            $table->foreignId('ruangan_id')->nullable()->constrained('ruangan')->onDelete('set null');
            
            // Tambahkan foreign key untuk projector
            $table->foreignId('projector_id')->nullable()->constrained('projectors')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {
            // Hapus foreign keys
            $table->dropForeignIdFor(\App\Models\Ruangan::class);
            $table->dropForeignIdFor(\App\Models\Projector::class);
            
            // Hapus kolom
            $table->dropColumn(['ruangan_id', 'projector_id']);
        });
    }
};
