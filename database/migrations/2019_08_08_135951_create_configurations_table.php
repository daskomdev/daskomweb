<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('registrationPraktikan_activation')->default(true);
            $table->boolean('registrationAsisten_activation')->default(true);
            $table->boolean('runmod_activation')->default(true);
            $table->boolean('tp_activation')->default(false);
            $table->boolean('tubes_activation')->default(false);
            $table->boolean('secretfeature_activation')->default(false);
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
        Schema::dropIfExists('configurations');
    }
}
