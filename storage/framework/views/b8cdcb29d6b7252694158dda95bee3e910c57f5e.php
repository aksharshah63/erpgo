<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Payment Method')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
            data-title="<?php echo e(__('Add New Payment Method')); ?>" data-size='md' data-url="<?php echo e(route('payment_methods.create')); ?>">
            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Name')); ?></th>
                <th><?php echo e(__('Action')); ?></th>
            </tr>
        </thead>
        <tbody class="list">
            <?php if(count(Auth::user()->payment_methods) > 0): ?>
                <?php $__currentLoopData = Auth::user()->payment_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($payment_method->name); ?></td>
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                <a href="#" class="action-item"
                                    data-url="<?php echo e(route('payment_methods.edit', $payment_method->id)); ?>" data-ajax-popup="true"
                                    data-title="<?php echo e(__('Edit Payment Method')); ?>" data-toggle="tooltip"
                                    data-original-title="<?php echo e(__('Edit')); ?>" data-size='md'>
                                    <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                </a>
                                <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                    data-original-title="<?php echo e(__('Delete')); ?>"
                                    data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                    data-confirm-yes="document.getElementById('delete-form-<?php echo e($payment_method->id); ?>').submit();">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['payment_methods.destroy', $payment_method->id], 'id' => 'delete-form-' . $payment_method->id])); ?>

                                <?php echo e(Form::close()); ?>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr class="font-style">
                    <td colspan="6" class="text-center">
                        <h6 class="text-center"><?php echo e(__('No Payment Methods Found.')); ?></h6>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/accounting/payment_method/index.blade.php ENDPATH**/ ?>