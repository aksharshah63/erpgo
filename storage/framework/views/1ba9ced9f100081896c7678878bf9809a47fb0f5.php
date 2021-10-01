<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Leave Date')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Leave Days')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Leave Reason')); ?></th>
            </tr>
        </thead>
        <tbody class="list">
            <?php $__currentLoopData = $leaveData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(\App\Utility::getDateFormated($leave->from).' - '.\App\Utility::getDateFormated($leave->to)); ?></td>
                    <td><?php echo e(Utility::diffDate($leave->from,$leave->to,true)); ?></td>
                    <td><?php echo e($leave->reason); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/hr/reports/show_leave.blade.php ENDPATH**/ ?>