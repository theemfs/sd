<?php $__env->startSection('title', 'Send SMS'); ?>

<?php $__env->startSection('content'); ?>
	<div class="panel panel-default">
		<div class="panel-heading"><?php echo e(trans('app.Send SMS')); ?></div>
		<p></p>

		<div class="panel-body">

			<?php echo Form::model($modems, ['method' => 'POST', 'action' => ['ModemsController@send'], 'class' => 'form-horizontal']); ?>


				<div class="form-group">
					<label class="control-label col-xs-2" for="modems_list"><?php echo e(trans('app.Modem')); ?></label>
					<div class="col-sm-10">
						<select id="modems_list" name="modem" class="form-control">
							<?php foreach($modems as $modem): ?>
								<option value="<?php echo e($modem->id); ?>"><?php echo e($modem->name); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<?php echo Form::label( trans('app.To') , null, ['class' => 'control-label col-xs-2']); ?>

					<div class="col-sm-10">
						<?php echo Form::text( 'to' , Session::has('to') ? Session::get('to') : '', ['class' => 'form-control', 'autocomplete' => 'off']); ?>

					</div>
				</div>

				<div class="form-group">
					<?php echo Form::label( trans('app.Message'), null, ['class' => 'control-label col-xs-2']); ?>

					<div class="col-sm-10">
						<?php echo Form::textarea( 'text' , Session::has('text') ? Session::get('text') : '', ['class' => 'form-control', 'autocomplete' => 'off']); ?>

					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<?php echo Form::submit( trans('app.Send') , ['class' => 'btn btn-primary form-control']); ?>

					</div>
				</div>

			<?php echo Form::close(); ?>


		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>