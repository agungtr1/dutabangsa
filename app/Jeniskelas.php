<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Jeniskelas extends Model
{
    protected $fillable = ['name'];

    public function peserta()
	{
	return $this->hasMany('App\Peserta');
	}
}
