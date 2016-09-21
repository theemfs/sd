<!DOCTYPE html>
<html lang="en">

	<head>
		{{-- @include('layouts.header') --}}

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- CSS --}}
		<link href="{{ url('/') }}/css/bootstrap.min.css" rel="stylesheet">
		<link href="{{ url('/') }}/css/font-awesome.min.css" rel="stylesheet">
		<link href="{{ url('/') }}/css/font-awesome-animation.min.css" rel="stylesheet">
		{{-- <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet"> --}}
@yield('css')
		<link href="{{ url('/') . elixir('css/all.css') }}" rel="stylesheet">
		{{-- <link href="https://bootswatch.com/united/bootstrap.min.css" rel="stylesheet"> --}}
		{{-- <link href="https://bootswatch.com/spacelab/bootstrap.min.css" rel="stylesheet"> --}}
		{{-- <link href="https://bootswatch.com/slate/bootstrap.min.css" rel="stylesheet"> --}}
		{{-- <link href="https://bootswatch.com/cyborg/bootstrap.min.css" rel="stylesheet"> --}}
		{{-- <link href="https://bootswatch.com/paper/bootstrap.min.css" rel="stylesheet"> --}}

		<title>{{ env('APP_NAME') }} / @yield('title')</title>

	</head>

<body>



	{{-- TOP NAVIGATION BAR --}}
	@include('layouts.nav_top')



	{{-- TOP SUCCESS FLASH MESSAGES --}}
	<div class="container">
		@if ( Session::has('flash_success') )
			<div class="alert alert-success">{{ Session::get('flash_success') }}</div>
		@endif
	</div>



	{{-- MAIN CONTENT BLOCK --}}
	<div class="container">
		<div class="row">
			@yield('content')
		</div>
	</div>



	{{-- BOTTOM ERROR BLOCK --}}
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



	{{-- JS --}}
	<script src="{{ url('/') }}/js/jquery.min.js"></script>
	<script src="{{ url('/') }}/js/bootstrap.min.js"></script>
	<script src="{{ url('/') . elixir('js/all.js') }}"></script>



	{{-- FOOTER --}}
	<footer>
		{{-- @yield('footer') --}}
		@yield('js')

		@if (Auth::user())
			<div class="container">
				{{-- <p class="text-muted small">&copy / &reg;</p> --}}
				{{-- <p class="text-muted small">@</p> --}}
				{{-- <p class="text-muted small">&copy Идея и разработка - Антон Хамаев</p> --}}
				{{-- <p class="text-muted small">По всем вопросам пишите <a href="mailto:">anton@grandbaikal.ru</a></p> --}}
			</div>
		@endif

	</footer>


	{{-- BOTTOM NAVIGATION BAR --}}
	@include('layouts.nav_bottom')



</body>

</html>