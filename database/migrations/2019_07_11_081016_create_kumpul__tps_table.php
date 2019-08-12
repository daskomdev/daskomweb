<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKumpulTpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kumpul__tps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('modul_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('praktikan_id');
            $table->timestamps();

            $table->foreign('modul_id')
                ->references('id')
                ->on('moduls')
                ->onDelete('cascade');

            $table->foreign('kelas_id')
                ->references('id')
                ->on('kelas')
                ->onDelete('cascade');

            $table->foreign('praktikan_id')
                ->references('id')
                ->on('praktikans')
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
        Schema::dropIfExists('kumpul__tps');
    }
}
