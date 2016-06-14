<?php $__env->startSection('content'); ?>
			<div class="panel panel-default">
				<div class="panel-heading"><?php echo e(trans('app.Login')); ?></div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/login')); ?>">
						<?php echo csrf_field(); ?>


						<div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
							<label class="col-md-4 control-label"><?php echo e(trans('app.Email')); ?></label>

							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>">

								<?php if($errors->has('email')): ?>
									<span class="help-block">
										<strong><?php echo e($errors->first('email')); ?></strong>
									</span>
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
							<label class="col-md-4 control-label"><?php echo e(trans('app.Password')); ?></label>

							<div class="col-md-6">
								<input type="password" class="form-control" name="password">

								<?php if($errors->has('password')): ?>
									<span class="help-block">
										<strong><?php echo e($errors->first('password')); ?></strong>
									</span>
								<?php endif; ?>
							</div>
						</div>

						<div class="form-group hidden">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" checked name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-fw fa-btn fa-sign-in"></i>&nbsp; <?php echo e(trans('app.Login')); ?>

								</button>

								<?php /* <a class="btn btn-link" href="<?php echo e(url('/password/reset')); ?>">Forgot Your Password?</a> */ ?>
							</div>
						</div>
					</form>
<?php /* <div class="col-md-6 col-md-offset-4">
	<a href="<?php echo route('socialite.auth', 'github'); ?>">Github</a>
	<a href="<?php echo route('socialite.auth', 'google'); ?>">Google</a>
	<a href="<?php echo route('socialite.auth', 'facebook'); ?>">Facebook</a>
	<a href="<?php echo route('socialite.auth', 'twitter'); ?>">Twitter</a>
	<a href="<?php echo route('socialite.auth', 'ldap'); ?>">Ldap</a>
</div> */ ?>
				</div>
			</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>