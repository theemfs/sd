@extends('layouts.app')

@section('title', trans('app.AdminSection') )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">{{ trans('app.Users') }}</div>

		@include('pages.admin.menu')

		<div class="panel-body">

		<div class="table-responsive">
			<table class="table table-condensed table-bordered table-responsive" id="ldapusers">
				<thead>
					<td>id</td>
					<td>name</td>
					<td>email</td>
					<td>password</td>
					<td>last_login_at</td>
					<td>telephonenumber</td>
					<td>homephone</td>
					<td>mobile</td>
					<td>title</td>
				</thead>
					@foreach($users as $user)
						<tr>
							{{-- <p><a href="{{ action('UsersController@show', $user->id) }}">{{ $user->name }}</a></p> --}}
							<td>{{ $user->id }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->password }}</td>
							<td>{{ $user->last_login_at }}</td>
							<td>{{ $user->telephonenumber }}</td>
							<td>{{ $user->homephone }}</td>
							<td>{{ $user->mobile }}</td>
							<td>{{ $user->title }}</td>
						</tr>
					@endforeach
			</table>
		</div>
	</div>

	</div>
@endsection



@section('footer')
	<script>

		$('#ldapusers').DataTable({
			responsive: false,
			paging:   	true,
			ordering: 	true,
			info:     	true,
			searching: 	true,
			select: 	true
		});

	</script>
@endsection