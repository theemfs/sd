@extends('layouts.app')

@section('libraries')
@endsection

@section('title', trans('app.Sendings') )

@section('content')

	<div class="panel panel-default">
		<div class="panel-heading">

			{{ trans('app.Sendings') }}
				<div class="btn-group pull-right" role="group" aria-label="...">
					<button onclick="window.location='{{ action('SendingsController@index') }}'" type="button" class="btn btn-sm btn-default">{{ trans('app.Refresh') }}</button>
					<button onclick="window.location='{{ action('SendingsController@create') }}'" type="button" class="btn btn-sm btn-success">{{ trans('app.Create') }}</button>
				</div>
		<hr>

			{!! Form::open(['method' => 'GET', 'url'=>'sendings', 'class' => 'form-horizontal']) !!}
				<div class="form-horizontal">
					<div class="form-group">
						<div class="col-md-10 col-md-offset-1">
							<div class="input-group">
								{!! Form::text('filter', $filter, ['class' => 'form-control', 'autocomplete' => 'off', 'autofocus' => 'on']) !!}
								<div class="input-group-btn">
									{!! Form::submit( trans('app.Filter'), ['class' => 'btn btn-primary']) !!}
								</div>
							</div>
						</div>
					</div>
				</div>
			{!! Form::close() !!}

		</div>

		<div class="panel-body">

			@foreach ($sendings as $sending)

				<div class="snippet">
					<h4 class="snippet-heading">
						<a href="{{ action('SendingsController@show', $sending->id) }}">{{ $sending->name }}</a>
							{{-- <div class="btn-group pull-right" role="group">
								<button onclick="window.location='{{ 'sendings' }}/{{ $sending->id }}'" type="button" class="btn btn-xs btn-default">{{ trans('app.Show') }}</button>
								<button onclick="window.location='{{ 'sendings' }}/{{ $sending->id }}/edit'" type="button" class="btn btn-xs btn-warning">{{ trans('app.Edit') }}</button>
							</div> --}}
					</h4>
					<div class="snippet-body">
						<p>{{ $sending->comment }}</p>
					</div>
				</div>

			@endforeach

			<div class="col-xs-12">
				{!! $sendings->appends(['filter' => $filter])->links() !!}
			</div>

		</div>
	</div>

@endsection