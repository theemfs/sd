@extends('layouts.app')

@section('title', 'Phone #'.$phone->id.': '.$phone->name.'' )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ 'Phone #'.$phone->id.': '.$phone->name.'' }}
			<div class="btn-group pull-right" role="group" aria-label="...">

				{{ Form::open(['action' => ['PhonesController@destroy', $phone->id], 'method' => 'DELETE', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-xs btn-danger">Destroy</button>
				{{ Form::close() }}

				{{ Form::open(['action' => ['PhonesController@edit', $phone->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-xs btn-warning">Edit</button>
				{{ Form::close() }}

			</div>
		</div>

		<div class="panel-body">
			{!! Form::model($phone, ['url'=>'phones', 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<a class="btn btn-default form-control" href="{{ action('PhonesController@index') }}" role="button">Close</a>
					</div>
				</div>

				{{-- <div class="form-group">
					{!! Form::label('name', null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'disabled', 'readonly']) !!}
					</div>
				</div> --}}

				<div class="form-group">
					{!! Form::label('comment', null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::textarea('comment', null, ['class' => 'form-control', 'autocomplete' => 'off', 'disabled', 'readonly']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Performers'), null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::text('name', $performers['name'], ['class' => 'form-control', 'autocomplete' => 'off', 'disabled', 'readonly']) !!}
					</div>
				</div>

			{!! Form::close() !!}
		</div>
	</div>
@stop