<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#admin-navbar" aria-expanded="false">
				<span class="sr-only"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse" id="admin-navbar">
			<ul class="nav navbar-nav">
				<li><a href="{{ action('PagesController@adminShow') }}"><i class="fa fa-fw fa-btn fa-briefcase"></i> / </a></li>
				<li><a href="{{ action('PagesController@adminPhpinfoShow') }}"><i class="fa fa-fw fa-btn fa-briefcase"></i> php info </a></li>
				<li><a href="{{ action('PagesController@adminUsersShow') }}"><i class="fa fa-fw fa-btn fa-briefcase"></i> users </a></li>
			</ul>
		</div>
	</div>
</nav>