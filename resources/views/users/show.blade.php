@extends('layouts.app')

@section('title', 'User #'.$user->id )

@section('content')



{{-- BREADCRUMBS --}}
<ol class="breadcrumb">
	<li><a href="{{ url('/') }}">{{ trans('app.Home') }}</a></li>
	<li><a href="{{ url('/') }}">{{ trans('app.Users') }}</a></li>
	<li class="active">{{ $user->name }}</li>
</ol>



	<!-- CENTER BLOCK -->
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">

			<div class="panel-heading">
				{{ $user->name }}
			</div>

			<div class="panel-body">

				<div> {{-- TABS --}}
					<ul class="nav nav-pills nav-justified" role="tablist">
						<li role="presentation" class="active"><a href="#user_contacts" aria-controls="home" role="tab" data-toggle="tab">{{ trans('app.User Contacts') }}</a></li>
						@can('show-admin')
						<li role="presentation"><a href="#user_cases" aria-controls="profile" role="tab" data-toggle="tab">{{ trans('app.User Cases') }}<span class="badge"></span></a></li>
						@endcan
						{{-- @can('show-new-cases')
							<li role="presentation"><a href="#not_assigned" aria-controls="messages" role="tab" data-toggle="tab">{{ trans('app.Not assigned') }}<span class="badge">{{ $cases_not_assigned->count() }}</span></a></li>
						@endcan
						@can('show-admin')
							<li role="presentation"><a href="#all" aria-controls="messages" role="tab" data-toggle="tab">{{ trans('app.All') }}<span class="badge">{{ $cases_all->count() }}</span></a></li>
						@endcan --}}
					</ul>
					<hr>



					<div class="tab-content">



						<div role="tabpanel" class="tab-pane in active" id="user_contacts">
							<p>{{ $user->department }} / {{ $user->title }}</p>
							<p>{{ $user->email }}</p>
							<p>{{ $user->phone }}</p>
							<p>{{ $user->mobile }}</p>
							<p>{{ $user->homephone }}</p>
							{{-- <p>{{ $user->last_login_at }}</p> --}}
						</div>

						<div role="tabpanel" class="tab-pane" id="user_cases">
							<table class="table table-bordered table-hover table-striped">
								@foreach($user->memberOf as $case_member)
								<tr class="">
									<td>{{ $case_member->id }}</td>
									<td><a href="{{ action('CasesController@show', $case_member->id) }}"s>{{ $case_member->name }}</a></td>
									<td>{{ $case_member->status->name }}</td>
								</tr>
								@endforeach
							</table>
						</div>



					</div>

			</div>
		</div>
	</div>



@stop