<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Contact Group')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Contact Group')): ?>
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="<?php echo e(__('Add New Contact Group')); ?>" data-size='lg' data-url="<?php echo e(route('contact_groups.create')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Name')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Description')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Private')); ?></th>
                <?php if(Gate::check('Edit Contact Group') || Gate::check('Delete Contact Group')): ?>
                    <th><?php echo e(__('Action')); ?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody class="list">
            <?php $__currentLoopData = $contact_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contactgroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($contactgroup->name); ?></td>
                    <td><?php echo e((!empty($contactgroup->description) ? $contactgroup->description : '-')); ?></td>
                    <td><?php echo e(($contactgroup->private==1) ? __("Yes") : __("No")); ?> </td>
                    <?php if(Gate::check('Edit Contact Group') || Gate::check('Delete Contact Group')): ?>
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Contact Group')): ?>
                                    <a href="#" class="action-item"
                                        data-url="<?php echo e(route('contact_groups.edit', $contactgroup->id)); ?>"
                                        data-ajax-popup="true" data-title="<?php echo e(__('Edit Contact Group')); ?>"
                                        data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>" data-size='lg'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Contact Group')): ?>
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="<?php echo e(__('Delete')); ?>"
                                        data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                        data-confirm-yes="document.getElementById('delete-form-<?php echo e($contactgroup->id); ?>').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['contact_groups.destroy', $contactgroup->id], 'id' => 'delete-form-' . $contactgroup->id])); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/crm/contact_group/index.blade.php ENDPATH**/ ?>