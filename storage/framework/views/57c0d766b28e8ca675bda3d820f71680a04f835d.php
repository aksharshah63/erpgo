<?php
$profile=asset(Storage::url('users'));
?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Profile Account')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12">
            <div class="card profile-card">
                <div class="avatar avatar-lg rounded-circle">
                    
                    <?php if(!empty($userDetail->userdetail->img_image)): ?>
                        <img alt="" <?php echo e($userDetail->userdetail->img_image); ?> class="avatar avatar-lg">
                    <?php else: ?>
                        <img alt="" src="<?php echo e($profile.'/avatar.png'); ?>" class="avatar avatar-lg">
                    <?php endif; ?>
                </div>
                <h4 class="h4 mb-0 mt-2"> <?php echo e($userDetail->name); ?></h4>
                <div class="sal-right-card">
                    <span class="badge badge-pill badge-blue"><?php echo e($userDetail->type); ?></span>
                </div>
                <h6 class="office-time mb-0 mt-4"><?php echo e($userDetail->email); ?></h6>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12">
            <section class="col-lg-12 pricing-plan card">
                <div class="our-system password-card p-3">
                    <div class="row">
                        <!-- <div class="col-lg-12"> -->

                        <ul class="nav nav-tabs my-4" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a data-toggle="pill" href="#personal-info" class="nav-link active" id="pills-home-tab" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo e(__('Personal Info')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="pill" href="#change-password" class="nav-link" id="pills-profile-tab" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo e(__('Change Password')); ?></span> </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div id="personal-info" class="tab-pane fade show active" role="tabpanel" aria-labelledby="pills-home-tab">
                            <?php echo e(Form::model($userDetail,array('route' => array('customer.update.profile'), 'method' => 'put', 'enctype' => "multipart/form-data"))); ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('name',__('Name'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('name',null,array('class'=>'form-control','placeholder'=>__('Enter User Name')))); ?>

                                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-name" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <?php echo e(Form::label('email',__('Email'),array('class'=>'form-control-label'))); ?>

                                    <?php echo e(Form::text('email',null,array('class'=>'form-control','placeholder'=>__('Enter User Email')))); ?>

                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-email" role="alert">
                                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                                    </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <div class="choose-file">
                                            <label for="avatar">
                                                <div><?php echo e(__('Choose file here')); ?></div>
                                                <input type="file" class="form-control" id="avatar" name="profile" data-filename="profiles">
                                            </label>
                                            <p class="profiles"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 text-right">
                                    <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                        <div id="change-password" class="tab-pane fade" role="tabpanel" aria-labelledby="pills-home-tab">
                            <?php echo e(Form::model($userDetail,array('route' => array('customer.update.password',$userDetail->id), 'method' => 'put'))); ?>

                            <div class="row">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('current_password',__('Current Password'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::password('current_password',array('class'=>'form-control','placeholder'=>__('Enter Current Password')))); ?>

                                        <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-current_password" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('new_password',__('New Password'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::password('new_password',array('class'=>'form-control','placeholder'=>__('Enter New Password')))); ?>

                                        <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-new_password" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('confirm_password',__('Re-type New Password'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::password('confirm_password',array('class'=>'form-control','placeholder'=>__('Enter Re-type New Password')))); ?>

                                        <?php $__errorArgs = ['confirm_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-confirm_password" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-right">
                                    <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/hr/employee/profile.blade.php ENDPATH**/ ?>