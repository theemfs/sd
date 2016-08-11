	<div class="form-group">
		{!! Form::label( trans('app.Name'), null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off', $readonly]) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label( trans('app.Comment'), null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::textarea('comment', null, ['class' => 'form-control', 'autocomplete' => 'off', $readonly]) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label( trans('app.Performers'), null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::select('performers[]', $performers, $performersIds, ['size' => '10', 'id' => 'performers_list', 'class' => 'form-control', 'multiple', 'autocomplete' => 'off', $readonly]) !!}
		</div>
	</div>

@section('footer')
	<script>
		$('#performers_list').select2({
			placeholder: "Добавлять можно по очереди или с нажатой Ctrl",
		});
	</script>
@endsection