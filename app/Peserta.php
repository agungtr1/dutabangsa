<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Peserta extends Model
{
    protected $fillable = ['nama','nis','nohp','email','jeniskelamin','jeniskelas_id','tempatlahir','tanggallahir','usia','nohpdarurat','alamatlengkap','didaftarkanoleh','mengetahuidb','latarbelakang','perusahaan','departemenpeserta','jabatan','leveljabatan','jenisindustri','universitas','jurusan','namasekolah','tanggalpelaksanaan','judulprogram','lokasipelaksanaan','kotapelaksanaan','akuninstagram','materi','posted_by','edit_by','created_at','updated_at'];

    public function jeniskelas()
	{
		return $this->belongsTo('App\Jeniskelas');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function pesertamateri()
    {
    	return $this->hasMany('App\Pesertamateri');
    }

}
