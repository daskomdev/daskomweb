<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryIzinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history__izins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('hari');
            $table->integer('shift');
            $table->char('status', 1)->default('1');

            /*    status   */
            // 1 => izin
            // 2 => sakit
            // 3 => alfa
            /***************/

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
        Schema::dropIfExists('history__izins');
    }
}
