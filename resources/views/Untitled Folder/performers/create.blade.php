@extends('layouts.app')

@section('title', trans('app.Create Performer') )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ trans('app.Create Performer') }}
		</div>

		<div class="panel-body">
			{!! Form::open(['url'=>'performers', 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						{!! Form::submit( trans('app.Create'), ['class' => 'btn btn-primary form-control']) !!}
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

							<div class="input-group">
								<input name="phones[]" type="text" class="form-control" autocomplete="off" value="">
								<span class="input-group-addon">
									<button type="button" class="btn btn-xs btn-default rem_phone">{{ trans('app.Remove Phone') }}</button>
								</span>
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12">
								<button type="button" class="btn btn-default form-control add_phone">{{ trans('app.Add Phone') }}</button>
							</div>
						</div>

					</div>
				</div>

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