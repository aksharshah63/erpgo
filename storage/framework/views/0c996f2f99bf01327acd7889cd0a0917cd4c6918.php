<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Bank Account')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Bank Account')): ?>
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="<?php echo e(__('Add New Bank Account')); ?>" data-size='md' data-url="<?php echo e(route('bank_accounts.create')); ?>">
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
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Bank')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Account Number')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Current Balance')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Contact Number')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Bank Branch')); ?></th>
                <?php if(Gate::check('Edit Bank Account') || Gate::check('Delete Bank Account')): ?>
                    <th><?php echo e(__('Action')); ?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody class="list">
            <?php $__currentLoopData = $bankaccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank_aacount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($bank_aacount->holder_name); ?></td>
                    <td><?php echo e($bank_aacount->bank_name); ?></td>
                    <td><?php echo e($bank_aacount->account_number); ?></td>
                    <td><?php echo e(number_format($bank_aacount->opening_balance,2)); ?></td>
                    <td><?php echo e($bank_aacount->contact_number); ?></td>
                    <td><?php echo e($bank_aacount->bank_address); ?></td>
                    <?php if(Gate::check('Edit Bank Account') || Gate::check('Delete Bank Account')): ?>
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Bank Account')): ?>
                                    <a href="#" class="action-item"
                                        data-url="<?php echo e(route('bank_accounts.edit', $bank_aacount->id)); ?>" data-ajax-popup="true"
                                        data-title="<?php echo e(__('Edit Bank Account')); ?>" data-toggle="tooltip"
                                        data-original-title="<?php echo e(__('Edit')); ?>" data-size='md'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Bank Account')): ?>
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="<?php echo e(__('Delete')); ?>"
                                        data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                        data-confirm-yes="document.getElementById('delete-form-<?php echo e($bank_aacount->id); ?>').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['bank_accounts.destroy', $bank_aacount->id], 'id' => 'delete-form-' . $bank_aacount->id])); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/accounting/bank_account/index.blade.php ENDPATH**/ ?>