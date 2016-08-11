@extends('layouts.app')

@section('title', trans('app.Round').' #'.$rounds->id.': '.$rounds->name.'' )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ trans('app.Round').' #'.$rounds->id.': '.$rounds->name.'' }}
			<div class="btn-group pull-right" role="group" aria-label="...">



				{{ Form::open(['action' => ['RoundsController@destroy', $rounds->id], 'method' => 'DELETE', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-xs btn-danger">{{ trans('app.Destroy') }}</button>
				{{ Form::close() }}

				{{ Form::open(['action' => ['RoundsController@show', $rounds->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-xs btn-default">{{ trans('app.Cancel') }}</button>
				{{ Form::close() }}

			</div>
		</div>

		<div class="panel-body">
			{!! Form::model($rounds, ['method' => 'PATCH', 'action' => ['RoundsController@update', $rounds->id], 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						{!! Form::submit( trans('app.Update'), ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>

				<hr>

				<div class="form-group">
					{!! Form::label( trans('app.Name'), null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Text') , null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::textarea('text', null, ['class' => 'form-control', 'autocomplete' => 'off', 'rows' => '5']) !!}
					</div>
				</div>

				{{-- <div class="form-group">
					{!! Form::label( trans('app.Filter'), null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						<div class="checkbox">
							<label>
								{!! Form::radio('sets', '0', ['class' => 'form-control']) !!} No numbers
							</label><br>
							<label>
								{!! Form::radio('sets', '1', ['class' => 'form-control']) !!} All numbers
							</label><br>
							<label>
								{!! Form::radio('sets', '2', ['class' => 'form-control']) !!} with mask
							</label>
						</div>
					</div>
				</div> --}}

			{!! Form::close() !!}
		</div>
	</div>
@stop

@section('footer')
@endsection