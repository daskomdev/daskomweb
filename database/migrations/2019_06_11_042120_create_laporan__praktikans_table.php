<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanPraktikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan__praktikans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('pesan');
            $table->float('rating_asisten');
            $table->float('rating_praktikum');
            $table->unsignedBigInteger('praktikan_id');
            $table->unsignedBigInteger('asisten_id');
            $table->unsignedBigInteger('modul_id');
            $table->timestamps();

            $table->foreign('praktikan_id')
                ->references('id')
                ->on('praktikans')
                ->onDelete('cascade');

            $table->foreign('asisten_id')
                ->references('id')
                ->on('asistens')
                ->onDelete('cascade');

            $table->foreign('modul_id')
                ->references('id')
                ->on('moduls')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('laporan__praktikans');
    }
}
