@extends('layouts.app')

@section('title', 'File #'.$file->id )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ trans('app.File From Case') }}
			#{{ $file->message->case->id }}
			"{{ $file->message->case->name }}"
		</div>

		<div class="panel-body">

			<div class="form-group">
				<div class="col-sm-2">
					<p>{{ $file->user->name }}</p>
					<p>{{ $file->created_at }}</p>
					<p><a href="{{ action('CasesController@show', $file->message->case->id) }}">{{ trans('app.Case') . ' #' . $file->message->case->id }}</a></p>
				</div>

				<div class="col-sm-10">
					{{-- <p><i class="fa fa-file-o fa-2x"></i> {{ $file->message->case->id }}</p> --}}
					<p><i class="fa fa-file-o fa-2x"></i> {{ $file->name }}</p>
					<p>{{ human_filesize($file->size) }}</p>
					<hr>
					{{-- <a class="btn btn-default" href="{{ action('CasesController@show', $file->message->case->id) }}" role="button">{{ trans('app.Go To Case') }}</a> --}}
					<a class="btn btn-default" href="{{ action('FilesController@getOriginal', $file->id) }}" role="button">{{ trans('app.Download') }}</a>
				</div>
			</div>

		</div>
	</div>
@stop