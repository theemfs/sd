	<div class="form-group">
		{!! Form::label('name', null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off', $readonly]) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('comment', null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::textarea('comment', null, ['class' => 'form-control', 'autocomplete' => 'off', $readonly]) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('sender', null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::text('sender', null, ['class' => 'form-control', 'autocomplete' => 'off', $readonly]) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('modem_port_name', null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::text('modem_port_name', null, ['class' => 'form-control', 'autocomplete' => 'off', $readonly]) !!}
		</div>
	</div>
{{-- 	<div class="form-group">
		{!! Form::label('url_status', null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::text('url_status', null, ['class' => 'form-control', 'autocomplete' => 'off', $readonly]) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('url_send', null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::text('url_send', null, ['class' => 'form-control', 'autocomplete' => 'off', $readonly]) !!}
		</div>
	</div> --}}

{{-- 	<div class="form-group">
		{!! Form::label('url_recieve', null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::text('url_recieve', null, ['class' => 'form-control', 'autocomplete' => 'off', $readonly]) !!}
		</div>
	</div> --}}

{{-- 	<div class="form-group">
		{!! Form::label('login', null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::text('login', null, ['class' => 'form-control', 'autocomplete' => 'off', $readonly]) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('password', null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::text('password', null, ['class' => 'form-control', 'autocomplete' => 'off', $readonly]) !!}
		</div>
	</div> --}}

{{-- 	<div class="form-group">
		{!! Form::label('sender', null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::text('sender', null, ['class' => 'form-control', 'autocomplete' => 'off', $readonly]) !!}
		</div>
	</div> --}}

	{{-- <div class="form-group">
		{!! Form::label('performers', null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::select('performers[]', $performers, $performersIds, ['id' => 'performers_list', 'class' => 'form-control', 'autocomplete' => 'off', $readonly]) !!}
		</div>
	</div> --}}

	{{--<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
		</div>
	</div>--}}

@section('footer')
	<script>
		$('#performers_list').select2({
			placeholder: "Добавлять можно по очереди или с нажатой Ctrl",
		});
	</script>
@endsection