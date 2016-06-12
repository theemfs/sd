@extends('layouts.app')

@section('title', 'Number #'.$case->id )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ trans('app.Case') . " #" . $case->id }}
			{{-- <div class="btn-group pull-right" role="group" aria-label="...">
			</div> --}}
		</div>

		<div class="panel-body">

			{{-- <div class="btn-group btn-group-justified" role="group">
				{{ Form::open(['action' => ['CasesController@destroy', $case->id], 'method' => 'DELETE', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-danger">Destroy</button>
				{{ Form::close() }}

				{{ Form::open(['action' => ['CasesController@edit', $case->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal']) }}
					<button type="submit" type="button" class="btn btn-warning">Edit</button>
				{{ Form::close() }}
			</div>
			<hr> --}}

			{!! Form::model($case, ['url'=>'cases', 'class' => 'form-horizontal']) !!}

				<div class="message">
					<div class="col-sm-2">
						<p>{{ $case->user->name }}</p>
						<p>{{ $case->created_at }}</p>
					</div>
					
					<div class="col-sm-10">
						<div class="message-body">{{ $case->text }}</div>
						<hr>
						
						@foreach ($files as $file)
							<a href="{{ action('FilesController@show', $file->id) }}">
							{{-- <a href="{{ url('getfile', $file->id) }}"> --}}
								<img class="img img-rounded" src="{{ url('/') . '/uploads/' . $file->thumbnail }}" alt="{{ $file->name }}">
							</a>
						@endforeach

					</div>
				</div>

			{!! Form::close() !!}
			
		</div>
	</div>
@stop