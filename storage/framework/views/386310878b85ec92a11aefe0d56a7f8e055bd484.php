<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Policies')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Policy')): ?>
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="<?php echo e(__('Add New Policy')); ?>" data-size='md' data-url="<?php echo e(route('policies.create')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Policy Name')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Department')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Description')); ?></th>
                <?php if(Gate::check('Edit Policy') || Gate::check('Delete Policy')): ?>
                    <th><?php echo e(__('Action')); ?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody class="list">
            <?php $__currentLoopData = $policies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $policy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($policy->policy_name); ?></td>
                    <td><?php echo e($policy->departmentDesc->title); ?></td>
                    <td class="text-wrap" width="50%"><?php echo $policy->description; ?></td>
                    <?php if(Gate::check('Edit Policy') || Gate::check('Delete Policy')): ?>
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Policy')): ?>
                                    <a href="#" class="action-item"
                                        data-url="<?php echo e(route('policies.edit', $policy->id)); ?>" data-ajax-popup="true"
                                        data-title="<?php echo e(__('Edit Policy')); ?>" data-toggle="tooltip"
                                        data-original-title="<?php echo e(__('Edit')); ?>" data-size='md'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Policy')): ?>
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="<?php echo e(__('Delete')); ?>"
                                        data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                        data-confirm-yes="document.getElementById('delete-form-<?php echo e($policy->id); ?>').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['policies.destroy', $policy->id], 'id' => 'delete-form-' . $policy->id])); ?>

                                    <?php echo e(Form::close()); ?>

                                <?php endif; ?>
                            </div>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/hr/leave_management/policies/index.blade.php ENDPATH**/ ?>