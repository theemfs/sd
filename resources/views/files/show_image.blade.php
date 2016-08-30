@extends('layouts.app')

@section('title', 'File #'.$file->id )

@section('content')
	<div class="panel panel-default">

		<div class="panel-heading">
			{{ trans('app.File') . " #" . $file->id }}
		</div>

		<div class="panel-body">

			<div class="form-group">
				<div class="col-sm-2">
					<p>{{ $file->user->name }}</p>
					<p>{{ $file->created_at }}</p>
					<p><a href="{{ action('CasesController@show', $file->message->case->id) }}">{{ trans('app.Case') . ' ' . $file->message->case->id }}</a></p>
				</div>

				<div class="col-sm-10">
					{{-- <a class="btn btn-default" href="{{ action('CasesController@show', $file->message->case->id) }}" role="button"><i class="fa fa-fw fa-arrow-left"></i>Back</a> --}}
					<a class="btn btn-default" href="{{ action('FilesController@getOriginal', $file->id) }}" role="button"><i class="fa fa-fw fa-download"></i>{{ trans('app.Download') }}</a>
					<hr>
					<img src="{{ action('FilesController@getOriginal', $file->id) }}" class="img img-responsive img-rounded center-block" alt="">
				</div>
			</div>

		</div>
	</div>
@stop