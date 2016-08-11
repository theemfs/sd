@extends('layouts.app')

@section('title', trans('app.Create Round'))

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ trans('app.Create Round') }}
		</div>

		<div class="panel-body">
			{!! Form::open(['url'=>'rounds', 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						{!! Form::submit( trans('app.Create'), ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Name'), null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Text') , null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::textarea('text', null, ['class' => 'form-control', 'autocomplete' => 'off', 'rows' => '5']) !!}
					</div>
				</div>

				{{-- <div class="form-group">
					{!! Form::label( trans('app.Groups'), null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::select('groups[]', $groups, $groupsIds, ['id'=>'groups_list', 'class' => 'form-control', 'multiple', 'autocomplete' => 'off']) !!}
					</div>
				</div> --}}

			{{-- 	<div class="form-group">
					{!! Form::label( trans('app.Start'), null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::checkbox('start', null, false) !!}
					</div>
				</div> --}}

				{{--<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>--}}

			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	<script>
		$('#groups_list').select2({
			placeholder: "Добавлять можно по очереди или с нажатой Ctrl",
		});
		// $('#phones_list').select2({
		// 	placeholder: "Добавлять можно по очереди или с нажатой Ctrl",
		// });
	</script>
@endsection