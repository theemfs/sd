@extends('layouts.app')

@section('title', trans('app.Sending').' #'.$sendings->id.': '.$sendings->name.'' )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ trans('app.Sending').' #'.$sendings->id.': '.$sendings->name.'' }}
			<div class="btn-group pull-right" role="group" aria-label="...">

				{{ Form::open(['action' => ['SendingsController@destroy', $sendings->id], 'method' => 'DELETE', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-xs btn-danger">{{ trans('app.Destroy') }}</button>
				{{ Form::close() }}

				{{ Form::open(['action' => ['SendingsController@edit', $sendings->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-xs btn-warning">{{ trans('app.Edit') }}</button>
				{{ Form::close() }}

			</div>
		</div>

		<div class="panel-body">
			{!! Form::model($sendings, ['url'=>'sendings', 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<a class="btn btn-default form-control" href="{{ action('SendingsController@index') }}" role="button">{{ trans('app.Close') }}</a>
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Name'), null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'readonly']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Text') , null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::textarea('text', null, ['class' => 'form-control', 'autocomplete' => 'off', 'rows' => '5', 'readonly']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Groups').' ('.count($groups).')', null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
<textarea name="" id="" rows="5" class="form-control" readonly>
@foreach ($groups as $group)
{{ $group->name }}
@endforeach
</textarea>
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Phones').' ('.count($phones).')', null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						<textarea name="" id="" rows="10" class="form-control" readonly>
@foreach ($phones as $phone)
{{ $phone }}
@endforeach
						</textarea>
					</div>
				</div>

			{!! Form::close() !!}

			<div class="col-xs-12 col-sm-10 col-sm-offset-2">
				<table class="table table-bordered table-hover table-condensed">
					@foreach ($messages as $message)
						<tr>
							<th>{{ $message->to }}</th>
							<th class="">{{ $message->created_at }}</th>
							<th class="">{{ $message->updated_at }}</th>
							@if ( $message->status == 0 )
								<th><i class="fa fa-refresh fa-spin"></i></th>
							@elseif ( $message->status == 1 )
								<th><i class="fa fa-check"></i></th>
							@endif
						</tr>
					@endforeach
				</table>
			</div>
		</div>

	</div>

@stop

@section('footer')
@endsection