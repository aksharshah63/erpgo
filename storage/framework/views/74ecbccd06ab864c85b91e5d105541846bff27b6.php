<?php echo e(Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>


<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
                    aria-controls="general" aria-selected="true"><?php echo e(__('General info')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="other-tab" data-toggle="tab" href="#other" role="tab" aria-controls="other"
                    aria-selected="false"><?php echo e(__('Work')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false"><?php echo e(__('Personal Details')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="additional-tab" data-toggle="tab" href="#additional" role="tab"
                    aria-controls="additional" aria-selected="false"><?php echo e(__('Additional info')); ?></a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <?php echo e(Form::label('name', __('Name'), ['class' => 'form-control-label'])); ?><span
                                class="text-danger">*</span>
                            <?php echo e(Form::text('name', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('email', __('Email'), ['class' => 'form-control-label'])); ?><span
                                class="text-danger">*</span>
                            <?php echo e(Form::email('email', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('password', __('Password'), ['class' => 'form-control-label'])); ?><span
                                class="text-danger">*</span>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('user_type', __('User Type'), ['class' => 'form-control-label'])); ?><span
                            class="text-danger">*</span>
                            <select name="user_type" id="user_type" class="form-control main-element" required>
                                <option value=""><?php echo e(__('Please Select')); ?></option>
                                <?php $__currentLoopData = \App\UserDetail::$user_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($k); ?>" <?php echo e(($user->user_type == $k) ? 'selected' : ''); ?>><?php echo e(__($v)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('user_status', __('User Status'), ['class' => 'form-control-label'])); ?><span
                            class="text-danger">*</span>
                            <select name="user_status" id="user_status" class="form-control main-element" required>
                                <option value=""><?php echo e(__('Please Select')); ?></option>
                                <?php $__currentLoopData = \App\UserDetail::$user_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($k); ?>" <?php echo e(($user->user_status == $k) ? 'selected' : ''); ?>><?php echo e(__($v)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('date_of_hire', __('Date of Hire'), ['class' => 'form-control-label'])); ?><span
                            class="text-danger">*</span>
                            <?php echo e(Form::text('date_of_hire', \App\Utility::getDateFormated($user->date_of_hire), ['class' => 'form-control datepicker', 'required' => 'required'])); ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('role', __('Role'), ['class' => 'form-control-label'])); ?><span
                            class="text-danger">*</span>
                            <select name="role" class="form-control main-element" required>
                                <option value=""><?php echo e(__('Select Role')); ?></option>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->id); ?>" <?php if($role->id == $userRole): ?> selected <?php endif; ?>><?php echo e($role->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('department', __('Department'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::select('department', $departments, $user->userdetail->department, ['class' => 'form-control main-element'])); ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('designation', __('Designation'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::select('designation', $designations, $user->userdetail->designation, ['class' => 'form-control main-element'])); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('location', __('Location'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::text('location', (isset($user->userdetail->location) ? $user->userdetail->location : null), ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('reporting_to', __('Reporting To'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::select('reporting_to',$userList, $user->userdetail->reporting_to, ['class' => 'form-control main-element'])); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('source_of_hire', __('Source of Hire'), ['class' => 'form-control-label'])); ?>

                            <select name="source_of_hire" id="source_of_hire" class="form-control main-element">
                                <option value=""><?php echo e(__('Please Select')); ?></option>
                                <?php $__currentLoopData = \App\UserDetail::$source_of_hire; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($k); ?>" <?php echo e(($user->userdetail->source_of_hire == $k) ? 'selected' : ''); ?>><?php echo e(__($v)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('pay_rate', __('Pay Rate'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::number('pay_rate', (isset($user->userdetail->pay_rate) ? $user->userdetail->pay_rate : null), ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('pay_type', __('Pay Type'), ['class' => 'form-control-label'])); ?>

                            <select name="pay_type" id="pay_type" class="form-control main-element">
                                <option value=""><?php echo e(__('Please Select')); ?></option>
                                <?php $__currentLoopData = \App\UserDetail::$pay_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($k); ?>" <?php echo e(($user->userdetail->pay_type == $k) ? 'selected' : ''); ?>><?php echo e(__($v)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('father_name', __('Father Name'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::text('father_name', (isset($user->userdetail->father_name) ? $user->userdetail->father_name : null), ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('mother_name', __('Mother Name'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::text('mother_name', (isset($user->userdetail->mother_name) ? $user->userdetail->mother_name : null), ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('mobile', __('Mobile'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::number('mobile', (isset($user->userdetail->mobile) ? $user->userdetail->mobile : null), ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('phone', __('Phone'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::number('phone', (isset($user->userdetail->phone) ? $user->userdetail->phone : null), ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('date_of_birth', __('Date Of Birth'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::text('date_of_birth', \App\Utility::getDateFormated($user->userdetail->date_of_birth), ['class' => 'form-control datepicker'])); ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('nationality', __('Nationality'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::text('nationality', (isset($user->userdetail->nationality) ? $user->userdetail->nationality : null), ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('gender', __('Gender'), ['class' => 'form-control-label'])); ?>

                            <select name="gender" id="gender" class="form-control main-element">
                                <option value=""><?php echo e(__('Please Select')); ?></option>
                                <?php $__currentLoopData = \App\UserDetail::$gender; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($k); ?>" <?php echo e(($user->userdetail->gender == $k) ? 'selected' : ''); ?>><?php echo e(__($v)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('marital_status', __('Marital Status'), ['class' => 'form-control-label'])); ?>

                            <select name="marital_status" id="marital_status" class="form-control main-element">
                                <option value=""><?php echo e(__('Please Select')); ?></option>
                                <?php $__currentLoopData = \App\UserDetail::$marital_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($k); ?>" <?php echo e(($user->userdetail->marital_status == $k) ? 'selected' : ''); ?>><?php echo e(__($v)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('hobbies', __('Hobbies'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::text('hobbies', (isset($user->userdetail->hobbies) ? $user->userdetail->hobbies : null), ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('website', __('Website'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::text('website', (isset($user->userdetail->website) ? $user->userdetail->website : null), ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('address1', __('Address1'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::text('address1', (isset($user->userdetail->address1) ? $user->userdetail->address1 : null), ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('address2', __('Address2'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::text('address2', (isset($user->userdetail->address2) ? $user->userdetail->address2 : null), ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('city', __('City'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::text('city', (isset($user->userdetail->city) ? $user->userdetail->city : null), ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('country', __('Country'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::text('country', (isset($user->userdetail->country) ? $user->userdetail->country : null), ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('state', __('State'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::text('state', (isset($user->userdetail->state) ? $user->userdetail->state : null), ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('zip_code', __('Zip Code'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::text('zip_code', (isset($user->userdetail->zip_code) ? $user->userdetail->zip_code : null), ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="additional" role="tabpanel" aria-labelledby="additional-tab">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <?php echo e(Form::label('biography', __('Biography'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::textarea('biography', (isset($user->userdetail->biography) ? $user->userdetail->biography : null), ['class' => 'form-control', 'rows' => '4', 'cols' => '50'])); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        <?php echo e(Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill'])); ?>

    </div>
</div>
<?php echo Form::close(); ?>

<?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/hr/employee/edit.blade.php ENDPATH**/ ?>