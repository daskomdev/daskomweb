<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFotoAsistensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foto__asistens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('kode', 3);
            $table->text('foto');
            $table->timestamps();

            $table->foreign('kode')
                ->references('kode')
                ->on('asistens')
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
        Schema::dropIfExists('foto__asistens');
    }
}
