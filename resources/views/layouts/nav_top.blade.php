@if (Auth::user())

<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		{{-- Brand and toggle get grouped for better mobile display --}}
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
				<span class="sr-only">{{-- Toggle navigation --}}</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		  {{-- <a class="navbar-brand" href="{{ url('/') }}"><i class="fa fa-fw fa-btn fa-facebook"></i></a> --}}
		</div>

		{{-- Collect the nav links, forms, and other content for toggling --}}
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="nav navbar-nav">
				@if (Auth::guest())
					{{-- <li><a href="{{ url('/about') }}"><i class="fa fa-fw fa-btn fa-question"></i></a></li> --}}
				@else
					<li><a href="{{ action('CasesController@index') }}"><i class="fa fa-fw fa-btn fa-briefcase"></i> {{ trans('app.Cases') }}</a></li>
					<li><a href="{{ action('UsersController@index') }}"><i class="fa fa-fw fa-btn fa-users"></i> {{ trans('app.Users') }}</a></li>
					@can('view-admin')
						<li><a href="{{ action('ArticlesController@index') }}"><i class="fa fa-fw fa-btn fa-wikipedia-w"></i> {{ trans('app.Articles') }}</a></li>
						<li><a href="{{ action('PagesController@test') }}"><i class="fa fa-fw fa-btn fa-facebook"></i> {{ trans('app.Test') }}</a></li>
						<li><a href="{{ action('PagesController@adminShow') }}"><i class="fa fa-fw fa-btn fa-cogs"></i> {{ trans('app.Admin panel') }}</a></li>
					@endcan
				@endif
			</ul>

			@if (Auth::user())
				<ul class="nav navbar-nav navbar-right">
				{{-- <li><a href="#">Link</a></li> --}}
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Profile and Settings"><i class="fa fa-fw fa-btn fa-user"></i> {{ Auth::user()->name }}<span class="caret"></span></a>
						<ul class="dropdown-menu">
							{{-- <li><a href="{{ action('UsersController@profile') }}"><i class="fa fa-fw fa-btn fa-user"></i>{{ trans('app.Profile') }}</a></li> --}}
							{{-- <li role="separator" class="divider"></li> --}}
							<li><a href="{{ action('AuthController@logout') }}"><i class="fa fa-fw fa-btn fa-sign-out"></i> {{ trans('app.Logout') }}</a></li>
						</ul>
					</li>
				</ul>
			@else
			@endif

			@can('view-admin')

			@endcan
		</div>{{-- /.navbar-collapse --}}
	</div>{{-- /.container-fluid --}}
</nav>

@endif