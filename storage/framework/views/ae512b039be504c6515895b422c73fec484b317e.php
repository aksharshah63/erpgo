<?php $__env->startSection('title'); ?>
    <?php echo e(__('Ledger Summary')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/html2pdf.bundle.min.js')); ?>"></script>
    <script>
        var filename = $('#filename').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {type: 'jpeg', quality: 1},
                html2canvas: {scale: 4, dpi: 72, letterRendering: true},
                jsPDF: {unit: 'in', format: 'A2'}
            };
            html2pdf().set(opt).from(element).save();
        }

    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="col-md-6">
        <?php echo e(Form::open(array('route' => array('report.ledger'),'method' => 'GET','id'=>'report_ledger'))); ?>

        <div class="row">
            <div class="col-md-3">
                <div class="all-select-box">
                    <div class="btn-box">
                        <?php echo e(Form::label('start_date', __('Start Date'),['class'=>'text-xs text-primary'])); ?>

                        <?php echo e(Form::date('start_date',$filter['startDateRange'], array('class' => 'form-control'))); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="all-select-box">
                    <div class="btn-box">
                        <?php echo e(Form::label('end_date', __('End Date'),['class'=>'text-xs text-primary'])); ?>

                        <?php echo e(Form::date('end_date',$filter['endDateRange'], array('class' => 'form-control'))); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="all-select-box">
                    <div class="btn-box">
                        <?php echo e(Form::label('account', __('Account'),['class'=>'text-xs text-primary'])); ?>

                        <?php echo e(Form::select('account',$accounts,isset($_GET['account'])?$_GET['account']:'', array('class' => 'form-control select2'))); ?>

                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-4">
                <a href="#" class="apply-btn" onclick="document.getElementById('report_ledger').submit(); return false;" data-toggle="tooltip" data-original-title="<?php echo e(__('Apply')); ?>">
                    <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
                </a>
                <a href="<?php echo e(route('report.ledger')); ?>" class="reset-btn" data-toggle="tooltip" data-original-title="<?php echo e(__('Reset')); ?>">
                    <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
                </a>
                <a href="#" class="action-btn" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="<?php echo e(__('Download')); ?>">
                    <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
                </a>
            </div>
        </div>
        <?php echo e(Form::close()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="printableArea">
        <div class="row mt-4">
            <div class="col">
                <input type="hidden" value="<?php echo e(__('Ledger').' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange']); ?>" id="filename">
                <div class="card p-4 mb-4">
                    <span class="h6 font-weight mb-0 "><?php echo e(__("Report")); ?> : </span>
                    <h6 class="text-muted mb-1"><?php echo e(__('Ledger Summary')); ?></h6>
                </div>
            </div>

            <div class="col">
                <div class="card p-4 mb-4">
                    <span class="h6 font-weight mb-0 "><?php echo e(__('Duration')); ?> :</span>
                    <h6 class="text-muted mb-1"><?php echo e($filter['startDateRange'].' to '.$filter['endDateRange']); ?></h6>
                </div>
            </div>
        </div>
        <?php if(!empty($account)): ?>
            <div class="row mt-4">
                <div class="col">
                    <div class="card p-4 mb-4">
                        <span class="h6 font-weight mb-0 "><?php echo e(__('Account Name')); ?> :</span>
                        <h6 class="text-muted mb-1"><?php echo e($account->name); ?></h6>
                    </div>
                </div>

                <div class="col">
                    <div class="card p-4 mb-4">
                        <span class="h6 font-weight mb-0 "><?php echo e(__('Account Code')); ?> :</span>
                        <h6 class="text-muted mb-1"><?php echo e($account->code); ?></h6>
                    </div>
                </div>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <span class="h6 font-weight mb-0 "><?php echo e(__('Total Debit')); ?> :</span>
                        <h6 class="text-muted mb-1"><?php echo e(\Auth::user()->priceFormat($filter['debit'])); ?></h6>
                    </div>
                </div>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <span class="h6 font-weight mb-0 "><?php echo e(__('Total Credit')); ?> :</span>
                        <h6 class="text-muted mb-1"><?php echo e(\Auth::user()->priceFormat($filter['credit'])); ?></h6>
                    </div>
                </div>

                <div class="col">
                    <div class="card p-4 mb-4">
                        <span class="h6 font-weight mb-0 "><?php echo e(__('Balance')); ?> :</span>
                        <h6 class="text-muted mb-1"><?php echo e(($filter['balance']>0)?__('Cr').'. '.\Auth::user()->priceFormat(abs($filter['balance'])):__('Dr').'. '.\Auth::user()->priceFormat(abs($filter['balance']))); ?></h6>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row mb-4">
            <div class="col-12 mb-4">
                <table class="table table-flush">
                    <thead>
                    <tr>
                        <th> #</th>
                        <th> <?php echo e(__('Transaction Date')); ?></th>
                        <th> <?php echo e(__('Create At')); ?></th>
                        <th> <?php echo e(__('Description')); ?></th>
                        <th> <?php echo e(__('Debit')); ?></th>
                        <th> <?php echo e(__('Credit')); ?></th>
                        <th> <?php echo e(__('Balance')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $balance=0;$debit=0;$credit=0; ?>
                    <?php if(count($journalItems) > 0): ?>
                        <?php $__currentLoopData = $journalItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="Id">
                                    <a href="<?php echo e(route('journal_entries.show',$item->journal)); ?>"><?php echo e(AUth::user()->journalNumberFormat($item->journal_id)); ?></a>
                                </td>

                                <td><?php echo e(\App\Utility::getDateFormated($item->transaction_date)); ?></td>
                                <td><?php echo e(\App\Utility::getDateFormated($item->created_at)); ?></td>
                                <td><?php echo e(!empty($item->description)?$item->description:'-'); ?></td>
                                <td><?php echo e(\Auth::user()->priceFormat($item->debit)); ?></td>
                                <td><?php echo e(\Auth::user()->priceFormat($item->credit)); ?></td>
                                <td>
                                    <?php if($item->debit>0): ?>
                                        <?php $debit+=$item->debit ?>
                                    <?php else: ?>
                                        <?php $credit+=$item->credit ?>
                                    <?php endif; ?>

                                    <?php $balance= $credit-$debit ?>
                                    <?php if($balance>0): ?>
                                        <?php echo e(__('Cr').'. '.\Auth::user()->priceFormat($balance)); ?>


                                    <?php elseif($balance<0): ?>
                                        <?php echo e(__('Dr').'. '.\Auth::user()->priceFormat(abs($balance))); ?>

                                    <?php else: ?>
                                        <?php echo e(__(\Auth::user()->priceFormat(0))); ?>

                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center"><?php echo e(__('No Data Founds')); ?></td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/accounting/report/ledger_summary.blade.php ENDPATH**/ ?>