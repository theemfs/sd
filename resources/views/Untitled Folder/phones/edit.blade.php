@extends('layouts.app')

@section('title', 'Edit Phone #'.$phone->id.': '.$phone->name.'' )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ 'Edit Phone #'.$phone->id.': '.$phone->name.'' }}
			<div class="btn-group pull-right" role="group" aria-label="...">

				{{ Form::open(['action' => ['PhonesController@destroy', $phone->id], 'method' => 'DELETE', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-xs btn-danger">Destroy</button>
				{{ Form::close() }}

				{{ Form::open(['action' => ['PhonesController@show', $phone->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-xs btn-default">Cancel</button>
				{{ Form::close() }}

			</div>
		</div>

		<div class="panel-body">
			{!! Form::model($phone, ['method' => 'PATCH', 'action' => ['PhonesController@update', $phone->id], 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						{!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>

				@include ('phones.form', ['readonly' => ''])

			{!! Form::close() !!}
		</div>
	</div>
@stop