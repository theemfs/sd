<?php $__env->startSection('libraries'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', trans('app.Numbers')); ?>

<?php $__env->startSection('content'); ?>

	<div class="panel panel-default">
		<div class="panel-heading">

			<?php echo e(trans('app.Numbers')); ?>

				<div class="btn-group pull-right" role="group" aria-label="...">
					<?php /* <button onclick="window.location='<?php echo e(action('NumbersController@index')); ?>'" type="button" class="btn btn-sm btn-default" title='<?php echo e(trans("app.Refresh")); ?>'><i class="fa fa-fw fa-btn fa-refresh"></i></button> */ ?>
					<button onclick="window.location='<?php echo e(action('NumbersController@create')); ?>'" type="button" class="btn btn-sm btn-success" title='<?php echo e(trans("app.Create")); ?>'><i class="fa fa-fw fa-btn fa-plus-circle"></i></button>
					<button onclick="window.location='<?php echo e(action('NumbersController@importShow')); ?>'" type="button" class="btn btn-sm btn-warning" title='<?php echo e(trans("app.Import")); ?>'><i class="fa fa-fw fa-btn fa-upload"></i></button>
					<?php /* <button onclick="window.location='<?php echo e(action('NumbersController@clean2')); ?>'" type="button" class="btn btn-sm btn-danger"><?php echo e(trans('app.Clean')); ?></button> */ ?>
				</div>
		<hr>

			<?php echo Form::open(['method' => 'GET', 'url'=>'numbers', 'class' => 'form-horizontal']); ?>

				<div class="form-horizontal">
					<div class="form-group">
						<div class="col-md-10 col-md-offset-1">
							<div class="input-group">
								<?php echo Form::text('filter', $filter, ['class' => 'form-control', 'autocomplete' => 'off', 'autofocus' => 'on']); ?>

								<div class="input-group-btn">
									<button type="submit" class="btn btn btn-primary" title='<?php echo e(trans("app.Filter")); ?>'><i class="fa fa-fw fa-btn fa-filter"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php echo Form::close(); ?>


		</div>

		<div class="panel-body">

			<?php foreach($numbers as $number): ?>

				<?php if(!$number->trashed()): ?>
					<div class="snippet">
				<?php else: ?>
					<div class="snippet bg-danger">
				<?php endif; ?>
				
					<h4 class="snippet-heading">
						<a href="<?php echo e(action('NumbersController@show', $number->id)); ?>"><?php echo e($number->id); ?></a>
							<div class="btn-group pull-right" role="group">
								<?php /* <button onclick="window.location='<?php echo e('numbers'); ?>/<?php echo e($number->id); ?>'" type="button" class="btn btn-xs btn-default"><?php echo e(trans('app.Show')); ?></button>
								<button onclick="window.location='<?php echo e('numbers'); ?>/<?php echo e($number->id); ?>/edit'" type="button" class="btn btn-xs btn-warning"><?php echo e(trans('app.Edit')); ?></button> */ ?>
							</div>
					</h4>
					<div class="snippet-body">
						<p><?php echo e($number->comment); ?></p>
					</div>
				</div>

			<?php endforeach; ?>

			<div class="col-xs-12">
				<?php echo $numbers->links(); ?>

			</div>

		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>