@extends('layouts.app')

@section('title', "Create Number")

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			Create Number
		</div>

		<div class="panel-body">

			<div class="btn-group btn-group-justified" role="group" aria-label="...">
				{{ Form::open(['action' => ['NumbersController@index'], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-default">Cancel</button>
				{{ Form::close() }}
			</div>
			<hr>

			{!! Form::open(['url'=>'numbers', 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						{!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('id', null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::text('id', null, ['class' => 'form-control', 'autocomplete' => 'off', 'autofocus' => 'on']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('comment', null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::textarea('comment', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
					</div>
				</div>

			{!! Form::close() !!}
		</div>
	</div>
@stop