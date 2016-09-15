@extends('layouts.app')



@section('title', 'Case #'.$case->id )



@section('css')
		{{-- <link href="{{ url('/') }}/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
		<link href="{{ url('/') }}/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
		<link href="{{ url('/') }}/css/bootstrap-select.min.css" rel="stylesheet">
@endsection



@section('content')



{{-- BREADCRUMBS --}}
<ol class="breadcrumb">
	<li><a href="{{ url('/') }}">{{ trans('app.Home') }}</a></li>
	<li><a href="{{ action('CasesController@index') }}">{{ trans('app.Cases') }}</a></li>
	<li class="active">#{{ $case->id }}. {{ $case->name }}</li>
</ol>



	{{-- TOP BLOCK --}}
	<div class="col-md-8 col-md-offset-2">



			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="row">
					<div class="panel panel-primary">
						<div class="panel-heading" role="tab" id="headingOne">
							<i class="fa fa-fw fa-btn fa-briefcase"></i>
							{{ trans('app.Case') }}
							#{{ $case->id }}.
							"{{ $case->name }}"
							({{ $case->user->name }})
						</div>

						<div id="collapseOne" class="panel-collapse in" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
								<div class="">
								@can('update-case', $case)
									{!! Form::model($case, ['method' => 'PATCH', 'action' => ['CasesController@update', $case->id], 'class' => 'form-horizontal']) !!}

										<div class="col-xs-12">
											{!! Form::label('users_list_performers', trans('app.Performers'), ['class' => 'control-label']) !!}
											<div class="form-group">
												{{-- {!! Form::select('performers[]', $users_can_be_performers, $performersIds, ['id' => 'users_list_performers', 'class' => 'form-control selectpicker', 'multiple', 'autocomplete' => 'off', 'size' => '1']) !!} --}}
												<select id="users_list_performers" class="form-control selectpicker" multiple="multiple" autocomplete="off" size="1" name="performers[]">
													@foreach($users_performers as $user_performer)
														<option value="{{ $user_performer->id }}" selected="selected" data-subtext="({{ $user_performer->department }}/{{ $user_performer->title }})">{{ $user_performer->getSurnameWithInitials() }}</option>
													@endforeach
														<option data-divider="true"></option>
													@foreach($users_can_be_performers as $user_can_be_performer)
														<option value="{{ $user_can_be_performer->id }}" data-subtext="({{ $user_can_be_performer->department }}/{{ $user_can_be_performer->title }})">{{ $user_can_be_performer->getSurnameWithInitials() }}</option>
													@endforeach
												</select>
											</div>
										</div>

										<div class="col-xs-12">
											{!! Form::label('users_list_members', trans('app.Members'), ['class' => 'control-label']) !!}
											<div class="form-group">
												{{-- {!! Form::select('members[]', $users, $membersIds, ['id' => 'users_list_members', 'class' => 'form-control selectpicker', 'multiple', 'autocomplete' => 'off', 'size' => '1']) !!} --}}
												<select id="users_list_members" class="form-control selectpicker" multiple="multiple" autocomplete="off" size="1" name="members[]">
													@foreach($users_members as $user_member)
														<option value="{{ $user_member->id }}" selected="selected" data-subtext="({{ $user_member->department }}/{{ $user_member->title }})">{{ $user_member->getSurnameWithInitials() }}</option>
													@endforeach
														<option data-divider="true"></option>
													@foreach($users_can_be_members as $user_can_be_member)
														<option value="{{ $user_can_be_member->id }}" data-subtext="({{ $user_can_be_member->department }}/{{ $user_can_be_member->title }})">{{ $user_can_be_member->getSurnameWithInitials() }}</option>
													@endforeach
												</select>
											</div>
										</div>

										<div class="col-sm-6 col-xs-12">
											{!! Form::label('status_id', trans('app.Status'), ['class' => 'control-label']) !!}
											<div class="form-group">
												{{-- {!! Form::select('status_id', $statuses, $case->status_id, ['id' => 'statuses_list', 'class' => 'form-control selectpicker', 'autocomplete' => 'off', 'size' => '1']) !!} --}}
												<select id="statuses_list" class="form-control selectpicker" autocomplete="off" size="1" name="status_id">
													@foreach($statuses as $status)
														<option value="{{ $status->id }}" {!! $status->id == $case->status_id ? "selected=\"selected\"" : '' !!} style="background: {{ $status->color }}">{{ $status->name }}</option>
													@endforeach
												</select>
											</div>
										</div>

										<div class="col-sm-6 col-xs-12">
											{!! Form::label('due_to', trans('app.Due To'), ['class' => 'control-label']) !!}
											<div class="form-group">
												<input type='text' name="due_to" id='due_to' class="form-control date"/>
												{{-- <span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span> --}}
											</div>
										</div>

										<div class="form-group">
											<div class="col-xs-12">
												{!! Form::button( '<i class="fa fa-fw fa-btn fa-check"></i>' . trans('app.Update'), ['type' => 'submit', 'class' => 'btn btn-primary form-control']) !!}
											</div>
										</div>

									{!! Form::close() !!}
								@else
										<div class="col-xs-12">

											{!! Form::label('users_list_performers', trans('app.Performers'), ['class' => 'control-label']) !!}
											<div class="form-group">
												{{-- {!! Form::select('performers[]', $users_can_be_performers, $performersIds, ['id' => 'users_list_performers', 'class' => 'form-control selectpicker', 'multiple', 'autocomplete' => 'off', 'size' => '1']) !!} --}}
												<select id="users_list_performers" class="form-control selectpicker" multiple="multiple" autocomplete="off" size="1" name="performers[]" disabled>
													@foreach($users_performers as $user_performer)
														<option value="{{ $user_performer->id }}" selected="selected" data-subtext="({{ $user_performer->department }}/{{ $user_performer->title }})">{{ $user_performer->getSurnameWithInitials() }}</option>
													@endforeach
														<option data-divider="true"></option>
													@foreach($users_can_be_performers as $user_can_be_performer)
														<option value="{{ $user_can_be_performer->id }}" data-subtext="({{ $user_can_be_performer->department }}/{{ $user_can_be_performer->title }})">{{ $user_can_be_performer->getSurnameWithInitials() }}</option>
													@endforeach
												</select>
											</div>
										</div>

										<div class="col-xs-12">
											{!! Form::label('users_list_members', trans('app.Members'), ['class' => 'control-label']) !!}
											<div class="form-group">
												{{-- {!! Form::select('members[]', $case->members->lists('name', 'id'), $membersIds, ['id' => 'users_list_members', 'class' => 'form-control selectpicker', 'multiple', 'autocomplete' => 'off', 'size' => '1']) !!} --}}
												<select id="users_list_members" class="form-control selectpicker" multiple="multiple" autocomplete="off" size="1" name="members[]">
													@foreach($users_members as $user_member)
														<option value="{{ $user_member->id }}" selected="selected" data-subtext="({{ $user_member->department }}/{{ $user_member->title }})">{{ $user_member->getSurnameWithInitials() }}</option>
													@endforeach
														<option data-divider="true"></option>
													@foreach($users_can_be_members as $user_can_be_member)
														<option value="{{ $user_can_be_member->id }}" data-subtext="({{ $user_can_be_member->department }}/{{ $user_can_be_member->title }})">{{ $user_can_be_member->getSurnameWithInitials() }}</option>
													@endforeach
												</select>
												{{-- <select id="statuses_list" class="form-control selectpicker" autocomplete="off" size="1" name="status_id">
												@foreach($statuses as $status)
													<option value="1" selected="selected" disabled>new</option>
												@endforeach --}}
											</div>
										</div>

										<div class="col-sm-6 col-xs-12">
											{!! Form::label('statuses_list', trans('app.Status'), ['class' => 'control-label']) !!}
											<div class="form-group">
												{{-- {!! Form::select('status_id', $statuses, $case->status_id, ['id' => 'statuses_list', 'class' => 'form-control selectpicker', 'autocomplete' => 'off', 'size' => '1', 'disabled']) !!} --}}
												<select id="statuses_list" class="form-control selectpicker" autocomplete="off" size="1" name="status_id" disabled>
													@foreach($statuses as $status)
														<option value="{{ $status->id }}" {!! $status->id == $case->status_id ? "selected=\"selected\"" : '' !!} style="background: {{ $status->color }}">{{ $status->name }}</option>
													@endforeach
												</select>
											</div>
										</div>

										<div class="col-sm-6 col-xs-12">
											{!! Form::label('due_to', trans('app.Due To'), ['class' => 'control-label']) !!}
											<div class="form-group">
												<input type='text' name="due_to" id='due_to' class="form-control date" readonly value="
													{{ ($case->due_to)>1 ? date("Y-m-d H:i", strtotime($case->due_to)) : "" }}
												"/>
											</div>
										</div>
								@endcan
								</div>
								{{-- <div class="col-xs-12">
									<small>Изменение параметров доступно только автору или исполнителю кейса.</small>
								</div> --}}
							</div>

						</div>
					</div>
				</div>
			</div>

	</div>



	{{-- CENTER BLOCK --}}
	<div class="col-md-8 col-md-offset-2">
		<div class="row">
			<div class="panel panel-default">

				<div class="panel-heading">
					{{ trans('app.Discussion') }}
				</div>

				<div class="panel-body">



					{{-- REPLY AREA --}}
					{{-- <button class="btn btn-primary col-xs-12" type="button" data-toggle="collapse" data-target="#reply_area" aria-expanded="false" aria-controls="collapseExample">
						{{ trans('app.Reply') }}
					</button>
					<div class="collapse" id="reply_area">
						<div class="well"> --}}
							{!! Form::open(['url'=>'messages', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
								<div class="message bg-info">
									<div class=""></div>
									<div class="col-xs-12">
										<div class="form-group">
											{!! Form::textarea('text', null, ['class' => 'form-control', 'rows' => '7', 'autocomplete' => 'off', 'placeholder' => trans('app.Add Message Textarea Placeholder') ]) !!}
										</div>
											{!! Form::hidden('case', $case->id, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
										<div class="form-group">
											{!! Form::file( 'attachments[]', ['class' => '', 'multiple' => 'true']) !!}
										</div>
									</div>
									<div class="form-group">
										<div class="col-xs-12 pull-right">
										{!! Form::button( '<i class="fa fa-fw fa-btn fa-paper-plane"></i>' . trans('app.Reply'), ['type' => 'submit', 'class' => 'btn btn-info form-control']) !!}
										</div>
									</div>
								</div>
							{!! Form::close() !!}
						{{-- </div>
					</div> --}}
					<div class="col-xs-12">
						<hr>
					</div>




					{{-- SECOND AND ETC MESSAGES --}}
					@foreach ($messages as $message)

						{{-- COLORING MESSAGES BY AUTHOR --}}
						{{-- @if ($message->user->id == Auth::user()->id)
							<div class="message bg-warning" id="{{ $message->id }}">
						@else
							<div class="message" id="{{ $message->id }}">
						@endif --}}

						{{-- COLORING MESSAGES BY TYPE --}}
						@if (($message->is_service_message == 1))
							@if (Auth::user()->is_admin)
							{{-- SERVICE MESSAGE --}}
								<div class="message message_service" id="{{ $message->id }}">
									<div class="col-xs-1">
										<i class="fa fa-fw fa-info"></i>
									</div>

									<div class="col-xs-11">
										<span class="small">
											<a href="{{ action('UsersController@show', $message->user->id) }}" data-toggle="tooltip" data-placement="auto" data-container="body" title="{{ $message->user->department }}/{{ $message->user->title }}: {{ $message->user->telephonenumber }}, {{ $message->user->mobile }}">{{ $message->user->name }}</a> |
											{{ $message->created_at }}
										</span>
										<div class="message-body small">{{ $message->text }}</div>
									</div>
								</div>
							@endif
						@else
						{{-- MESSAGES --}}
							<div class="message" id="{{ $message->id }}" {!! Auth::user()->id==$message->user_id ? 'style="background-color: #FFFFD4"' : ""!!}>
								<div class="col-xs-1">
									<i class="fa fa-fw fa-comment"></i>
								</div>

								<div class="col-xs-11">
									<div class="form-group">
										<span class="small">
											<a href="{{ action('UsersController@show', $message->user->id) }}" data-toggle="tooltip" data-placement="auto" data-container="body" title="{{ $message->user->department }}/{{ $message->user->title }}: {{ $message->user->phone }}, {{ $message->user->mobile }}">{{ $message->user->name }}</a> |
											{{ $message->created_at }}
										</span>
										<hr>

										<div class="message-body">{!! link_it($message->text) !!}</div>

										@foreach ($message->files as $file)
											@if ( substr($file->mimetype, 0, 5) == 'image')
												<a href="{{ action('FilesController@show', $file->id) }}">
													<img class="img img-rounded" src="{{ url('/') . '/thumbnails/' . $file->thumbnail }}" title="{{ $file->name }}">
												</a>
											@else
												<a href="{{ action('FilesController@show', $file->id) }}">
													<p><i class="fa fa-file"></i> {{ $file->name }} [{{ human_filesize($file->size) }}]</p>
												</a>
											@endif
										@endforeach
									</div>
								</div>
							</div>
						@endif


					@endforeach



					{{-- <!-- FIRST MESSAGE -->
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
					</div> --}}



				</div>
			</div>
		</div>
	</div>



	{{-- RIGHT BLOCK --}}
	<div class="col-md-3">

	</div>

@endsection



@section('js')

	<script src="{{ url('/') }}/js/bootstrap-select.min.js"></script>

	<script src="{{ url('/') }}/js/moment-with-locales.min.js"></script>
	<script src="{{ url('/') }}/js/bootstrap-datetimepicker.min.js"></script>
	<script>
		$('#users_list_performers, #users_list_members').selectpicker({
			size: '10',
			showTick: 'true',
			selectOnTab: 'true',
			selectedTextFormat: 'count > 10',
			liveSearch: 'true',
			actionsBox: 'true',
			liveSearchPlaceholder: '',
			noneSelectedText: "{{ trans('app.Nothing Selected') }}",
		});

		$('#statuses_list').selectpicker({
			size: '10',
			showTick: 'true',
			selectOnTab: 'true',
			selectedTextFormat: 'count > 10',
			actionsBox: 'true',
			liveSearchPlaceholder: '',
			noneSelectedText: "{{ trans('app.Nothing Selected') }}",
		});

		$(function () {
			$('#due_to').datetimepicker({
				defaultDate: '{{ $case->due_to > date("Y-m-d H:i", mktime(0, 0, 0, 1, 1, 1971)) ? date("Y-m-d H:i", strtotime($case->due_to)) : "" }}',
				locale: 'ru',
				showTodayButton: true,
				showClear: true,
			});
		});

		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>

@endsection