<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('resep', function (Blueprint $table) {
            $table->bigIncrements('resep_id');
            $table->string('no_resep')->unique();
            $table->date('tanggal');
            $table->string('pasien_nama');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        }, [
            'engine' => 'InnoDB',
            'charset' => 'latin1',
            'collation' => 'latin1_swedish_ci'
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('resep');
    }
};
