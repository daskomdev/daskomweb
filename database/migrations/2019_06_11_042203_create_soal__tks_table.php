<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoalTksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal__tks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('modul_id');
            $table->text('pertanyaan');
            $table->string('jawaban_benar');
            $table->string('jawaban_salah1');
            $table->string('jawaban_salah2');
            $table->string('jawaban_salah3');
            $table->timestamps();

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
        Schema::dropIfExists('soal__tks');
    }
}
