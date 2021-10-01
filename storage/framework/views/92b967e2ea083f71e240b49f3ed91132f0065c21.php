<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Leave Requests')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Leave Request')): ?>
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="<?php echo e(__('Add New Leave Request')); ?>" data-size='md' data-url="<?php echo e(route('leave_requests.create')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>


<ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link status active" id="pills-home-tab" data-toggle="pill" href="#pending" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo e(__('Pending').'('.__($pendingstatues).')'); ?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link status" id="pills-profile-tab" data-toggle="pill" href="#approve" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo e(__('Approve').'('.__($approvestatues).')'); ?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link status" id="pills-profile-tab" data-toggle="pill" href="#reject" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo e(__('Reject').'('.__($rejectstatues).')'); ?></a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="table-responsive">
                <table class="table align-items-center dataTable">
                    <thead>
                        <tr>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('User Name')); ?></th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('From')); ?></th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('To')); ?></th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('Reason')); ?></th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?></th>
                            <?php if(Gate::check('Edit Leave Request')): ?>
                                <th><?php echo e(__('Action')); ?></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php $__currentLoopData = $leave_requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave_request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($leave_request->status=='Pending'): ?>
                                <tr>
                                    <td><?php echo e(!empty($leave_request->user->name) ? $leave_request->user->name : '-'); ?></td>
                                    <td><?php echo e(Utility::getDateFormated($leave_request->from)); ?></td>
                                    <td><?php echo e(Utility::getDateFormated($leave_request->to)); ?></td>
                                    <td><?php echo e($leave_request->reason); ?></td>
                                    <td><?php echo e($leave_request->status); ?></td>
                                    <?php if(Gate::check('Edit Leave Request')): ?>
                                        <td>
                                            <!-- Actions -->
                                            <div class="actions ml-12">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Leave Request')): ?>
                                                    <a href="#" class="action-item text-success approve">
                                                        <input type="hidden" value="<?php echo e($leave_request->user_id); ?>">
                                                        <i class="fas fa-check approve" data-toggle="tooltip" data-original-title="<?php echo e(__('Approve')); ?>"></i>
                                                    </a>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Leave Request')): ?>
                                                    <a href="#" class="action-item text-danger danger">
                                                        <input type="hidden" value="<?php echo e($leave_request->user_id); ?>">
                                                        <i class="fas fa-ban danger" data-toggle="tooltip" data-original-title="<?php echo e(__('Reject')); ?>"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
        
            </div>
    </div>
    <div class="tab-pane fade" id="approve" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="table-responsive">
                <table class="table align-items-center dataTable">
                    <thead>
                        <tr>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('User Name')); ?></th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('From')); ?></th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('To')); ?></th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('Reason')); ?></th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?></th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php $__currentLoopData = $leave_requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave_request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($leave_request->status=='Approve'): ?>
                                <tr>
                                    <td><?php echo e(!empty($leave_request->user->name) ? $leave_request->user->name : '-'); ?></td>
                                    <td><?php echo e(Utility::getDateFormated($leave_request->from)); ?></td>
                                    <td><?php echo e(Utility::getDateFormated($leave_request->to)); ?></td>
                                    <td><?php echo e($leave_request->reason); ?></td>
                                    <td><?php echo e($leave_request->status); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
        
            </div>
    </div>
    <div class="tab-pane fade" id="reject" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="table-responsive">
                <table class="table align-items-center dataTable">
                    <thead>
                        <tr>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('User Name')); ?></th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('From')); ?></th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('To')); ?></th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('Reason')); ?></th>
                            <th scope="col" class="sort" data-sort="status"><?php echo e(__('Status')); ?></th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <?php $__currentLoopData = $leave_requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave_request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($leave_request->status=='Reject'): ?>
                                <tr>
                                    <td><?php echo e(!empty($leave_request->user->name) ? $leave_request->user->name : '-'); ?></td>
                                    <td><?php echo e(Utility::getDateFormated($leave_request->from)); ?></td>
                                    <td><?php echo e(Utility::getDateFormated($leave_request->to)); ?></td>
                                    <td><?php echo e($leave_request->reason); ?></td>
                                    <td><?php echo e($leave_request->status); ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
$(document).on('change', '#employee', function() {
    var id = $(this).val();
    $.ajax({
        url: "<?php echo e(url('/get_employee')); ?>",
        data: {
            '_token': "<?php echo e(csrf_token()); ?>",
            'id': id,
        },
        type: "POST",
        success: function(data) {
    
        }
    });
});

$(document).on('click', '.fa-check', function() {
    var id = $(this).prev().val();
    $.ajax({
        url: "<?php echo e(url('/approve_leave')); ?>",
        data: {
            '_token': "<?php echo e(csrf_token()); ?>",
            'id': id,
        },
        type: "POST",
        success: function(data) {
            if(data.is_success == true)
            {
                show_toastr('<?php echo e(__('Success')); ?>', data.msg, 'success');
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }
            else
            {
                show_toastr('<?php echo e(__('Error')); ?>', data.msg, 'errors');
            }
        }
    });
});

$(document).on('click', '.fa-ban', function() {
    var id = $(this).prev().val();
    $.ajax({
        url: "<?php echo e(url('/reject_leave')); ?>",
        data: {
            '_token': "<?php echo e(csrf_token()); ?>",
            'id': id,
        },
        type: "POST",
        success: function(data) {
            if(data.is_success == true)
            {
                show_toastr('<?php echo e(__('Success')); ?>', data.msg, 'success');
                setTimeout(function() {
                    location.reload();
                }, 2000);
            }
            else
            {
                show_toastr('<?php echo e(__('Error')); ?>', data.msg, 'errors');
            }
        }
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/hr/leave_management/leave_request/index.blade.php ENDPATH**/ ?>