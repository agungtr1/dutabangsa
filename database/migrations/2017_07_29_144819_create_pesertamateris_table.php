<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesertamaterisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesertamateris', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('peserta_id')->unsigned()->index();
            $table->foreign('peserta_id')->references('id')->on('pesertas')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('materi_id')->unsigned()->index();
            $table->foreign('materi_id')->references('id')->on('materis')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('pesertamateris');
    }
}
