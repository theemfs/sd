<?php $__env->startSection('title', trans('app.Import') ); ?>

<?php $__env->startSection('content'); ?>
	<div class="panel panel-default">

		<div class="panel-heading">
			<?php echo e(trans('app.Import')); ?>

		</div>

		<div class="panel-body">

			<div class="btn-group btn-group-justified" role="group" aria-label="...">
				<?php echo e(Form::open(['action' => ['NumbersController@index'], 'method' => 'GET', 'class' => 'pull-right form-horizontal'])); ?>

					<button type="submit" type="button" class="btn btn-default"><?php echo e(trans('app.Cancel')); ?></button>
				<?php echo e(Form::close()); ?>

			</div>
			<hr>

			<?php echo Form::open(['url'=>'numbersimport', 'class' => 'form-horizontal']); ?>


				<div class="form-group">
					<?php echo Form::label( trans('app.Numbers'), null, ['class' => 'control-label col-xs-2']); ?>

					<div class="col-sm-10">
						<?php echo Form::textarea('numbers_list', $numbers_list, ['class' => 'form-control', 'autocomplete' => 'off']); ?>

					</div>
				</div>

				<div class="form-group">
					<?php echo Form::label( trans('app.Type'), null, ['class' => 'control-label col-xs-2']); ?>

					<div class="col-sm-10">
						<select class="form-control" name="type" id="">
							<option value=""></option>
							<option value="company"><?php echo e(trans('app.Company Number')); ?></option>
							<option value="personal"><?php echo e(trans('app.Personal Number')); ?></option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<?php echo Form::submit( trans('app.Import'), ['class' => 'btn btn-primary form-control']); ?>

					</div>
				</div>

			<?php echo Form::close(); ?>


		<hr>

		<?php if(strlen($results)>0): ?>
			<ul class="alert alert-success">
					<?php echo $results; ?>

			</ul>
		<?php endif; ?>

		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>