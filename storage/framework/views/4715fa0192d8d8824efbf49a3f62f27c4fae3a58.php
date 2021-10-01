<?php $__env->startSection('title'); ?>
    <?php echo e(__('Growth Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="<?php echo e(__('Download')); ?>">
            <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
        </a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="card-wrapper">
    <!-- Files -->
    <div class="card mb-3 border shadow-none" id="growth_report">
        <canvas id="canvas" height="280" width="600"></canvas>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('assets/js/html2pdf.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/Chart.min.js')); ?>"></script>
<script>
function saveAsPDF() {
    var element = document.getElementById('growth_report');
    var opt = {
        margin: 0.3,
        filename: 'growth_report',
        image: {type: 'jpeg', quality: 1},
        html2canvas: {scale: 4, dpi: 72, letterRendering: true},
        jsPDF: {unit: 'in', format: 'A2'}
    };
    html2pdf().set(opt).from(element).save();
}

var month = <?php echo json_encode($months); ?>;
var barChartData = {
    labels: month,
    datasets: <?php echo json_encode($arrResponse); ?>

};

window.onload = function() {
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
            barValueSpacing: 20,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            precision: 0
                        }
                    }]
                },
                legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                fontColor: '#333',
                                usePointStyle: true,
                            }
                },
        }
    });
};
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/crm/report/growth_report.blade.php ENDPATH**/ ?>