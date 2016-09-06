@extends('layouts.app')



@section('css')
	<link href="{{ url('/') }}/css/jquery.dataTables.min.css" rel="stylesheet">
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
					<a class="btn btn-default btn-success pull-right btn-xs" href="{{ action('CasesController@create') }}" role="button"><i class="fa fa-fw fa-btn fa-plus"></i> {{ trans('app.Create') }}</a>
				</div>

				<div class="panel-body">

					<div> {{-- TABS --}}
						<ul class="nav nav-pills nav-justified" role="tablist">

							{{-- I AM AUTHOR --}}
							<li role="presentation" {!! !Auth::user()->can_be_performer ? 'class="active"' : '' !!}>
								<a href="#author" aria-controls="home" role="tab" data-toggle="tab">
									<i class="fa fa-fw fa-btn fa-hand-o-up"></i>
									{{ trans('app.As Author') }}
									<span class="badge">{{ $cases_author->count() }}</span>
								</a>
							</li>

							{{-- I AM PERFORMER --}}
							@if (Auth::user()->can_be_performer)
								<li role="presentation" {!! Auth::user()->can_be_performer ? 'class="active"' : '' !!}>
									<a href="#performer" aria-controls="profile" role="tab" data-toggle="tab">
										<i class="fa fa-fw fa-btn fa-user"></i>
										{{ trans('app.As Performer') }}
										<span class="badge">{{ $cases_performer->count() }}</span>
									</a>
								</li>
							@endif

							{{-- I AM MEMBER --}}
							<li role="presentation">
								<a href="#member" aria-controls="messages" role="tab" data-toggle="tab">
									<i class="fa fa-fw fa-btn fa-users"></i>
									{{ trans('app.As Member') }}
									<span class="badge">{{ $cases_member->count() }}</span>
								</a>
							</li>

							{{-- NEW CASES --}}
							@can('show-new-cases')
								<li role="presentation">
									<a href="#new" aria-controls="messages" role="tab" data-toggle="tab">
										<i class="fa fa-fw fa-btn fa-file"></i>
										{{ trans('app.New Cases') }}
										<span class="badge">{{ $cases_new->count() }}</span>
									</a>
								</li>
							@endcan

							{{-- OPEN CASES --}}
							@can('show-admin')
								<li role="presentation">
									<a href="#open" aria-controls="messages" role="tab" data-toggle="tab">
										<i class="fa fa-fw fa-btn fa-unlock"></i>
										{{ trans('app.Open Cases') }}
										<span class="badge">{{ $cases_open->count() }}</span>
									</a>
								</li>
							@endcan

							{{-- CLOSED CASES --}}
							<li role="presentation">
								<a href="#closed" aria-controls="messages" role="tab" data-toggle="tab">
									<i class="fa fa-fw fa-btn fa-lock"></i>
									{{ trans('app.Closed Cases') }}
									<span class="badge">{{ $cases_closed->count() }}</span>
								</a>
							</li>

						</ul>
						<hr>



						<div class="tab-content">



							{{-- I AM AUTHOR --}}
							<div role="tabpanel" class="table-responsive tab-pane {!! !Auth::user()->can_be_performer ? 'in active' : '' !!}" id="author">
								<table class="table table-condensed table-bordered">
									<thead>
										<td class="text-center"><strong>#</strong></td>
										<td class="text-center col-xs-7"><strong>{{ trans('app.Case') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Last Reply At') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Created At') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Due To') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Status') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Performers') }}</strong></td>
									</thead>

									@foreach ($cases_author as $case_author)
										<tr style="background-color: {{ $case_author->status->color }}">
											<td class="text-center">
												<a href="{{ action('CasesController@show', $case_author->id) }}">{{ $case_author->id }}</a>
											</td>
											<td>
												<a href="{{ action('CasesController@show', $case_author->id) }}">
													<i class="fa fa-fw fa-btn fa-briefcase"></i>
													<strong>{{ $case_author->name }}</strong>
													<small class="text-muted col-md-11 col-md-offset-1 hidden-xs">{{ mb_substr($case_author->text, 0, 300)."..." }}</small>
												</a>
											</td>
											<td class="text-center"><small>{{ $case_author->last_reply_at }} ({{ $case_author->last_replier->getSurnameWithInitials() }})</small></td>
											<td class="text-center"><small>{{ $case_author->created_at }}</small></td>
											<td class="text-center"><small>{{ $case_author->due_to }}</small></td>
											<td class="text-center"><small>{{ $case_author->status->name }}</small></td>
											<td class="text-center">
												@foreach($case_author->performers as $performer)
													<small>
														<a href="{{ action('UsersController@show', $performer->id) }}">
															{{-- <i class="fa fa-fw fa-btn fa-user"></i> --}}
															{{ $performer->getSurnameWithInitials() }}
														</a><br>
													</small>
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
										<td class="text-center"><strong>#</strong></td>
										<td class="text-center col-xs-5"><strong>{{ trans('app.Case') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Last Reply At') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Author') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Created At') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Due To') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Status') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Performers') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Members') }}</strong></td>
									</thead>

									@foreach ($cases_performer as $case_performer)
										<tr style="background-color: {{ $case_performer->status->color }}">
											<td class="text-center">
												<a href="{{ action('CasesController@show', $case_performer->id) }}">{{ $case_performer->id }}</a>
											</td>
											<td>
												<a href="{{ action('CasesController@show', $case_performer->id) }}">
													<i class="fa fa-fw fa-btn fa-briefcase"></i>
													<strong>{{ $case_performer->name }}</strong>
													<small class="text-muted col-md-11 col-md-offset-1 hidden-xs">{{ mb_substr($case_performer->text, 0, 300)."..." }}</small>
												</a>
											</td>
											<td class="text-center"><small>{{ $case_performer->last_reply_at }} ({{ $case_performer->last_replier->getSurnameWithInitials() }})</small></td>
											<td>
												<small>
													<a href="{{ action('UsersController@show', $case_performer->user->id) }}">
														{{-- <i class="fa fa-fw fa-btn fa-user"></i> --}}
														{{ $case_performer->user->getSurnameWithInitials() }}
													</a>
												</small>
											</td>
											<td class="text-center"><small>{{ $case_performer->created_at }}</small></td>
											<td class="text-center"><small>{{ $case_performer->due_to }}</small></td>
											<td class="text-center"><small>{{ $case_performer->status->name }}</small></td>
											<td class="text-left">
												@foreach($case_performer->performers as $performer)
													<small>
														<a href="{{ action('UsersController@show', $performer->id) }}">
															{{-- <i class="fa fa-fw fa-btn fa-user"></i> --}}
															{{ $performer->getSurnameWithInitials() }}
														</a>
													</small>
												@endforeach
											</td>
											<td class="text-left text-overflow">
												@if($case_performer->members->count()<=5)
													@foreach($case_performer->members as $member)
														<small>
															<a href="{{ action('UsersController@show', $member->id) }}">
																{{-- <i class="fa fa-fw fa-btn fa-user"></i> --}}
																{{ $member->getSurnameWithInitials() }}
															</a>
														</small><br>
													@endforeach
												@else
													<small>{{ trans('app.Members Count') }}: {{ $case_performer->members->count() }}</small>
												@endif
											</td>
										</tr>
									@endforeach
								</table>
							</div>



							{{-- I AM MEMBER --}}
							<div role="tabpanel" class="table-responsive tab-pane" id="member">
								<table class="table table-condensed table-bordered">
									<thead>
										<td class="text-center"><strong>#</strong></td>
										<td class="text-center col-xs-5"><strong>{{ trans('app.Case') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Last Reply At') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Author') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Created At') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Due To') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Status') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Performers') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Members') }}</strong></td>
									</thead>

									@foreach ($cases_member as $case_member)
										<tr style="background-color: {{ $case_member->status->color }}">
											<td class="text-center">
												<a href="{{ action('CasesController@show', $case_member->id) }}">{{ $case_member->id }}</a>
											</td>
											<td>
												<a href="{{ action('CasesController@show', $case_member->id) }}">
													<i class="fa fa-fw fa-btn fa-briefcase"></i>
													<strong>{{ $case_member->name }}</strong>
													<small class="text-muted col-md-11 col-md-offset-1 hidden-xs">{{ mb_substr($case_member->text, 0, 300)."..." }}</small>
												</a>
											</td>
											<td class="text-center"><small>{{ $case_member->last_reply_at }} ({{ $case_member->last_replier->getSurnameWithInitials() }})</small></td>
											<td>
												<small>
													<a href="{{ action('UsersController@show', $case_member->user->id) }}">
														{{-- <i class="fa fa-fw fa-btn fa-user"></i> --}}
														{{ $case_member->user->getSurnameWithInitials() }}
													</a>
												</small>
											</td>
											<td class="text-center"><small>{{ $case_member->created_at }}</small></td>
											<td class="text-center"><small>{{ $case_member->due_to }}</small></td>
											<td class="text-center"><small>{{ $case_member->status->name }}</small></td>
											<td class="text-left">
												@foreach($case_member->performers as $performer)
													<small>
														<a href="{{ action('UsersController@show', $performer->id) }}">
															{{-- <i class="fa fa-fw fa-btn fa-user"></i> --}}
															{{ $performer->getSurnameWithInitials() }}
														</a>
													</small>
												@endforeach
											</td>
											<td class="text-left text-overflow">
												@if($case_member->members->count()<=5)
													@foreach($case_member->members as $member)
														<small>
															<a href="{{ action('UsersController@show', $member->id) }}">
																{{-- <i class="fa fa-fw fa-btn fa-user"></i> --}}
																{{ $member->getSurnameWithInitials() }}
															</a>
														</small><br>
													@endforeach
												@else
													<small>{{ trans('app.Members Count') }}: {{ $case_member->members->count() }}</small>
												@endif
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
										<td class="text-center"><strong>#</strong></td>
										<td class="text-center col-xs-8"><strong>{{ trans('app.Case') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Author') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Created At') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Due To') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Status') }}</strong></td>
									</thead>

									@foreach ($cases_new as $case_new)
										<tr>
											<td class="text-center">
												<a href="{{ action('CasesController@show', $case_new->id) }}">{{ $case_new->id }}</a>
											</td>
											<td>
												<a href="{{ action('CasesController@show', $case_new->id) }}">
													<i class="fa fa-fw fa-btn fa-briefcase"></i>
													<strong>{{ $case_new->name }}</strong>
													<small class="text-muted col-md-11 col-md-offset-1 hidden-xs">{{ mb_substr($case_new->text, 0, 300)."..." }}</small>
												</a>
											</td>
											<td><small><a href="{{ action('UsersController@show', $case_new->user->id) }}">{{ $case_new->user->getSurnameWithInitials() }}</a></small></td>
											<td class="text-center"><small>{{ $case_new->created_at }}</small></td>
											<td class="text-center"><small>{{ $case_new->due_to }}</small></td>
											<td class="text-center"><small>{{ $case_new->status->name }}</small></td>
										</tr>
									@endforeach
								</table>

							</div>
							@endcan



							{{-- OPEN CASES --}}
							@can('show-admin')
							<div role="tabpanel" class="table-responsive tab-pane" id="open">
								<table class="table table-condensed table-bordered">
									<thead>
										<td class="text-center"><strong>#</strong></td>
										<td class="text-center col-xs-5"><strong>{{ trans('app.Case') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Last Reply At') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Author') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Created At') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Due To') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Status') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Performers') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Members') }}</strong></td>
									</thead>

									@foreach ($cases_open as $case_open)
										<tr style="background-color: {{ $case_open->status->color }}">
											<td class="text-center">
												<a href="{{ action('CasesController@show', $case_open->id) }}">{{ $case_open->id }}</a>
											</td>
											<td>
												<a href="{{ action('CasesController@show', $case_open->id) }}">
													<i class="fa fa-fw fa-btn fa-briefcase"></i>
													<strong>{{ $case_open->name }}</strong>
													<small class="text-muted col-md-11 col-md-offset-1 hidden-xs">{{ mb_substr($case_open->text, 0, 300)."..." }}</small>
												</a>
											</td>
											<td class="text-center"><small>{{ $case_open->last_reply_at }} ({{ $case_open->last_replier->getSurnameWithInitials() }})</small></td>
											<td>
												<small>
													<a href="{{ action('UsersController@show', $case_open->user->id) }}">
														{{-- <i class="fa fa-fw fa-btn fa-user"></i> --}}
														{{ $case_open->user->getSurnameWithInitials() }}
													</a>
												</small>
											</td>
											<td class="text-center"><small>{{ $case_open->created_at }}</small></td>
											<td class="text-center"><small>{{ $case_open->due_to }}</small></td>
											<td class="text-center"><small>{{ $case_open->status->name }}</small></td>
											<td class="text-left">
												@foreach($case_open->performers as $performer)
													<small>
														<a href="{{ action('UsersController@show', $performer->id) }}">
															{{-- <i class="fa fa-fw fa-btn fa-user"></i> --}}
															{{ $performer->getSurnameWithInitials() }}
														</a>
													</small>
												@endforeach
											</td>
											<td class="text-left text-overflow">
												@if($case_open->members->count()<=5)
													@foreach($case_open->members as $member)
														<small>
															<a href="{{ action('UsersController@show', $member->id) }}">
																{{-- <i class="fa fa-fw fa-btn fa-user"></i> --}}
																{{ $member->getSurnameWithInitials() }}
															</a>
														</small><br>
													@endforeach
												@else
													<small>{{ trans('app.Members Count') }}: {{ $case_open->members->count() }}</small>
												@endif
											</td>
										</tr>
									@endforeach
								</table>
							</div>
							@endcan



							{{-- CLOSED CASES --}}
							{{-- @can('show-admin') --}}
							<div role="tabpanel" class="table-responsive tab-pane" id="closed">
								<table class="table table-condensed table-bordered">
									<thead>
										<td class="text-center"><strong>#</strong></td>
										<td class="text-center col-xs-5"><strong>{{ trans('app.Case') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Last Reply At') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Author') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Created At') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Due To') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Status') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Performers') }}</strong></td>
										<td class="text-center col-xs-1"><strong>{{ trans('app.Members') }}</strong></td>
									</thead>

									@foreach ($cases_closed as $case_closed)
										<tr style="background-color: {{ $case_closed->status->color }}">
											<td class="text-center">
												<a href="{{ action('CasesController@show', $case_closed->id) }}">{{ $case_closed->id }}</a>
											</td>
											<td>
												<a href="{{ action('CasesController@show', $case_closed->id) }}">
													<i class="fa fa-fw fa-btn fa-briefcase"></i>
													<strong>{{ $case_closed->name }}</strong>
													<small class="text-muted col-md-11 col-md-offset-1 hidden-xs">{{ mb_substr($case_closed->text, 0, 300)."..." }}</small>
												</a>
											</td>
											<td class="text-center"><small>{{ $case_closed->last_reply_at }} ({{ $case_closed->last_replier->getSurnameWithInitials() }})</small></td>
											<td>
												<small>
													<a href="{{ action('UsersController@show', $case_closed->user->id) }}">
														{{-- <i class="fa fa-fw fa-btn fa-user"></i> --}}
														{{ $case_closed->user->getSurnameWithInitials() }}
													</a>
												</small>
											</td>
											<td class="text-center"><small>{{ $case_closed->created_at }}</small></td>
											<td class="text-center"><small>{{ $case_closed->due_to }}</small></td>
											<td class="text-center"><small>{{ $case_closed->status->name }}</small></td>
											<td class="text-left">
												@foreach($case_closed->performers as $performer)
													<small>
														<a href="{{ action('UsersController@show', $performer->id) }}">
															{{-- <i class="fa fa-fw fa-btn fa-user"></i> --}}
															{{ $performer->getSurnameWithInitials() }}
														</a>
													</small>
												@endforeach
											</td>
											<td class="text-left text-overflow">
												@if($case_closed->members->count()<=5)
													@foreach($case_closed->members as $member)
														<small>
															<a href="{{ action('UsersController@show', $member->id) }}">
																{{-- <i class="fa fa-fw fa-btn fa-user"></i> --}}
																{{ $member->getSurnameWithInitials() }}
															</a>
														</small><br>
													@endforeach
												@else
													<small>{{ trans('app.Members Count') }}: {{ $case_closed->members->count() }}</small>
												@endif
											</td>
										</tr>
									@endforeach
								</table>
							</div>
							{{-- @endcan --}}



						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

@endsection



@section('js')
	<script src="{{ url('/') }}/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('table').DataTable({
				// "sDom": '<"top"i>rt<"bottom"flp><"clear">',
				"bFilter":		false,
				"lengthMenu":	[[10, 25, 50, -1], [10, 25, 50, "Все"]],
				"paging":		false,
				"ordering":		true,
				"order": 		[[ 2, "desc" ]],
				"info":			false,
				"search":		false,
				"stateSave":	false,
				"pagingType":	"full_numbers",
				// "scrollY": 200,
				// "scrollX": true
				"language": {
				// 	"decimal": ",",
				// 	"thousands": "."
					"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
				}
			});
		} );
	</script>
@endsection