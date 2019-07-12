<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoalTpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal__tps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('modul_id');
            $table->text('soal');
            $table->boolean('isEssay')->nullable()->default(false);
            $table->boolean('isProgram')->nullable()->default(false);
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
        Schema::dropIfExists('soal__tps');
    }
}
