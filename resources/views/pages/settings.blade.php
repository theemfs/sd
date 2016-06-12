@extends('layouts.app')

@section('title', 'Send SMS')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">{{ trans('app.Send SMS') }}</div>
		<p></p>

		<div class="panel-body">

			{!! Form::model($modems, ['method' => 'POST', 'action' => ['ModemsController@send'], 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<label class="control-label col-xs-2" for="modems_list">{{ trans('app.Modem') }}</label>
					<div class="col-sm-10">
						<select id="modems_list" name="modem" class="form-control">
							@foreach ($modems as $modem)
								<option value="{{ $modem->id }}">{{ $modem->name }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.To') , null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::text( 'to' , Session::has('to') ? Session::get('to') : '', ['class' => 'form-control', 'autocomplete' => 'off']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Message'), null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::textarea( 'text' , Session::has('text') ? Session::get('text') : '', ['class' => 'form-control', 'autocomplete' => 'off']) !!}
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						{!! Form::submit( trans('app.Send') , ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>

			{!! Form::close() !!}

		</div>
	</div>

@endsection