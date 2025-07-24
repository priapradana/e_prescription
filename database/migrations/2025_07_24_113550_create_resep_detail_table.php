<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('resep_detail', function (Blueprint $table) {
            $table->id('resep_detail_id'); // BIGINT UNSIGNED
            $table->unsignedBigInteger('resep_id');
            $table->unsignedInteger('obatalkes_id')->nullable(); // INT(11) UNSIGNED NULL

            $table->string('racikan_id')->nullable();
            $table->boolean('is_racikan_header')->default(false);
            $table->string('nama_racikan')->nullable();
            $table->string('signa_kode')->nullable();
            $table->string('signa_nama')->nullable();
            $table->decimal('jumlah', 10, 2)->default(1);
            $table->timestamps();

            // Foreign keys
            $table->foreign('resep_id')->references('resep_id')->on('resep')->onDelete('cascade');
            $table->foreign('obatalkes_id')->references('obatalkes_id')->on('obatalkes_m')->onDelete('set null');
        }, [
            'engine' => 'InnoDB',
            'charset' => 'latin1',
            'collation' => 'latin1_swedish_ci'
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('resep_detail');
    }
};

