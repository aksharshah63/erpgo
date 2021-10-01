<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Bank Transfer')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Bank Transfer')): ?>
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="<?php echo e(__('Add New Bank Transfer')); ?>" data-size='md' data-url="<?php echo e(route('transfers.create')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Date')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('From  Account')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('To  Account')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Amount')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Reference')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Description')); ?></th>
                <?php if(Gate::check('Edit Bank Transfer') || Gate::check('Delete Bank Transfer')): ?>
                    <th><?php echo e(__('Action')); ?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody class="list">
            <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank_transfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(Utility::getDateFormated($bank_transfer->date)); ?></td>
                    <td><?php echo e(!empty($bank_transfer->fromBankAccount())? $bank_transfer->fromBankAccount()->bank_name.' '.$bank_transfer->fromBankAccount()->holder_name:''); ?></td>
                    <td><?php echo e(!empty( $bank_transfer->toBankAccount())? $bank_transfer->toBankAccount()->bank_name.' '. $bank_transfer->toBankAccount()->holder_name:''); ?></td>
                    <td><?php echo e(number_format($bank_transfer->amount,2)); ?></td>
                    <td><?php echo e(!empty($bank_transfer->reference) ? $bank_transfer->reference :'-'); ?></td>
                    <td><?php echo e(!empty($bank_transfer->description) ? $bank_transfer->description : '-'); ?></td>
                    <?php if(Gate::check('Edit Bank Transfer') || Gate::check('Delete Bank Transfer')): ?>
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Bank Transfer')): ?>
                                    <a href="#" class="action-item"
                                        data-url="<?php echo e(route('transfers.edit', $bank_transfer->id)); ?>" data-ajax-popup="true"
                                        data-title="<?php echo e(__('Edit Bank Transfer')); ?>" data-toggle="tooltip"
                                        data-original-title="<?php echo e(__('Edit')); ?>" data-size='md'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Bank Transfer')): ?>
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="<?php echo e(__('Delete')); ?>"
                                        data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                        data-confirm-yes="document.getElementById('delete-form-<?php echo e($bank_transfer->id); ?>').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['transfers.destroy', $bank_transfer->id], 'id' => 'delete-form-' . $bank_transfer->id])); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/accounting/bank_transfer/index.blade.php ENDPATH**/ ?>