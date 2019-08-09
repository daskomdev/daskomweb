<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTugaspendahuluansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugaspendahuluans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('modul_id');
            $table->text('pembahasan');
            $table->boolean('isActive')->default(false);
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
        Schema::dropIfExists('tugaspendahuluans');
    }
}
