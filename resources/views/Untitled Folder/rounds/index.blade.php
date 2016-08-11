@extends('layouts.app')

@section('libraries')
@endsection

@section('title', trans('app.Rounds') )

@section('content')

	<div class="panel panel-default">
		<div class="panel-heading">

			{{ trans('app.Rounds') }}
				<div class="btn-group pull-right" role="group" aria-label="...">
					<button onclick="window.location='{{ action('RoundsController@index') }}'" type="button" class="btn btn-sm btn-default">{{ trans('app.Refresh') }}</button>
					<button onclick="window.location='{{ action('RoundsController@create') }}'" type="button" class="btn btn-sm btn-success">{{ trans('app.Create') }}</button>
				</div>
		<hr>

			{!! Form::open(['method' => 'GET', 'url'=>'rounds', 'class' => 'form-horizontal']) !!}
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

			@foreach ($rounds as $sending)

				<div class="snippet">
					<h4 class="snippet-heading">
						<a href="{{ action('RoundsController@show', $sending->id) }}">{{ $sending->name }}</a>
							{{-- <div class="btn-group pull-right" role="group">
								<button onclick="window.location='{{ 'rounds' }}/{{ $sending->id }}'" type="button" class="btn btn-xs btn-default">{{ trans('app.Show') }}</button>
								<button onclick="window.location='{{ 'rounds' }}/{{ $sending->id }}/edit'" type="button" class="btn btn-xs btn-warning">{{ trans('app.Edit') }}</button>
							</div> --}}
					</h4>
					<div class="snippet-body">
						<p>{{ $sending->comment }}</p>
					</div>
				</div>

			@endforeach

			<div class="col-xs-12">
				{!! $rounds->appends(['filter' => $filter])->links() !!}
			</div>

		</div>
	</div>

@endsection