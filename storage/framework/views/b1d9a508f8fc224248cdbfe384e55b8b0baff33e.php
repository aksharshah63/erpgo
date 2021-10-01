<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Chart of Accounts')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Chart of Account')): ?>
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="<?php echo e(__('Add New Chart of Account')); ?>" data-size='md' data-url="<?php echo e(route('chart_of_accounts.create')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php $__currentLoopData = $chartAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type=>$accounts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-12">
                <div class="card-header">
                    <h6><?php echo e($type); ?></h6>
                </div>
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Code')); ?></th>
                                <th> <?php echo e(__('Name')); ?></th>
                                <th> <?php echo e(__('Type')); ?></th>
                                <th> <?php echo e(__('Balance')); ?></th>
                                <th> <?php echo e(__('Status')); ?></th>
                                <?php if(Gate::check('View Chart of Account') || Gate::check('Edit Chart of Account') || Gate::check('Delete Chart of Account')): ?>
                                    <th> <?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td><?php echo e($account->code); ?></td>
                                    <td><?php echo e($account->name); ?></td>
                                    <td><?php echo e(!empty($account->subType)?$account->subType->name:'-'); ?></td>
                                    <td>
                                        <?php if(!empty($account->balance()) && $account->balance()['netAmount']<0): ?>
                                            <?php echo e(__('Dr').'. '.\Auth::user()->priceFormat(abs($account->balance()['netAmount']))); ?>

                                        <?php elseif(!empty($account->balance()) && $account->balance()['netAmount']>0): ?>
                                            <?php echo e(__('Cr').'. '.\Auth::user()->priceFormat($account->balance()['netAmount'])); ?>

                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($account->is_enabled==1): ?>
                                            <span class="badge badge-success"><?php echo e(__('Enabled')); ?></span>
                                        <?php else: ?>
                                            <span class="badge badge-danger"><?php echo e(__('Disabled')); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(Gate::check('View Chart of Account') || Gate::check('Edit Chart of Account') || Gate::check('Delete Chart of Account')): ?>
                                        <td>
                                            <!-- Actions -->
                                            <div class="actions ml-12">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Chart of Account')): ?>
                                                    <a href="<?php echo e(route('report.ledger')); ?>?account=<?php echo e($account->id); ?>" class="action-item" data-toggle="tooltip" data-original-title="<?php echo e(__('Ledger Summary')); ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Chart of Account')): ?>
                                                    <a href="#" class="action-item"
                                                        data-url="<?php echo e(route('chart_of_accounts.edit', $account->id)); ?>" data-ajax-popup="true"
                                                        data-title="<?php echo e(__('Edit Chart of Account')); ?>" data-toggle="tooltip"
                                                        data-original-title="<?php echo e(__('Edit')); ?>" data-size='md'>
                                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Chart of Account')): ?>
                                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                                        data-original-title="<?php echo e(__('Delete')); ?>"
                                                        data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                                        data-confirm-yes="document.getElementById('delete-form-<?php echo e($account->id); ?>').submit();">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['chart_of_accounts.destroy', $account->id], 'id' => 'delete-form-' . $account->id])); ?>

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
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        $(document).on('change', '#type', function () {
            var type = $(this).val();
            $.ajax({
                url: '<?php echo e(route('charofAccount.subType')); ?>',
                type: 'POST',
                data: {
                    "type": type, "_token": "<?php echo e(csrf_token()); ?>",
                },
                success: function (data) {
                    $('#sub_type').empty();
                    $.each(data, function (key, value) {
                        $('#sub_type').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        });

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/accounting/chart_of_account/index.blade.php ENDPATH**/ ?>