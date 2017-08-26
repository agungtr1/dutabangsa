@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="{{ url('/home') }}">Dashboard</a></li>
                <li class="active">Data Peserta</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Data Peserta</h2>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-2">
                            <a class="btn btn-primary" href="{{ route('datapeserta.create') }}">Tambah</a> 
                                <a class="btn btn-default" href="{{ route('export.datapeserta') }}"><i class="fa fa-btn fa-print"></i> Export</a>
                        </div>
                        <div class="col-md-10">
                        
                            {!! Form::open(['url'=>route('datapeserta.post'),'method'=>'post','class'=>'form-horizontal','role'=>'form','id'=>'filter-form']) !!}
                            <div class="form-group{{ $errors->has('filter') ? ' has-error' : '' }}">
                                {!! Form::label('filter', 'FIlter:', ['class'=>'col-md-1 control-label']) !!}
                                <div class="col-md-3">
                                {{-- {!! Form::select('filter', ['all'=>'Semua Waktu','bulanan'=>'Per Bulan Ini','tahunan'=>'Per Tahun Ini','tanggal'=>'Berdasarkan Tanggal'], 'all', ['id'=>'filter','class'=>'form-control','placeholder' => 'Pilih Waktu','onChange'=>'submitForm(this)']) !!}
                                {!! $errors->first('filter', '<p class="help-block">:message</p>') !!} --}}
                                {!! Form::text('filter', null, ['class'=>'form-control','placeholder'=>'search by nama']) !!}
                                            </div>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-search"></i> </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    @foreach($datapeserta as $dp)
                        <p><b>{{ $dp->nis }}</b></p>
                    @endforeach
                    testets
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

