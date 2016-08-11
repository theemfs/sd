	<div class="form-group">
		{!! Form::label( trans('app.Name'), null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off', $readonly]) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label( trans('app.Text') , null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::textarea('text', null, ['class' => 'form-control', 'autocomplete' => 'off', 'rows' => '5', $readonly]) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label( trans('app.Groups'), null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::select('groups[]', $groups, $groupsIds, ['id'=>'groups_list', 'class' => 'form-control', 'multiple', 'autocomplete' => 'off', $readonly]) !!}
		</div>
	</div>

{{-- 	<div class="form-group">
		{!! Form::label( trans('app.Start'), null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::checkbox('start', null, false) !!}
		</div>
	</div> --}}

	{{--<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
		</div>
	</div>--}}

@section('footer')
	<script>
		$('#groups_list').select2({
			placeholder: "Добавлять можно по очереди или с нажатой Ctrl",
		});
		// $('#phones_list').select2({
		// 	placeholder: "Добавлять можно по очереди или с нажатой Ctrl",
		// });
	</script>
@endsection