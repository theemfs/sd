@extends('layouts.app')

@section('title', trans("app.Create Case"))

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ trans("app.Create Case") }}
		</div>

		<div class="panel-body">

			{!! Form::open(['url'=>'cases', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}

				{{-- <div class="form-group">
					{!! Form::label('', null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::text('id', null, ['class' => 'form-control', 'autocomplete' => 'off', 'autofocus' => 'on', 'placeholder' => 'Опишите проблему в двух словах']) !!}
						<p class="text-muted">{{ trans('app.Text Hint') }}</p>
					</div>
				</div> --}}

				<div class="form-group">
					{{-- {!! Form::label( trans('app.Text'), null, ['class' => 'control-label col-xs-2']) !!} --}}
					<div class="col-sm-12">
						{!! Form::textarea('text', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => trans('app.Text Placeholder')]) !!}
						{{-- <p class="text-muted">{{ trans('app.Text Hint') }}</p> --}}
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-12">
						{!! Form::file( 'attachments[]', ['class' => '', 'multiple' => 'true']) !!}
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-2 col-sm-offset-2 pull-right">
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
@stop