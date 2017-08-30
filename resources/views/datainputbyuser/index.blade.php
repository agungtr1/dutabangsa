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
                            <a class="btn btn-primary" href="{{ route('listdatapeserta.create') }}">Tambah</a> 
                            <a class="btn btn-default" href="{{ route('export.listdatapeserta') }}"><i class="fa fa-btn fa-print"></i> Export</a>
                        </div>
                        <div class="col-md-10">
                        
                            {!! Form::open(['url'=>route('listdatapeserta.filter'),'method'=>'post','class'=>'form-horizontal','role'=>'form','id'=>'filter-form']) !!}
                            <div class="col-md-1">
                                {!! Form::label('filter', 'FIlter:', ['class'=>'col-md-1 control-label']) !!}
                            </div>
                            <div class="form-group">
                                <div class="col-md-2">
                                    {!! Form::select('jk', ['laki-laki'=>'Laki - Laki','perempuan'=>'Perempuan'], null, ['class'=>'js-selectize','placeholder'=>'Jenis Kelamin']) !!}
                                </div>
                                <div class="col-md-2">
                                    {!! Form::select('jeniskelas_id', [''=>'']+App\Jeniskelas::pluck('name','id')->all(), null, ['class'=>'js-selectize','placeholder'=>'Jenis Kelas']) !!}
                                </div>
                                <div class="col-md-2">
                                    {!! Form::select('lb', ['bekerja'=>'Bekerja','kuliah'=>'Kuliah','sekolah'=>'Sekolah'], null, ['class'=>'js-selectize','placeholder'=>'Latar Belakang']) !!}
                                </div>
                                <div class="col-md-2">
                                    {!! Form::select('materi', [''=>'']+App\Materi::pluck('name','name')->all(), null, ['class'=>'js-selectize','placeholder'=>'Materi']) !!}
                                </div>
                                <div class="col-md-2">
                                    {!! Form::select('jenisindustri', [''=>'']+App\Jenisindustri::pluck('name','name')->all(), null, ['class'=>'js-selectize','placeholder'=>'Jenis Industri']) !!}
                                </div>
                            </div>
                            
                            <div class="col-md-1">
                                &nbsp;
                            </div>
                            <div class="form-group">
                                <div class="col-md-2">
                                    {!! Form::select('lj', ['top management'=>'Top management','middle management'=>'Middle Management','fresh graduate'=>'Fresh Graduate','lain-lainnya'=>'Lainnya'], null, ['class'=>'js-selectize','placeholder'=>'Level Jabatan']) !!}
                                </div>
                                <div class="col-md-2">
                                    {!! Form::select('bp', ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'], null, ['class'=>'js-selectize','placeholder'=>'Bulan Pelaksanaan']) !!}
                                </div>
                                <div class="col-md-2">
                                    {!! Form::select('tp', ['2014'=>'2014','2015'=>'2015','2016'=>'2016','2017'=>'2017','2018'=>'2018','2019'=>'2019','2020'=>'2020','2021'=>'2021','2022'=>'2022','2023'=>'2023','2024'=>'2024','2025'=>'2025'], null, ['class'=>'js-selectize','placeholder'=>'Tahun Pelaksanaan']) !!}
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-btn fa-search"></i> </button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>No. HP</th>
                                    <th>Jenis Kelas</th>
                                    <th>Latar Belakang</th>
                                    <th>Tgl. Pelaksanaan</th>
                                    <th>Judul</th>
                                    <th>Materi</th>
                                    <th>Input</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($datapeserta as $dp)
                                <tr>
                                    <td><b>{{ $dp->nis }}</b></td>
                                    <td><b>{{ $dp->nama }}</b></td>
                                    <td><b>{{ $dp->nohp }}</b></td>
                                    <td><b>{{ $dp->jeniskelas->name }}</b></td>
                                    <td><b>{{ $dp->latarbelakang }}</b></td>
                                    <td><b>{{ $dp->tanggalpelaksanaan }}</b></td>
                                    <td><b>{{ $dp->judulprogram }}</b></td>
                                    <td><b>{{ $dp->materi }}</b></td>
                                    <td><b>{{ $dp->posted_by }}</b></td>
                                    <td>
                                        <a href="{{ route('listdatapeserta.show',$dp->id) }}" class="btn btn-xs btn-success"><i class="fa fa-btn fa-eye"></i></a>
                                        <a href="{{ route('print.listdatapeserta',$dp->id) }}" class="btn btn-xs btn-default" target="_blank"><i class="fa fa-btn fa-print"></i></a>
                                        <a href="{{ route('listdatapeserta.edit',$dp->id) }}" class="btn btn-xs btn-info"><i class="fa fa-btn fa-pencil"></i></a>
                                        <a href="{{ route('listdatapeserta.destroy',$dp->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-btn fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $datapeserta->links() }}
                    {{-- {!! $html->table(['id'=>'datapeserta','class'=>'table-striped']) !!} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    {{-- {!! $html->scripts() !!} --}}
@endsection