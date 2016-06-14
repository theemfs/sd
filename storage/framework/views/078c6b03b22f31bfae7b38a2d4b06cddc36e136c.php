<?php $__env->startSection('title', trans('app.Round').' #'.$rounds->id.': '.$rounds->name.'' ); ?>

<?php $__env->startSection('content'); ?>
	<div class="panel panel-default">

		<div class="panel-heading">
			<?php echo e(trans('app.Round').' #'.$rounds->id.': '.$rounds->name.''); ?>

			<div class="btn-group pull-right" role="group" aria-label="...">
			</div>
		</div>

		<div class="panel-body">

			<?php if( $status['estimated'] > 0 ): ?>
				<div class="btn-group btn-group-justified" role="group">
					<?php echo e(Form::open(['action' => ['RoundsController@edit', $rounds->id], 'method' => 'GET', 'class' => 'pull-right form-horizontal'])); ?>

						<button type="submit" type="button" class="btn btn-warning"><?php echo e(trans('app.Edit')); ?></button>&nbsp;
					<?php echo e(Form::close()); ?>

				</div>
				<hr>
			<?php endif; ?>

			<?php echo Form::model($rounds, ['url'=>'rounds', 'class' => 'form-horizontal']); ?>


				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2">
						<a class="btn btn-default form-control" href="<?php echo e(action('RoundsController@index')); ?>" role="button"><?php echo e(trans('app.Close')); ?></a>
					</div>
				</div>

				<hr>

				<div class="form-group">
					<?php echo Form::label( trans('app.Name'), null, ['class' => 'control-label col-xs-2']); ?>

					<div class="col-sm-10">
						<?php echo Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'readonly']); ?>

					</div>
				</div>

				<div class="form-group">
					<?php echo Form::label( trans('app.Text') , null, ['class' => 'control-label col-xs-2']); ?>

					<div class="col-sm-10">
						<?php echo Form::textarea('text', null, ['class' => 'form-control', 'autocomplete' => 'off', 'rows' => '2', 'readonly']); ?>

					</div>
				</div>

				<div class="form-group">
					<?php echo Form::label( trans('app.Status') , null, ['class' => 'control-label col-xs-2']); ?>

					<div class="col-sm-10">
						<p>All / Sended / Delivered / Queued / Estimated</p>
						<p><?php echo e($status['all']); ?> / <?php echo e($status['sended']); ?> / <?php echo e($status['delivered']); ?> / <?php echo e($status['queued']); ?> / <?php echo e($status['estimated']); ?></p>
						<p>Last Update: <?php echo e($status['last_update']); ?></p>

						<?php if( $status['progress_sending'] == 100): ?>
							<div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" style="width: <?php echo e($status['progress_sending']); ?>%;"></div></div>
						<?php else: ?>
							<div class="progress"><div class="progress-bar progress-bar-info" role="progressbar" style="width: <?php echo e($status['progress_sending']); ?>%;"></div></div>
						<?php endif; ?>

						<?php if( $status['progress_delivery'] == 100): ?>
							<div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" style="width: <?php echo e($status['progress_delivery']); ?>%;"></div></div>
						<?php else: ?>
							<div class="progress"><div class="progress-bar progress-bar-info" role="progressbar" style="width: <?php echo e($status['progress_delivery']); ?>%;"></div></div>
						<?php endif; ?>
					</div>
				</div>

			<?php echo Form::close(); ?>


		</div>

	</div>



	<div class="panel panel-default">

		<div class="panel-heading">
			<?php echo e(trans('app.Tasks')); ?>

			<div class="btn-group pull-right" role="group">
			</div>
		</div>

		<div class="panel-body">

			<?php if( $status['estimated'] > 0 ): ?>
				<?php echo Form::open(['action' => ['RoundsController@task', $rounds->id], 'method' => 'POST', 'class' => 'form-horizontal']); ?>


					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2">
							<?php echo Form::submit( trans('app.Create'), ['class' => 'btn btn-primary form-control']); ?>

						</div>
					</div>

					<?php echo Form::hidden('round_id', $rounds->id, ['class' => 'form-control']); ?>


					<hr>

					<div class="form-group">
						<?php echo Form::label( trans('app.Count'), null, ['class' => 'control-label col-xs-2']); ?>

						<div class="col-sm-10">
							<?php echo Form::text('count', null, ['class' => 'form-control', 'autocomplete' => 'off']); ?>

						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-xs-2" for="modems_list"><?php echo e(trans('app.Modem')); ?></label>
						<div class="col-sm-10">
							<select id="modems_list" name="modem_id" class="form-control">
									<option value="" selected></option>
								<?php foreach($modems as $modem): ?>
									<option value="<?php echo e($modem->id); ?>"><?php echo e($modem->name); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>

				<?php echo Form::close(); ?>


				<hr>
			<?php else: ?>
			<?php endif; ?>



			<?php foreach($tasks as $task): ?>
				<div class="snippet">
					<h4 class="snippet-heading">
						<?php echo e(trans('app.Task').' '.$task->id); ?>. <?php echo e(unserialize($task->status)['modem_name']); ?>

					</h4>
					<div class="snippet-body">
						<p>All / Sended / Delivered / Queued / Estimated</p>
						<p><?php echo e(unserialize($task->status)['all']); ?> / <?php echo e(unserialize($task->status)['sended']); ?> / <?php echo e(unserialize($task->status)['delivered']); ?> / <?php echo e(unserialize($task->status)['queued']); ?> / <?php echo e(unserialize($task->status)['estimated']); ?></p>
						<p>Last Update: <?php echo e(unserialize($task->status)['last_update']); ?></p>
					</div>
					<?php if( unserialize($task->status)['progress'] == 100): ?>
						<div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" style="width: <?php echo e(unserialize($task->status)['progress']); ?>%;"></div></div>
					<?php else: ?>
						<div class="progress"><div class="progress-bar progress-bar-info" role="progressbar" style="width: <?php echo e(unserialize($task->status)['progress']); ?>%;"></div></div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>

		</div>

	</div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>