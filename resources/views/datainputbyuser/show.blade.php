@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul class="breadcrumb">
                <li><a href="{{ url('/home') }}">Dashboard</a></li>
                <li><a href="{{ route('listdatapeserta.index') }}">Data Peserta</a></li>
                <li class="active">View Data Peserta <b>{{ $datapeserta->nama }}</b></li>
            </ul>
            <div class="panel panel-default">
                <div class="panel-heading">Data Peserta</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 control-label">
                            <p>NIP</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>{{ $datapeserta->nis }}</p></b>
                        </div>
                        <div class="col-md-4 control-label">
                            <p>Nama</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>{{ $datapeserta->nama }}</p></b>
                        </div>
                        <div class="col-md-4 control-label">
                            <p>No. Handpohone</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->nohp == NULL) - @else {{ $datapeserta->nohp }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label">
                            <p>Email</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->email == NULL) - @else {{ $datapeserta->email }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label">
                            <p>Jenis Kelamin</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->jeniskelamin == NULL) - @else {{ $datapeserta->jeniskelamin }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label">
                            <p>Jenis kelas</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>{{ $jeniskelas->name }}</p></b>
                        </div>
                        @if($jeniskelas->id == 1 || $jeniskelas->id == 3)
                        <div class="col-md-4 control-label" style="text-align: center;background-color: #eaf0eb;">
                            <p>Tempat, Tanggal Lahir</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->tempatlahir == NULL) - @else {{ $datapeserta->tempatlahir }}, {{ $datapeserta->tanggallahir }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label" style="text-align: center;background-color: #eaf0eb;">
                            <p>Usia</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->usia == NULL) - @else {{ $datapeserta->usia }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label" style="text-align: center;background-color: #eaf0eb;">
                            <p>No. HP Darurat</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->nohpdarurat == NULL) - @else {{ $datapeserta->nohpdarurat }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label" style="text-align: center;background-color: #eaf0eb;">
                            <p>Alamat Lengkap</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->alamatlengkap == NULL) - @else {{ $datapeserta->alamatlengkap }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label" style="text-align: center;background-color: #eaf0eb;">
                            <p>Didaftarkan Oleh</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->didaftarkanoleh == NULL) - @else {{ $datapeserta->didaftarkanoleh }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label" style="text-align: center;background-color: #eaf0eb;">
                            <p>Mengetahui Duta Bangsa</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->mengetahuidb == NULL) - @else {{ $datapeserta->mengetahuidb }} @endif</p></b>
                        </div>
                        @endif
                        <div class="col-md-4 control-label">
                            <p>Latar Belakang</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>{{ $datapeserta->latarbelakang }}</p></b>
                        </div>
                        @if($datapeserta->latarbelakang == "bekerja")
                        <div class="col-md-4 control-label" style="text-align: center;background-color: #eaf0eb;">
                            <p>Perusahaan</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->perusahaan == NULL) - @else {{ $datapeserta->perusahaan }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label" style="text-align: center;background-color: #eaf0eb;">
                            <p>Jenis Industri</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->jenisindustri == NULL) - @else {{ $datapeserta->jenisindustri }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label" style="text-align: center;background-color: #eaf0eb;">
                            <p>Departemen</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->departemenpeserta == NULL) - @else {{ $datapeserta->departemenpeserta }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label" style="text-align: center;background-color: #eaf0eb;">
                            <p>Jabatan</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->jabatan == NULL) - @else {{ $datapeserta->jabatan }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label" style="text-align: center;background-color: #eaf0eb;">
                            <p>Level Jabatan</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->leveljabatan == NULL) - @else {{ $datapeserta->leveljabatan }} @endif</p></b>
                        </div>
                        @elseif($datapeserta->latarbelakang == "kuliah")
                        <div class="col-md-4 control-label" style="text-align: center;background-color: #eaf0eb;">
                            <p>Universitas</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->universitas == NULL) - @else {{ $datapeserta->universitas }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label" style="text-align: center;background-color: #eaf0eb;">
                            <p>Jurusan</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->jurusan == NULL) - @else {{ $datapeserta->jurusan }} @endif</p></b>
                        </div>
                        @elseif($datapeserta->latarbelakang == "sekolah")
                        <div class="col-md-4 control-label" style="text-align: center;background-color: #eaf0eb;">
                            <p>Sekolah</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->namasekolah == NULL) - @else {{ $datapeserta->namasekolah }} @endif</p></b>
                        </div>
                        @endif
                        <div class="col-md-4 control-label">
                            <p>Tanggal Pelaksanaan</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->tanggalpelaksanaan == NULL) - @else {{ $datapeserta->tanggalpelaksanaan }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label">
                            <p>Judul Program</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->judulprogram == NULL) - @else {{ strtoupper($datapeserta->judulprogram) }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label">
                            <p>Lokasi Pelaksanaan</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->lokasipelaksanaan == NULL) - @else {{ $datapeserta->lokasipelaksanaan }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label">
                            <p>Kota Pelaksanaan</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->kotapelaksanaan == NULL) - @else {{ $datapeserta->kotapelaksanaan }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label">
                            <p>Akun Instagram</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->akuninstagram == NULL) - @else {{ $datapeserta->akuninstagram }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label">
                            <p>Materi</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->materi == NULL) - @else {{ $datapeserta->materi }} @endif</p></b>
                        </div>
                        <div class="col-md-4 control-label">
                            <p>Di Input Oleh</p>
                        </div>
                        <div class="col-md-6">
                            <b><p>@if($datapeserta->posted_by == NULL) - @else {{ $datapeserta->posted_by }}, {{ $datapeserta->created_at }}</p>@endif</b>
                        </div>
                        <div style="clear: both;">&nbsp;</div>
                        <div class="col-md-6 col-md-offset-4">
                            <a href="javascript:history.back(-1)" class="btn btn-primary">
                                <i class="fa fa-btn fa-back"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

