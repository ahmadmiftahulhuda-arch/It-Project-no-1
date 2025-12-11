<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nim', 20)->unique();
            $table->string('nama', 100);
            $table->string('kordinator', 100);
            $table->unsignedBigInteger('kelas_id')->nullable();
              $table->timestamps();

            $table->foreign('kelas_id')
                  ->references('id')->on('kelas')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
