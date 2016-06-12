@extends('layouts.app')

@section('title', 'SMS')

@section('content')
	<div class="panel panel-default">
		<div class="panel-heading">SMS</div>

		<div class="panel-body">
			<p>SMS</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor fuga iste quos ullam,
			reprehenderit, consequuntur dolorum provident iusto, possimus repellendus voluptatum illum. Corporis fuga, a quidem expedita dolores atque quas.</p>



{!! Form::model($gateways, ['method' => 'POST', 'action' => ['PagesController@send_sms'], 'class' => 'form-horizontal']) !!}

	<div class="form-group">
		<label class="control-label col-xs-2" for="gateways_list">Gateways</label>
		<div class="col-sm-10">
			<select id="gateways_list" class="form-control" name="" id="">
				@foreach ($gateways as $gateway)
					<option value="{{ $gateway->id }} ">{{ $gateway->name }} ({{ $gateway->sender}})</option>
				@endforeach
			</select>
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('message', null, ['class' => 'control-label col-xs-2']) !!}
		<div class="col-sm-10">
			{!! Form::textarea('message', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
		{!! Form::submit('Send', ['class' => 'btn btn-primary form-control']) !!}
		</div>
	</div>

{!! Form::close() !!}



		</div>
	</div>




@endsection