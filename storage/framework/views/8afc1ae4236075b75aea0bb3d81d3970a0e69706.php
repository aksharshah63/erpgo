<?php $__env->startSection('title'); ?>
    <?php echo e(__('Gender Profile')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="<?php echo e(__('Download')); ?>">
            <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
        </a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div id="gender_profile">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0"><?php echo e(__('User Gender Count')); ?></h6>
                        </div>
                    </div>
                    <?php if(count($user) > 0): ?>
                        <canvas id="canvas" height="230" width="600"></canvas>
                    <?php else: ?>
                        <h5 class="text-center"><?php echo e(__('User Gender Count Not Found')); ?></h5>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                        <table class="table align-items-center">
                            <thead>
                                <tr>
                                    <th class="border-top-0"><?php echo e(__('Gender')); ?></th>
                                    <th class="border-top-0"><?php echo e(__('Count')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                    <td><?php echo e(__("Male")); ?>

                                    <td><?php echo e($gender['male']); ?>

                            </tr>
                            <tr>
                                    <td><?php echo e(__("Female")); ?>

                                    <td><?php echo e($gender['female']); ?>

                            </tr>
                            <tr>
                                    <td><?php echo e(__("Other")); ?>

                                    <td><?php echo e($gender['other']); ?>

                            </tr>
                            <tr>
                                    <td class="text-dark"><?php echo e(__("Total")); ?>

                                    <td class="text-dark"><?php echo e($gender['total']); ?>

                            </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card-wrapper mt-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="mb-0"><?php echo e(__('User Gender By Department')); ?></h6>
            </div>
        </div>
        <div class="table-responsive mt-3">
            <table class="table align-items-center">
                <thead>
                    <tr>
                        <th class="border-top-0"><?php echo e(__('Department')); ?></th>
                        <th class="border-top-0"><?php echo e(__('Male')); ?></th>
                        <th class="border-top-0"><?php echo e(__('Female')); ?></th>
                        <th class="border-top-0"><?php echo e(__('Other')); ?></th>
                        <th class="border-top-0 text-dark"><?php echo e(__('Total')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($departments) > 0): ?>
                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(ucfirst($department->title)); ?></td>
                                <td><?php echo e($department->Male); ?></td>
                                <td><?php echo e($department->Female); ?></td>
                                <td><?php echo e($department->Other); ?></td>
                                <td class="text-dark"><?php echo e($department->Total); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">
                                <h5 class="text-center"><?php echo e(__('User Gneder By Department Not Found ')); ?></h5>
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
<?php if(count($user) > 0): ?>
    var barChartData = {
        labels: <?php echo json_encode(array_keys($user)); ?>,
        datasets: [{
            backgroundColor: ['#051C4B','#ffc107','#dc3545'],
            data: <?php echo json_encode(array_values($user)); ?>,
        }],
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'doughnut',
            data: barChartData,
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
        });
    };
<?php endif; ?>
</script>

<script>
    function saveAsPDF() {
        var element = document.getElementById('gender_profile');
        var opt = {
            margin: 0.3,
            filename: 'gender_profile_report',
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 4, dpi: 72, letterRendering: true},
            jsPDF: {unit: 'in', format: 'A2'}
        };
        html2pdf().set(opt).from(element).save();
    }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/hr/reports/gender_profile.blade.php ENDPATH**/ ?>