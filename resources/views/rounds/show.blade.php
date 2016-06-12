@extends('layouts.app')

@section('title', trans('app.Round').' #'.$rounds->id.': '.$rounds->name.'' )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ trans('app.Round').' #'.$rounds->id.': '.$rounds->name.'' }}
			<div class="btn-group pull-right" role="group" aria-label="...">
			</div>
		</div>

		<div class="panel-body">

			@if( $status['estimated'] > 0 )
				<div class="btn-group btn-group-justified" role="group">
					{{ Form::open(['action' => ['RoundsController@edit', $rounds->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
						<button type="submit" type="button" class="btn btn-warning">{{ trans('app.Edit') }}</button>&nbsp;
					{{ Form::close() }}
				</div>
				<hr>
			@endif

			{!! Form::model($rounds, ['url'=>'rounds', 'class' => 'form-horizontal']) !!}

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<a class="btn btn-default form-control" href="{{ action('RoundsController@index') }}" role="button">{{ trans('app.Close') }}</a>
					</div>
				</div>

				<hr>

				<div class="form-group">
					{!! Form::label( trans('app.Name'), null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'readonly']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Text') , null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						{!! Form::textarea('text', null, ['class' => 'form-control', 'autocomplete' => 'off', 'rows' => '2', 'readonly']) !!}
					</div>
				</div>

				<div class="form-group">
					{!! Form::label( trans('app.Status') , null, ['class' => 'control-label col-xs-2']) !!}
					<div class="col-sm-10">
						<p>All / Sended / Delivered / Queued / Estimated</p>
						<p>{{ $status['all'] }} / {{ $status['sended'] }} / {{ $status['delivered'] }} / {{ $status['queued'] }} / {{ $status['estimated'] }}</p>
						<p>Last Update: {{ $status['last_update'] }}</p>

						@if( $status['progress_sending'] == 100)
							<div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" style="width: {{ $status['progress_sending'] }}%;"></div></div>
						@else
							<div class="progress"><div class="progress-bar progress-bar-info" role="progressbar" style="width: {{ $status['progress_sending'] }}%;"></div></div>
						@endif

						@if( $status['progress_delivery'] == 100)
							<div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" style="width: {{ $status['progress_delivery'] }}%;"></div></div>
						@else
							<div class="progress"><div class="progress-bar progress-bar-info" role="progressbar" style="width: {{ $status['progress_delivery'] }}%;"></div></div>
						@endif
					</div>
				</div>

			{!! Form::close() !!}

		</div>

	</div>



	<div class="panel panel-default">

		<div class="panel-heading">
			{{ trans('app.Tasks') }}
			<div class="btn-group pull-right" role="group">
			</div>
		</div>

		<div class="panel-body">

			@if( $status['estimated'] > 0 )
				{!! Form::open(['action' => ['RoundsController@task', $rounds->id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}

					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							{!! Form::submit( trans('app.Create'), ['class' => 'btn btn-primary form-control']) !!}
						</div>
					</div>

					{!! Form::hidden('round_id', $rounds->id, ['class' => 'form-control']) !!}

					<hr>

					<div class="form-group">
						{!! Form::label( trans('app.Count'), null, ['class' => 'control-label col-xs-2']) !!}
						<div class="col-sm-10">
							{!! Form::text('count', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-2" for="modems_list">{{ trans('app.Modem') }}</label>
						<div class="col-sm-10">
							<select id="modems_list" name="modem_id" class="form-control">
								@foreach ($modems as $modem)
									<option value="{{ $modem->id }}">{{ $modem->name }}</option>
								@endforeach
							</select>
						</div>
					</div>

				{!! Form::close() !!}

				<hr>
			@else
			@endif



			@foreach ($tasks as $task)
				<div class="snippet">
					<h4 class="snippet-heading">
						{{ trans('app.Task').' '.$task->id }}. {{ unserialize($task->status)['modem_name'] }}
					</h4>
					<div class="snippet-body">
						<p>All / Sended / Delivered / Queued / Estimated</p>
						<p>{{ unserialize($task->status)['all'] }} / {{ unserialize($task->status)['sended'] }} / {{ unserialize($task->status)['delivered'] }} / {{ unserialize($task->status)['queued'] }} / {{ unserialize($task->status)['estimated'] }}</p>
						<p>Last Update: {{ unserialize($task->status)['last_update'] }}</p>
					</div>
					@if( unserialize($task->status)['progress'] == 100)
						<div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" style="width: {{ unserialize($task->status)['progress'] }}%;"></div></div>
					@else
						<div class="progress"><div class="progress-bar progress-bar-info" role="progressbar" style="width: {{ unserialize($task->status)['progress'] }}%;"></div></div>
					@endif
				</div>
			@endforeach

		</div>

	</div>



@stop

@section('footer')
@endsection