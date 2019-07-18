<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrentPraktikumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('current__praktikums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('asisten_id');
            $table->unsignedBigInteger('kelas_id');
            $table->integer('status');
            $table->timestamps();

            $table->foreign('asisten_id')
                ->references('id')
                ->on('asistens')
                ->onDelete('cascade');

            $table->foreign('kelas_id')
                ->references('id')
                ->on('kelas')
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
        Schema::dropIfExists('current__praktikums');
    }
}
