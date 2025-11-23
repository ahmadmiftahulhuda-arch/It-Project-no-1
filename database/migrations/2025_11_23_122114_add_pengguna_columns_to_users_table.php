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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nim')->nullable()->unique();
            $table->string('peran')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('status')->nullable();
            $table->date('tanggal_bergabung')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nim', 'peran', 'jurusan', 'status', 'tanggal_bergabung']);
        });
    }
};
