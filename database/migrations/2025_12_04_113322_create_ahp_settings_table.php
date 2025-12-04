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
        Schema::create('ahp_settings', function (Blueprint $table) {
            $table->id();
            $table->string('criteria');               // Nama kriteria
            $table->double('weight', 8, 5)->default(0); // Bobot hasil perhitungan AHP
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ahp_settings');
    }
};
