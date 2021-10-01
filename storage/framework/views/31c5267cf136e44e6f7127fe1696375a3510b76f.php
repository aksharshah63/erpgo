<?php $__env->startSection('title'); ?>
    <?php echo e(__('Head Count')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="<?php echo e(__('Download')); ?>">
            <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
        </a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="head_count">
    <div class="card">
        <div class="card-body">
            <canvas id="canvas" height="200" width="600"></canvas>
        </div>
    </div>
    <div class="card-wrapper mt-3">
        <div class="table-responsive mt-3">
            <table class="table align-items-center">
                <thead>
                    <tr>
                        <th scope="col" class="sort" data-sort="status"><?php echo e(__('Name')); ?></th>
                        <th scope="col" class="sort" data-sort="status"><?php echo e(__('Hire Date')); ?></th>
                        <th scope="col" class="sort" data-sort="status"><?php echo e(__('Department')); ?></th>
                        <th scope="col" class="sort" data-sort="status"><?php echo e(__('Location')); ?></th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php if(count($userdetails) > 0): ?>
                        <?php $__currentLoopData = $userdetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userdetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><a style="color:#0073aa;" href="<?php echo e(route('users.show', $userdetail->id)); ?>" class="action-item"><?php echo e(ucfirst($userdetail->name)); ?></a></td>
                                <td><?php echo e(!empty($userdetail->date_of_hire) ? \App\Utility::getDateFormated($userdetail->date_of_hire) : '-'); ?></td>
                                <td><?php echo e((!empty($userdetail->userdetail->departmentDesc->title) ?  $userdetail->userdetail->departmentDesc->title : '-')); ?></td>
                                <td><?php echo e(!empty($userdetail->location) ? $userdetail->location : '-'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr class="font-style">
                            <td colspan="6" class="text-center">
                                <h6 class="text-center"><?php echo e(__('No Users Found.')); ?></h6>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('assets/js/Chart.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/html2pdf.bundle.min.js')); ?>"></script>
<script>
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
                    scales: {
                        yAxes: [{
                            ticks: {
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

<script>
    function saveAsPDF() {
        var element = document.getElementById('head_count');
        var opt = {
            margin: 0.3,
            filename: 'head_count_report',
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 4, dpi: 72, letterRendering: true},
            jsPDF: {unit: 'in', format: 'A2'}
        };
        html2pdf().set(opt).from(element).save();
    }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/hr/reports/head_count.blade.php ENDPATH**/ ?>