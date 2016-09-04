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



	{{-- LEFT BLOCK --}}
	<div class="col-md-2">
		<div class="row">

		</div>
	</div>



	{{-- CENTER BLOCK --}}
	<div class="col-md-8">
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
							<li role="presentation"><a href="#open" aria-controls="messages" role="tab" data-toggle="tab">{{ trans('app.All') }}<span class="badge">{{ $cases_open->count() }}</span></a></li>
						@endcan
					</ul>
					<hr>



					<div class="tab-content">



						{{-- I AM AUTHOR --}}
						<div role="tabpanel" class="tab-pane {!! !Auth::user()->can_be_performer ? 'in active' : '' !!}" id="author">
							@foreach ($cases_author as $case_author)
								<div class="snippet" style="background-color: {{ $case_author->status->color }}">
									<span class="small">
										<i class="fa fa-fw fa-btn fa-user"></i>
										<a href="{{ action('UsersController@show', $case_author->user->id) }}">{{ $case_author->user->name }}</a> |
										{{ $case_author->created_at }} - {{ $case_author->due_to }} |
										{{ $case_author->status->name }} |
										{{ $case_author->last_reply_at }}
									</span>
									<hr>
									<h4 class="snippet-heading">
										<p class="pull-right small">
											{{-- {{ $case_author->id }} --}}
										</p>
										<a href="{{ action('CasesController@show', $case_author->id) }}">[#{{ $case_author->id }}] {{ $case_author->name }}</a>
									</h4>
									<div class="snippet-body">
										<p>{{ mb_substr($case_author->text, 0, 100)."..." }}</p>
									</div>
								</div>
							@endforeach
						</div>



						{{-- I AM PERFORMER --}}
						<div role="tabpanel" class="tab-pane {!! Auth::user()->can_be_performer ? 'in active' : '' !!}" id="performer">
							@foreach ($cases_performer as $case_performer)
								<div class="snippet" style="background-color: {{ $case_performer->status->color }}">
									<span class="small">
										<i class="fa fa-fw fa-btn fa-user"></i>
										<a href="{{ action('UsersController@show', $case_performer->user->id) }}">{{ $case_performer->user->name }}</a> |
										{{ $case_performer->created_at }} - {{ $case_performer->due_to }} |
										{{ $case_performer->status->name }} |
										{{ $case_performer->last_reply_at }}
									</span>
									<hr>
									<h4 class="snippet-heading">
										<p class="pull-right small">
											{{-- {{ $case_performer->id }} --}}
										</p>
										<a href="{{ action('CasesController@show', $case_performer->id) }}">[#{{ $case_performer->id }}] {{ $case_performer->name }}</a>
									</h4>
									<div class="snippet-body">
										<p>{{ mb_substr($case_performer->text, 0, 100)."..." }}</p>
									</div>
								</div>
							@endforeach
						</div>



						{{-- I AM MEMBER --}}
						<div role="tabpanel" class="tab-pane" id="member">
							@foreach ($cases_member as $case_member)
								<div class="snippet" style="background-color: {{ $case_member->status->color }}">
									<span class="small">
										<i class="fa fa-fw fa-btn fa-user"></i>
										<a href="{{ action('UsersController@show', $case_member->user->id) }}">{{ $case_member->user->name }}</a> |
										{{ $case_member->created_at }} - {{ $case_member->due_to }} |
										{{ $case_member->status->name }} |
										{{ $case_member->last_reply_at }}
									</span>
									<hr>
									<h4 class="snippet-heading">
										<p class="pull-right small">
											{{-- {{ $case_member->id }} --}}
										</p>
										<a href="{{ action('CasesController@show', $case_member->id) }}">[#{{ $case_member->id }}] {{ $case_member->name }}</a>
									</h4>
									<div class="snippet-body">
										<p>{{ mb_substr($case_member->text, 0, 100)."..." }}</p>
									</div>
								</div>
							@endforeach
						</div>



						{{-- NEW CASES --}}
						@can('show-new-cases')
						<div role="tabpanel" class="tab-pane" id="new">
							@foreach ($cases_new as $case_new)
								<div class="snippet">
									<span class="small">
										<i class="fa fa-fw fa-btn fa-user"></i>
										{{ $case_new->user->name }} |
										{{ $case_new->created_at }} - {{ $case_new->due_to }} |
										{{ $case_new->status->name }} |
										{{ $case_new->last_reply_at }}
									</span>
									<hr>
									<h4 class="snippet-heading">
										<p class="pull-right small">
											{{-- {{ $case_not_assigned->id }} --}}
										</p>
										<a href="{{ action('CasesController@show', $case_new->id) }}">[#{{ $case_new->id }}] {{ $case_new->name }}</a>
									</h4>
									<div class="snippet-body">
										<p>{{ mb_substr($case_new->text, 0, 100)."..." }}</p>
									</div>
								</div>
							@endforeach
						</div>
						@endcan



						{{-- ALL CASES --}}
						@can('show-admin')
						<div role="tabpanel" class="tab-pane" id="open">
							@foreach ($cases_open as $case_open)
								<div class="snippet" style="background-color: {{ $case_open->status->color }}">
									<span class="small">
										<i class="fa fa-fw fa-btn fa-user"></i>
										<a href="{{ action('UsersController@show', $case_open->user->id) }}">{{ $case_open->user->name }}</a> |
										{{ $case_open->created_at }} - {{ $case_open->due_to }} |
										{{ $case_open->status->name }} |
										{{ $case_open->last_reply_at }}
									</span>
									<hr>
									<h4 class="snippet-heading">
										<p class="pull-right small">
											{{-- {{ $case_open->id }} --}}
										</p>
										<a href="{{ action('CasesController@show', $case_open->id) }}">[#{{ $case_open->id }}] {{ $case_open->name }}</a>
									</h4>
									<div class="snippet-body">
										<p>{{ mb_substr($case_open->text, 0, 100)."..." }}</p>
									</div>
								</div>
							@endforeach
						</div>
						@endcan
					</div>
				</div>

				<div class="col-md-2">
					{{-- {!! $cases->links() !!} --}}
				</div>
			</div>
		</div>
	</div>

@endsection



@section('js')
@endsection