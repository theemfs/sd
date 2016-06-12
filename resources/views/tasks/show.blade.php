@extends('layouts.app')

@section('title', 'Task #'.$task->id.': '.$task->name.'' )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ 'Task #'.$task->id.': '.$task->name.'' }}
			<div class="btn-group pull-right" role="group" aria-label="...">

				{{ Form::open(['action' => ['TasksController@destroy', $task->id], 'method' => 'DELETE', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-xs btn-danger">Destroy</button>
				{{ Form::close() }}

				{{ Form::open(['action' => ['TasksController@edit', $task->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-xs btn-warning">Edit</button>
				{{ Form::close() }}

			</div>
		</div>

		<div class="panel-body">
			{!! Form::model($task, ['url'=>'tasks', 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<a class="btn btn-default form-control" href="{{ action('TasksController@index') }}" role="button">{{ trans('app.Close') }}</a>
					</div>
				</div>

				<hr>

				<div class="form-group">
					{!! Form::label( trans('app.Count'), null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::text('count', null, ['class' => 'form-control', 'autocomplete' => 'off', 'readonly']) !!}
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-xs-2" for="modems_list">{{ trans('app.Round') }}</label>
					<div class="col-sm-10">
						{!! Form::text('round_id', $round->name, ['class' => 'form-control', 'autocomplete' => 'off', 'readonly']) !!}
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-xs-2" for="modems_list">{{ trans('app.Modem') }}</label>
					<div class="col-sm-10">
						{!! Form::text('modem_id', $modem->name, ['class' => 'form-control', 'autocomplete' => 'off', 'readonly']) !!}
					</div>
				</div>

			{!! Form::close() !!}
		</div>
	</div>
@stop