@extends('layouts.app')

@section('title', "Create Group")

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			Create Group
		</div>

		<div class="panel-body">
			{!! Form::open(['url'=>'groups', 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						{!! Form::submit( trans('app.Create'), ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>

				@include ('groups.form', ['readonly' => ''])

			{!! Form::close() !!}
		</div>
	</div>
@stop