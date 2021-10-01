<?php $__env->startSection('title'); ?>
    <?php echo e(__('Customer Report')); ?>

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
    <div class="card mb-3 border shadow-none">
        <table class="table dataTable" id="customer_report">
            <thead>
                <tr>
                    <th class="border-top-0"><?php echo e(__('Label')); ?></th>
                    <?php $__currentLoopData = array_keys($arr); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th class="border-top-0"><?php echo e(__($item)); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border-top-1 p-3 note-content"><?php echo e(__('All')); ?></td>
                    <?php $__currentLoopData = array_values($arr); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td class="border-top-1 p-3 note-content"><?php echo e(__($item)); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script src="<?php echo e(asset('assets/js/html2pdf.bundle.min.js')); ?>"></script>
<script>
function saveAsPDF() {
    var element = document.getElementById('customer_report');
    var opt = {
        margin: 0.3,
        filename: 'customer_report',
        image: {type: 'jpeg', quality: 1},
        html2canvas: {scale: 4, dpi: 72, letterRendering: true},
        jsPDF: {unit: 'in', format: 'A2'}
    };
    html2pdf().set(opt).from(element).save();
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/crm/report/customer_report.blade.php ENDPATH**/ ?>