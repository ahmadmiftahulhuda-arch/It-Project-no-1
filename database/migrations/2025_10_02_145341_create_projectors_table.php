<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('projectors', function (Blueprint $table) {
            $table->id();
            $table->string('kode_proyektor')->unique();
            $table->string('merk');
            $table->string('model');
            $table->text('keterangan')->nullable();
            $table->enum('status', ['tersedia', 'dipinjam', 'rusak'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projectors');
    }
};