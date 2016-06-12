@extends('layouts.app')

@section('libraries')
	{{-- <meta http-equiv="refresh" content="5"> --}}
@endsection

@section('title', 'Gateway #'.$modem->id.': '.$modem->name.'' )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ 'Gateway #'.$modem->id.': '.$modem->name.'' }}
		</div>

		<div class="panel-body">

			<div class="col-sm-10 col-sm-offset-2 pull-right">
				{{-- @if ( strstr($modem->getStatus()->status, 'online') )
					<p>Status: <span class="bg-success">{{ $modem->getStatus()->status }}</p></span>
				@else
					<p>Status: <span class="bg-danger">{{ $modem->getStatus()->status }}</p></span>
				@endif

				<p>Status: {{ $modem->getStatus()->status }}</p>
				<p>Sent (SMS / Reports): {{ $modem->getStatus()->sent->sms }} / {{ $modem->getStatus()->sent->dlr }}</p>
				<p>Recieved (SMS / Reports): {{ $modem->getStatus()->received->sms }} / {{ $modem->getStatus()->received->dlr }}</p> --}}
			</div>

			<div class="btn-group btn-group-justified" role="group" aria-label="...">
				{{--{{ Form::open(['action' => ['ModemsController@destroy', $modem->id], 'method' => 'DELETE', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-danger">Destroy</button>
				{{ Form::close() }}--}}

				{{ Form::open(['action' => ['ModemsController@edit', $modem->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-warning">Edit</button>
				{{ Form::close() }}

				{{ Form::open(['action' => ['ModemsController@show', $modem->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-info">Refresh</button>
				{{ Form::close() }}

			</div>
			<hr>

			{!! Form::model($modem, ['url'=>'modems', 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<a class="btn btn-default form-control" href="{{ action('ModemsController@index') }}" role="button">Close</a>
					</div>
				</div>

				@include ('modems.form', ['readonly' => 'readonly'])

			{!! Form::close() !!}


		</div>
	</div>
@stop