<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pollings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('polling_id');
            $table->unsignedBigInteger('asisten_id');
            $table->integer('jumlah_polling')->default(0);
            $table->timestamps();

            $table->foreign('polling_id')
                ->references('id')
                ->on('jenis__pollings')
                ->onDelete('cascade');

            $table->foreign('asisten_id')
                ->references('id')
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
        Schema::dropIfExists('pollings');
    }
}
