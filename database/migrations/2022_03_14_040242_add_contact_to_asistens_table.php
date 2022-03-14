<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContactToAsistensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asistens', function (Blueprint $table) {
            $table->string('nomor_telepon')->after('deskripsi');
            $table->string('id_line')->after('nomor_telepon');
            $table->string('instagram')->after('id_line');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asistens', function (Blueprint $table) {
            // $table->dropColumn(['nomor_telepon', 'id_line','instagram']);
        });
    }
}
