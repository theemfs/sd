@extends('layouts.app')

@section('title', 'Performer #'.$performer->id.': '.$performer->name.'' )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ trans('app.Performer').' #'.$performer->id.': '.$performer->name.'' }}
		</div>

		<div class="panel-body">

			<div class="btn-group btn-group-justified" role="group">

				{{ Form::open(['action' => ['PerformersController@destroy', $performer->id], 'method' => 'DELETE', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> {{ trans('app.Destroy') }}</button>
				{{ Form::close() }}

				{{ Form::open(['action' => ['PerformersController@edit', $performer->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-warning"><i class="fa fa-pencil"></i> {{ trans('app.Edit') }}</button>
				{{ Form::close() }}

			</div>
			<hr>

			{!! Form::model($performer, ['url'=>'performers', 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<a class="btn btn-primary form-control" href="{{ action('PerformersController@index') }}" role="button"><i class="fa fa-times"></i> {{ trans('app.Close') }}</a>
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Name') , null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'readonly']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Comment') , null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::textarea('comment', null, ['class' => 'form-control', 'autocomplete' => 'off', 'readonly']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Groups') , null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
<textarea name="" id="" rows="5" class="form-control" readonly>
@foreach ($groups as $group)
{{ $group->name }}
@endforeach
</textarea>
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Phones') , null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						@foreach ($phones as $phone)
							<input name="phones[]" type="text" class="form-control" readonly value="{{ $phone->id }}">
						@endforeach
					</div>
				</div>

			{!! Form::close() !!}
		</div>
	</div>
@stop