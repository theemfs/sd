@extends('layouts.app')

@section('title', trans('app.Dashboard') )

@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">{{ trans('app.Dashboard') }}</div>

			<div class="panel-body">
				{{-- <p>All numbers {{ $data->total }}</p>
				<p>Deleted {{ $data->deleted }}</p> --}}
			</div>
		</div>
	</div>
@endsection