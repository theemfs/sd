@extends('layouts.app')

@section('title', "Create Task")

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			Create Task
		</div>

		<div class="panel-body">
			{!! Form::open(['url'=>'tasks', 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						{!! Form::submit( trans('app.Create'), ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>

				<hr>

				<div class="form-group">
					{!! Form::label( trans('app.Count'), null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::text('count', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-xs-2" for="modems_list">{{ trans('app.Round') }}</label>
					<div class="col-sm-10">
						<select id="round_list" name="round_id" class="form-control">
							@foreach ($rounds as $round)
								<option value="{{ $round->id }}">{{ $round->name }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-xs-2" for="modems_list">{{ trans('app.Modem') }}</label>
					<div class="col-sm-10">
						<select id="modems_list" name="modem_id" class="form-control">
							@foreach ($modems as $modem)
								<option value="{{ $modem->id }}">{{ $modem->name }}</option>
							@endforeach
						</select>
					</div>
				</div>

			{!! Form::close() !!}
		</div>
	</div>
@stop