<?php $__env->startSection('libraries'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', trans('app.Cases')); ?>

<?php $__env->startSection('content'); ?>

	<div class="panel panel-default">

		<div class="panel-heading">
			<?php echo e(trans('app.Cases')); ?>

			<a class="btn btn-default btn-success pull-right btn-xs" href="<?php echo e(action('CasesController@create')); ?>" role="button"><?php echo e(trans('app.Create')); ?></a>
		</div>

		<div class="panel-body">

			<?php foreach($cases as $case): ?>

				<div class="snippet">

					<h4 class="snippet-heading">
						<p class="pull-right"><?php echo e($case->id); ?></p>
						<!-- <a href="<?php echo e(action('CasesController@show', $case->id)); ?>"><?php echo e(mb_substr($case->text, 0, 50)."..."); ?></a> -->
						<a href="<?php echo e(action('CasesController@show', $case->id)); ?>"><?php echo e($case->name); ?></a>
					</h4>


					<p><?php echo e($case->user->name); ?></p>
					<div class="snippet-body">
						<p><?php echo e(mb_substr($case->text, 0, 300)."..."); ?></p>
					</div>
				</div>

			<?php endforeach; ?>

			<div class="col-xs-12">
				<?php echo $cases->links(); ?>

			</div>

		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>