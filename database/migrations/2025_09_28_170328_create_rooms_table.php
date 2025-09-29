<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('rooms', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100);
        $table->string('building', 50);
        $table->enum('type', ['Ruang Kelas', 'Laboratorium', 'Ruang Rapat', 'Aula']);
        $table->integer('capacity');
        $table->boolean('has_projector')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
