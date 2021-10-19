<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoMahasiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('info_id')->nullable();
            $table->unsignedBigInteger('mahasiswa_id')->nullable();
            $table->timestamp('tanggal_kirim')->useCurrent();
            $table->timestamps();

            $table->foreign('info_id')->references('id')->on('info')->onDelete('cascade');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_mahasiswa');
    }
}
