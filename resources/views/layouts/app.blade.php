<!DOCTYPE html>
<html lang="en">

	<head>
		{{-- @include('layouts.header') --}}

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		{{-- <meta property="og:type" content="article" />
		<meta property="og:title" content="The Rock" />
		<meta property="og:url" content="http://servicedesk.nyzix.com/cases/7/" /> --}}
		{{-- <meta property="og:image" content="http://servicedesk.nyzix.com/thumbnails/10/e0b7e98b30494004ae4f3a56a33a8463.jpg" /> --}}

		<!-- CSS -->
		<link href="{{ url('/') }}/css/bootstrap.min.css" rel="stylesheet">
		<link href="{{ url('/') }}/css/font-awesome.min.css" rel="stylesheet">
		<link href="{{ url('/') . elixir('css/all.css') }}" rel="stylesheet">
@yield('css')
		{{-- <link href="https://bootswatch.com/united/bootstrap.min.css" rel="stylesheet"> --}}
		{{-- <link href="https://bootswatch.com/spacelab/bootstrap.min.css" rel="stylesheet"> --}}
		{{-- <link href="https://bootswatch.com/slate/bootstrap.min.css" rel="stylesheet"> --}}
		{{-- <link href="https://bootswatch.com/cyborg/bootstrap.min.css" rel="stylesheet"> --}}
		{{-- <link href="https://bootswatch.com/paper/bootstrap.min.css" rel="stylesheet"> --}}
		{{-- <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" /> --}}

		<title>CRM2 / @yield('title')</title>

	</head>

<body>

	@include('layouts.nav')

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

		{{-- @include('layouts.footer') --}}

		<!-- JavaScripts -->
		<script src="{{ elixir('js/all.js') }}"></script>
		{{-- <script src="{{ url('/') }}/js/bootstrap-datepicker.min.js"></script>
		<script src="{{ url('/') }}/js/ckeditor.js"></script>
		<script src="{{ url('/') }}/js/jquery.dataTables.min.js"></script> --}}



		<footer>

			{{-- @yield('footer') --}}
			@yield('js')
			<div class="container">
				<p class="text-muted">&copy</p>
			</div>

		</footer>



</body>

</html>