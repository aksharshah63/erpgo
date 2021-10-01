<?php $__env->startSection('title'); ?>
    <?php echo e($project->project_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Project')): ?>
            <a href="#" class="btn btn-sm btn-icon rounded-pill btn btn-primary"
                data-url="<?php echo e(route('projects.edit', $project->id)); ?>" data-ajax-popup="true"
                data-title="<?php echo e(__('Edit Project')); ?>" data-toggle="tooltip"
                data-original-title="<?php echo e(__('Edit')); ?>" data-size='lg'>
                <span class="btn-inner--icon"><i class="fas fa-edit"></i></i></span>
            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Task')): ?>
            <a href="<?php echo e(route('projects.tasks.index',$project->id)); ?>" class="btn btn-sm btn-icon rounded-pill btn btn-primary">
                <span class="btn-inner--icon"><?php echo e(__('Tasks')); ?></span>
            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Timesheet')): ?>
            <a href="<?php echo e(route('timesheet.index',$project->id)); ?>" class="btn btn-sm btn-icon rounded-pill btn btn-primary">
                <span class="btn-inner--icon"><?php echo e(__('Timesheet')); ?></span>
            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Grant Chart')): ?>
            <a href="<?php echo e(route('projects.gantt',$project->id)); ?>" class="btn btn-sm btn-icon rounded-pill btn btn-primary">
                <span class="btn-inner--icon"><?php echo e(__('Gantt Chart')); ?></span>
            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Expense')): ?>
            <a href="<?php echo e(route('projects.expenses.index',$project->id)); ?>" class="btn btn-sm btn-icon rounded-pill btn btn-primary">
                <span class="btn-inner--icon"><?php echo e(__('Expense')); ?></span>
            </a>
        <?php endif; ?>
        <a href="<?php echo e(route('projects.index')); ?>" class="btn btn-sm rounded-circle btn-icon-only btn btn-primary">
            <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-3 col-sm-6">
            <div class="card card-stats border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-muted mb-1"><?php echo e(__('Task Done')); ?></h6>
                            <span class="h4 font-weight-bold mb-0 "><?php echo e($project_data['task']['done']); ?></span>
                        </div>
                        <div class="col-auto">
                            <div class="progress-circle progress-sm" data-progress="<?php echo e($project_data['task']['percentage']); ?>" data-text="<?php echo e($project_data['task']['percentage']); ?>%" data-color="primary"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <span class="text-sm text-muted"><?php echo e(__('Total Task').' : '.$project_data['task']['total']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="">
                        <div class="row">
                            <div class="col-12">
                                <h6 class="mb-0"><?php echo e($project_data['task_chart']['total']); ?></h6>
                                <span class="text-sm text-muted"><?php echo e(__('Last 7 days task done')); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="w-100 pt-4 pb-5">
                        <div class="spark-chart" data-toggle="spark-chart" data-color="info" data-dataset="<?php echo e(json_encode($project_data['task_chart']['chart'])); ?>"></div>
                    </div>
                    <div class="progress-wrapper mb-3">
                        <small class="progress-label"><?php echo e(__('Day Left')); ?> <span class="text-muted"><?php echo e($project_data['day_left']['day']); ?></span></small>
                        <div class="progress mt-0 height-3">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?php echo e($project_data['day_left']['percentage']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($project_data['day_left']['percentage']); ?>%;"></div>
                        </div>
                    </div>
                    <div class="progress-wrapper">
                        <small class="progress-label"><?php echo e(__('Open Task')); ?> <span class="text-muted"><?php echo e($project_data['open_task']['tasks']); ?></span></small>
                        <div class="progress mt-0 height-3">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?php echo e($project_data['open_task']['percentage']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($project_data['open_task']['percentage']); ?>%;"></div>
                        </div>
                    </div>
                    <div class="progress-wrapper">
                        <small class="progress-label"><?php echo e(__('Completed Milestone')); ?> <span class="text-muted"><?php echo e($project_data['milestone']['total']); ?></span></small>
                        <div class="progress mt-0 height-3">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="<?php echo e($project_data['milestone']['percentage']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($project_data['milestone']['percentage']); ?>%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="text-muted mb-1"><?php echo e(__('Expense')); ?></h6>
                            <span class="h4 font-weight-bold mb-0 "><?php echo e(\Auth::user()->priceFormat($project_data['expense']['total'])); ?></span>
                        </div>
                        <div class="col-auto">
                            <div class="progress-circle progress-sm" data-progress="<?php echo e($project_data['expense']['percentage']); ?>" data-text="<?php echo e($project_data['expense']['percentage']); ?>%" data-color="primary"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <span class="text-sm text-muted"><?php echo e(__('Total Budget').' : '.\Auth::user()->priceFormat($project_data['expense']['total'])); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="mb-0"><?php echo e($project_data['timesheet_chart']['total']); ?></h6>
                            <span class="text-sm text-muted"><?php echo e(__('Last 7 days hours spent')); ?></span>
                        </div>
                    </div>
                    <div class="w-100 pt-4 pb-5">
                        <div class="spark-chart" data-toggle="spark-chart" data-color="warning" data-dataset="<?php echo e(json_encode($project_data['timesheet_chart']['chart'])); ?>"></div>
                    </div>
                    <div class="progress-wrapper mb-3">
                        <small class="progress-label"><?php echo e(__('Total project time spent')); ?> <span class="text-muted"><?php echo e($project_data['time_spent']['total']); ?></span></small>
                        <div class="progress mt-0 height-3">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="<?php echo e($project_data['time_spent']['percentage']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($project_data['time_spent']['percentage']); ?>%;"></div>
                        </div>
                    </div>
                    <div class="progress-wrapper">
                        <small class="progress-label"><?php echo e(__('Allocated hours on task')); ?> <span class="text-muted"><?php echo e($project_data['task_allocated_hrs']['hrs']); ?></span></small>
                        <div class="progress mt-0 height-3">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="<?php echo e($project_data['task_allocated_hrs']['percentage']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($project_data['task_allocated_hrs']['percentage']); ?>%;"></div>
                        </div>
                    </div>
                    <div class="progress-wrapper">
                        <small class="progress-label"><?php echo e(__('User Assigned')); ?> <span class="text-muted"><?php echo e($project_data['user_assigned']['total']); ?></span></small>
                        <div class="progress mt-0 height-3">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="<?php echo e($project_data['user_assigned']['percentage']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($project_data['user_assigned']['percentage']); ?>%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-sm-6">
            <div class="card card-fluid">
                <div class="card-header">
                    <h6 class="mb-0"><?php echo e(__('Project overview')); ?></h6>
                </div>
                <div class="card-body py-3 flex-grow-1">
                    <div class="pb-3 mb-3 border-bottom">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img <?php echo e($project->img_image); ?> class="avatar rounded-circle">
                            </div>
                            <div class="col ml-n2">
                                <div class="progress-wrapper">
                                    <span class="progress-percentage"><small class="font-weight-bold"><?php echo e(__('Completed:')); ?> </small><?php echo e($project->project_progress()['percentage']); ?></span>
                                    <div class="progress progress-xs mt-2">
                                        <div class="progress-bar bg-<?php echo e($project->project_progress()['color']); ?>" role="progressbar" aria-valuenow="<?php echo e($project->project_progress()['percentage']); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($project->project_progress()['percentage']); ?>;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm mb-0">
                        <?php echo e($project->description); ?>

                    </p>
                </div>
                <div class="card-footer py-0 px-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <small><?php echo e(__('Start date')); ?>:</small>
                                    <div class="h6 mb-0"><?php echo e(\App\Utility::getDateFormated($project->start_date)); ?></div>
                                </div>
                                <div class="col-6">
                                    <small><?php echo e(__('End date')); ?>:</small>
                                    <div class="h6 mb-0 <?php echo e((strtotime($project->end_date) < time()) ? 'text-danger' : ''); ?>"><?php echo e(\App\Utility::getDateFormated($project->end_date)); ?></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="mb-0"><?php echo e(__('Members')); ?></h6>
                        </div>
                        <div class="col-auto">
                            <div class="actions">
                                <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-url="<?php echo e(route('invite.project.member.view', $project->id)); ?>" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Add Member')); ?>">
                                    <span class="btn-inner--icon">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <div class="mh-350 min-h-350">
                        <table class="table align-items-center">
                            <tbody class="list" id="project_users">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0"><?php echo e(__('Milestones')); ?> (<?php echo e(count($project->milestones)); ?>)</h6>
                        </div>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Milestone')): ?>
                            <div class="text-right">
                                <a href="#" data-url="<?php echo e(route('project.milestone',$project->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Milestone')); ?>" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary">
                                    <span class="btn-inner--icon">
                                        <i class="fas fa-plus"></i>
                                    </span>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
               
                <div class="mh-350 min-h-350">
                    <div class="list-group list-group-flush">
                        <?php if($project->milestones->count() > 0): ?>
                            <?php $__currentLoopData = $project->milestones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="list-group-item list-group-item-action">
                                <div class="media align-items-center">
                                    <div class="media-body">
                                        <h6 class="text-sm d-block text-limit mb-0"><?php echo e($milestone->title); ?>

                                            <span class="badge badge-pill badge-<?php echo e(\App\Project::$status_color[$milestone->status]); ?>"><?php echo e(__(\App\Project::$project_status[$milestone->status])); ?></span>
                                        </h6>
                                        <span class="d-block text-sm text-muted"><?php echo e($milestone->tasks->count().' '. __('Tasks')); ?></span>
                                    </div>
                                    <div class="media-body text-right">
                                            <a href="#" class="action-item"
                                                data-url="<?php echo e(route('project.milestone.show',$milestone->id)); ?>" data-ajax-popup="true"
                                                data-title="<?php echo e($milestone->title); ?>" data-toggle="tooltip"
                                                data-original-title="<?php echo e(__('View')); ?>" data-size='lg'>
                                                <span class="btn-inner--icon"><i class="fas fa-eye"></i></span>
                                            </a>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Milestone')): ?>
                                            <a href="#" class="action-item"
                                                    data-url="<?php echo e(route('project.milestone.edit',$milestone->id)); ?>" data-ajax-popup="true"
                                                    data-title="<?php echo e(__('Edit Milestone')); ?>" data-toggle="tooltip"
                                                    data-original-title="<?php echo e(__('Edit')); ?>" data-size='md'>
                                                    <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Milestone')): ?>

                                            <a href="#" class="action-item text-danger" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?')); ?>|<?php echo e(__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($milestone->id); ?>').submit();">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['project.milestone.destroy', $milestone->id],'id'=>'delete-form-'.$milestone->id]); ?>

                                            <?php echo Form::close(); ?>

                                        <?php endif; ?>
                                    </div>
                                </div>
                            </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="py-5">
                                <h6 class="h6 text-center"><?php echo e(__('No Milestone Found.')); ?></h6>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0"><?php echo e(__('Attachments')); ?></h6>
                                <small><?php echo e(__('Attachment that uploaded in this project')); ?></small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="scrollbar-inner">
                        <div class="mh-500 min-h-500">
                            <?php if($project->projectAttachments()->count() > 0): ?>
                                <?php $__currentLoopData = $project->projectAttachments(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card mb-3 border shadow-none">
                                        <div class="px-3 py-3">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img src="<?php echo e(asset('assets/img/icons/files/'.$attachment->extension.'.png')); ?>" class="img-fluid" style="width: 40px;">
                                                </div>
                                                <div class="col ml-n2">
                                                    <h6 class="text-sm mb-0">
                                                        <a href="#"><?php echo e($attachment->name); ?></a>
                                                    </h6>
                                                    <p class="card-text small text-muted"><?php echo e($attachment->file_size); ?></p>
                                                </div>
                                                <div class="col-auto actions">
                                                    <a href="<?php echo e(asset(Storage::url('tasks/'.$attachment->file))); ?>" download class="action-item" role="button">
                                                        <i class="fas fa-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="py-5">
                                    <h6 class="h6 text-center"><?php echo e(__('No Attachments Found.')); ?></h6>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Activity')): ?>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('Activity Log')); ?></h6>
                                    <small><?php echo e(__('Activity Log of this project')); ?></small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="scrollbar-inner">
                            <div class="mh-500 min-h-500">
                                <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                                    <?php $__currentLoopData = $project->activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="timeline-block">
                                            <span class="timeline-step timeline-step-sm bg-dark border-dark text-white">
                                                <i class="fas <?php echo e($activity->logIcon($activity->log_type)); ?>"></i>
                                            </span>
                                            <div class="timeline-content">
                                                <span class="text-dark text-sm"><?php echo e(__($activity->log_type)); ?></span>
                                                <a class="d-block h6 text-sm mb-0"><?php echo $activity->getRemark(); ?></a>
                                                <small><i class="fas fa-clock mr-1"></i><?php echo e($activity->created_at->diffForHumans()); ?></small>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
<script>
    $(document).ready(function () {
            loadProjectUser();
        $(document).on('click', '.invite_usr', function () {
            var project_id = $('#project_id').val();
            var user_id = $(this).attr('data-id');

            $.ajax({
                url: '<?php echo e(route('invite.project.user.member')); ?>',
                method: 'POST',
                dataType: 'json',
                data: {
                    'project_id': project_id,
                    'user_id': user_id,
                },
                success: function (data) {
                    if (data.code == '200') {
                        //$('#commonModal').modal('hide');
                        show_toastr(data.status, data.success, 'success')
                        setInterval('location.reload()', 5000); 
                        loadProjectUser();
                        //if ($('#project_users').length > 0) {
                        //     loadProjectUser();
                        // } else {
                        //     ajaxFilterProjectView('created_at-desc', $('#project_keyword').val());
                        // }
                    } else if (data.code == '404') {
                        show_toastr(data.status, data.errors, 'error')
                    }
                }
            });
        });
    });

    function loadProjectUser() {
            var mainEle = $('#project_users');
            var project_id = '<?php echo e($project->id); ?>';

            $.ajax({
                url: '<?php echo e(route('project.user')); ?>',
                data: {project_id: project_id},
                beforeSend: function () {
                    $('#project_users').html('<tr><th colspan="2" class="h6 text-center pt-5"><?php echo e(__('Loading...')); ?></th></tr>');
                },
                success: function (data) {
                    mainEle.html(data.html);
                    $('[id^=fire-modal]').remove();
                    loadConfirm();
                }
            });
        }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/projects/view.blade.php ENDPATH**/ ?>