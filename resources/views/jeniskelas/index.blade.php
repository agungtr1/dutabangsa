@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li class="active">Jenis Kelas</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Jenis Kelas</h2>
				</div>
				<div class="panel-body">
					<p> <a class="btn btn-primary" href="{{ route('jeniskelas.create') }}">Tambah</a> </p>
					<div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($jeniskelas as $dp)
                                <tr>
                                    <td><b>{{ $dp->name }}</b></td>
                                    <td>
                                        <a href="{{ route('jeniskelas.edit',$dp->id) }}" class="btn btn-xs btn-info"><i class="fa fa-btn fa-pencil"></i></a>
                                    </td>
                                    <td>
                                    	@if ($dp->id != 1  && $dp->id != 2 && $dp->id != 3 && $dp->id != 4 && $dp->id != 5 && $dp->id != 6)
                                    	{!! Form::open(['url'=>route('jeniskelas.destroy',$dp->id),'method'=>'delete','class'=>'form-inline js-confirm','data-confirm'=>'Are you sure you want to delete this item?','_token'=>csrf_token()]) !!}
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-btn fa-trash"></i></button>
                                        {!! Form::close() !!}
										@endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
					{{-- {!! $html->table(['class'=>'table-striped']) !!} --}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
	{{-- {!! $html->scripts() !!} --}}
@endsection