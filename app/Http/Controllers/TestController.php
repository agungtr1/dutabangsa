<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peserta;
use App\Materi;
use App\Jeniskelas;

class TestController extends Controller
{
    public function getdata()
    {
        $datapeserta = Peserta::with('jeniskelas')->get();
        /*$materi = Materi::all(['id','name']);*/
        /*$jeniskelas = Jeniskelas::find($datapeserta->jeniskelas_id);*/
        return view('datapeserta.testview')->with(compact('datapeserta'));
    }
}
