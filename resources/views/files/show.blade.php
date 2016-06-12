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

					<p><a href="{{ action('CasesController@show', $file->cases->id) }}">{{ trans('app.Case') . ' ' . $file->cases->id }}</a></p>
				</div>

				<div class="col-sm-10">
					<img src="{{ $img }}" class="img img-responsive img-rounded center-block" alt="">
				</div>
			</div>

		</div>
	</div>
@stop