@extends('layouts.app')



@section('css')
@endsection



@section('title', trans('app.Test'))



@section('content')



{{-- BREADCRUMBS --}}
<ol class="breadcrumb">
	<li><a href="{{ url('/') }}">{{ trans('app.Home') }}</a></li>
	<li class="active">{{ trans('app.Test') }}</li>
</ol>


	{{-- CENTER BLOCK --}}
	<div class="col-md-12">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('app.Test') }}</div>

				<div class="panel-body">
					<p>Test page</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor fuga iste quos ullam, reprehenderit, consequuntur dolorum provident iusto, possimus repellendus voluptatum illum. Corporis fuga, a quidem expedita dolores atque quas.</p>
				</div>
			</div>
		</div>
	</div>



@endsection



{{-- <?php
  require('Pusher.php');

  $options = array(
    'encrypted' => true
  );
  $pusher = new Pusher(
    '90125195e3c66249c253',
    'f868e86d1e1e544e46e8',
    '249970',
    $options
  );

  $data['message'] = 'hello world';
  $pusher->trigger('test_channel', 'my_event', $data);
?> --}}

@section('js')
	{{-- <script src="https://js.pusher.com/3.2/pusher.min.js"></script>
	<script>
		// Enable pusher logging - don't include this in production
		Pusher.logToConsole = true;

		var pusher = new Pusher('90125195e3c66249c253', {
		  encrypted: true
		});

		var channel = pusher.subscribe('test_channel');
		channel.bind('my_event', function(data) {
		  alert(data.message);
		});
	</script> --}}
@endsection