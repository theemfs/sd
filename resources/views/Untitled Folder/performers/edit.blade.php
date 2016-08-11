@extends('layouts.app')

@section('title', trans('app.Edit Performer').' '.$performer->id.': '.$performer->name.'' )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ trans('app.Edit Performer').' #'.$performer->id.': '.$performer->name.'' }}
			<div class="btn-group pull-right" role="group" aria-label="...">
			</div>
		</div>

		<div class="panel-body">

			<div class="btn-group btn-group-justified" role="group">

				{{ Form::open(['action' => ['PerformersController@destroy', $performer->id], 'method' => 'DELETE', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> {{ trans('app.Destroy') }}</button>
				{{ Form::close() }}

				{{ Form::open(['action' => ['PerformersController@show', $performer->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-default"><i class="fa fa-times"></i> {{ trans('app.Cancel') }}</button>
				{{ Form::close() }}

			</div>
			<hr>

			{!! Form::model($performer, ['method' => 'PATCH', 'action' => ['PerformersController@update', $performer->id], 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						{{ Form::button('<i class="fa fa-floppy-o"></i> '.trans('app.Update'), array('type' => 'submit', 'class' => 'btn btn-primary form-control')) }}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Name') , null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Comment') , null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::textarea('comment', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Groups') , null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::select('groups[]', $groups, $groupsIds, ['id' => 'groups_list', 'class' => 'form-control', 'multiple', 'autocomplete' => 'off', 'size' => '5']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Phones') , null, ['class' => 'control-label col-sm-2 col-xs-12']) !!}
					<div class="col-sm-10 phones-wrapper">

						<div class="phones">

							@foreach ($phones as $phone)
								<div class="input-group">
									<input name="phones[]" type="text" class="form-control" autocomplete="off" value="{{ $phone->id }}">
									<span class="input-group-addon">
										<button type="button" class="btn btn-xs btn-warning rem_phone" ><i class="fa fa-minus"></i> {{ trans('app.Remove Phone') }}</button>
									</span>
								</div>
							@endforeach

							<div class="input-group">
								<input name="phones[]" type="text" class="form-control" autocomplete="off" value="">
								<span class="input-group-addon">
									<button type="button" class="btn btn-xs btn-warning rem_phone"><i class="fa fa-minus"></i> {{ trans('app.Remove Phone') }}</button>
								</span>
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12">
								<button type="button" class="btn btn-warning form-control add_phone"><i class="fa fa-plus"></i> {{ trans('app.Add Phone') }}</button>
							</div>
						</div>

					</div>
				</div>

				{{-- @include ('performers.form', ['readonly' => '']) --}}

			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
	<script>
		$('#groups_list').select2();

		$('.phones-wrapper').each(function() {
			var $wrapper = $('.phones', this);
			$(".add_phone", $(this)).click(function(e) {
				$('.input-group:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
			});
			$('.input-group .rem_phone', $wrapper).click(function() {
				if ($('.input-group', $wrapper).length > 1)
				$(this).parent().parent('.input-group').remove();
			});
		});

	</script>
@endsection