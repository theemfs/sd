@extends('layouts.app')

@section('title', 'User #'.$user->id )

@section('content')



	<!-- LEFT BLOCK -->
	<div class="col-md-3">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ trans('app.Photo') }}
				</div>

				<div class="panel-body">
					<div class="">

					</div>
					<hr>
					{{-- <div class="">
						{!! Form::model($case, ['method' => 'PATCH', 'action' => ['CasesController@update', $case->id], 'class' => 'form-horizontal']) !!}
							{!! Form::label('users_list_spectators', null, ['class' => 'control-label']) !!}
							<div class="form-group">
								<div class="col-xs-12">
									{!! Form::select('users[]', $users, $usersIds, ['id' => 'users_list_spectators', 'class' => 'form-control', 'multiple', 'autocomplete' => 'off', 'size' => '5']) !!}
								</div>
							</div>

							<div class="form-group">
								<div class="col-xs-12">
									{!! Form::submit( trans('app.Save'), ['class' => 'btn btn-primary form-control col-xs-12']) !!}
								</div>
							</div>
						{!! Form::close() !!}
					</div>
					<hr> --}}
				</div>
			</div>
		</div>
	</div>



	<!-- CENTER BLOCK -->
	<div class="col-md-6">
		<div class="panel panel-default">

			<div class="panel-heading">
				{{ $user->name }}
			</div>

			<div class="panel-body">



			</div>
		</div>
	</div>



	<!-- RIGHT BLOCK -->
	<div class="col-md-3">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ trans('app.Member Of Cases') }}
				</div>

				<div class="panel-body">
					{{ $user->memberOf }}
				</div>
			</div>
		</div>
	</div>



@stop