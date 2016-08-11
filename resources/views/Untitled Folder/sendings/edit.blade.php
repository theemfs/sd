@extends('layouts.app')

@section('title', trans('app.Sending').' #'.$sendings->id.': '.$sendings->name.'' )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ trans('app.Sending').' #'.$sendings->id.': '.$sendings->name.'' }}
			<div class="btn-group pull-right" role="group" aria-label="...">

				{{ Form::open(['action' => ['SendingsController@send', $sendings->id], 'method' => 'POST', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-xs btn-success">{{ trans('app.Send') }}</button>
				{{ Form::close() }}

				{{ Form::open(['action' => ['SendingsController@destroy', $sendings->id], 'method' => 'DELETE', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-xs btn-danger">{{ trans('app.Destroy') }}</button>
				{{ Form::close() }}

				{{ Form::open(['action' => ['SendingsController@show', $sendings->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-xs btn-default">{{ trans('app.Cancel') }}</button>
				{{ Form::close() }}

			</div>
		</div>

		<div class="panel-body">
			{!! Form::model($sendings, ['method' => 'PATCH', 'action' => ['SendingsController@update', $sendings->id], 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						{!! Form::submit( trans('app.Update'), ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>

				@include ('sendings.form', ['readonly' => ''])

			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
@endsection