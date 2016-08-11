<ul class="nav nav-pills nav-justified">
	<li><a href="{{ action('PagesController@adminShow') }}"><i class="fa fa-fw fa-btn fa-briefcase"></i> / </a></li>
	<li><a href="{{ action('PagesController@adminPhpinfoShow') }}"><i class="fa fa-fw fa-btn fa-briefcase"></i> php info </a></li>
	<li><a href="{{ action('PagesController@adminUsersShow') }}"><i class="fa fa-fw fa-btn fa-briefcase"></i> users </a></li>
	<li><a href="{{ action('PagesController@getUsersFromLdap') }}"><i class="fa fa-fw fa-btn fa-briefcase"></i> ldap users </a></li>
	<li><a href="{{ action('PagesController@syncUsersFromLdap') }}"><i class="fa fa-fw fa-btn fa-briefcase"></i> sync ldap users </a></li>
</ul>