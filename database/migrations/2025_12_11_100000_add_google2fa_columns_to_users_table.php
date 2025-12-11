<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('google2fa_secret')->nullable()->after('password');
            $table->text('google2fa_recovery_codes')->nullable()->after('google2fa_secret');
            $table->boolean('google2fa_timestamp')->nullable()->after('google2fa_recovery_codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'google2fa_secret',
                'google2fa_recovery_codes',
                'google2fa_timestamp',
            ]);
        });
    }
};
