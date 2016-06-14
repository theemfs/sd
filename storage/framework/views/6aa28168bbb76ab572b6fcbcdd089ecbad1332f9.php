<?php $__env->startSection('title', trans('app.Dashboard') ); ?>

<?php $__env->startSection('content'); ?>
	<div class="panel panel-default">
		<div class="panel-heading"><?php echo e(trans('app.Dashboard')); ?></div>

		<div class="panel-body">
			<?php /* <p>All numbers <?php echo e($data->total); ?></p>
			<p>Deleted <?php echo e($data->deleted); ?></p> */ ?>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>