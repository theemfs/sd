<?php $__env->startSection('title', trans("app.Create Case")); ?>

<?php $__env->startSection('content'); ?>


	<!-- LEFT BLOCK -->
	<div class="col-sm-3">
	</div>



	<!-- CENTER BLOCK -->
	<div class="col-sm-6">
		<div class="panel panel-default">

			<div class="panel-heading">
				<?php echo e(trans("app.Create Case")); ?>

			</div>

			<div class="panel-body">

				<?php echo Form::open(['url'=>'cases', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']); ?>


					<div class="form-group">
						<div class="col-sm-12">
							<?php echo Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'autofocus' => 'on', 'placeholder' => trans('app.Case Title')]); ?>

						</div>
					</div>

					<div class="form-group">
						<?php /* <?php echo Form::label( trans('app.Text'), null, ['class' => 'control-label col-xs-2']); ?> */ ?>
						<div class="col-sm-12">
							<?php echo Form::textarea('text', null, ['class' => 'form-control', 'rows' => '3', 'autocomplete' => 'off', 'placeholder' => trans('app.Case Text')]); ?>

							<?php /* <p class="text-muted"><?php echo e(trans('app.Text Hint')); ?></p> */ ?>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-12">
							<?php echo Form::file( 'attachments[]', ['class' => '', 'multiple' => 'true']); ?>

						</div>
					</div>

					<div class="form-group">
						<div class="col-xs-12 pull-right">
							<?php echo Form::submit( trans('app.Create'), ['class' => 'btn btn-primary form-control']); ?>

						</div>
					</div>



				<?php echo Form::close(); ?>


				<?php /* <div class="btn-group btn-group-justified" role="group" aria-label="...">
					<?php echo e(Form::open(['action' => ['CasesController@index'], 'method' => 'GET', 'class' => 'pull-right form-horizontal'])); ?>

						<button type="submit" type="button" class="btn btn-default"><?php echo e(trans('app.Cancel')); ?></button>
					<?php echo e(Form::close()); ?>

				</div> */ ?>

			</div>
		</div>
	</div>



	<!-- RIGHT BLOCK -->
	<div class="col-sm-3">
	</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>