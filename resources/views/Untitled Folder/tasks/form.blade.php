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

{{-- 	<div class="form-group">
		{!! Form::label('performers', null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::select('performers[]', $performers, $performersIds, ['class' => 'form-control', 'multiple', 'autocomplete' => 'off', $readonly]) !!}
		</div>
	</div> --}}

	{{--<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
		</div>
	</div>--}}