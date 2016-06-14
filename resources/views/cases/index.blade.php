@extends('layouts.app')

@section('libraries')
@endsection

@section('title', trans('app.Cases'))

@section('content')

	<div class="panel panel-default">

		<div class="panel-heading">
			{{ trans('app.Cases') }}
			<a class="btn btn-default btn-success pull-right btn-xs" href="{{ action('CasesController@create') }}" role="button">{{ trans('app.Create') }}</a>
		</div>

		<div class="panel-body">

			@foreach ($cases as $case)

				<div class="snippet">

					<h4 class="snippet-heading">
						<p class="pull-right">{{ $case->id }}</p>
						<!-- <a href="{{ action('CasesController@show', $case->id) }}">{{ mb_substr($case->text, 0, 50)."..." }}</a> -->
						<a href="{{ action('CasesController@show', $case->id) }}">{{ $case->name }}</a>
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