@extends('layouts.app')

@section('title', trans("app.Create Case"))

@section('content')


	<!-- LEFT BLOCK -->
	<div class="col-sm-3">
	</div>



	<!-- CENTER BLOCK -->
	<div class="col-sm-6">
		<div class="panel panel-default">

			<div class="panel-heading">
				{{ trans("app.Create Case") }}
			</div>

			<div class="panel-body">

				{!! Form::open(['url'=>'cases', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

					<div class="form-group">
						<div class="col-sm-12">
							{!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'autofocus' => 'on', 'placeholder' => trans('app.Case Title')]) !!}
						</div>
					</div>

					<div class="form-group">
						{{-- {!! Form::label( trans('app.Text'), null, ['class' => 'control-label col-xs-2']) !!} --}}
						<div class="col-sm-12">
							{!! Form::textarea('text', null, ['class' => 'form-control', 'rows' => '3', 'autocomplete' => 'off', 'placeholder' => trans('app.Case Text')]) !!}
							{{-- <p class="text-muted">{{ trans('app.Text Hint') }}</p> --}}
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-12">
							{!! Form::file( 'attachments[]', ['class' => '', 'multiple' => 'true']) !!}
						</div>
					</div>

					<div class="form-group">
						<div class="col-xs-12 pull-right">
							{!! Form::submit( trans('app.Create'), ['class' => 'btn btn-primary form-control']) !!}
						</div>
					</div>



				{!! Form::close() !!}

				{{-- <div class="btn-group btn-group-justified" role="group" aria-label="...">
					{{ Form::open(['action' => ['CasesController@index'], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
						<button type="submit" type="button" class="btn btn-default">{{ trans('app.Cancel') }}</button>
					{{ Form::close() }}
				</div> --}}

			</div>
		</div>
	</div>



	<!-- RIGHT BLOCK -->
	<div class="col-sm-3">
	</div>



@stop