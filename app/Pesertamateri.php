<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pesertamateri extends Model
{
    protected $fillable = ['user_id','materi_id'];


    public function materi()
    {
    	return $this->belongsTo('App\Materi');
    }

    public function peserta()
    {
    	return $this->belongsTo('App\Peserta');
    }
}
