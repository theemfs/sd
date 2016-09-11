@extends('layouts.app')

@section('title', 'Edit Number #'.$number->id )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ 'Edit Number #'.$number->id }}
			<div class="btn-group pull-right" role="group" aria-label="...">
			</div>
		</div>

		<div class="panel-body">

			<div class="btn-group btn-group-justified" role="group" aria-label="...">
				{{ Form::open(['action' => ['NumbersController@destroy', $number->id], 'method' => 'DELETE', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-danger">Destroy</button>
				{{ Form::close() }}

				{{ Form::open(['action' => ['NumbersController@show', $number->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-default">Cancel</button>
				{{ Form::close() }}
			</div>
			<hr>

			{!! Form::model($number, ['method' => 'PATCH', 'action' => ['NumbersController@update', $number->id], 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						{!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label('id', null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::text('id', null, ['class' => 'form-control', 'autocomplete' => 'off', 'disabled']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Comment') , null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::textarea('comment', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
					</div>
				</div>

				{{-- <div class="form-group">
					{!! Form::label( trans('app.Groups') , null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::select('sets[]', $sets, $setsIds, ['id' => 'sets_list', 'class' => 'form-control', 'multiple', 'autocomplete' => 'off', 'size' => '5']) !!}
					</div>
				</div> --}}

			{!! Form::close() !!}
		</div>
	</div>
@stop