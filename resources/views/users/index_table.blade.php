@extends('layouts.app')



@section('css')
	<link href="{{ url('/') }}/css/jquery.dataTables.min.css" rel="stylesheet">
{{-- <META HTTP-EQUIV="refresh" CONTENT="60"> --}}
@endsection



@section('title', trans('app.Users'))



@section('content')



{{-- BREADCRUMBS --}}
<ol class="breadcrumb">
	<li><a href="{{ url('/') }}">{{ trans('app.Home') }}</a></li>
	<li class="active">{{ trans('app.Users') }}</li>
</ol>


	{{-- <div class="col-md-1"></div> --}}

	{{-- CENTER BLOCK --}}
	<div class="col-md-12">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ trans('app.Users') }}
				</div>

				<div class="panel-body">

					{{-- I AM AUTHOR --}}
					<div class="table-responsive tab-pane">
						<table class="table table-condensed table-bordered">
							<thead>
								<td class="text-center col-xs-7"><strong>{{ trans('app.User') }}</strong></td>
								<td class="text-center col-xs-1"><strong>{{ trans('app.Email') }}</strong></td>
								<td class="text-center col-xs-1"><strong>{{ trans('app.Phone') }}</strong></td>
								<td class="text-center col-xs-1"><strong>{{ trans('app.Mobile') }}</strong></td>
								<td class="text-center col-xs-1"><strong>{{ trans('app.Department') }}</strong></td>
								<td class="text-center col-xs-1"><strong>{{ trans('app.Title') }}</strong></td>
							</thead>

							@foreach ($users as $user)
								<tr>
									<td>
										<a href="{{ action('UsersController@show', $user->id) }}">
											<i class="fa fa-fw fa-btn fa-briefcase"></i>
											<strong>{{ $user->name }}</strong>
										</a>
									</td>
									<td class="text-center"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
									<td class="text-center">{{ $user->phone }}</td>
									<td class="text-center">{{ $user->mobile }}</td>
									<td class="text-center">{{ $user->department }}</td>
									<td class="text-center">{{ $user->title }}</td>
								</tr>
							@endforeach
						</table>
					</div>

				</div>
			</div>
		</div>
	</div>

@endsection



@section('js')
	<script src="{{ url('/') }}/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('table').DataTable({
				// "sDom": '<"top"i>rt<"bottom"flp><"clear">',
				// "bFilter":		false,
				"lengthMenu":	[[10, 25, 50, -1], [10, 25, 50, "Все"]],
				"paging":		false,
				"ordering":		true,
				"order": 		[[ 0, "asc" ]],
				"info":			false,
				"search":		true,
				"stateSave":	false,
				"pagingType":	"full_numbers",
				// "scrollY": 200,
				// "scrollX": true
				"language": {
				// 	"decimal": ",",
				// 	"thousands": "."
					"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Russian.json"
				}
			});
		} );

		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
	</script>
@endsection