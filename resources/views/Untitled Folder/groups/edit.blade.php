@extends('layouts.app')

@section('title', 'Edit group #'.$group->id.': '.$group->name.'' )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ 'Group #'.$group->id.': '.$group->name.'' }}
			<div class="btn-group pull-right" role="group" aria-label="...">

				{{ Form::open(['action' => ['GroupsController@destroy', $group->id], 'method' => 'DELETE', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-xs btn-danger">Destroy</button>
				{{ Form::close() }}

				{{ Form::open(['action' => ['GroupsController@show', $group->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-xs btn-default">Cancel</button>
				{{ Form::close() }}

			</div>
		</div>

		<div class="panel-body">
			{!! Form::model($group, ['method' => 'PATCH', 'action' => ['GroupsController@update', $group->id], 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						{!! Form::submit( trans('app.Update'), ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>

				@include ('groups.form', ['readonly' => ''])

			{!! Form::close() !!}
		</div>
	</div>
@stop