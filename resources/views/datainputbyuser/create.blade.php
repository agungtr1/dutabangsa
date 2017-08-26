@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
                <li><a href="{{ url('/home') }}">Dashboard</a></li>
                <li><a href="{{ route('listdatapeserta.index') }}">Data Peserta</a></li>
                <li class="active">Tambah Data Peserta Baru</b></li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Tambah Data Peserta Baru</div>
                <div class="panel-body">
                    {!! Form::open(['url'=>route('listdatapeserta.store'), 'method'=>'post', 'class'=>'form-horizontal']) !!}
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