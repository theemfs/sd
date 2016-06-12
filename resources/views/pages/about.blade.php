@extends('layouts.app')

@section('title', trans('app.About') )

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">{{ trans('app.About') }}</div>

		<div class="panel-body">
			<p>About page</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor fuga iste quos ullam, reprehenderit, consequuntur dolorum provident iusto, possimus repellendus voluptatum illum. Corporis fuga, a quidem expedita dolores atque quas.</p>
		</div>
	</div>

@endsection