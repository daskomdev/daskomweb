<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePelanggaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggarans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pelanggaran_id');
            $table->unsignedBigInteger('asisten_id');
            $table->timestamps();

            $table->foreign('pelanggaran_id')
                ->references('id')
                ->on('kode__pelanggarans')
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
        Schema::dropIfExists('pelanggarans');
    }
}
