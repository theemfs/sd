@extends('layouts.app')



@section('css')
{{-- <META HTTP-EQUIV="refresh" CONTENT="60"> --}}
@endsection



@section('title', trans('app.Cases'))



@section('content')



{{-- BREADCRUMBS --}}
<ol class="breadcrumb">
	<li><a href="{{ url('/') }}">{{ trans('app.Home') }}</a></li>
	<li class="active">{{ trans('app.Cases') }}</li>
</ol>


	{{-- <div class="col-md-1"></div> --}}

	{{-- CENTER BLOCK --}}
	<div class="col-md-12">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ trans('app.Cases') }}
					<a class="btn btn-default btn-success pull-right btn-xs" href="{{ action('CasesController@create') }}" role="button">{{ trans('app.Create') }}</a>
				</div>

				<div class="panel-body">

					<div> {{-- TABS --}}
						<ul class="nav nav-pills nav-justified" role="tablist">
							<li role="presentation" {!! !Auth::user()->can_be_performer ? 'class="active"' : '' !!}><a href="#author" aria-controls="home" role="tab" data-toggle="tab">{{ trans('app.As Author') }}<span class="badge">{{ $cases_author->count() }}</span></a></li>
							<li role="presentation" {!! Auth::user()->can_be_performer ? 'class="active"' : '' !!}><a href="#performer" aria-controls="profile" role="tab" data-toggle="tab">{{ trans('app.As Performer') }}<span class="badge">{{ $cases_performer->count() }}</span></a></li>
							<li role="presentation"><a href="#member" aria-controls="messages" role="tab" data-toggle="tab">{{ trans('app.As Member') }}<span class="badge">{{ $cases_member->count() }}</span></a></li>
							@can('show-new-cases')
								<li role="presentation"><a href="#new" aria-controls="messages" role="tab" data-toggle="tab">{{ trans('app.New Cases') }}<span class="badge">{{ $cases_new->count() }}</span></a></li>
							@endcan
							@can('show-admin')
								<li role="presentation"><a href="#open" aria-controls="messages" role="tab" data-toggle="tab">{{ trans('app.Open Cases') }}<span class="badge">{{ $cases_open->count() }}</span></a></li>
								<li role="presentation"><a href="#closed" aria-controls="messages" role="tab" data-toggle="tab">{{ trans('app.Closed Cases') }}<span class="badge">{{ $cases_closed->count() }}</span></a></li>
							@endcan
						</ul>
						<hr>



						<div class="tab-content">



							{{-- I AM AUTHOR --}}
							<div role="tabpanel" class="table-responsive tab-pane {!! !Auth::user()->can_be_performer ? 'in active' : '' !!}" id="author">
								<table class="table table-condensed table-bordered">
									<thead>
										<td class="text-center">#</td>
										<td class="text-center col-xs-7">{{ trans('app.Case') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Created At') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Due To') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Status') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Last Reply At') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Performers') }}</td>
									</thead>

									@foreach ($cases_author as $case_author)
										<tr style="background-color: {{ $case_author->status->color }}">
											<td class="text-center">
												<a href="{{ action('CasesController@show', $case_author->id) }}">{{ $case_author->id }}</a>
											</td>
											<td>
												<a href="{{ action('CasesController@show', $case_author->id) }}">
													<strong>{{ $case_author->name }}</strong>
													<small class="text-muted col-md-11 col-md-offset-1">{{ mb_substr($case_author->text, 0, 300)."..." }}</small>
												</a>
											</td>
											<td class="text-center"><small>{{ $case_author->created_at }}</small></td>
											<td class="text-center"><small>{{ $case_author->due_to }}</small></td>
											<td class="text-center"><small>{{ $case_author->status->name }}</small></td>
											<td class="text-center"><small>{{ $case_author->last_reply_at }}</small></td>
											<td class="text-center">
												@foreach($case_author->performers as $performer)
													<small><a href="{{ action('UsersController@show', $performer->id) }}">{{ $performer->getSurnameWithInitials() }}</a></small>
												@endforeach
											</td>
										</tr>
									@endforeach
								</table>
							</div>



							{{-- I AM PERFORMER --}}
							<div role="tabpanel" class="table-responsive tab-pane {!! Auth::user()->can_be_performer ? 'in active' : '' !!}" id="performer">
								<table class="table table-condensed table-bordered">
									<thead>
										<td class="text-center">#</td>
										<td class="text-center col-xs-7">{{ trans('app.Case') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Author') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Created At') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Due To') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Status') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Last Reply At') }}</td>
									</thead>

									@foreach ($cases_performer as $case_performer)
										<tr style="background-color: {{ $case_performer->status->color }}">
											<td class="text-center">
												<a href="{{ action('CasesController@show', $case_performer->id) }}">{{ $case_performer->id }}</a>
											</td>
											<td>
												<a href="{{ action('CasesController@show', $case_performer->id) }}">
													<strong>{{ $case_performer->name }}</strong>
													<small class="text-muted col-md-11 col-md-offset-1">{{ mb_substr($case_performer->text, 0, 300)."..." }}</small>
												</a>
											</td>
											<td><small><a href="{{ action('UsersController@show', $case_performer->user->id) }}">{{ $case_performer->user->getSurnameWithInitials() }}</a></small></td>
											<td class="text-center"><small>{{ $case_performer->created_at }}</small></td>
											<td class="text-center"><small>{{ $case_performer->due_to }}</small></td>
											<td class="text-center"><small>{{ $case_performer->status->name }}</small></td>
											<td class="text-center"><small>{{ $case_performer->last_reply_at }}</small></td>
										</tr>
									@endforeach
								</table>
							</div>



							{{-- I AM MEMBER --}}
							<div role="tabpanel" class="table-responsive tab-pane" id="member">
								<table class="table table-condensed table-bordered">
									<thead>
										<td class="text-center">#</td>
										<td class="text-center col-xs-7">{{ trans('app.Case') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Author') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Created At') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Due To') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Status') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Last Reply At') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Performers') }}</td>
									</thead>

									@foreach ($cases_member as $case_member)
										<tr style="background-color: {{ $case_member->status->color }}">
											<td class="text-center">
												<a href="{{ action('CasesController@show', $case_member->id) }}">{{ $case_member->id }}</a>
											</td>
											<td>
												<a href="{{ action('CasesController@show', $case_member->id) }}">
													<strong>{{ $case_member->name }}</strong>
													<small class="text-muted col-md-11 col-md-offset-1">{{ mb_substr($case_member->text, 0, 300)."..." }}</small>
												</a>
											</td>
											<td><small><a href="{{ action('UsersController@show', $case_member->user->id) }}">{{ $case_member->user->getSurnameWithInitials() }}</a></small></td>
											<td class="text-center"><small>{{ $case_member->created_at }}</small></td>
											<td class="text-center"><small>{{ $case_member->due_to }}</small></td>
											<td class="text-center"><small>{{ $case_member->status->name }}</small></td>
											<td class="text-center"><small>{{ $case_member->last_reply_at }}</small></td>
											<td class="text-center">
												@foreach($case_member->performers as $performer)
													<small><a href="{{ action('UsersController@show', $performer->id) }}">{{ $performer->getSurnameWithInitials() }}</a></small>
												@endforeach
											</td>
										</tr>
									@endforeach
								</table>
							</div>



							{{-- NEW CASES --}}
							@can('show-new-cases')
							<div role="tabpanel" class="table-responsive tab-pane" id="new">
								<table class="table table-condensed table-bordered">
									<thead>
										<td class="text-center">#</td>
										<td class="text-center col-xs-7">{{ trans('app.Case') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Author') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Created At') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Due To') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Status') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Last Reply At') }}</td>
									</thead>

									@foreach ($cases_new as $case_new)
										<tr>
											<td class="text-center">
												<a href="{{ action('CasesController@show', $case_new->id) }}">{{ $case_new->id }}</a>
											</td>
											<td>
												<a href="{{ action('CasesController@show', $case_new->id) }}">
													<strong>{{ $case_new->name }}</strong>
													<small class="text-muted col-md-11 col-md-offset-1">{{ mb_substr($case_new->text, 0, 300)."..." }}</small>
												</a>
											</td>
											<td><small><a href="{{ action('UsersController@show', $case_new->user->id) }}">{{ $case_new->user->getSurnameWithInitials() }}</a></small></td>
											<td class="text-center"><small>{{ $case_new->created_at }}</small></td>
											<td class="text-center"><small>{{ $case_new->due_to }}</small></td>
											<td class="text-center"><small>{{ $case_new->status->name }}</small></td>
											<td class="text-center"><small>{{ $case_new->last_reply_at }}</small></td>
										</tr>
									@endforeach
								</table>

							</div>
							@endcan



							{{-- OPEN CASES --}}
							@can('show-admin')
							<div role="tabpanel" class="tab-pane" id="open">
								<table class="table table-condensed table-bordered">
									<thead>
										<td class="text-center">#</td>
										<td class="text-center col-xs-7">{{ trans('app.Case') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Author') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Created At') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Due To') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Status') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Last Reply At') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Performers') }}</td>
									</thead>

									@foreach ($cases_open as $case_open)
										<tr style="background-color: {{ $case_open->status->color }}">
											<td class="text-center">
												<a href="{{ action('CasesController@show', $case_open->id) }}">{{ $case_open->id }}</a>
											</td>
											<td>
												<a href="{{ action('CasesController@show', $case_open->id) }}">
													<strong>{{ $case_open->name }}</strong>
													<small class="text-muted col-md-11 col-md-offset-1">{{ mb_substr($case_open->text, 0, 300)."..." }}</small>
												</a>
											</td>
											<td>
												<small><a href="{{ action('UsersController@show', $case_open->user->id) }}">{{ $case_open->user->getSurnameWithInitials() }}</a></small>
											</td>
											<td class="text-center"><small>{{ $case_open->created_at }}</small></td>
											<td class="text-center"><small>{{ $case_open->due_to }}</small></td>
											<td class="text-center"><small>{{ $case_open->status->name }}</small></td>
											<td class="text-center"><small>{{ $case_open->last_reply_at }}</small></td>
											<td class="text-center">
												@foreach($case_open->performers as $performer)
													<small><a href="{{ action('UsersController@show', $performer->id) }}">{{ $performer->getSurnameWithInitials() }}</a></small>
												@endforeach
											</td>
										</tr>
									@endforeach
								</table>
							</div>
							@endcan



							{{-- CLOSED CASES --}}
							@can('show-admin')
							<div role="tabpanel" class="tab-pane" id="closed">
								<table class="table table-condensed table-bordered">
									<thead>
										<td class="text-center">#</td>
										<td class="text-center col-xs-7">{{ trans('app.Case') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Author') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Created At') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Due To') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Status') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Last Reply At') }}</td>
										<td class="text-center col-xs-1">{{ trans('app.Performers') }}</td>
									</thead>

									@foreach ($cases_closed as $case_closed)
										<tr style="background-color: {{ $case_closed->status->color }}">
											<td class="text-center">
												<a href="{{ action('CasesController@show', $case_closed->id) }}">{{ $case_closed->id }}</a>
											</td>
											<td>
												<a href="{{ action('CasesController@show', $case_closed->id) }}">
													<strong>{{ $case_closed->name }}</strong>
													<small class="text-muted col-md-11 col-md-offset-1">{{ mb_substr($case_closed->text, 0, 300)."..." }}</small>
												</a>
											</td>
											<td>
												<small><a href="{{ action('UsersController@show', $case_closed->user->id) }}">{{ $case_closed->user->getSurnameWithInitials() }}</a></small>
											</td>
											<td class="text-center"><small>{{ $case_closed->created_at }}</small></td>
											<td class="text-center"><small>{{ $case_closed->due_to }}</small></td>
											<td class="text-center"><small>{{ $case_closed->status->name }}</small></td>
											<td class="text-center"><small>{{ $case_closed->last_reply_at }}</small></td>
											<td class="text-center">
												@foreach($case_closed->performers as $performer)
													<small><a href="{{ action('UsersController@show', $performer->id) }}">{{ $performer->getSurnameWithInitials() }}</a></small>
												@endforeach
											</td>
										</tr>
									@endforeach
								</table>
							</div>
							@endcan



						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

@endsection



@section('js')
@endsection