@extends('layouts.app')

@section('title', 'Edit Phone #'.$modems->id.': '.$modems->name.'' )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ 'Edit Phone #'.$modems->id.': '.$modems->name.'' }}
		</div>

		<div class="panel-body">

			<div class="btn-group btn-group-justified" role="group" aria-label="...">
				{{ Form::open(['action' => ['ModemsController@destroy', $modems->id], 'method' => 'DELETE', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-danger">Destroy</button>
				{{ Form::close() }}

				{{ Form::open(['action' => ['ModemsController@show', $modems->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-default">Cancel</button>
				{{ Form::close() }}
			</div>
			<hr>

			{!! Form::model($modems, ['method' => 'PATCH', 'action' => ['ModemsController@update', $modems->id], 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						{!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>

				@include ('modems.form', ['readonly' => ''])

			{!! Form::close() !!}
		</div>
	</div>
@stop