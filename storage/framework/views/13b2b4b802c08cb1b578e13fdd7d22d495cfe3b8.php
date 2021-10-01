<?php $__env->startSection('title'); ?>
    <?php echo e(__('Income Summary')); ?>

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
            <?php echo e(Form::open(array('route' => array('income.summary.report'),'method' => 'GET','id'=>'report_income_summary'))); ?>

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
        <div class="col-auto my-auto">
            <a href="#" class="apply-btn" onclick="document.getElementById('report_income_summary').submit(); return false;" data-toggle="tooltip" data-original-title="<?php echo e(__('Apply')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="<?php echo e(route('income.summary.report')); ?>" class="reset-btn" data-toggle="tooltip" data-original-title="<?php echo e(__('Reset')); ?>">
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
                <input type="hidden" value="<?php echo e($filter['category'].' '.__('Income Summary').' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange']); ?>" id="filename">
                <div class="card p-4 mb-4">
                    <span class="h6 font-weight mb-0 "><?php echo e(__('Report')); ?> :</span>
                    <h6 class="text-muted mb-1"><?php echo e(__('Income Summary')); ?></h6>
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
                                    <th><?php echo e(__('Category')); ?></th>
                                    <?php $__currentLoopData = $monthList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th><?php echo e($month); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="13" class="text-dark"><span>Invoice :</span></td>
                                </tr>
                                <?php $__currentLoopData = $invoiceArray; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($invoice['category']); ?></td>
                                        <?php $__currentLoopData = $invoice['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e(\Auth::user()->priceFormat($data)); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td colspan="13" class="text-dark"><span>Income = Invoice</span></td>
                                </tr>
                                <tr>
                                    <td class="text-dark"><?php echo e(__('Total')); ?></td>
                                    <?php $__currentLoopData = $chartIncomeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td><?php echo e(\Auth::user()->priceFormat($income)); ?></td>
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
    data: <?php echo json_encode($chartIncomeArr); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/accounting/report/income_summary.blade.php ENDPATH**/ ?>