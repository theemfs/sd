<?php $__env->startSection('title', "Create Number"); ?>

<?php $__env->startSection('content'); ?>
	<div class="panel panel-default">

		<div class="panel-heading">
			Create Number
		</div>

		<div class="panel-body">

			<div class="btn-group btn-group-justified" role="group" aria-label="...">
				<?php echo e(Form::open(['action' => ['NumbersController@index'], 'method' => 'GET', 'class' => 'pull-right form-horizontal'])); ?>

					<button type="submit" type="button" class="btn btn-default">Cancel</button>
				<?php echo e(Form::close()); ?>

			</div>
			<hr>

			<?php echo Form::open(['url'=>'numbers', 'class' => 'form-horizontal']); ?>


				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<?php echo Form::submit('Create', ['class' => 'btn btn-primary form-control']); ?>

					</div>
				</div>

				<div class="form-group">
					<?php echo Form::label('id', null, ['class' => 'control-label col-xs-2']); ?>

					<div class="col-sm-10">
						<?php echo Form::text('id', null, ['class' => 'form-control', 'autocomplete' => 'off', 'autofocus' => 'on']); ?>

					</div>
				</div>

				<div class="form-group">
					<?php echo Form::label('comment', null, ['class' => 'control-label col-xs-2']); ?>

					<div class="col-sm-10">
						<?php echo Form::textarea('comment', null, ['class' => 'form-control', 'autocomplete' => 'off']); ?>

					</div>
				</div>

			<?php echo Form::close(); ?>

		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>