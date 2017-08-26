@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul class="breadcrumb">
				<li><a href="{{ url('/home') }}">Dashboard</a></li>
				<li><a href="{{ url('/admin/materi') }}">Materi</a></li>
				<li class="active">Ubah Materi</li>
			</ul>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2 class="panel-title">Ubah Materi</h2>
				</div>
				<div class="panel-body">
					{!! Form::model($materi, ['url' => route('materi.update', $materi->id),
					'method'=>'put', 'class'=>'form-horizontal']) !!}
					@include('materi._form')
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection