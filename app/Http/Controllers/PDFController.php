<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use yajra\Datatables\Html\Builder;
use yajra\Datatables\DataTables;
use App\Peserta;
use App\Materi;
use App\Jeniskelas;
use Session;
use App\Http\Requests\StorePesertaRequest;
use PDF;

class PDFController extends Controller
{
    public function export()
    {
        $pdf = PDF::loadView('datapeserta.export');
        return $pdf->stream('pdf.pdf');
    }
}
