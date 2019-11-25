<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePollingStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pollings', function (Blueprint $table) {
            $table->dropColumn('jumlah_polling');
            $table->unsignedBigInteger('praktikan_id')->after('asisten_id');

            $table->foreign('praktikan_id')
                ->references('id')
                ->on('praktikans')
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
        //
    }
}
