@extends('layouts.app')

@section('title', 'Case #'.$case->id )

@section('content')



	<!-- LEFT BLOCK -->
	<div class="col-md-3">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ trans('app.Members') }}
				</div>

				<div class="panel-body">
					<div class="">
						{!! Form::model($case, ['method' => 'PATCH', 'action' => ['CasesController@update', $case->id], 'class' => 'form-horizontal']) !!}
							{!! Form::label('users_list_members', null, ['class' => 'control-label']) !!}
							<div class="form-group">
								<div class="col-xs-12">
									{!! Form::select('users[]', $users, $membersIds, ['id' => 'users_list_members', 'class' => 'form-control selectpicker', 'multiple', 'autocomplete' => 'off', 'size' => '1']) !!}
								</div>
							</div>

							<div class="form-group">
								<div class="col-xs-12">
									{!! Form::submit( trans('app.Save'), ['class' => 'btn btn-primary form-control col-xs-12']) !!}
								</div>
							</div>
						{!! Form::close() !!}
					</div>
					<hr>
					{{-- <div class="">
						{!! Form::model($case, ['method' => 'PATCH', 'action' => ['CasesController@update', $case->id], 'class' => 'form-horizontal']) !!}
							{!! Form::label('users_list_spectators', null, ['class' => 'control-label']) !!}
							<div class="form-group">
								<div class="col-xs-12">
									{!! Form::select('users[]', $users, $usersIds, ['id' => 'users_list_spectators', 'class' => 'form-control', 'multiple', 'autocomplete' => 'off', 'size' => '5']) !!}
								</div>
							</div>

							<div class="form-group">
								<div class="col-xs-12">
									{!! Form::submit( trans('app.Save'), ['class' => 'btn btn-primary form-control col-xs-12']) !!}
								</div>
							</div>
						{!! Form::close() !!}
					</div>
					<hr> --}}
				</div>
			</div>
		</div>
	</div>



	<!-- CENTER BLOCK -->
	<div class="col-md-6">
		<div class="panel panel-default">

			<div class="panel-heading">
				{{ trans('app.Case') . " #" . $case->id }}
			</div>

			<div class="panel-body">


				<!-- FIRST MESSAGE -->
				<div class="message bg-warning" id="{{ $message_first->id }}">
					<div class="col-xs-1">
						<i class="fa fa-fw fa-comment"></i>
						<!-- <img src="/build/images/user.png" alt="..." class="img-rounded"> -->
						<a href="{{ action('CasesController@show', $case->id) }}#{{$message_first->id}}">
							<!-- <i class="fa fa-fw fa-anchor"></i> -->
						</a>
					</div>

					<div class="col-xs-11">
						<div class="form-group">
							<span class="small">{{ $message_first->user->name }} | {{ $message_first->created_at }}</span>
							<hr>

							<div class="message-body">{{ $message_first->text }}</div>

							@foreach ($message_first->files as $file)
								@if ( substr($file->mimetype, 0, 5) == 'image')
									<a href="{{ action('FilesController@show', $file->id) }}">
										<img class="img img-rounded" src="{{ url('/') . '/thumbnails/' . $file->thumbnail }}" alt="{{ $file->name }}">
									</a>
								@else
									<a href="{{ action('FilesController@show', $file->id) }}">
										<p><i class="fa fa-file" aria-hidden="true"></i>{{ $file->name }} [{{ human_filesize($file->size) }}]</p>
									</a>
								@endif
							@endforeach
						</div>
					</div>
				</div>



				<!-- SECOND AND ETC MESSAGES -->
				@foreach ($messages as $message)
					<div class="message" id="{{ $message->id }}">
						<div class="col-xs-1">
							<i class="fa fa-fw fa-comment"></i>
							<!-- <img src="/build/images/user.png" alt="..." class="img-rounded"> -->
							<a href="{{ action('CasesController@show', $case->id) }}#{{$message->id}}">
								<!-- <i class="fa fa-fw fa-anchor"></i> -->
							</a>
						</div>

						<div class="col-xs-11">
							<div class="form-group">
								<span class="small">{{ $message->user->name }} | {{ $message->created_at }}</span>
								<hr>

								<div class="message-body">{{ $message->text }}</div>

								@foreach ($message->files as $file)
									@if ( substr($file->mimetype, 0, 5) == 'image')
										<a href="{{ action('FilesController@show', $file->id) }}">
											<img class="img img-rounded" src="{{ url('/') . '/thumbnails/' . $file->thumbnail }}" title="{{ $file->name }}">
										</a>
									@else
										<a href="{{ action('FilesController@show', $file->id) }}">
											<p><i class="fa fa-file"></i>{{ $file->name }} [{{ human_filesize($file->size) }}]</p>
										</a>
									@endif
								@endforeach
							</div>
						</div>
					</div>
				@endforeach
				<hr>



				<!-- REPLY AREA -->
				{!! Form::open(['url'=>'messages', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
					<div class="message bg-info">
						<div class=""></div>
						<div class="col-xs-12">
							<div class="form-group">
								{!! Form::textarea('text', null, ['class' => 'form-control', 'rows' => '3', 'autocomplete' => 'off', 'placeholder' => trans('app.Add Message Textarea Placeholder') ]) !!}
							</div>
								{!! Form::hidden('case', $case->id, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
							<div class="form-group">
								{!! Form::file( 'attachments[]', ['class' => '', 'multiple' => 'true']) !!}
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 pull-right">
								{!! Form::submit( trans('app.Add Message'), ['class' => 'btn btn-primary form-control col-xs-12']) !!}
							</div>
						</div>
					</div>
				{!! Form::close() !!}



			</div>
		</div>
	</div>



	<!-- RIGHT BLOCK -->
	<div class="col-md-3">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ trans('app.Case') . " #" . $case->id }}
				</div>

				<div class="panel-body">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</div>
			</div>
		</div>
	</div>

@endsection



@section('footer')

<script>
	// $('#users_list_members').select2();
	$('#users_list_members').selectpicker({
		// style: 'btn-info',
		size: 'auto',
		showTick: 'true',
		selectOnTab: 'true',
		selectedTextFormat: 'count > 1',
		liveSearch: 'true',
		actionsBox: 'true',
		header: 'test',
		liveSearchPlaceholder: '',
		noneSelectedText: 'nothing selected :-)',
		title: 'test!'
	});

</script>

@endsection