@extends('layouts.app')

@section('title', trans('app.AdminSection') )

@section('content')
	<div class="panel panel-default">
		
		<div class="panel-heading">{{ trans('app.Users') }}</div>
		
		@include('pages.admin.menu')

		<div class="panel-body">
			@foreach($users as $user)
				<p>{{ $user->name }}</p>
			@endforeach
		</div>

	</div>
@endsection