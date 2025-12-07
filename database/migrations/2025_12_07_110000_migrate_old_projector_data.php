<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Jika proyektor = 1 (true), kita cari projector tersedia dan assign
        // Jika proyektor = 0 (false), projector_id tetap null
        
        // Ambil satu projector yang tersedia sebagai default
        $defaultProjector = DB::table('projectors')
            ->where('status', 'tersedia')
            ->first();
        
        if ($defaultProjector) {
            // Update semua peminjaman dengan proyektor = 1, set projector_id ke default
            DB::table('peminjamans')
                ->where('proyektor', 1)
                ->whereNull('projector_id')
                ->update(['projector_id' => $defaultProjector->id]);
        }
    }

    public function down(): void
    {
        // Revert projector_id jika ada
        DB::table('peminjamans')->update(['projector_id' => null]);
    }
};
