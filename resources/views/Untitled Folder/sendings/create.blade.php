@extends('layouts.app')

@section('title', "Create Sending")

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			Create Sending
		</div>

		<div class="panel-body">
			{!! Form::open(['url'=>'sendings', 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						{!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>

				@include ('sendings.form', ['readonly' => ''])

			{!! Form::close() !!}
		</div>
	</div>
@stop