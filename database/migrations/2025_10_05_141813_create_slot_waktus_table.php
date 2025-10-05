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
    Schema::create('slot_waktus', function (Blueprint $table) {
        $table->id();
        $table->string('id_slot')->unique();   // contoh: "7:30"
        $table->string('waktu');               // contoh: "07:30"
        $table->timestamps();
    });
}

};
