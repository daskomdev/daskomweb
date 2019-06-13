<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanPjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan__pjs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('allasisten_id');
            $table->text('laporan');
            $table->string('hari');
            $table->integer('shift');
            $table->unsignedBigInteger('modul_id');
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
        Schema::dropIfExists('laporan__pjs');
    }
}
