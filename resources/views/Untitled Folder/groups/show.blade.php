@extends('layouts.app')

@section('title', trans('app.Group').' #'.$groups->id.': '.$groups->name.'' )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ trans('app.Group').' #'.$groups->id.': '.$groups->name.'' }}
			<div class="btn-group pull-right" role="group" aria-label="...">

				{{ Form::open(['action' => ['GroupsController@destroy', $groups->id], 'method' => 'DELETE', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-xs btn-danger">{{ trans('app.Destroy')}}</button>
				{{ Form::close() }}

				{{ Form::open(['action' => ['GroupsController@edit', $groups->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-xs btn-warning">{{ trans('app.Edit')}}</button>
				{{ Form::close() }}

			</div>
		</div>

		<div class="panel-body">
			{!! Form::model($groups, ['url'=>'groups', 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<a class="btn btn-default form-control" href="{{ action('GroupsController@index') }}" role="button">{{ trans('app.Close')}}</a>
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Name'), null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'readonly']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Comment'), null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::textarea('comment', null, ['class' => 'form-control', 'autocomplete' => 'off', 'readonly']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Performers').' ('.count($performers).')', null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
<textarea name="" id="" rows="5" class="form-control" readonly>
@foreach ($performers as $performer)
{{ $performer->name }}
@endforeach
</textarea>
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Phones').' ('.count($phones).')', null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
<textarea name="" id="" rows="5" class="form-control" readonly>
@foreach ($phones as $phone)
{{ $phone }}
@endforeach
</textarea>
					</div>
				</div>

			{!! Form::close() !!}
		</div>
	</div>
@stop