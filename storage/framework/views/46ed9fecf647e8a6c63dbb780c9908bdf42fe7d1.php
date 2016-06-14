<?php $__env->startSection('libraries'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', trans('app.Rounds') ); ?>

<?php $__env->startSection('content'); ?>

	<div class="panel panel-default">
		<div class="panel-heading">

			<?php echo e(trans('app.Rounds')); ?>

				<div class="btn-group pull-right" role="group" aria-label="...">
					<button onclick="window.location='<?php echo e(action('RoundsController@create')); ?>'" type="button" class="btn btn-sm btn-success" title='<?php echo e(trans("app.Create")); ?>'><i class="fa fa-fw fa-btn fa-plus-circle"></i></button>
				</div>
		<hr>

			<?php echo Form::open(['method' => 'GET', 'url'=>'rounds', 'class' => 'form-horizontal']); ?>

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

			<?php foreach($rounds as $sending): ?>

				<div class="snippet">
					<h4 class="snippet-heading">
						<a href="<?php echo e(action('RoundsController@show', $sending->id)); ?>"><?php echo e($sending->name); ?></a>
						<p class="pull-right"><?php echo e($sending->id); ?></p>
					</h4>
					<div class="snippet-body">
						<p><?php echo e($sending->comment); ?></p>
					</div>
				</div>

			<?php endforeach; ?>

			<div class="col-xs-12">
				<?php echo $rounds->appends(['filter' => $filter])->links(); ?>

			</div>

		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>