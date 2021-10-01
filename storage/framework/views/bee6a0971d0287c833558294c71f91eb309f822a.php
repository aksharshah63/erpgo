<?php $__env->startSection('title'); ?>
    <?php echo e(__('Income Vs Expense Summary')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/html2pdf.bundle.min.js')); ?>"></script>
    <script>
        var year = '<?php echo e($currentYear); ?>';
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
<div class="col-xl-8 col-lg-8 col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
    <div class="row d-flex justify-content-end">
        <div class="col">
            <?php echo e(Form::open(array('route' => array('income.vs.expense.summary.report'),'method' => 'GET','id'=>'income_vs_expense_summary'))); ?>

            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('year', __('Year'),['class'=>'text-xs text-primary'])); ?>

                    <?php echo e(Form::select('year',$yearList,isset($_GET['year'])?$_GET['year']:'', array('class' => 'form-control select2'))); ?>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('category', __('Category'),['class'=>'text-xs text-primary'])); ?>

                    <?php echo e(Form::select('category',$category,isset($_GET['category'])?$_GET['category']:'', array('class' => 'form-control select2'))); ?>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('customer', __('Customer'),['class'=>'text-xs text-primary'])); ?>

                    <?php echo e(Form::select('customer',$customer,isset($_GET['customer'])?$_GET['customer']:'', array('class' => 'form-control select2'))); ?>

                </div>
            </div>
        </div>
        <div class="col">
            <div class="all-select-box">
                <div class="btn-box">
                    <?php echo e(Form::label('vendor', __('Vendor'),['class'=>'text-xs text-primary'])); ?>

                    <?php echo e(Form::select('vendor',$vendor,isset($_GET['vendor'])?$_GET['vendor']:'', array('class' => 'form-control select2'))); ?>

                </div>
            </div>
        </div>
        <div class="col-auto my-auto">
            <a href="#" class="apply-btn" onclick="document.getElementById('income_vs_expense_summary').submit(); return false;" data-toggle="tooltip" data-original-title="<?php echo e(__('Apply')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="<?php echo e(route('income.vs.expense.summary.report')); ?>" class="reset-btn" data-toggle="tooltip" data-original-title="<?php echo e(__('Reset')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
            </a>
            <a href="#" class="action-btn" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="<?php echo e(__('Download')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
            </a>
        </div>
    </div>
</div>
    <?php echo e(Form::close()); ?>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div id="printableArea">
        <div class="row mt-3">
            <div class="col">
                <input type="hidden" value="<?php echo e($filter['category'].' '.__('Income Vs Expense Summary').' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange']); ?>" id="filename">
                <div class="card p-4 mb-4">
                    <span class="h6 font-weight mb-0 "><?php echo e(__('Report')); ?> :</span>
                    <h6 class="text-muted mb-1"><?php echo e(__('Income Vs Expense Summary')); ?></h6>
                </div>
            </div>
            <?php if($filter['category']!= __('All')): ?>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <span class="h6 font-weight mb-0 "><?php echo e(__('Category')); ?> :</span>
                        <h6 class="text-muted mb-1"><?php echo e($filter['category']); ?></h6>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($filter['customer']!= __('All')): ?>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <span class="h6 font-weight mb-0 "><?php echo e(__('Customer')); ?> :</span>
                        <h6 class="text-muted mb-1"><?php echo e($filter['customer']); ?></h6>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($filter['vendor']!= __('All')): ?>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <span class="h6 font-weight mb-0 "><?php echo e(__('Vendor')); ?> :</span>
                        <h6 class="text-muted mb-1"><?php echo e($filter['vendor']); ?></h6>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col">
                <div class="card p-4 mb-4">
                    <span class="h6 font-weight mb-0 "><?php echo e(__('Duration')); ?> :</span>
                    <h6 class="text-muted mb-1"><?php echo e($filter['startDateRange'].' to '.$filter['endDateRange']); ?></h6>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12" id="chart-container">
                <div class="card">
                    <div class="card-body">
                        <canvas id="canvas" height="280" width="600"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <table class="table table-striped mb-0" id="dataTable-manual">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Type')); ?></th>
                                    <?php $__currentLoopData = $monthList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th><?php echo e($month); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="13" class="text-dark"><span><?php echo e(__('Income')); ?> : </span></td>
                                </tr>
                                <tr>
                                    <td><?php echo e((__('Invoice'))); ?></td>
                                    <?php $__currentLoopData = $invoiceIncomeTotal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td><?php echo e(\Auth::user()->priceFormat($invoice)); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                <tr>
                                    <td colspan="13" class="text-dark"><span><?php echo e(__('Expense')); ?> : </span></td>
                                </tr>
                                <tr>
                                    <td><?php echo e((__('Payment'))); ?></td>
                                    <?php $__currentLoopData = $paymentExpenseTotal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td><?php echo e(\Auth::user()->priceFormat($payment)); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                <tr>
                                    <td><?php echo e((__('Bill'))); ?></td>
                                    <?php $__currentLoopData = $billExpenseTotal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td><?php echo e(\Auth::user()->priceFormat($bill)); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                <tr>
                                    <td colspan="13" class="text-dark"><span>Profit = Income - Expense</span></td>
                                </tr>
                                <tr>
                                    <td><?php echo e((__('Profit'))); ?></td>
                                    <?php $__currentLoopData = $profit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prft): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td><?php echo e(\Auth::user()->priceFormat($prft)); ?></td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('assets/js/Chart.min.js')); ?>"></script>
<script>
    var ctx = document.getElementById("canvas").getContext("2d");

var data = {
  labels: <?php echo json_encode($monthList); ?>,
  datasets: [{
    pointBackgroundColor: "#011c4b",
    borderColor: "#011c4b",
    fill: false,
    data: <?php echo json_encode($profit); ?>

  }]
};

var myBarChart = new Chart(ctx, {
  type: 'line',
  data: data,
  options: {
    barValueSpacing: 20,
    scales: {
      yAxes: [{
        ticks: {
          min: 0,
        }
      }]
    },
    legend: {
        display: false
    },
    tooltips: {
        callbacks: {
           label: function(tooltipItem) {
                  return tooltipItem.yLabel;
           }
        }
    }
  }
});

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/accounting/report/income_vs_expense_summary.blade.php ENDPATH**/ ?>