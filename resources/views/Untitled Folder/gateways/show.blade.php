@extends('layouts.app')

@section('libraries')
	{{-- <meta http-equiv="refresh" content="5"> --}}
@endsection

@section('title', 'Gateway #'.$gateway->id.': '.$gateway->name.'' )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ 'Gateway #'.$gateway->id.': '.$gateway->name.'' }}
		</div>

		<div class="panel-body">

			<div class="col-sm-10 col-sm-offset-2 pull-right">
				{{-- @if ( strstr($gateway->getStatus()->status, 'online') )
					<p>Status: <span class="bg-success">{{ $gateway->getStatus()->status }}</p></span>
				@else
					<p>Status: <span class="bg-danger">{{ $gateway->getStatus()->status }}</p></span>
				@endif

				<p>Status: {{ $gateway->getStatus()->status }}</p>
				<p>Sent (SMS / Reports): {{ $gateway->getStatus()->sent->sms }} / {{ $gateway->getStatus()->sent->dlr }}</p>
				<p>Recieved (SMS / Reports): {{ $gateway->getStatus()->received->sms }} / {{ $gateway->getStatus()->received->dlr }}</p> --}}
			</div>

			<div class="btn-group btn-group-justified" role="group">
				{{--{{ Form::open(['action' => ['GatewaysController@destroy', $gateway->id], 'method' => 'DELETE', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-danger">Destroy</button>
				{{ Form::close() }}--}}

				{{ Form::open(['action' => ['GatewaysController@restart', $gateway->id], 'method' => 'POST', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-danger"><i class="fa fa-refresh"></i> {{ trans('app.Restart') }}</button>
				{{ Form::close() }}

				{{-- 
				{{ Form::open(['action' => ['GatewaysController@checkbalance', $gateway->id], 'method' => 'POST', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-danger"><i class="fa fa-refresh"></i> {{ trans('app.Check All Modems Balance') }}</button>&nbsp;
				{{ Form::close() }}
				 --}}

				{{ Form::open(['action' => ['GatewaysController@edit', $gateway->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-warning">Edit</button>&nbsp;
				{{ Form::close() }}

				{{ Form::open(['action' => ['GatewaysController@show', $gateway->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-info">Refresh</button>&nbsp;
				{{ Form::close() }}

			</div>
			<hr>

			@foreach ($modems as $modem)
				<div class="col-sm-offset-2">
					<div class="snippet bg-info">
						<h4 class="snippet-heading">
							<a href="{{ action('ModemsController@show', $modem->id) }}">{{ $modem->name }}</a>
						</h4>
						<div class="snippet-body">
							{{-- <p>Created / Updated / Number / Comment</p> --}}
							{{-- <p>{{ $modem->created_at }} / {{ $modem->updated_at}} / {{ $modem->sender }} / {{ $modem->comment }} / {{ $modem->status }}</p> --}}
							{{-- <p>{{ $modem->created_at }} / {{ $modem->updated_at}} / {{ $modem->sender }} / {{ $modem->comment }}</p> --}}
						</div>
					</div>
				</div>
			@endforeach

			{{-- 
			{!! Form::model($gateway, ['url'=>'gateways', 'class' => 'form-horizontal']) !!}
			 --}}

			{{-- 
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<a class="btn btn-default form-control" href="{{ action('GatewaysController@index') }}" role="button">Close</a>
					</div>
				</div>

				<hr>
				
				@include ('gateways.form', ['readonly' => 'readonly'])

				<div class="form-group">
					{!! Form::label('status', null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::textarea('status', $status, ['class' => 'form-control', 'autocomplete' => 'off', 'rows'=>'70', 'readonly', 'rows'=>'32']) !!}
					</div>
				</div>
			--}}
			{{-- 
			{!! Form::close() !!}

			<hr>
			--}}

		</div>
	</div>
@stop

@section('footer')
	<script>
		// $("#restart").attr('disabled', 'disabled');
	</script>
@stop