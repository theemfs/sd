@extends('layouts.app')

@section('title', trans('app.Create Set') )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ trans('app.Create Set') }}
		</div>

		<div class="panel-body">
			{!! Form::open(['url'=>'sets', 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						{!! Form::submit( trans('app.Create'), ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>

				<hr>

				<div class="form-group">
					{!! Form::label( trans('app.Name'), null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Comment'), null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::textarea('comment', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
					</div>
				</div>

			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	<script>
		$('#sets_list').select2({
			placeholder: "Добавлять можно по очереди или с нажатой Ctrl",
		});
	</script>
@endsection