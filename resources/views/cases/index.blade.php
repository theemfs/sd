@extends('layouts.app')



@section('css')
@endsection



@section('title', trans('app.Cases'))



@section('content')

	<!-- LEFT BLOCK -->
	<div class="col-md-2">
		<div class="row">

		</div>
	</div>



	<!-- CENTER BLOCK -->
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans('app.Cases') }}
				<a class="btn btn-default btn-success pull-right btn-xs" href="{{ action('CasesController@create') }}" role="button">{{ trans('app.Create') }}</a>
			</div>

			<div class="panel-body">

				<div> {{-- TABS --}}
					<!-- Nav tabs -->
					<ul class="nav nav-pills nav-justified" role="tablist">
						<li role="presentation" class="active"><a href="#author" aria-controls="home" role="tab" data-toggle="tab">{{ trans('app.As Author') }} <span class="badge">{{ $cases_author->count() }}</span></a></li>
						<li role="presentation"><a href="#performer" aria-controls="profile" role="tab" data-toggle="tab">{{ trans('app.As Performer') }} <span class="badge">{{ $cases_performer->count() }}</span></a></li>
						<li role="presentation"><a href="#member" aria-controls="messages" role="tab" data-toggle="tab">{{ trans('app.As Member') }} <span class="badge">{{ $cases_member->count() }}</span></a></li>
					</ul>
					<!-- Tab panes -->
					<hr>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="author">
							@foreach ($cases_author as $case_author)
								<div class="snippet">

									<h4 class="snippet-heading">
										<p class="pull-right">{{ $case_author->id }}</p>
										<!-- <a href="{{ action('CasesController@show', $case_author->id) }}">{{ mb_substr($case_author->text, 0, 50)."..." }}</a> -->
										<a href="{{ action('CasesController@show', $case_author->id) }}">{{ $case_author->name }}</a>
									</h4>


									<p>{{ $case_author->user->name }}</p>
									<div class="snippet-body">
										<p>{{ mb_substr($case_author->text, 0, 300)."..." }}</p>
									</div>
								</div>
							@endforeach
						</div>
						<div role="tabpanel" class="tab-pane fade" id="performer">
							@foreach ($cases_performer as $case_performer)
								<div class="snippet">

									<h4 class="snippet-heading">
										<p class="pull-right">{{ $case_performer->id }}</p>
										<!-- <a href="{{ action('CasesController@show', $case_performer->id) }}">{{ mb_substr($case_performer->text, 0, 50)."..." }}</a> -->
										<a href="{{ action('CasesController@show', $case_performer->id) }}">{{ $case_performer->name }}</a>
									</h4>


									<p>{{ $case_performer->user->name }}</p>
									<div class="snippet-body">
										<p>{{ mb_substr($case_performer->text, 0, 300)."..." }}</p>
									</div>
								</div>
							@endforeach
						</div>
						<div role="tabpanel" class="tab-pane fade" id="member">
							@foreach ($cases_member as $case_member)
								<div class="snippet">

									<h4 class="snippet-heading">
										<p class="pull-right">{{ $case_member->id }}</p>
										<!-- <a href="{{ action('CasesController@show', $case_member->id) }}">{{ mb_substr($case_member->text, 0, 50)."..." }}</a> -->
										<a href="{{ action('CasesController@show', $case_member->id) }}">{{ $case_member->name }}</a>
									</h4>


									<p>{{ $case_member->user->name }}</p>
									<div class="snippet-body">
										<p>{{ mb_substr($case_member->text, 0, 300)."..." }}</p>
									</div>
								</div>
							@endforeach
						</div>
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
	<script>
	</script>
@endsection