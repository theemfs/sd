<!DOCTYPE html>
<html lang="en">

	<head>
		@include('layouts.header')
		<title>CRM2 / @yield('title')</title>
		@yield('libraries')
	</head>

<body>

	<nav class="navbar navbar-default">
		@include('layouts.nav')
	</nav>

	<div class="container">
		@if ( Session::has('flash_success') )
			<div class="alert alert-success">{{ Session::get('flash_success') }}</div>
		@endif
	</div>

	<div class="container">
		<div class="row">
			@yield('content')
		</div>
	</div>

	<div class="container">
		@if ($errors->any())
			<ul class="alert alert-danger">
				@foreach ($errors->all() as $error)
					<p>{{ $error }}</p>
				@endforeach
			</ul>
		@endif
		<hr>
	</div>

	<div class="container">
		@include('layouts.footer')
	</div>
</body>

</html>