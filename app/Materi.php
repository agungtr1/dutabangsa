<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Materi extends Model
{
    protected $fillable = ['name'];

    public function pesertamateri()
    {
    	return $this->hasMany('App\Pesertamateri');
    }
}
