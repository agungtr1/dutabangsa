@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="{{ url('/home') }}">Dashboard</a></li>
                <li><a href="{{ route('listdatapeserta.index') }}">Data Peserta</a></li>
                <li class="active">Export Data Peserta</li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">Export Data Peserta</h2>
                </div>
                <div class="panel-body">
                    <div class="row">
                    {!! Form::open(['url'=>route('export.listdatapesertaall.post'),'method'=>'post','class'=>'form-horizontal','role'=>'form','id'=>'filter-form']) !!}    
                        <div class="col-md-8">
                            <div class="form-group{{ $errors->has('filter') ? ' has-error' : '' }}">
                                {!! Form::label('filter', 'Export Semua Data', ['class'=>'col-md-3 control-label']) !!}
                                <div class="col-md-7">
                                {!! Form::select('filter', ['all'=>'Semua Waktu','bulanan'=>'Per Bulan Ini','tahunan'=>'Per Tahun Ini','tanggal'=>'Berdasarkan Tanggal'], 'all', ['id'=>'filter','class'=>'form-control','placeholder' => 'Pilih Waktu']) !!}
                                {!! $errors->first('filter', '<p class="help-block">:message</p>') !!}
                                <!-- SHOW - - - HIDE ! -->
                                <div style='display:none;margin-top: 5px;margin-left: 1px;' id='tanggal' class="row">
                                    <div class="form-group">
                                        <div class="col-md-5">
                                        {!! Form::date('dari', date('Y-m-d'), ['class'=>'form-control','placeholder'=>'yyyy-mm-dd']) !!}
                                        </div>
                                        <div class="col-md-1">
                                        s/d
                                        </div>
                                        <div class="col-md-5">
                                        {!! Form::date('sampai', date('Y-m-d'), ['class'=>'form-control','placeholder'=>'yyyy-mm-dd']) !!}
                                        </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-1">
                                    <button class="btn btn-info" type="submit"><i class="fa fa-btn fa-print"></i> Export Semua Data</button>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-2">
                            <a class="btn btn-info" href="{{ route('export.listdatapesertaall.post') }}"><i class="fa fa-btn fa-print"></i> Export Semua Data</a>
                        </div> -->
                    {!! Form::close() !!}
                    </div>
                    <div class="row">
                    <hr/>
                        <div class="col-md-2">
                            &nbsp;
                        </div>
                        <div class="col-md-4">
                            <b>Atau Pilih Nama Peserta</b>
                        </div>
                    </div>
                    <hr/>
                    {!! Form::open(['url' => route('export.listdatapeserta.post'),'method' => 'post', 'class'=>'form-horizontal']) !!}
                    <div class="form-group {!! $errors->has('id') ? 'has-error' : '' !!}">
                        {!! Form::label('id', 'Peserta', ['class'=>'col-md-2 control-label']) !!}
                        <div class="col-md-4">
                        {!! Form::select('id[]', $datapeserta, null, ['class'=>'js-selectize','multiple','placeholder' => 'Pilih Nama Peserta']) !!}
                        {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group {!! $errors->has('type') ? 'has-error' : '' !!}">
                        {!! Form::label('type', 'Pilih Output', ['class'=>'col-md-2 control-label']) !!}
                        <div class="col-md-4 checkbox">
                            {{ Form::radio('type', 'xls', true) }} Excel
                            {{ Form::radio('type', 'pdf') }} PDF
                            {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                        {!! Form::submit('Download', ['class'=>'btn btn-primary','target'=>'_blank']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
    <script type="text/javascript">
    {     
         $(document).ready(function(){
            $('#filter').on('change', function() {
                if ( this.value == 'tanggal')
                {
                    $("#tanggal").show();
                }
                else
                {
                    $("#tanggal").hide();
                }
                
            });


    });  }
    </script>
@endsection