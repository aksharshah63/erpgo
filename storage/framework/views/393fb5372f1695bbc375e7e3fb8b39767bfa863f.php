<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Users')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Employee')): ?>
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="<?php echo e(__('Add New User')); ?>" data-size='lg' data-url="<?php echo e(route('users.create')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('User Name')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Designation')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Department')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('User Type')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Joined')); ?></th>
                <?php if(Gate::check('View Employee') || Gate::check('Edit Employee') || Gate::check('Delete Employee')): ?>
                    <th><?php echo e(__('Action')); ?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody class="list">
            <?php if(count($users) > 0): ?>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($user->name); ?> </td>
                        <td><?php echo e((!empty($user->userdetail->designationDesc->title) ?  $user->userdetail->designationDesc->title : '-')); ?></td>
                        <td><?php echo e((!empty($user->userdetail->departmentDesc->title) ?  $user->userdetail->departmentDesc->title : '-')); ?></td>
                        <td><?php echo e((!empty($user->user_type) ? __(\App\UserDetail::$user_type[$user->user_type]) : '-' )); ?></td>
                        <td><?php echo e(Utility::getDateFormated($user->date_of_hire)); ?></td>
                        <?php if(Gate::check('View Employee') || Gate::check('Edit Employee') || Gate::check('Delete Employee')): ?>
                            <td>
                                <!-- Actions -->
                                <div class="actions ml-12">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Employee')): ?>
                                        <a href="<?php echo e(route('users.show', $user->id)); ?>" class="action-item"
                                            data-toggle="tooltip" title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Employee')): ?>
                                        <a href="#" class="action-item"
                                            data-url="<?php echo e(route('users.edit', $user->id)); ?>" data-ajax-popup="true"
                                            data-title="<?php echo e(__('Edit User')); ?>" data-toggle="tooltip"
                                            data-original-title="<?php echo e(__('Edit')); ?>" data-size='lg'>
                                            <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                        </a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Employee')): ?>
                                        <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                            data-original-title="<?php echo e(__('Delete')); ?>"
                                            data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                            data-confirm-yes="document.getElementById('delete-form-<?php echo e($user->id); ?>').submit();">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'id' => 'delete-form-' . $user->id])); ?>

                                        <?php echo e(Form::close()); ?>

                                    <?php endif; ?>
                                </div>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </tbody>
    </table>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/hr/employee/index.blade.php ENDPATH**/ ?>