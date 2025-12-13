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
    Schema::table('pengembalians', function (Blueprint $table) {
        $table->dateTime('tanggal_pengembalian')->change();
    });
}

public function down()
{
    Schema::table('pengembalians', function (Blueprint $table) {
        $table->date('tanggal_pengembalian')->change();
    });
}

};
