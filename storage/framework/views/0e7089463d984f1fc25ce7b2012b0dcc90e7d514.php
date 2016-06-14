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
					<p><a href="<?php echo e(action('CasesController@show', $file->message->case->id)); ?>"><?php echo e(trans('app.Case') . ' ' . $file->message->case->id); ?></a></p>
				</div>

				<div class="col-sm-10">
					<a class="btn btn-default" href="<?php echo e(action('CasesController@show', $file->message->case->id)); ?>" role="button"><i class="fa fa-fw fa-arrow-left"></i>Back</a>
					<a class="btn btn-default" href="<?php echo e(action('FilesController@getOriginal', $file->id)); ?>" role="button"><i class="fa fa-fw fa-download"></i>Download</a>
					<hr>
					<img src="<?php echo e(action('FilesController@getOriginal', $file->id)); ?>" class="img img-responsive img-rounded center-block" alt="">
				</div>
			</div>

		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>