<?php $__env->startSection('title', trans('app.Dashboard') ); ?>

<?php $__env->startSection('content'); ?>
	<div class="panel panel-default">
		<div class="panel-heading"><?php echo e(trans('app.Dashboard')); ?></div>

		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-condensed table-hover table-bordered">
					<tr>
						<td>All numbers</td>
						<td><?php echo e($data_numbers->total); ?></td>
					</tr>
					<tr>
						<td>Deleted</td>
						<td><?php echo e($data_numbers->deleted); ?></td>
					</tr>
					<tr>
						<td>Delivered / Sended = 100% (Sended = Delivered)</td>
						<td><?php echo e($data_numbers->sended_delivered); ?></td>
					</tr>
					<tr>
						<td>Delivered / Sended > 60%</td>
						<td><?php echo e($data_numbers->percent); ?></td>
					</tr>
					<tr>
						<td>Sended Total</td>
						<td><?php echo e($data_spams->sended); ?></td>
					</tr>
					<tr>
						<td>Delivered Total</td>
						<td><?php echo e($data_spams->delivered); ?></td>
					</tr>
					<tr>
						<td>Percentage</td>
						<td><?php echo e($data_spams->percentage); ?>%</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>