<?php $__env->startSection('title', trans('app.Inbox') ); ?>

<?php $__env->startSection('content'); ?>
	<div class="panel panel-default">
		<div class="panel-heading"><?php echo e(trans('app.Inbox')); ?></div>
		<p></p>

		<div class="panel-body">
			
			<?php foreach($spams as $spam): ?>

				<div class="snippet">
					<h4 class="snippet-heading">
						<a href="<?php echo e(action('NumbersController@show', $spam->from)); ?>"><?php echo e($spam->from); ?></a>
					</h4>
					<div class="snippet-body">
						<p class="pull-right"><?php echo e($spam->created_at); ?></p>
						<p><?php echo e($spam->text); ?></p>
					</div>
				</div>

			<?php endforeach; ?>

			<div class="col-xs-12">
				<?php echo $spams->links(); ?>

			</div>

		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>