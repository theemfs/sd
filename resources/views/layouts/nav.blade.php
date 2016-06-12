<div class="container">
	<div class="navbar-header">
		<!-- Collapsed Hamburger -->
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#spark-navbar-collapse">
			<span class="sr-only"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>

		<a class="navbar-brand" href="{{ url('/') }}">

		</a>
	</div>

	<div class="collapse navbar-collapse" id="spark-navbar-collapse">

		<ul class="nav navbar-nav">
			@if (Auth::user())

				<li><a href="{{ action('PagesController@dashboardShow') }}"><i class="fa fa-fw fa-btn fa-phone"></i> {{ trans('app.Dashboard') }}</a></li>
				<li><a href="{{ action('CasesController@index') }}"><i class="fa fa-fw fa-btn fa-phone"></i> {{ trans('app.Cases') }}</a></li>
				<li><a href="{{ action('FilesController@index') }}"><i class="fa fa-fw fa-btn fa-phone"></i> {{ trans('app.Files') }}</a></li>
				{{-- <li><a href="{{ action('RoundsController@index') }}"><i class="fa fa-fw fa-btn fa-play-circle"></i> {{ trans('app.Rounds') }}</a></li>
				<li><a href="{{ action('PagesController@send') }}"><i class="fa fa-fw fa-btn fa-envelope-o"></i> {{ trans('app.Send SMS') }}</a></li> --}}
				
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<i class="fa fa-fw fa-btn fa-cog"></i> {{ trans('app.Settings') }}<span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						{{-- <li><a href="{{ action('GatewaysController@show', 1) }}"><i class="fa fa-fw fa-btn fa-usb"></i> {{ trans('app.Modems') }}</a></li>
						<li><a href="{{ action('OperatorsController@index') }}"><i class="fa fa-fw fa-btn fa-mobile"></i> {{ trans('app.Operators') }}</a></li> --}}
					</ul>
				</li>

			@else
			@endif
		</ul>

		<ul class="nav navbar-nav navbar-right">
			@if (Auth::guest())
				<!-- <li><a href="{{ url('/login') }}">Login</a></li> -->
				<!-- <li><a href="{{ url('/register') }}">Register</a></li> -->
			@else
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						{{ Auth::user()->name }}
						 <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						{{-- <li class="divider"></li> --}}
						<li><a href="{{ action('AuthController@logout') }}"><i class="fa fa-fw fa-btn fa-sign-out"></i>&nbsp; {{ trans('app.Logout') }}</a></li>
					</ul>
				</li>
			@endif
		</ul>

	</div>
</div>