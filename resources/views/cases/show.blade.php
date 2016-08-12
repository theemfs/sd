@extends('layouts.app')



@section('title', 'Case #'.$case->id )



@section('css')
		{{-- <link href="{{ url('/') }}/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
		<link href="{{ url('/') }}/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
		<link href="{{ url('/') }}/css/bootstrap-select.min.css" rel="stylesheet">
@endsection



@section('content')

	<!-- TOP BLOCK -->
	<div class="col-md-12">


			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="row">
					<div class="panel panel-default">
						<div class="panel-heading" role="tab" id="headingOne">
							{{-- <h4 class="panel-title"> --}}
								<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<i class="fa fa-fw fa-btn fa-cogs"></i> {{ trans('app.Case Settings') }}
								</a>
							{{-- </h4> --}}
						</div>

						<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
							<div class="panel-body">
								<div class="">
								@can('update-case', $case)
									{!! Form::model($case, ['method' => 'PATCH', 'action' => ['CasesController@update', $case->id], 'class' => 'form-horizontal']) !!}
										<div class="form-group">
											<div class="col-xs-12">
												{!! Form::submit( trans('app.Update'), ['class' => 'btn btn-primary form-control col-xs-12']) !!}
											</div>
										</div>

										<div class="col-md-3 col-sm-6 col-xs-12">
											{!! Form::label('users_list_performers', trans('app.Performers'), ['class' => 'control-label']) !!}
											<div class="form-group">
												{!! Form::select('performers[]', $users, $performersIds, ['id' => 'users_list_performers', 'class' => 'form-control selectpicker', 'multiple', 'autocomplete' => 'off', 'size' => '1']) !!}
											</div>
										</div>

										<div class="col-md-3 col-sm-6 col-xs-12">
											{!! Form::label('users_list_members', trans('app.Members'), ['class' => 'control-label']) !!}
											<div class="form-group">
												{!! Form::select('members[]', $users, $membersIds, ['id' => 'users_list_members', 'class' => 'form-control selectpicker', 'multiple', 'autocomplete' => 'off', 'size' => '1']) !!}
											</div>
										</div>

										<div class="col-md-3 col-sm-6 col-xs-12">
											{!! Form::label('users_list_members', trans('app.Status'), ['class' => 'control-label']) !!}
											<div class="form-group">
												{!! Form::select('status_id', $statuses, $case->status_id, ['id' => 'statuses_list', 'class' => 'form-control selectpicker', 'autocomplete' => 'off', 'size' => '1']) !!}
											</div>
										</div>

										<div class="col-md-3 col-sm-6 col-xs-12">
											{!! Form::label('users_list_members', trans('app.Due To'), ['class' => 'control-label']) !!}
											<div class="form-group">
												<input type='text' name="due_to" id='due_to' class="form-control date"/>
												{{-- <span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span> --}}
											</div>
										</div>
									{!! Form::close() !!}
								@else
										<div class="col-md-3 col-sm-6 col-xs-12">
											{!! Form::label('users_list_performers', trans('app.Performers'), ['class' => 'control-label']) !!}
											<div class="form-group">
												{!! Form::select('performers[]', $case->performers->lists('name', 'id'), $performersIds, ['id' => 'users_list_performers', 'class' => 'form-control selectpicker', 'multiple', 'autocomplete' => 'off', 'size' => '1']) !!}
											</div>
										</div>

										<div class="col-md-3 col-sm-6 col-xs-12">
											{!! Form::label('users_list_members', trans('app.Members'), ['class' => 'control-label']) !!}
											<div class="form-group">
												{!! Form::select('members[]', $case->members->lists('name', 'id'), $membersIds, ['id' => 'users_list_members', 'class' => 'form-control selectpicker', 'multiple', 'autocomplete' => 'off', 'size' => '1']) !!}
												{{-- <select id="statuses_list" class="form-control selectpicker" autocomplete="off" size="1" name="status_id">
												@foreach($statuses as $status)
													<option value="1" selected="selected" disabled>new</option>
												@endforeach --}}
											</div>
										</div>

										<div class="col-md-3 col-sm-6 col-xs-12">
											{!! Form::label('users_list_members', trans('app.Status'), ['class' => 'control-label']) !!}
											<div class="form-group">
												{!! Form::select('status_id', $statuses, $case->status_id, ['id' => 'statuses_list', 'class' => 'form-control selectpicker', 'autocomplete' => 'off', 'size' => '1', 'disabled']) !!}
											</div>
										</div>

										<div class="col-md-3 col-sm-6 col-xs-12">
											{!! Form::label('users_list_members', trans('app.Due To'), ['class' => 'control-label']) !!}
											<div class="form-group">
												<input type='text' name="due_to" id='due_to' class="form-control date" readonly value="{{ date("Y-m-d H:i", strtotime($case->due_to)) }}"/>
											</div>
										</div>
								@endcan
								</div>
								<small>
									Изменение параметров доступно только автору или исполнителю кейса.
								</small>
							</div>

						</div>
					</div>
				</div>
			</div>

	</div>



	<!-- CENTER BLOCK -->
	<div class="col-md-8 col-md-offset-2">
		<div class="row">
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
												<p><i class="fa fa-file"></i> {{ $file->name }} [{{ human_filesize($file->size) }}]</p>
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
	</div>



	<!-- RIGHT BLOCK -->
	<div class="col-md-3">

	</div>

@endsection



@section('js')

@can('update-case', $case)
	<script src="{{ url('/') }}/js/moment-with-locales.min.js"></script>
	<script src="{{ url('/') }}/js/bootstrap-datetimepicker.min.js"></script>
	<script>
		$('#users_list_performers, #users_list_members').selectpicker({
			// style: 'btn-info',
			size: '7',
			showTick: 'true',
			selectOnTab: 'true',
			selectedTextFormat: 'count > 1',
			liveSearch: 'true',
			actionsBox: 'true',
			// header: 'test',
			liveSearchPlaceholder: '',
			noneSelectedText: "{{ trans('app.Nothing Selected') }}",
			// title: 'test!',
		});

		$('#statuses_list').selectpicker({
			size: '7',
			showTick: 'true',
			selectOnTab: 'true',
			selectedTextFormat: 'count > 1',
			actionsBox: 'true',
			liveSearchPlaceholder: '',
			noneSelectedText: "{{ trans('app.Nothing Selected') }}",
		});

		// $("body").scrollTop(1000);

		$(function () {
			$('#due_to').datetimepicker({
				defaultDate: '{{ date("Y-m-d H:i", strtotime($case->due_to)) }}',
				locale: 'ru',
				// useCurrent: true,
				showTodayButton: true,
				// showClear: true,
				// showClose: true,
				// focusOnShow: true,
			});
		});
	</script>

@endcan

@endsection