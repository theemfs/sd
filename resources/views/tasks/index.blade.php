@extends('layouts.app')

@section('libraries')
@endsection

@section('title', trans('app.Tasks') )

@section('content')

	<div class="panel panel-default">
		<div class="panel-heading">

			{{ trans('app.Tasks') }}
				<div class="btn-group pull-right" role="group" aria-label="...">
					<button onclick="window.location='{{ action('TasksController@index') }}'" type="button" class="btn btn-sm btn-default">Refresh</button>
					<button onclick="window.location='{{ action('TasksController@create') }}'" type="button" class="btn btn-sm btn-success">Create</button>
				</div>
		<hr>

			{!! Form::open(['method' => 'GET', 'url'=>'tasks', 'class' => 'form-horizontal']) !!}
				<div class="form-horizontal">
					<div class="form-group">
						<div class="col-md-10 col-md-offset-1">
							<div class="input-group">
								{!! Form::text('filter', $filter, ['class' => 'form-control', 'autocomplete' => 'off', 'autofocus' => 'on']) !!}
								<div class="input-group-btn">
									{!! Form::submit('Filter', ['class' => 'btn btn-primary']) !!}
								</div>
							</div>
						</div>
					</div>
				</div>
			{!! Form::close() !!}

		</div>

		<div class="panel-body">

			@foreach ($tasks as $task)

				<div class="snippet">
					<h4 class="snippet-heading">
						<div class="btn-group pull-right" role="group" aria-label="...">
							<button onclick="window.location='{{ 'tasks' }}/{{ $task->id }}'" type="button" class="btn btn-xs btn-default">Show</button>
							<button onclick="window.location='{{ 'tasks' }}/{{ $task->id }}/edit'" type="button" class="btn btn-xs btn-warning">Edit</button>
						</div>
					</h4>
					<div class="snippet-body">
						<p>Count: {{ $task->count }}</p>
						<p>Round: {{ $task->round_id }}</p>
						<p>Modem: {{ $task->modem_id }}</p>
						<p>Status: {{ $task->status }}</p>
						<p>{{ $task->comment }}</p>
					</div>
				</div>

			@endforeach

			<div class="col-xs-12">
				@if ( strlen($filter)>0 )
					{!! $tasks->appends(['filter' => $filter])->links() !!}
				@else
					{!! $tasks->links() !!}
				@endif
			</div>

		</div>
	</div>

@endsection