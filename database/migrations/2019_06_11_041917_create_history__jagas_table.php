<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryJagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history__jagas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hari');
            $table->integer('shift');
            $table->boolean('pj')->default(false);
            $table->unsignedBigInteger('asisten_id');
            $table->unsignedBigInteger('modul_id');
            $table->timestamps();

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
        Schema::dropIfExists('history__jagas');
    }
}
