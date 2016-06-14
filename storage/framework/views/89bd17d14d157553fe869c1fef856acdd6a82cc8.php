<?php $__env->startSection('title', trans('app.Create Round')); ?>

<?php $__env->startSection('content'); ?>
	<div class="panel panel-default">

		<div class="panel-heading">
			<?php echo e(trans('app.Create Round')); ?>

		</div>

		<div class="panel-body">
			<?php echo Form::open(['url'=>'rounds', 'class' => 'form-horizontal']); ?>


				<div class="form-group">
					<?php echo Form::label( trans('app.Name'), null, ['class' => 'control-label col-xs-2']); ?>

					<div class="col-sm-10">
						<?php echo Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']); ?>

					</div>
				</div>

				<div class="form-group">
					<?php echo Form::label( trans('app.Text') , null, ['class' => 'control-label col-xs-2']); ?>

					<div class="col-sm-10">
						<?php echo Form::textarea('text', null, ['class' => 'form-control', 'autocomplete' => 'off', 'rows' => '5']); ?>

					</div>
				</div>

				<div class="form-group">
					<?php echo Form::label( trans('app.Set'), null, ['class' => 'control-label col-xs-2']); ?>

					<div class="col-sm-10">
						<select class="form-control" name="sets" id="">
							<option value="sended=delivered"><?php echo e(trans('app.Sended = Delivered') . ' (' . $sended_delivered . ')'); ?></option>
							<option value="allexceptblack"><?php echo e(trans('app.All except black') . ' (' . $all_besides_deleted . ')'); ?></option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<?php echo Form::label( trans('app.Random'), null, ['class' => 'control-label col-xs-2']); ?>

					<div class="col-sm-10">
						<select class="form-control" name="random" id="">
							<option value="true"><?php echo e(trans('app.Yes')); ?></option>
							<option value="false"><?php echo e(trans('app.No')); ?></option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<?php echo Form::submit( trans('app.Create'), ['class' => 'btn btn-primary form-control']); ?>

					</div>
				</div>

			<?php /* 	<div class="form-group">
					<?php echo Form::label( trans('app.Start'), null, ['class' => 'control-label col-xs-2']); ?>

					<div class="col-sm-10">
						<?php echo Form::checkbox('start', null, false); ?>

					</div>
				</div> */ ?>

				<?php /*<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<?php echo Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']); ?>

					</div>
				</div>*/ ?>

			<?php echo Form::close(); ?>

		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
	<script>
		$('#groups_list').select2({
			placeholder: "Добавлять можно по очереди или с нажатой Ctrl",
		});
		// $('#phones_list').select2({
		// 	placeholder: "Добавлять можно по очереди или с нажатой Ctrl",
		// });
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>