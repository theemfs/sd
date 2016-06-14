<?php $__env->startSection('title', 'Case #'.$case->id ); ?>

<?php $__env->startSection('content'); ?>

	<!-- LEFT BLOCK -->
	<div class="col-sm-3">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?php echo e(trans('app.Members')); ?>

				</div>

				<div class="panel-body">
					<div class="">
						<?php echo Form::label('users_list_members', null, ['class' => 'control-label']); ?>

						<?php echo Form::select('users[]', $users, $usersIds, ['id' => 'users_list_members	', 'class' => 'form-control', 'multiple', 'autocomplete' => 'off', 'size' => '5']); ?>

					</div>
					<hr>
					<div class="">
						<?php echo Form::label('users_list_spectators', null, ['class' => 'control-label']); ?>

						<?php echo Form::select('users[]', $users, $usersIds, ['id' => 'users_list_spectators', 'class' => 'form-control', 'multiple', 'autocomplete' => 'off', 'size' => '5']); ?>

					</div>
					<hr>
				</div>
			</div>
		</div>
	</div>

	<!-- CENTER BLOCK -->
	<div class="col-sm-6">
		<div class="panel panel-default">

			<div class="panel-heading">
				<?php echo e(trans('app.Case') . " #" . $case->id); ?>

			</div>

			<div class="panel-body">


				<!-- FIRST MESSAGE -->
				<div class="message bg-warning" id="<?php echo e($message_first->id); ?>">
					<div class="col-xs-1">
						<i class="fa fa-fw fa-comment"></i>
						<!-- <img src="/build/images/user.png" alt="..." class="img-rounded"> -->
						<a href="<?php echo e(action('CasesController@show', $case->id)); ?>#<?php echo e($message_first->id); ?>">
							<!-- <i class="fa fa-fw fa-anchor"></i> -->
						</a>
					</div>

					<div class="col-xs-11">
						<div class="form-group">
							<span class="small"><?php echo e($message_first->user->name); ?> | <?php echo e($message_first->created_at); ?></span>
							<hr>

							<div class="message-body"><?php echo e($message_first->text); ?></div>

							<?php foreach($message_first->files as $file): ?>
								<?php if( substr($file->mimetype, 0, 5) == 'image'): ?>
									<a href="<?php echo e(action('FilesController@show', $file->id)); ?>">
										<img class="img img-rounded" src="<?php echo e(url('/') . '/thumbnails/' . $file->thumbnail); ?>" alt="<?php echo e($file->name); ?>">
									</a>
								<?php else: ?>
									<a href="<?php echo e(action('FilesController@show', $file->id)); ?>">
										<p><i class="fa fa-file" aria-hidden="true"></i><?php echo e($file->name); ?> [<?php echo e(human_filesize($file->size)); ?>]</p>
									</a>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
				</div>



				<!-- SECOND AND ETC MESSAGES -->
				<?php foreach($messages as $message): ?>
					<div class="message" id="<?php echo e($message->id); ?>">
						<div class="col-xs-1">
							<i class="fa fa-fw fa-comment"></i>
							<!-- <img src="/build/images/user.png" alt="..." class="img-rounded"> -->
							<a href="<?php echo e(action('CasesController@show', $case->id)); ?>#<?php echo e($message->id); ?>">
								<!-- <i class="fa fa-fw fa-anchor"></i> -->
							</a>
						</div>

						<div class="col-xs-11">
							<div class="form-group">
								<span class="small"><?php echo e($message->user->name); ?> | <?php echo e($message->created_at); ?></span>
								<hr>

								<div class="message-body"><?php echo e($message->text); ?></div>

								<?php foreach($message->files as $file): ?>
									<?php if( substr($file->mimetype, 0, 5) == 'image'): ?>
										<a href="<?php echo e(action('FilesController@show', $file->id)); ?>">
											<img class="img img-rounded" src="<?php echo e(url('/') . '/thumbnails/' . $file->thumbnail); ?>" alt="<?php echo e($file->name); ?>">
										</a>
									<?php else: ?>
										<a href="<?php echo e(action('FilesController@show', $file->id)); ?>">
											<p><i class="fa fa-file" aria-hidden="true"></i><?php echo e($file->name); ?> [<?php echo e(human_filesize($file->size)); ?>]</p>
										</a>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				<hr>


				<!-- reply area -->
				<?php echo Form::open(['url'=>'messages', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']); ?>

					<div class="message bg-info">
						<div class=""></div>
						<div class="col-xs-12">
							<div class="form-group">
								<?php echo Form::textarea('text', null, ['class' => 'form-control', 'rows' => '3', 'autocomplete' => 'off', 'placeholder' => trans('app.Add Message Textarea Placeholder') ]); ?>

							</div>
								<?php echo Form::hidden('case', $case->id, ['class' => 'form-control', 'autocomplete' => 'off']); ?>

							<div class="form-group">
								<?php echo Form::file( 'attachments[]', ['class' => '', 'multiple' => 'true']); ?>

							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12 pull-right">
								<?php echo Form::submit( trans('app.Add Message'), ['class' => 'btn btn-primary form-control col-xs-12']); ?>

							</div>
						</div>
					</div>
				<?php echo Form::close(); ?>




			</div>
		</div>
	</div>

	<!-- RIGHT BLOCK -->
	<div class="col-sm-3">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<?php echo e(trans('app.Case') . " #" . $case->id); ?>

				</div>

				<div class="panel-body">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</div>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>