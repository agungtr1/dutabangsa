{!! Form::model($model, ['url'=>$form_url, 'method'=>'delete','class'=>'form-inline js-confirm','data-confirm'=>$confirm_message]) !!}
	<a href="{{ $show_url }}" class="btn btn-xs btn-success"><i class="fa fa-btn fa-eye"></i></a>
	<a href="{{ $print_url }}" class="btn btn-xs btn-default" target="_blank"><i class="fa fa-btn fa-print"></i></a>
	<a href="{{ $edit_url }}" class="btn btn-xs btn-info"><i class="fa fa-btn fa-pencil"></i></a>
	{!! Form::button('<i class="fa fa-btn fa-trash"></i>', ['type' => 'submit', 'class'=>'btn btn-xs btn-danger']) !!}
{!! Form::close() !!}