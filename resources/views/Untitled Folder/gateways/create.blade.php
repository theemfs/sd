@extends('layouts.app')

@section('title', "Create Gateway")

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			Create Gateway
		</div>

		<div class="panel-body">
			{!! Form::open(['url'=>'gateways', 'class' => 'form-horizontal']) !!}

				@include ('gateways.form', ['readonly' => ''])

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						{!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>

			{!! Form::close() !!}
		</div>
	</div>
@stop