<div class="container">
	<div class="navbar-header">
		<!-- Collapsed Hamburger -->
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#spark-navbar-collapse">
			<span class="sr-only"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>

		<a class="navbar-brand" href="<?php echo e(url('/')); ?>"><i class="fa fa-fw fa-btn fa-home"></i></a>
	</div>

	<div class="collapse navbar-collapse" id="spark-navbar-collapse">

		<ul class="nav navbar-nav">
			<?php if(Auth::user()): ?>

				<li><a href="<?php echo e(action('NumbersController@index')); ?>"><i class="fa fa-fw fa-btn fa-phone"></i> <?php echo e(trans('app.Numbers')); ?></a></li>
				<li><a href="<?php echo e(action('RoundsController@index')); ?>"><i class="fa fa-fw fa-btn fa-play-circle"></i> <?php echo e(trans('app.Rounds')); ?></a></li>
				<li><a href="<?php echo e(action('PagesController@inboxShow')); ?>"><i class="fa fa-fw fa-btn fa-envelope-o"></i> <?php echo e(trans('app.Inbox')); ?></a></li>
				<li><a href="<?php echo e(action('PagesController@send')); ?>"><i class="fa fa-fw fa-btn fa-envelope-o"></i> <?php echo e(trans('app.Send SMS')); ?></a></li>
				
				
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<i class="fa fa-fw fa-btn fa-cog"></i> <?php echo e(trans('app.Settings')); ?><span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="<?php echo e(action('GatewaysController@show', 1)); ?>"><i class="fa fa-fw fa-btn fa-usb"></i> <?php echo e(trans('app.Modems')); ?></a></li>
						<li><a href="<?php echo e(action('OperatorsController@index')); ?>"><i class="fa fa-fw fa-btn fa-mobile"></i> <?php echo e(trans('app.Operators')); ?></a></li>
					</ul>
				</li>

			<?php else: ?>
			<?php endif; ?>
		</ul>

		<ul class="nav navbar-nav navbar-right">
			<?php if(Auth::guest()): ?>
				<!-- <li><a href="<?php echo e(url('/login')); ?>">Login</a></li> -->
				<!-- <li><a href="<?php echo e(url('/register')); ?>">Register</a></li> -->
			<?php else: ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						<?php echo e(Auth::user()->name); ?>

						 <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li class="divider"></li>
						<li><a href="<?php echo e(action('AuthController@logout')); ?>"><i class="fa fa-fw fa-btn fa-sign-out"></i>&nbsp; <?php echo e(trans('app.Logout')); ?></a></li>
					</ul>
				</li>
			<?php endif; ?>
		</ul>

	</div>
</div>