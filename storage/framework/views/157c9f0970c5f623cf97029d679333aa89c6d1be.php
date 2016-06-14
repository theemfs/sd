<?php $__env->startSection('title', 'File #'.$file->id ); ?>

<?php $__env->startSection('content'); ?>
	<div class="panel panel-default">

		<div class="panel-heading">
			<?php echo e(trans('app.File') . " #" . $file->id); ?>

		</div>

		<div class="panel-body">

			<div class="form-group">
				<div class="col-sm-2">
					<p><?php echo e($file->user->name); ?></p>
					<p><?php echo e($file->created_at); ?></p>

					<p><a href="<?php echo e(action('CasesController@show', $file->cases->id)); ?>"><?php echo e(trans('app.Case') . ' ' . $file->cases->id); ?></a></p>
				</div>

				<div class="col-sm-10">

					<?php if($file->thumbnail): ?>
						<img src="<?php echo e($img); ?>" class="img img-responsive img-rounded center-block" alt="">
					<?php else: ?>
						no preview
					<?php endif; ?>
					
				</div>
			</div>

		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>