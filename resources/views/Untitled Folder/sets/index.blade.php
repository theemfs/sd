@extends('layouts.app')

@section('libraries')
@endsection

@section('title', trans('app.Sets') )

@section('content')

	<div class="panel panel-default">
		<div class="panel-heading">

			{{ trans('app.Sets') }}
				<div class="btn-group pull-right" role="group" aria-label="...">
					<button onclick="window.location='{{ action('SetsController@index') }}'" type="button" class="btn btn-sm btn-default">{{ trans('app.Refresh') }}</button>
					<button onclick="window.location='{{ action('SetsController@create') }}'" type="button" class="btn btn-sm btn-success">{{ trans('app.Create') }}</button>
				</div>
		<hr>

			{!! Form::open(['method' => 'GET', 'url'=>'groups', 'class' => 'form-horizontal']) !!}
				<div class="form-horizontal">
					<div class="form-group">
						<div class="col-md-10 col-md-offset-1">
							<div class="input-group">
								{!! Form::text('filter', $filter, ['class' => 'form-control', 'autocomplete' => 'off', 'autofocus' => 'on']) !!}
								<div class="input-group-btn">
									{!! Form::submit(trans('app.Filter'), ['class' => 'btn btn-primary']) !!}
								</div>
							</div>
						</div>
					</div>
				</div>
			{!! Form::close() !!}

		</div>

		<div class="panel-body">

			@foreach ($sets as $set)

				<div class="snippet">
					<h4 class="snippet-heading">
						<a href="{{ action('SetsController@show', $set->id) }}">{{ $set->name }}</a>
							{{-- <div class="btn-group pull-right" role="group" aria-label="...">
								<button onclick="window.location='{{ 'groups' }}/{{ $set->id }}'" type="button" class="btn btn-xs btn-default">{{ trans('app.Show') }}</button>
								<button onclick="window.location='{{ 'groups' }}/{{ $set->id }}/edit'" type="button" class="btn btn-xs btn-warning">{{ trans('app.Edit') }}</button>
							</div> --}}
					</h4>
					<div class="snippet-body">
						<p>{{ $set->comment }}</p>
						<p>{{ trans('app.Performers Count')}}: {{ $set->performers->count() }}</p>
							@foreach ( $set->performers as $performer )
								{{ $performer->name }} /
							@endforeach
					</div>
				</div>

			@endforeach

			<div class="col-xs-12">
				{!! $sets->appends(['filter' => $filter])->links() !!}
			</div>

		</div>
	</div>

@endsection