<!DOCTYPE html>
<html>
	<head>
		<title>{{ trans('app.404') }}</title>

	   <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">

		<style>
			html, body {
				height: 100%;
			}

			body {
				margin: 0;
				padding: 0;
				width: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: 'Exo 2', sans-serif;
			}

			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 50px;
				margin-bottom: 40px;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="title">{{ trans('app.404') }}</div>
				<a class="title" href="{{ url('/') }}">{{ trans('app.go home') }}</a>
			</div>
		</div>
	</body>
</html>