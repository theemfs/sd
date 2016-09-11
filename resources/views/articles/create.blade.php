@extends('layouts.app')



@section('title', trans("app.Create Case"))



@section('content')



{{-- BREADCRUMBS --}}
<ol class="breadcrumb">
	<li><a href="{{ url('/') }}">{{ trans('app.Home') }}</a></li>
	<li><a href="{{ action('ArticlesController@index') }}">{{ trans('app.Articles') }}</a></li>
	<li class="active">{{ trans('app.Article Creating') }}</li>
</ol>



	<!-- LEFT BLOCK -->
	<div class="col-md-2">
	</div>



	<!-- CENTER BLOCK -->
	<div class="col-md-8">
		<div class="panel panel-default">

			<div class="panel-heading">
				{{ trans("app.Article Creating") }}
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
							{!! Form::textarea('text', null, ['class' => 'form-control', 'rows' => '10', 'autocomplete' => 'off', 'placeholder' => trans('app.Case Text')]) !!}
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
							{!! Form::button( '<i class="fa fa-fw fa-btn fa-check"></i>' . trans('app.Create'), ['type' => 'submit', 'class' => 'btn btn-primary form-control']) !!}
						</div>
					</div>



				{!! Form::close() !!}

			</div>
		</div>
	</div>



	<!-- RIGHT BLOCK -->
	<div class="col-md-2">
	</div>

@endsection



@section('js')
@endsection