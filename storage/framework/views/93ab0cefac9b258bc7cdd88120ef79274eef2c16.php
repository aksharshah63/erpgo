<?php $__env->startSection('title'); ?>
    <?php echo e(__('View User')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <a href="<?php echo e(route('users.index')); ?>" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary">
            <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
        </a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-4 order-lg-2">
            <div class="card">
                <div class="list-group list-group-flush" id="tabs">
                    <div data-href="#accountcontact" class="list-group-item text-primary">
                        <div class="media">
                            <i class="fas fa-user"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1"><?php echo e(__('General info')); ?></a>
                            </div>
                        </div>
                    </div>
                    <div data-href="#leave" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-industry"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1"><?php echo e(__('Leave')); ?></a>
                            </div>
                        </div>
                    </div>
                    <div data-href="#notes" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-sticky-note"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1"><?php echo e(__('Notes')); ?></a>
                            </div>
                        </div>
                    </div>
                    <div data-href="#performance" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-chart-line"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1"><?php echo e(__('Performance')); ?></a>
                            </div>
                        </div>
                    </div>
                    <div data-href="#policy" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-lock"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1"><?php echo e(__('Policy')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 order-lg-1">
            <div class="card bg-gradient-primary hover-shadow-lg border-0">
                <div class="card-body py-3">
                    <div class="row row-grid align-items-center">
                        <div class="col-lg-8">
                            <div class="media align-items-center">
                                <a href="#" class="avatar avatar-lg rounded-circle mr-3">
                                    <img class="avatar avatar-lg" <?php echo e($user->userdetail->img_image); ?> alt="Owner">
                                </a>
                                <div class="media-body">
                                    <h5 class="text-white mb-0"> <?php echo e(ucfirst($user->name)); ?></h5>
                                    <div>
                                        <?php echo e(Form::open(['route' => ['update.user.profile'],'enctype'=>'multipart/form-data','id' => 'update_avatar'])); ?>

                                        <input type="file" name="image" id="image" class="custom-input-file custom-input-file-link" data-multiple-caption="{count} files selected" multiple/>
                                        <input type="hidden" name="id" value="<?php echo e($user->userdetail->user_id); ?>"/>
                                        <label for="image">
                                            <span class="text-white" style="cursor: pointer;"><?php echo e(__('Change Avatar')); ?></span>
                                        </label>
                                        <?php echo e(Form::close()); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="accountcontact" class="tabs-card">
                <div class="card">
                    <div class="card-header">
                        <h5 class=" h6 mb-0"><?php echo e(__('Basic Info')); ?></h5>
                    </div>
                    <div class="card-body">
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Name')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e($user->name); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('User Id')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(!empty($user->user_id) ? $user->user_id : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Email')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><a href="mailto:<?php echo e($user->email); ?>"><?php echo e($user->email); ?></a></span>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class=" h6 mb-0"><?php echo e(__('Work')); ?></h5>
                    </div>
                    <div class="card-body">
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Department')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(!empty($user->userdetail->departmentDesc->title) ? $user->userdetail->departmentDesc->title : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Designation')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(!empty($user->userdetail->designationDesc->title) ? $user->userdetail->designationDesc->title : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Reporting To')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(!empty($user->userdetail->reporting_to) ? $user->userdetail->reporting_to : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Date of Hire')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(Utility::getDateFormated($user->date_of_hire)); ?></span>
                            </div>
                        </dl>
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Source of Hire')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(!empty($user->userdetail->source_of_hire) ? __(\App\UserDetail::$source_of_hire[$user->userdetail->source_of_hire]) : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('User Status')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(__(\App\UserDetail::$user_status[$user->user_status])); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Phone')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><a href="tel:<?php echo e($user->userdetail->phone); ?>"><?php echo e(!empty($user->userdetail->phone) ? $user->userdetail->phone : '-'); ?></a></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('User Type')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(__(\App\UserDetail::$user_type[$user->user_type])); ?></span>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class=" h6 mb-0"><?php echo e(__('Personal Details')); ?></h5>
                    </div>
                    <div class="card-body">
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Father Name')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(!empty($user->userdetail->father_name) ? $user->userdetail->father_name : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Mother Name')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(!empty($user->userdetail->mother_name) ? $user->userdetail->mother_name : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Address1')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(!empty($user->userdetail->address1) ? $user->userdetail->address1 : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Address2')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(!empty($user->userdetail->address2) ? $user->userdetail->address2 : '-'); ?></span>
                            </div>
                        </dl>
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('City')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(!empty($user->userdetail->city) ? $user->userdetail->city : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Country')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(!empty($user->userdetail->country) ? $user->userdetail->country : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('State')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(!empty($user->userdetail->state) ? $user->userdetail->state : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Zip Code')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(!empty($user->userdetail->zip_code) ? $user->userdetail->zip_code : '-'); ?></span>
                            </div>
                        </dl>
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Mobile')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><a href="tel:<?php echo e($user->userdetail->mobile); ?>"><?php echo e(!empty($user->userdetail->mobile) ? $user->userdetail->mobile : '-'); ?></a></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Date Of Birth')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(!empty($user->userdetail->date_of_birth) ? Utility::getDateFormated($user->userdetail->date_of_birth) : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Gender')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(!empty($user->userdetail->gender) ? __(\App\UserDetail::$gender[$user->userdetail->gender]) : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Marital Status')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(!empty($user->userdetail->marital_status) ? __(\App\UserDetail::$marital_status[$user->userdetail->marital_status]) : '-'); ?></span>
                            </div>
                        </dl>
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Nationality')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(!empty($user->userdetail->nationality) ? $user->userdetail->nationality : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Hobbies')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e(!empty($user->userdetail->hobbies) ? $user->userdetail->hobbies : '-'); ?></span>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('Work Experience')); ?></h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="<?php echo e(__('Add New Work Experience')); ?>" data-size='lg'
                                        data-url="<?php echo e(route('work_experiences.create',['id' => $user->id])); ?>" class="action-item"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="5%"><?php echo e(__('Previous Company')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="5%"><?php echo e(__('Job Title')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="5%"><?php echo e(__('From')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="5%"><?php echo e(__('To')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="5%"><?php echo e(__('Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php if(count($work_experiences) > 0): ?>
                                        <?php $__currentLoopData = $work_experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $workexperience): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($workexperience->previous_company); ?></td>
                                                <td><?php echo e($workexperience->job_title); ?></td>
                                                <td><?php echo e(Utility::getDateFormated($workexperience->from)); ?></td>
                                                <td><?php echo e(Utility::getDateFormated($workexperience->to)); ?></td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                data-url="<?php echo e(route('work_experiences.edit', $workexperience->id)); ?>"
                                                                data-ajax-popup="true" data-title="<?php echo e(__('Edit Work Experience')); ?>"
                                                                data-original-title="<?php echo e(__('Edit')); ?>" data-size='lg'><?php echo e(__('Edit')); ?></a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="<?php echo e(__('Delete')); ?>"
                                                                    data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                                                    data-confirm-yes="document.getElementById('delete-form-<?php echo e($workexperience->id); ?>').submit();">
                                                                    <?php echo e(__('Remove')); ?>

                                                                </a>
                                                                <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['work_experiences.destroy', $workexperience->id], 'id' => 'delete-form-' . $workexperience->id])); ?>

                                                                <?php echo e(Form::close()); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('Education')); ?></h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="<?php echo e(__('Add New Education')); ?>" data-size='lg'
                                        data-url="<?php echo e(route('educations.create',['id' => $user->id])); ?>" class="action-item"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('School Name')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Degree')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Field(s) of Study')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Year of Completion')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php if(count($educations) > 0): ?>
                                        <?php $__currentLoopData = $educations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $education): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($education->school_name); ?></td>
                                                <td><?php echo e($education->degree); ?></td>
                                                <td><?php echo e($education->field_of_study); ?></td>
                                                <td><?php echo e($education->year_of_completion); ?></td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                data-url="<?php echo e(route('educations.edit', $education->id)); ?>"
                                                                data-ajax-popup="true" data-title="<?php echo e(__('Edit Education')); ?>"
                                                                data-original-title="<?php echo e(__('Edit')); ?>" data-size='lg'><?php echo e(__('Edit')); ?></a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="<?php echo e(__('Delete')); ?>"
                                                                    data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                                                    data-confirm-yes="document.getElementById('delete-form-<?php echo e($education->id); ?>').submit();">
                                                                    <?php echo e(__('Remove')); ?>

                                                                </a>
                                                                <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['educations.destroy', $education->id], 'id' => 'delete-form-' . $education->id])); ?>

                                                                <?php echo e(Form::close()); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="leave" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('History')); ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="50%"><?php echo e(__('Date')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="40%"><?php echo e(__('Description')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="10%"><?php echo e(__('Days')); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php if($getleavehistories->count() > 0): ?>
                                        <?php $__currentLoopData = $getleavehistories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getleavehistory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(Utility::getDateFormated($getleavehistory->from) .' - '. Utility::getDateFormated($getleavehistory->to)); ?></td>
                                                <td class="text-wrap" width="40%"><?php echo e(!empty($getleavehistory->reason) ? $getleavehistory->reason : '-'); ?></td>
                                                <td><?php echo e(Utility::diffDate($getleavehistory->from,$getleavehistory->to,true)); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr class="font-style">
                                            <td colspan="6" class="text-center">
                                                <h6 class="text-center"><?php echo e(__('No Histroy Found.')); ?></h6>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="notes" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('Note')); ?></h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="<?php echo e(__('Add New Note')); ?>" data-size='lg'
                                        data-url="<?php echo e(route('notes.create',['type' => 'user','id' => $user->id])); ?>" class="action-item"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="80%"><?php echo e(__('Note')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="10%"><?php echo e((' ')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="10%"><?php echo e(__('Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($notes) > 0): ?>
                                        <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-wrap" width="80%"><?php echo $note->note; ?></td>
                                                <td><?php echo e(Auth::user()->name); ?></td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                data-url="<?php echo e(route('notes.edit', $note->id)); ?>"
                                                                data-ajax-popup="true" data-title="<?php echo e(__('Edit Note')); ?>"
                                                                data-original-title="<?php echo e(__('Edit')); ?>" data-size='lg'><?php echo e(__('Edit')); ?></a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="<?php echo e(__('Delete')); ?>"
                                                                    data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                                                    data-confirm-yes="document.getElementById('delete-form-<?php echo e($note->id); ?>').submit();">
                                                                    <?php echo e(__('Remove')); ?>

                                                                </a>
                                                                <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['notes.destroy', $note->id], 'id' => 'delete-form-' . $note->id])); ?>

                                                                <?php echo e(Form::close()); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="performance" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('Performance Reviews')); ?></h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="<?php echo e(__('Add New Performance Reviews')); ?>" data-size='lg'
                                        data-url="<?php echo e(route('performance_reviews.create',['id' => $user->id])); ?>" class="action-item"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Review Date')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Reporting To')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Attendance/Punctuality')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Communication/Listening')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php if(count($performance_reviews) > 0): ?>
                                        <?php $__currentLoopData = $performance_reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $performance_review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(Utility::getDateFormated($performance_review->review_date)); ?></td>
                                                <td><?php echo e(!empty($performance_review->user->name) ?  $performance_review->user->name : '-'); ?></td>
                                                <td><?php echo e(!empty($performance_review->attendence_punctuality) ?  __(\App\PerformanceReview::$reviews[$performance_review->attendence_punctuality]) : '-'); ?></td>
                                                <td><?php echo e(!empty($performance_review->communication_listening) ? __(\App\PerformanceReview::$reviews[$performance_review->communication_listening]) : '-'); ?></td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="<?php echo e(__('Delete')); ?>"
                                                                    data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                                                    data-confirm-yes="document.getElementById('delete-form-<?php echo e($performance_review->id); ?>').submit();">
                                                                    <?php echo e(__('Remove')); ?>

                                                                </a>
                                                                <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['performance_reviews.destroy', $performance_review->id], 'id' => 'delete-form-' . $performance_review->id])); ?>

                                                                <?php echo e(Form::close()); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('Performance Comments')); ?></h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="<?php echo e(__('Add New Performance Comments')); ?>" data-size='lg'
                                        data-url="<?php echo e(route('performance_comments.create',['id' => $user->id])); ?>" class="action-item"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="15%"><?php echo e(__('Date')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="15%"><?php echo e(__('Reviewer')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="50%"><?php echo e(__('Comments')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php if(count($performance_comments) > 0): ?>
                                        <?php $__currentLoopData = $performance_comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $performance_comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(Utility::getDateFormated($performance_comment->reference_date)); ?></td>
                                                <td><?php echo e(!empty($performance_comment->user->name) ?  $performance_comment->user->name : '-'); ?></td>
                                                <td class="text-wrap" width="50%"><?php echo e(!empty($performance_comment->comments) ? $performance_comment->comments : '-'); ?></td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="<?php echo e(__('Delete')); ?>"
                                                                    data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                                                    data-confirm-yes="document.getElementById('delete-form-<?php echo e($performance_comment->id); ?>').submit();">
                                                                    <?php echo e(__('Remove')); ?>

                                                                </a>
                                                                <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['performance_comments.destroy', $performance_comment->id], 'id' => 'delete-form-' . $performance_comment->id])); ?>

                                                                <?php echo e(Form::close()); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('Performance Goals')); ?></h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="<?php echo e(__('Add New Performance Goals')); ?>" data-size='lg'
                                        data-url="<?php echo e(route('performance_goals.create',['id' => $user->id])); ?>" class="action-item"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="15%"><?php echo e(__('Set Date')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="15%"><?php echo e(__('Completion Date')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Supervisor')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="30%"><?php echo e(__('Employee Assessment')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php if(count($performance_goals) > 0): ?>
                                        <?php $__currentLoopData = $performance_goals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $performance_goal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e(Utility::getDateFormated($performance_goal->set_date)); ?></td>
                                                <td><?php echo e(Utility::getDateFormated($performance_goal->completion_date)); ?></td>
                                                <td><?php echo e(!empty($performance_goal->user->name) ? $performance_goal->user->name : '-'); ?></td>
                                                <td><?php echo e(!empty($performance_goal->employee_assessment) ? $performance_goal->employee_assessment : '-'); ?></td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="<?php echo e(__('Delete')); ?>"
                                                                    data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                                                    data-confirm-yes="document.getElementById('delete-form-<?php echo e($performance_goal->id); ?>').submit();">
                                                                    <?php echo e(__('Remove')); ?>

                                                                </a>
                                                                <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['performance_goals.destroy', $performance_goal->id], 'id' => 'delete-form-' . $performance_goal->id])); ?>

                                                                <?php echo e(Form::close()); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="policy" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('Policy')); ?></h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="<?php echo e(__('Add New Policy')); ?>" data-size='lg'
                                        data-url="<?php echo e(route('policy.create',['id' => $user->id,'dept_id' => $user->userdetail->department])); ?>" class="action-item"><i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="90%"><?php echo e(__('Name')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="10%"><?php echo e(__('Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php if($policies->count() > 0): ?>
                                        <?php $__currentLoopData = $policies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $policy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($policy->policy_name); ?></td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="<?php echo e(__('Delete')); ?>"
                                                                    data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                                                    data-confirm-yes="document.getElementById('delete-form-<?php echo e($policy->id); ?>').submit();">
                                                                    <?php echo e(__('Remove')); ?>

                                                                </a>
                                                                <a href="#" class="dropdown-item"
                                                                data-url="<?php echo e(route('policy.show', $policy->id)); ?>" data-ajax-popup="true"
                                                                data-title="<?php echo e(__('View ').ucfirst($policy->policy_name)); ?>" data-size='lg'>
                                                                <?php echo e(__('View')); ?></a>
                                                                <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['policy.destroy', $policy->id,$user->id], 'id' => 'delete-form-' . $policy->id])); ?>

                                                                <?php echo e(Form::close()); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
$(document).on('change', '#image', function() {
            $('#update_avatar').submit();
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/hr/employee/view.blade.php ENDPATH**/ ?>