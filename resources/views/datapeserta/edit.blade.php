@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
                <li><a href="{{ url('/home') }}">Dashboard</a></li>
                <li><a href="{{ route('datapeserta.index') }}">Data Peserta</a></li>
                <li class="active">Edit Data Peserta <b>{{ $datapeserta->nama }}</b></li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Edit Data Peserta</div>
                <div class="panel-body">
                    {!! Form::model($datapeserta, ['url' => route('datapeserta.update', $datapeserta->id),
                    'method' => 'put', 'class'=>'form-horizontal']) !!}
                        @include('datapeserta._form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="/js/panggil.js"></script>
@endsection