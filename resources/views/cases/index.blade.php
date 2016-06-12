@extends('layouts.app')

@section('libraries')
@endsection

@section('title', trans('app.Cases'))

@section('content')

	<div class="panel panel-default">
		<div class="panel-heading">

			{{ trans('app.Cases') }}
				<div class="btn-group pull-right" role="group" aria-label="...">
					{{-- <button onclick="window.location='{{ action('CasesController@index') }}'" type="button" class="btn btn-sm btn-default">{{ trans('app.Refresh') }}</button> --}}
					<button onclick="window.location='{{ action('CasesController@create') }}'" type="button" class="btn btn-sm btn-success">{{ trans('app.Create') }}</button>
					{{-- <button onclick="window.location='{{ action('CasesController@clean2') }}'" type="button" class="btn btn-sm btn-danger">{{ trans('app.Clean') }}</button> --}}
				</div>
		<hr>

			{!! Form::open(['method' => 'GET', 'url'=>'cases', 'class' => 'form-horizontal']) !!}
				<div class="form-horizontal">
					<div class="form-group">
						<div class="col-xs-12">
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

			@foreach ($cases as $case)

				<div class="snippet">

					<h4 class="snippet-heading">
						<p class="pull-right">{{ $case->id }}</p>
						<a href="{{ action('CasesController@show', $case->id) }}">{{ mb_substr($case->text, 0, 50)."..." }}</a>
					</h4>


					<p>{{ $case->user->name }}</p>
					<div class="snippet-body">
						<p>{{ mb_substr($case->text, 0, 300)."..." }}</p>
					</div>
				</div>

			@endforeach

			<div class="col-xs-12">
				{!! $cases->links() !!}
			</div>

		</div>
	</div>

@endsection