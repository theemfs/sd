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



@section('js')
@endsection