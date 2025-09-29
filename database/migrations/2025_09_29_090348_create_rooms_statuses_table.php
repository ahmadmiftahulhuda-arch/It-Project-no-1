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
    Schema::create('room_statuses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade');
        $table->date('date');
        $table->time('time_slot');
        $table->enum('status', ['Tersedia', 'Terpakai', 'Pending']);
        $table->string('used_by', 100)->nullable(); // nama dosen/event
        $table->time('available_at')->nullable();   // jam ruangan kosong lagi
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_statuses');
    }
};
