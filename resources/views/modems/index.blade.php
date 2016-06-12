@extends('layouts.app')

@section('libraries')
	{{-- <meta http-equiv="refresh" content="5"> --}}
@endsection

@section('title', trans('app.Modems') )

@section('content')

	<div class="panel panel-default">
		<div class="panel-heading">

			{{ trans('app.Modems') }}
				<div class="btn-group pull-right" role="group" aria-label="...">
					<button onclick="window.location='{{ action('ModemsController@index') }}'" type="button" class="btn btn-sm btn-default">Refresh</button>
					<button onclick="window.location='{{ action('ModemsController@create') }}'" type="button" class="btn btn-sm btn-success">Create</button>
				</div>
		<hr>

			{!! Form::open(['method' => 'GET', 'url'=>'modems', 'class' => 'form-horizontal']) !!}
				<div class="form-horizontal">
					<div class="form-group">
						<div class="col-md-10 col-md-offset-1">
							<div class="input-group">
								{!! Form::text('filter', $filter, ['class' => 'form-control', 'autocomplete' => 'off', 'autofocus' => 'on']) !!}
								<div class="input-group-btn">
									{!! Form::submit('Filter', ['class' => 'btn btn-primary']) !!}
								</div>
							</div>
						</div>
					</div>
				</div>
			{!! Form::close() !!}

		</div>

		<div class="panel-body">

			@if ( Session::has('notification') )
				<div class="alert alert-info">{{ Session::get('notification') }}</div>
			@endif

			@foreach ($modems as $modem)

				<div class="snippet">
					<h4 class="snippet-heading">
						{{ $modem->name }}
							<div class="btn-group pull-right" role="group" aria-label="...">
								<button onclick="window.location='{{ 'modems' }}/{{ $modem->id }}'" type="button" class="btn btn-xs btn-default">Show</button>
								<button onclick="window.location='{{ 'modems' }}/{{ $modem->id }}/edit'" type="button" class="btn btn-xs btn-warning">Edit</button>
							</div>
					</h4>
					<div class="snippet-body">
						<p>{{ $modem->comment }}</p>

						<div class="">
							{{-- @if ( strstr($modem->getStatus()->status, 'online') )
								<p>Status: <span class="bg-success">{{ $modem->getStatus()->status }}</p></span>
							@else
								<p>Status: <span class="bg-danger">{{ $modem->getStatus()->status }}</p></span>
							@endif

							<p>Status: {{ $modem->getStatus()->status }}</p>
							<p>Sent (SMS / Reports): {{ $modem->getStatus()->sent->sms }} / {{ $modem->getStatus()->sent->dlr }}</p>
							<p>Recieved (SMS / Reports): {{ $modem->getStatus()->received->sms }} / {{ $modem->getStatus()->received->dlr }}</p> --}}
						</div>

					</div>
				</div>

			@endforeach

			<div class="col-xs-12">
				{!! $modems->appends(['filter' => $filter])->links() !!}
			</div>

		</div>
	</div>

@endsection