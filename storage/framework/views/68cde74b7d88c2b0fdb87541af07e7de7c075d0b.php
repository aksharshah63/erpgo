<dl class="row p-2">
    <div class="col-4">
        <span class="text-sm text-muted p-2"><?php echo e(__('Type')); ?></span>
        <span class="d-block h6 mb-0 p-2"><?php echo e(ucfirst(str_replace('_',' ',$calenderSchedule->type))); ?></span>
    </div>
    <div class="col-4">
        <span class="text-sm text-muted p-2"><?php echo e(__('Date')); ?></span>
        <span class="d-block h6 mb-0 p-2"><?php echo e((isset($calenderSchedule->date) ? $calenderSchedule->date : $calenderSchedule->start_date)); ?></span>
    </div>
    <div class="col-4">
        <span class="text-sm text-muted p-2"><?php echo e(__('Time')); ?></span>
        <span class="d-block h6 mb-0 p-2"><?php echo e((!empty($calenderSchedule->time) ? $calenderSchedule->time : '-')); ?></span>
    </div>
</dl>
<dl class="row p-2">
    <div class="col-12">
        <span class="text-sm text-muted p-2"><?php echo e(__('Texts')); ?></span>
        <span class="d-block h6 mb-0 p-2">
            <?php if(!empty($calenderSchedule->note)): ?>
            <?php echo $calenderSchedule->note; ?>

            <?php else: ?>
                <?php echo e('-'); ?>

            <?php endif; ?>
        </span>
    </div>
</dl>
<?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/crm/calender_schedule/view.blade.php ENDPATH**/ ?>