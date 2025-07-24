<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Ubah obatalkes_id dari INT ke INT UNSIGNED
        Schema::table('obatalkes_m', function (Blueprint $table) {
            $table->unsignedInteger('obatalkes_id')->autoIncrement()->change();
        });
    }

    public function down()
    {
        // Kembalikan jika perlu (opsional, hati-hati)
        Schema::table('obatalkes_m', function (Blueprint $table) {
            $table->integer('obatalkes_id', true, true)->autoIncrement()->change();
        });
    }
};