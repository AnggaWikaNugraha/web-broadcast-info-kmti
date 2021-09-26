<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFotoToDivisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('divisi', function (Blueprint $table) {
            $table->string('foto');
            $table->string('fungsi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('divisi', function (Blueprint $table) {
            $table->dropColumn('foto');
            $table->dropColumn('fungsi');
        });
    }
}
