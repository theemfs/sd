@extends('layouts.app')

@section('title', 'Number #'.$number->id )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ 'Number #'.$number->id }}
			<div class="btn-group pull-right" role="group" aria-label="...">
			</div>
		</div>

		<div class="panel-body">

			<div class="btn-group btn-group-justified" role="group">
				{{ Form::open(['action' => ['NumbersController@destroy', $number->id], 'method' => 'DELETE', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-danger">Destroy</button>
				{{ Form::close() }}

				{{ Form::open(['action' => ['NumbersController@edit', $number->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-warning">Edit</button>
				{{ Form::close() }}
			</div>
			<hr>

			{!! Form::model($number, ['url'=>'numbers', 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<a class="btn btn-default form-control" href="{{ action('NumbersController@index') }}" role="button">Close</a>
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('id', null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::text('id', null, ['class' => 'form-control', 'autocomplete' => 'off', 'disabled', 'readonly']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('comment', null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::textarea('comment', null, ['class' => 'form-control', 'autocomplete' => 'off', 'disabled', 'readonly']) !!}
					</div>
				</div>

			{!! Form::close() !!}
		</div>
	</div>
@stop