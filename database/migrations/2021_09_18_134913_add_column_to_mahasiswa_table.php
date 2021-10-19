<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->string('jam_mulai', 6);
            $table->string('jam_berakhir', 6);
            $table->string('lokasi', 255);
            $table->string('keterangan', 1000);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('jam_mulai');
            $table->dropColumn('jam_berakhir');
            $table->dropColumn('lokasi');
            $table->dropColumn('keterangan');
        });
    }
}
