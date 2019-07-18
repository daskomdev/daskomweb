<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJawabanPraktikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawaban__praktikans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('praktikum_id');
            $table->unsignedBigInteger('jurnal_id');
            $table->unsignedBigInteger('fitb_id');
            $table->unsignedBigInteger('mandiri_id');
            $table->unsignedBigInteger('ta_id');
            $table->unsignedBigInteger('tk_id');
            $table->unsignedBigInteger('tp_id');
            $table->text('jawaban');
            $table->string('jenis_soal');
            $table->timestamps();

            $table->foreign('praktikum_id')
                ->references('id')
                ->on('praktikums')
                ->onDelete('cascade');

            $table->foreign('jurnal_id')
                ->references('id')
                ->on('soal__jurnals')
                ->onDelete('cascade');

            $table->foreign('fitb_id')
                ->references('id')
                ->on('soal__fitbs')
                ->onDelete('cascade');

            $table->foreign('mandiri_id')
                ->references('id')
                ->on('soal__mandiris')
                ->onDelete('cascade');

            $table->foreign('ta_id')
                ->references('id')
                ->on('soal__tas')
                ->onDelete('cascade');

            $table->foreign('tk_id')
                ->references('id')
                ->on('soal__tks')
                ->onDelete('cascade');

            $table->foreign('tp_id')
                ->references('id')
                ->on('soal__mandiris')
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
        Schema::dropIfExists('jawaban__praktikans');
    }
}
