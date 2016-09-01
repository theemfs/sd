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
							<li role="presentation"><a href="#not_assigned" aria-controls="messages" role="tab" data-toggle="tab">{{ trans('app.Not assigned') }}<span class="badge">{{ $cases_not_assigned->count() }}</span></a></li>
						@endcan
						@can('show-admin')
							<li role="presentation"><a href="#all" aria-controls="messages" role="tab" data-toggle="tab">{{ trans('app.All') }}<span class="badge">{{ $cases_all->count() }}</span></a></li>
						@endcan
					</ul>
					<hr>



					<div class="tab-content">



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



						@can('show-new-cases')
						<div role="tabpanel" class="tab-pane" id="not_assigned">
							@foreach ($cases_not_assigned as $case_not_assigned)
								<div class="snippet">
									<span class="small">
										<i class="fa fa-fw fa-btn fa-user"></i>
										{{-- {{ $case_not_assigned->user->name }} | --}}
										{{ $case_not_assigned->created_at }} - {{ $case_not_assigned->due_to }} |
										{{-- {{ $case_not_assigned->status->name }} | --}}
										{{ $case_not_assigned->last_reply_at }}
									</span>
									<hr>
									<h4 class="snippet-heading">
										<p class="pull-right small">
											{{-- {{ $case_not_assigned->id }} --}}
										</p>
										<a href="{{ action('CasesController@show', $case_not_assigned->id) }}">[#{{ $case_not_assigned->id }}] {{ $case_not_assigned->name }}</a>
									</h4>
									<div class="snippet-body">
										<p>{{ mb_substr($case_not_assigned->text, 0, 100)."..." }}</p>
									</div>
								</div>
							@endforeach
						</div>
						@endcan
						@can('show-admin')
						<div role="tabpanel" class="tab-pane" id="all">
							@foreach ($cases_all as $case_all)
								<div class="snippet" style="background-color: {{ $case_all->status->color }}">
									<span class="small">
										<i class="fa fa-fw fa-btn fa-user"></i>
										<a href="{{ action('UsersController@show', $case_all->user->id) }}">{{ $case_all->user->name }}</a> |
										{{ $case_all->created_at }} - {{ $case_all->due_to }} |
										{{ $case_all->status->name }} |
										{{ $case_all->last_reply_at }}
									</span>
									<hr>
									<h4 class="snippet-heading">
										<p class="pull-right small">
											{{-- {{ $case_all->id }} --}}
										</p>
										<a href="{{ action('CasesController@show', $case_all->id) }}">[#{{ $case_all->id }}] {{ $case_all->name }}</a>
									</h4>
									<div class="snippet-body">
										<p>{{ mb_substr($case_all->text, 0, 100)."..." }}</p>
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