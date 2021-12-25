<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDivisiIdToInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('info', function (Blueprint $table) {
            $table->unsignedBigInteger('kmti_id')->nullable();
            $table->foreign('kmti_id')->references('id')->on('kmti')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('info', function (Blueprint $table) {
            $table->dropForeign('info_kmti_id_foreign');
            $table->dropColumn('kmti_id');
        });
    }
}
