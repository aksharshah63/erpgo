<?php $__env->startSection('title'); ?>
    <?php echo e(__('Activity Report')); ?>

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
        <table class="table dataTable" id="activity_report">
            <thead>
                <tr>
                    <th class="border-top-0" width="95%"><?php echo e(__('Types')); ?></th>
                    <th class="border-top-0" width="5%"><?php echo e(__('Count')); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border-top-1 p-3 note-content"><?php echo e(__('Schedules')); ?></td>
                    <td class="border-top-1 p-3 note-content"><?php echo e(__($schedules)); ?></td>
                </tr>
                <tr>
                    <td class="border-top-1 p-3 note-content"><?php echo e(__('Notes')); ?></td>
                    <td class="border-top-1 p-3 note-content"><?php echo e(__($notes)); ?></td>
                </tr>
                <tr>
                    <td class="border-top-1 p-3 note-content text-dark"><?php echo e(__('Total')); ?></td>
                    <td class="border-top-1 p-3 note-content text-dark"><?php echo e(__($schedules + $notes)); ?></td>
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
    var element = document.getElementById('activity_report');
    var opt = {
        margin: 0.3,
        filename: 'activity_report',
        image: {type: 'jpeg', quality: 1},
        html2canvas: {scale: 4, dpi: 72, letterRendering: true},
        jsPDF: {unit: 'in', format: 'A2'}
    };
    html2pdf().set(opt).from(element).save();
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/crm/report/activity_report.blade.php ENDPATH**/ ?>