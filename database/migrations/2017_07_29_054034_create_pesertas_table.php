<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('nis')->unique();
            $table->string('nohp');
            $table->string('email')->nullable();
            $table->string('jeniskelamin');
            $table->integer('jeniskelas_id')->unsigned();
            $table->string('tempatlahir')->nullable();
            $table->string('tanggallahir')->nullable();
            $table->integer('usia')->nullable();
            $table->string('nohpdarurat')->nullable();
            $table->text('alamatlengkap')->nullable();
            $table->string('didaftarkanoleh')->nullable();
            $table->string('mengetahuidb')->nullable();
            /*$table->string('didaftarkanoleh2')->nullable();
            $table->string('mengetahuidb2')->nullable();*/
            $table->string('latarbelakang');
            $table->string('perusahaan')->nullable();
            $table->string('departemenpeserta')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('leveljabatan')->nullable();
            $table->string('jenisindustri')->nullable();
            $table->string('universitas')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('namasekolah')->nullable();
            $table->string('tanggalpelaksanaan');
            $table->string('judulprogram')->nullable();
            $table->string('lokasipelaksanaan')->nullable();
            $table->string('kotapelaksanaan')->nullable();
            $table->string('akuninstagram')->nullable();
            $table->text('materi')->nullable();
            $table->string('posted_by')->nullable();
            $table->string('edit_by')->nullable();
            $table->timestamps();

            $table->foreign('id_jeniskelas')->references('id')->on('jeniskelas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesertas');
    }
}
