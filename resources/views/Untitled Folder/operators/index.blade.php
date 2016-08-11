@extends('layouts.app')

@section('libraries')
@endsection

@section('title', trans('app.Operators'))

@section('content')

	<div class="panel panel-default">
		<div class="panel-heading">

			{{ trans('app.Operators') }}
				<div class="btn-group pull-right" role="group" aria-label="...">
					<button onclick="window.location='{{ action('NumbersController@index') }}'" type="button" class="btn btn-sm btn-default">{{ trans('app.Refresh') }}</button>
					<button onclick="window.location='{{ action('NumbersController@create') }}'" type="button" class="btn btn-sm btn-success">{{ trans('app.Create') }}</button>
				</div>
		<hr>

			{!! Form::open(['method' => 'GET', 'url'=>'numbers', 'class' => 'form-horizontal']) !!}
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

			@foreach ($operators as $operator)

				<div class="snippet">
					<h4 class="snippet-heading">
						<a href="{{ action('NumbersController@show', $operator->id) }}">{{ $operator->name }}</a>
							<div class="btn-group pull-right" role="group">
								{{-- <button onclick="window.location='{{ 'numbers' }}/{{ $operator->id }}'" type="button" class="btn btn-xs btn-default">{{ trans('app.Show') }}</button>
								<button onclick="window.location='{{ 'numbers' }}/{{ $operator->id }}/edit'" type="button" class="btn btn-xs btn-warning">{{ trans('app.Edit') }}</button> --}}
							</div>
					</h4>
					<div class="snippet-body">
						<p>({{ $operator->code }}) {{ $operator->from }}-{{ $operator->to }}</p>
					</div>
				</div>

			@endforeach

			<div class="col-xs-12">
				{!! $operators->links() !!}
			</div>

		</div>
	</div>

@endsection