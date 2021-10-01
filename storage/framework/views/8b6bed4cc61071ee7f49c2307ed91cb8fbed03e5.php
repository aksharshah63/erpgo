<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Holidays')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Holiday')): ?>
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="<?php echo e(__('Add New Holiday')); ?>" data-size='md' data-url="<?php echo e(route('holidays.create')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Title')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Start Date')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('End Date')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Duration')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Description')); ?></th>
                <?php if(Gate::check('Edit Holiday') || Gate::check('Delete Holiday')): ?>
                    <th><?php echo e(__('Action')); ?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody class="list">
            <?php $__currentLoopData = $holidays; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holiday): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($holiday->holiday_name); ?></td>
                    <td><?php echo e(Utility::getDateFormated($holiday->start_date)); ?></td>
                    <td><?php echo e((!empty($holiday->end_date) ?  Utility::getDateFormated($holiday->end_date) : '-')); ?></td>
                    <td><?php echo e($holiday->days); ?> <?php echo e(__('Days')); ?></td>
                    <td><?php echo e((!empty($holiday->description) ?  $holiday->description : '-')); ?></td>
                    <?php if(Gate::check('Edit Holiday') || Gate::check('Delete Holiday')): ?>
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Holiday')): ?>
                                    <a href="#" class="action-item"
                                        data-url="<?php echo e(route('holidays.edit', $holiday->id)); ?>" data-ajax-popup="true"
                                        data-title="<?php echo e(__('Edit Holiday')); ?>" data-toggle="tooltip"
                                        data-original-title="<?php echo e(__('Edit')); ?>" data-size='md'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Holiday')): ?>
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="<?php echo e(__('Delete')); ?>"
                                        data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                        data-confirm-yes="document.getElementById('delete-form-<?php echo e($holiday->id); ?>').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['holidays.destroy', $holiday->id], 'id' => 'delete-form-' . $holiday->id])); ?>

                                    <?php echo e(Form::close()); ?>

                                <?php endif; ?>
                            </div>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
    $(document).ready(function() {
        $(document).on('change', '.range', function() {
            if ($('.range').is(":checked"))
                $(".enddate").removeClass('d-none');
            else
                $(".enddate").addClass('d-none');
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/hr/leave_management/holiday/index.blade.php ENDPATH**/ ?>