<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Invoices')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Invoice')): ?>
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-12">
                <div class="all-button-box">
                    <a href="<?php echo e(route('invoices.create')); ?>" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary">
                        <i class="fas fa-plus"></i> <?php echo e(__('Create')); ?>

                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if($invoices->count() > 0): ?>
        <div class="row">
            <div class="col-md-6">
                <h5 class="h5 d-inline-block font-weight-400 mb-4"><?php echo e(__('Status')); ?></h5>
                <div class="card">
                    <div class="card-body">
                        <canvas id="canvas" height="200" width="600"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h5 class="h5 d-inline-block font-weight-400 mb-4"><?php echo e(__('Payment')); ?></h5>
                <div class="card">
                    <div class="card-body">
                        <canvas id="canvas-invoice" height="200" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table align-items-center dataTable">
                    <thead>
                        <tr>
                            <th> <?php echo e(__('Invoice')); ?></th>
                            <th><?php echo e(__('Customer')); ?></th>
                            <th><?php echo e(__('Transaction Date')); ?></th>
                            <th><?php echo e(__('Due Date')); ?></th>
                            <th><?php echo e(__('Due Amount')); ?></th>
                            <th><?php echo e(__('Status')); ?></th>
                            <?php if(Gate::check('Edit Invoice') || Gate::check('Delete Invoice') || Gate::check('View Invoice') || Gate::check('Duplicate Invoice')): ?>
                                <th><?php echo e(__('Action')); ?></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="Id"><a href="<?php echo e(route('invoices.show',$invoice->id)); ?>"><?php echo e(Auth::user()->invoiceNumberFormat($invoice->invoice_id)); ?></a></td>
                                <td> <?php echo e(!empty($invoice->customer)? $invoice->customer->first_name. ' '.$invoice->customer->last_name:''); ?> </td>
                                <td><?php echo e(Utility::getDateFormated($invoice->transaction_date)); ?></td>
                                <td><?php echo e(Utility::getDateFormated($invoice->due_date)); ?></td>
                                <td><?php echo e(\Auth::user()->priceFormat($invoice->getDue())); ?></td>
                                <td>
                                    <?php if($invoice->status == 0): ?>
                                        <span class="badge badge-pill badge-primary"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                    <?php elseif($invoice->status == 1): ?>
                                        <span class="badge badge-pill badge-warning"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                    <?php elseif($invoice->status == 2): ?>
                                        <span class="badge badge-pill badge-danger"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                    <?php elseif($invoice->status == 3): ?>
                                        <span class="badge badge-pill badge-info"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                    <?php elseif($invoice->status == 4): ?>
                                        <span class="badge badge-pill badge-success"><?php echo e(__(\App\Invoice::$statues[$invoice->status])); ?></span>
                                    <?php endif; ?>
                                </td>
                                <?php if(Gate::check('Edit Invoice') || Gate::check('Delete Invoice') || Gate::check('View Invoice') || Gate::check('Duplicate Invoice')): ?>
                                    <td class="Action">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Duplicate Invoice')): ?>
                                            <a href="#" class="action-item" data-toggle="tooltip" data-original-title="<?php echo e(__('Duplicate')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('You want to confirm duplicate this Invoice.').'|'.__('Press Yes to continue or Cancel to go back')); ?>" data-confirm-yes="document.getElementById('duplicate-form-<?php echo e($invoice->id); ?>').submit();">
                                                <i class="fas fa-copy"></i>
                                                <?php echo Form::open(['method' => 'get', 'route' => ['invoice.duplicate', $invoice->id],'id'=>'duplicate-form-'.$invoice->id]); ?>

                                                    <?php echo Form::close(); ?>

                                            </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Invoice')): ?>
                                            <a href="<?php echo e(route('invoices.show',$invoice->id)); ?>" class="action-item" data-toggle="tooltip" data-original-title="<?php echo e(__('Detail')); ?>">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Invoice')): ?>
                                            <a href="<?php echo e(route('invoices.edit',$invoice->id)); ?>" class="action-item" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Invoice')): ?>
                                            <a href="#" class="action-item text-danger " data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This Action Can Not Be Undone. Do You Want To Continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($invoice->id); ?>').submit();">
                                            <i class="fas fa-trash"></i>
                                            </a>
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['invoices.destroy', $invoice->id],'id'=>'delete-form-'.$invoice->id]); ?>

                                            <?php echo Form::close(); ?>

                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('assets/js/Chart.min.js')); ?>"></script>
<script>
    <?php if($invoices->count() > 0): ?>
    var barChartData = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: <?php echo json_encode(array_values($statusCnts)); ?>,
                backgroundColor: ['#051C4B','#ffc107','#dc3545','#17a2b8','#28a745']
            }],
            labels: <?php echo json_encode(array_keys($statusCnts)); ?>

        },
        options:{
            legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        fontColor: '#333',
                        usePointStyle: true,
                    }
                },
        }
    };

    var barChartData1 = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: <?php echo json_encode(array_values($incPercentage)); ?>,
                backgroundColor: ['#051C4B','#ffc107']
            }],
            labels: <?php echo json_encode(array_keys($incPercentage)); ?>

        },
        options:{
            legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        fontColor: '#333',
                        usePointStyle: true,
                    },
                },
        }
    };

    window.onload = function() {
    window.myBar = new Chart(document.getElementById("canvas"), barChartData);
    window.myBar1 = new Chart(document.getElementById("canvas-invoice"), barChartData1);
};
<?php endif; ?>
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/accounting/transaction/sales/invoice/index.blade.php ENDPATH**/ ?>