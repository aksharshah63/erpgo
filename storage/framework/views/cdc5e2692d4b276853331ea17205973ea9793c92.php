<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Accouncements')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Announcement')): ?>
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="<?php echo e(__('Add New Announcement')); ?>" data-size='lg' data-url="<?php echo e(route('announcements.create')); ?>">
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
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Sent To')); ?></th>
                <?php if(Gate::check('Edit Announcement') || Gate::check('Delete Announcement')): ?>
                    <th><?php echo e(__('Action')); ?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody class="list">
            <?php $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(__($announcement->title)); ?></td>
                    <td><?php echo e((!empty($announcement->send_announcement_to) ?  \App\Announcement::$send_announcement_to[$announcement->send_announcement_to] : '-')); ?></td>
                    <?php if(Gate::check('Edit Announcement') || Gate::check('Delete Announcement')): ?>
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Announcement')): ?>
                                    <a href="#" class="action-item"
                                        data-url="<?php echo e(route('announcements.edit', $announcement->id)); ?>" data-ajax-popup="true"
                                        data-title="<?php echo e(__('Edit Announcement')); ?>" data-toggle="tooltip"
                                        data-original-title="<?php echo e(__('Edit')); ?>" data-size='lg'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Announcement')): ?>
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="<?php echo e(__('Delete')); ?>"
                                        data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                        data-confirm-yes="document.getElementById('delete-form-<?php echo e($announcement->id); ?>').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['announcements.destroy', $announcement->id], 'id' => 'delete-form-' . $announcement->id])); ?>

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
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    $(document).on('change', '#send_announcement_to', function() {
        var id = $(this).val();
        $('.annoucement_choise').addClass('d-none');
        $('#'+id).removeClass('d-none');
        $('.select2-dropdown').select2();
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/hr/announcement/index.blade.php ENDPATH**/ ?>