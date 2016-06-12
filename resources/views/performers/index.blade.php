@extends('layouts.app')

@section('libraries')
@endsection

@section('title', trans('app.Performers') )

@section('content')

	<div class="panel panel-default">
		<div class="panel-heading">

			{{ trans('app.Performers') }}
				<div class="btn-group pull-right" role="group" aria-label="...">
					<button onclick="window.location='{{ action('PerformersController@index') }}'" type="button" class="btn btn-sm btn-default">{{ trans('app.Refresh') }}</button>
					<button onclick="window.location='{{ action('PerformersController@create') }}'" type="button" class="btn btn-sm btn-success">{{ trans('app.Create') }}</button>
				</div>
		<hr>

			{!! Form::open(['method' => 'GET', 'url'=>'performers', 'class' => 'form-horizontal']) !!}
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

			@foreach ($performers as $performer)

				<div class="snippet">
					<h4 class="snippet-heading">
						<a href="{{ action('PerformersController@show', $performer->id) }}">{{ $performer->name }}</a>

							<div class="btn-group pull-right" role="group">
								{{ $performer->id }}
								{{-- <a href="{{ action('PerformersController@show', $performer->id) }}" type="button" class="btn btn-xs btn-default">{{ trans('app.Show') }}</a>
								<button onclick="window.location='performers/{{ $performer->id }}/edit'" type="button" class="btn btn-xs btn-warning">{{ trans('app.Edit') }}</button> --}}
							</div>
					</h4>
					<div class="snippet-body">

							<p>{{ $performer->comment }}</p>
							<p>
								@foreach ( $performer->phones as $phone )
									<a class="btn btn-default btn-xs" href="{{ action('PhonesController@show', $phone->id) }}" class="">{{ $phone->id }}</a>
								@endforeach
							</p>
							<p>
								@foreach ( $performer->groups as $group )
									<a class="btn btn-info btn-xs" href="{{ action('GroupsController@show', $group->id) }}" class="">{{ $group->name }}</a>
								@endforeach
							</p>
					</div>
				</div>

			@endforeach

			<div class="col-xs-12">
				@if ( strlen($filter)>0 )
					{!! $performers->appends(['filter' => $filter])->links() !!}
				@else
					{!! $performers->links() !!}
				@endif
			</div>

		</div>
	</div>

@endsection