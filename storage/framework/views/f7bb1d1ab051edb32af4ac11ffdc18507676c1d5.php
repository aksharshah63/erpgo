<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Roles')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Role')): ?>
            <a href="#" data-url="<?php echo e(route('roles.create')); ?>" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create Role')); ?>" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        <?php endif; ?>
    <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Permissions')): ?>
        <a href="<?php echo e(route('permissions.index')); ?>" class="btn btn-primary btn-sm"><i class="fas fa-lock"></i> <?php echo e(__('Permissions')); ?> </a>
    <?php endif; ?> -->
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
   
<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
        <tr>
            <th scope="col" class="sort" data-sort="status"><?php echo e(__('Role')); ?></th>
            <th scope="col" class="sort" data-sort="status"><?php echo e(__('Permissions')); ?></th>
            <?php if(Gate::check('Edit Role') || Gate::check('Delete Role')): ?>
                <th width="200px"><?php echo e(__('Action')); ?></th>
            <?php endif; ?>
        </tr>
        </thead>
        <tbody class="list">
        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="Role"><?php echo e($role->name); ?></td>
                <td class="Permission">
                    <?php $__currentLoopData = $role->permissions()->pluck('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="#" class="absent-btn"><?php echo e($permission); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <?php if(Gate::check('Edit Role') || Gate::check('Delete Role')): ?>
                    <td class="Action">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Role')): ?>
                                <a href="#" data-url="<?php echo e(URL::to('roles/'.$role->id.'/edit')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit Role')); ?>" class="action-item" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>"><i class="fas fa-pencil-alt"></i></a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Role')): ?>
                            <a href="#" class="action-item text-danger" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($role->id); ?>').submit();"><i class="fas fa-trash"></i></a>
                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id],'id'=>'delete-form-'.$role->id]); ?>

                            <?php echo Form::close(); ?>

                        <?php endif; ?>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
                
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/roles/index.blade.php ENDPATH**/ ?>