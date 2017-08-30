@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li class="active">Materi</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Materi</h2>
				</div>
				<div class="panel-body">
					<p> <a class="btn btn-primary" href="{{ route('materi.create') }}">Tambah</a> </p>
					<div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($materi as $m)
                                <tr>
                                    <td><b>{{ $m->name }}</b></td>
                                    <td>
                                        <a href="{{ route('materi.edit',$m->id) }}" class="btn btn-xs btn-info"><i class="fa fa-btn fa-pencil"></i></a>
                                        <a href="{{ route('materi.destroy',$m->id) }}" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-btn fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $materi->links() }}
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