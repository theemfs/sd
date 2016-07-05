@extends('layouts.app')

@section('title', trans('app.AdminSection') )

@section('content')
	<div class="panel panel-default">
		
		<div class="panel-heading">{{ trans('app.AdminSection') }}</div>
		
		@include('pages.admin.menu')

		<div class="panel-body">
			<pre>
				{{!! getCleanPhpinfo() !!}}
			</pre>
		</div>

	</div>
@endsection