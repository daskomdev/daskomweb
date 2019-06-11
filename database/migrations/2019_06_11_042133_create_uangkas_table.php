<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUangkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uangkas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('status', 1);

            /*             status            */
            // 0 => income atau pemasukkan
            // 1 => outcome atau pengeluaran
            /*********************************/

            $table->text('deskripsi');
            $table->integer('nominal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uangkas');
    }
}
