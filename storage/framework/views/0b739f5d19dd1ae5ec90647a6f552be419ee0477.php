<?php $__env->startSection('title'); ?>
    <?php echo e(__('Age Profile')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="<?php echo e(__('Download')); ?>">
            <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
        </a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div id="age_profile">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0"><?php echo e(__(' User Age Breakdown by Department')); ?></h6>
                </div>
            </div>
            <canvas id="canvas" height="200" width="600"></canvas>
        </div>
    </div>
    <div class="card-wrapper mt-3">
        <!-- Files -->
        <div class="table-responsive mt-3">
            <table class="table align-items-center">
                <thead>
                    <tr>
                        <th scope="col" class="sort" data-sort="status"><?php echo e(__('Department')); ?></th>
                        <th scope="col" class="sort" data-sort="status"><?php echo e(__('Under 18 year')); ?></th>
                        <th scope="col" class="sort" data-sort="status"><?php echo e('18' . __('To') .'25'. __('Year')); ?></th>
                        <th scope="col" class="sort" data-sort="status"><?php echo e('26' . __('To') .'35'. __('Year')); ?></th>
                        <th scope="col" class="sort" data-sort="status"><?php echo e('36' . __('To') .'45'. __('Year')); ?></th>
                        <th scope="col" class="sort" data-sort="status"><?php echo e('46' . __('To') .'55'. __('Year')); ?></th>
                        <th scope="col" class="sort" data-sort="status"><?php echo e('56' . __('To') .'65'. __('Year')); ?></th>
                        <th scope="col" class="sort" data-sort="status"><?php echo e('65+'. __('Year')); ?></th>
                    </tr>
                </thead>
                <tbody class="list">
                    <?php if(count($arrResponse) > 0): ?>
                        <?php $__currentLoopData = $arrResponse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($key); ?></td>
                                <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <td><?php echo e($v); ?></td>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
window.onload = function() {
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
                labels: <?php echo json_encode($arrChart['labels']); ?>,
                datasets: <?php echo json_encode($arrChart['data']); ?>

            },
            options: {
                        scales: {
                            xAxes: [{
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
        var element = document.getElementById('age_profile');
        var opt = {
            margin: 0.3,
            filename: 'age_profile_report',
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 4, dpi: 72, letterRendering: true},
            jsPDF: {unit: 'in', format: 'A2'}
        };
        html2pdf().set(opt).from(element).save();
    }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/hr/reports/age_profile.blade.php ENDPATH**/ ?>