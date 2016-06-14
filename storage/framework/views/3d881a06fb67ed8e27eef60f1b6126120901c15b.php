<?php $__env->startSection('libraries'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', trans('app.Files')); ?>

<?php $__env->startSection('content'); ?>

	<div class="panel panel-default">
		<div class="panel-heading">

			<?php echo e(trans('app.Files')); ?>

				<div class="btn-group pull-right" role="group" aria-label="...">
					<?php /* <button onclick="window.location='<?php echo e(action('FilesController@index')); ?>'" type="button" class="btn btn-sm btn-default"><?php echo e(trans('app.Refresh')); ?></button> */ ?>
					<button onclick="window.location='<?php echo e(action('FilesController@create')); ?>'" type="button" class="btn btn-sm btn-success"><?php echo e(trans('app.Create')); ?></button>
					<?php /* <button onclick="window.location='<?php echo e(action('FilesController@clean2')); ?>'" type="button" class="btn btn-sm btn-danger"><?php echo e(trans('app.Clean')); ?></button> */ ?>
				</div>
		<hr>

			<?php echo Form::open(['method' => 'GET', 'url'=>'files', 'class' => 'form-horizontal']); ?>

				<div class="form-horizontal">
					<div class="form-group">
						<div class="col-xs-12">
							<div class="input-group">
								<?php echo Form::text('filter', $filter, ['class' => 'form-control', 'autocomplete' => 'off', 'autofocus' => 'on']); ?>

								<div class="input-group-btn">
									<?php echo Form::submit( trans('app.Filter'), ['class' => 'btn btn-primary']); ?>

								</div>
							</div>
						</div>
					</div>
				</div>
			<?php echo Form::close(); ?>


		</div>

		<div class="panel-body">

			<?php foreach($files as $file): ?>

				<div class="snippet">
					<h4 class="snippet-heading">
						<a href="<?php echo e(action('FilesController@show', $file->id)); ?>"><?php echo e($file->id); ?></a>
							<div class="btn-group pull-right" role="group">
								<?php /* <button onclick="window.location='<?php echo e('numbers'); ?>/<?php echo e($file->id); ?>'" type="button" class="btn btn-xs btn-default"><?php echo e(trans('app.Show')); ?></button>
								<button onclick="window.location='<?php echo e('numbers'); ?>/<?php echo e($file->id); ?>/edit'" type="button" class="btn btn-xs btn-warning"><?php echo e(trans('app.Edit')); ?></button> */ ?>
							</div>
					</h4>
					<div class="snippet-body">
						<p><?php echo e(substr($file->text, 0, 100)."..."); ?></p>
					</div>
				</div>

			<?php endforeach; ?>

			<div class="col-xs-12">
				<?php echo $files->links(); ?>

			</div>

		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>