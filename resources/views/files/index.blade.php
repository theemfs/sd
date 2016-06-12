@extends('layouts.app')

@section('libraries')
@endsection

@section('title', trans('app.Files'))

@section('content')

	<div class="panel panel-default">
		<div class="panel-heading">

			{{ trans('app.Files') }}
				<div class="btn-group pull-right" role="group" aria-label="...">
					{{-- <button onclick="window.location='{{ action('FilesController@index') }}'" type="button" class="btn btn-sm btn-default">{{ trans('app.Refresh') }}</button> --}}
					<button onclick="window.location='{{ action('FilesController@create') }}'" type="button" class="btn btn-sm btn-success">{{ trans('app.Create') }}</button>
					{{-- <button onclick="window.location='{{ action('FilesController@clean2') }}'" type="button" class="btn btn-sm btn-danger">{{ trans('app.Clean') }}</button> --}}
				</div>
		<hr>

			{!! Form::open(['method' => 'GET', 'url'=>'files', 'class' => 'form-horizontal']) !!}
				<div class="form-horizontal">
					<div class="form-group">
						<div class="col-xs-12">
							<div class="input-group">
								{!! Form::text('filter', $filter, ['class' => 'form-control', 'autocomplete' => 'off', 'autofocus' => 'on']) !!}
								<div class="input-group-btn">
									{!! Form::submit( trans('app.Filter'), ['class' => 'btn btn-primary']) !!}
								</div>
							</div>
						</div>
					</div>
				</div>
			{!! Form::close() !!}

		</div>

		<div class="panel-body">

			@foreach ($files as $file)

				<div class="snippet">
					<h4 class="snippet-heading">
						<a href="{{ action('FilesController@show', $file->id) }}">{{ $file->id }}</a>
							<div class="btn-group pull-right" role="group">
								{{-- <button onclick="window.location='{{ 'numbers' }}/{{ $file->id }}'" type="button" class="btn btn-xs btn-default">{{ trans('app.Show') }}</button>
								<button onclick="window.location='{{ 'numbers' }}/{{ $file->id }}/edit'" type="button" class="btn btn-xs btn-warning">{{ trans('app.Edit') }}</button> --}}
							</div>
					</h4>
					<div class="snippet-body">
						<p>{{ substr($file->text, 0, 100)."..." }}</p>
					</div>
				</div>

			@endforeach

			<div class="col-xs-12">
				{!! $files->links() !!}
			</div>

		</div>
	</div>

@endsection