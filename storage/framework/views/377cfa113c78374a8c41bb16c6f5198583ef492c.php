<!DOCTYPE html>
<html lang="en">

	<head>
		<?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<title>CRM2 / <?php echo $__env->yieldContent('title'); ?></title>
		<?php echo $__env->yieldContent('libraries'); ?>
	</head>

<body>

	<?php echo $__env->make('layouts.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="container">
		<?php if( Session::has('flash_success') ): ?>
			<div class="alert alert-success"><?php echo e(Session::get('flash_success')); ?></div>
		<?php endif; ?>
	</div>

	<div class="container">
		<div class="row">
			<?php echo $__env->yieldContent('content'); ?>
		</div>
	</div>

	<div class="container">
		<?php if($errors->any()): ?>
			<ul class="alert alert-danger">
				<?php foreach($errors->all() as $error): ?>
					<p><?php echo e($error); ?></p>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
		<hr>
	</div>

	<div class="container">
		<?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
</body>

</html>