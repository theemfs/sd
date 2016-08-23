@extends('layouts.app')



@section('content')
	<div class="col-md-8 col-md-offset-2">
		<div class="panel panel-default">
			<div class="panel-heading">{{ trans('app.Login') }}</div>
			<div class="panel-body">
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
					{!! csrf_field() !!}

					<div class="form-group">
						<label class="col-md-3 control-label">{{ trans('app.Email') }}</label>

						<div class="col-md-8">
							<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ trans('app.Domain login') }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label">{{ trans('app.Password') }}</label>

						<div class="col-md-8">
							<input type="password" class="form-control" name="password" placeholder="{{ trans('app.Domain Password') }}">
						</div>
					</div>

					<div class="form-group hidden">
						<div class="col-md-8 col-md-offset-4">
							<div class="checkbox">
								<label>
									<input type="checkbox" checked name="remember"> Remember Me
								</label>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-8 col-md-offset-3">
							<button type="submit" class="btn btn-primary">
								<i class="fa fa-fw fa-btn fa-sign-in"></i> {{ trans('app.Login') }}
							</button>
						</div>
					</div>
				</form>
				{{-- <div class="col-md-6 col-md-offset-4">
				<a href="{!! route('socialite.auth', 'github') !!}">Github</a>
				<a href="{!! route('socialite.auth', 'google') !!}">Google</a>
				<a href="{!! route('socialite.auth', 'facebook') !!}">Facebook</a>
				<a href="{!! route('socialite.auth', 'twitter') !!}">Twitter</a>
				<a href="{!! route('socialite.auth', 'ldap') !!}">Ldap</a>
				</div> --}}
			</div>
		</div>
	</div>
@endsection