@extends('layouts.app')

@section('title', "Create Phone")

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			Create Phone
		</div>

		<div class="panel-body">
			{!! Form::open(['url'=>'phones', 'class' => 'form-horizontal']) !!}

				@include ('phones.form', ['readonly' => ''])

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						{!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>

			{!! Form::close() !!}
		</div>
	</div>
@stop