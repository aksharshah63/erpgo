<div class="modal-dialog modal-vertical modal-lg side-modal" role="document" id="<?php echo e($task->id); ?>">
    <div class="modal-content">
        <div class="modal-header">
            <div class="col d-flex align-items-center">
                <div class="custom-control custom-checkbox mt-n1">
                    <input type="checkbox" class="custom-control-input" id="complete_task" <?php if($task->is_complete == 1): ?> checked <?php endif; ?> data-url="<?php echo e(route('change.complete',[$task->project_id,$task->id])); ?>">
                    <label class="custom-control-label" for="complete_task"></label>
                </div>
                <h6 class="mb-0"><?php echo e($task->name); ?></h6>
            </div>
            <div class="col-auto">
                <div class="actions text-right">
                    <div class="float-left">
                        <a href="#" class="action-item <?php echo e(($task->is_favourite) ? 'action-favorite' : ''); ?> active" data-url="<?php echo e(route('change.fav',[$task->project_id,$task->id])); ?>" id="add_favourite" data-toggle="tooltip" data-original-title="<?php echo e(__('Mark as favorite')); ?>">
                            <i class="fas fa-star"></i>
                        </a>
                    </div>
                    <div class="priority-color float-right">
                        <div class="colorPickSelector" style="background-color: <?php echo e($task->priority_color); ?>"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="scrollbar-inner">
            <div class="modal-body">
                <div class="row mb-4 align-items-center">
                    <div class="col-6">
                        <label class="form-control-label mb-0">
                            <?php echo e(__('See Detail')); ?>

                        </label>
                    </div>
                    <div class="col-6 text-right">
                        <a href="#" class="btn btn-xs btn-secondary btn-icon rounded-pill" data-toggle="collapse" data-target="#overview">
                            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                        </a>
                    </div>
                </div>
                <div id="overview" class="collapse">
                    <b><?php echo e(__('Estimated Hours')); ?></b> : <span><?php echo e((!empty($task->estimated_hrs)) ? number_format($task->estimated_hrs) : '-'); ?></span> <br>
                    <b><?php echo e(__('Milestone')); ?></b> : <span><?php echo e((!empty($task->milestone)) ? $task->milestone->title : '-'); ?></span> <br>
                    <b><?php echo e(__('Description')); ?></b> <br> <span><?php echo e((!empty($task->description)) ? $task->description : '-'); ?></span>
                </div>
                <hr/>
                <?php if($allow_progress == 'false'): ?>
                    <div class="row align-items-center">
                        <div class="col-12 pb-2">
                            <label class="form-control-label mb-0">
                                <?php echo e(__('Task Progress')); ?> : <b id="t_percentage"><?php echo e($task->progress); ?></b>%
                            </label>
                        </div>
                        <div class="col-12">
                            <div id="progress-result" class="tab-pane tab-example-result fade show active" role="tabpanel" aria-labelledby="progress-result-tab">
                                <input type="range" class="task_progress custom-range" value="<?php echo e($task->progress); ?>" id="task_progress" name="progress" data-url="<?php echo e(route('change.progress',[$task->project_id,$task->id])); ?>">
                            </div>
                        </div>
                    </div>
                    <hr/>
                <?php endif; ?>
                <div class="row mb-4 align-items-center">
                    <div class="col-6">
                        <label class="form-control-label mb-0">
                            <?php echo e(__('Checklist')); ?>

                        </label>
                    </div>
                    <div class="col-6 text-right">
                        <a href="#" class="btn btn-xs btn-secondary btn-icon rounded-pill" data-toggle="collapse" data-target="#form-checklist">
                            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                            <span class="btn-inner--text"><?php echo e(__('Add item')); ?></span>
                        </a>
                    </div>
                </div>
                <div class="checklist" id="checklist">
                    <form method="post" id="form-checklist" class="collapse pb-2" data-action="<?php echo e(route('checklist.store',[$task->project_id,$task->id])); ?>">
                        <div class="card border shadow-none">
                            <div class="px-3 py-2 row align-items-center">
                                <div class="col-10">
                                    <input type="text" name="name" required class="form-control" placeholder="<?php echo e(__('Checklist Name')); ?>"/>
                                </div>
                                <div class="col-2 card-meta d-inline-flex align-items-center">
                                    <button class="btn btn-primary btn-xs" type="submit" id="checklist_submit">
                                        <i class="fas fa-plus "></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php $__currentLoopData = $task->checklist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $checklist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card border shadow-none checklist-member">
                            <div class="px-3 py-2 row align-items-center">
                                <div class="col-10">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="check-item-<?php echo e($checklist->id); ?>" <?php if($checklist->status): ?> checked <?php endif; ?> data-url="<?php echo e(route('checklist.update',[$task->project_id,$checklist->id])); ?>">
                                        <label class="custom-control-label h6 text-sm" for="check-item-<?php echo e($checklist->id); ?>"><?php echo e($checklist->name); ?></label>
                                    </div>
                                </div>
                                <div class="col-auto card-meta d-inline-flex align-items-center ml-sm-auto">
                                    <a href="#" class="action-item delete-checklist" data-url="<?php echo e(route('checklist.destroy',[$task->project_id,$checklist->id])); ?>">
                                        <i class="fas fa-trash-alt text-danger"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <hr/>
                <div class="row mb-4 align-items-center">
                    <div class="col-6">
                        <label class="form-control-label mb-0"><?php echo e(__('Attachments')); ?></label>
                    </div>
                    <div class="col-6 text-right">
                        <a href="#" class="btn btn-xs btn-secondary btn-icon rounded-pill" data-toggle="collapse" data-target="#add_file">
                            <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                            <span class="btn-inner--text"><?php echo e(__('Add item')); ?></span>
                        </a>
                    </div>
                </div>
                <div class="card mb-3 border shadow-none collapse" id="add_file">
                    <div class="card border-0 shadow-none mb-0">
                        <div class="px-3 py-2 row align-items-center">
                            <div class="col-10">
                                <input type="file" name="task_attachment" id="task_attachment" required class="custom-input-file"/>
                                <label for="task_attachment">
                                    <i class="fa fa-upload"></i>
                                    <span class="attachment_text"><?php echo e(__('Choose a file…')); ?></span>
                                </label>
                            </div>
                            <div class="col-2 card-meta d-inline-flex align-items-center">
                                <button class="btn btn-primary btn-xs" type="submit" id="file_submit" data-action="<?php echo e(route('comment.store.file',[$task->project_id,$task->id])); ?>">
                                    <i class="fas fa-plus "></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="comments-file">
                    <?php $__currentLoopData = $task->taskFiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card mb-3 border shadow-none task-file">
                            <div class="px-3 py-3">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <img src="<?php echo e(asset('assets/img/icons/files/'.$file->extension.'.png')); ?>" class="img-fluid" style="width: 40px;">
                                    </div>
                                    <div class="col ml-n2">
                                        <h6 class="text-sm mb-0">
                                            <a href="#"><?php echo e($file->name); ?></a>
                                        </h6>
                                        <p class="card-text small text-muted"><?php echo e($file->file_size); ?></p>
                                    </div>
                                    <div class="col-auto actions">
                                        <a href="<?php echo e(asset(Storage::url('tasks/'.$file->file))); ?>" download class="action-item" role="button">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <?php if(auth()->guard('web')->check()): ?>
                                            <a href="#" class="action-item delete-comment-file" role="button" data-url="<?php echo e(route('comment.destroy.file',[$task->project_id,$task->id,$file->id])); ?>">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <hr/>
                <label class="form-control-label mb-4"><?php echo e(__('Activity')); ?></label>
                <div class="list-group list-group-flush mb-0">
                    <?php $__currentLoopData = $task->activity_log(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <a href="#" class="avatar avatar-sm">
                                        <img <?php echo e($activity->userdetail->img_image); ?> class="avatar avatar-sm rounded-circle">
                                    </a>
                                </div>
                                <div class="col ml-n2">
                                    <span class="text-dark text-sm"><?php echo e(__($activity->log_type)); ?></span>
                                    <a class="d-block h6 text-sm font-weight-light mb-0"><?php echo $activity->getRemark(); ?></a>
                                    <small class="d-block"><?php echo e($activity->created_at->diffForHumans()); ?></small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <hr/>
                <label class="form-control-label mb-4"><?php echo e(__('Comments')); ?></label>
                <div class="list-group list-group-flush mb-0" id="comments">
                    <?php $__currentLoopData = $task->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="list-group-item px-0">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <a href="#" class="avatar avatar-sm rounded-circle">
                                        <img <?php echo e($comment->userdetail->img_image); ?> title="<?php echo e($comment->user->name); ?>" class="avatar avatar-sm rounded-circle">
                                    </a>
                                </div>
                                <div class="col ml-n2">
                                    <p class="d-block h6 text-sm font-weight-light mb-0 text-break"><?php echo e($comment->comment); ?></p>
                                    <small class="d-block"><?php echo e($comment->created_at->diffForHumans()); ?></small>
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="delete-comment" data-url="<?php echo e(route('comment.destroy',[$task->project_id,$task->id,$comment->id])); ?>"><i class="fas fa-trash-alt text-danger"></i></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="col-12 d-flex">
                <div class="pr-3">
                    <img <?php echo e(Auth::user()->userdetail->img_image); ?> title="<?php echo e(Auth::user()->name); ?>" class="avatar rounded-circle avatar-sm">
                </div>
                <form method="post" class="card-comment-box" id="form-comment" data-action="<?php echo e(route('comment.store',[$task->project_id,$task->id])); ?>">
                    <textarea rows="1" class="form-control" name="comment" data-toggle="autosize" placeholder="<?php echo e(__('Add a comment...')); ?>"></textarea>
                </form>
            </div>
            <div class="col-4 col-md-3 text-right">
                <div class="actions">
                    <a href="#" id="comment_submit" class="action-item"><i class="fas fa-paper-plane"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $(".colorPickSelector").colorPick({
            'onColorSelected': function () {
                var task_id = this.element.parents('.side-modal').attr('id');
                var color = this.color;

                if (task_id) {
                    this.element.css({'backgroundColor': color});
                    // $('.task-left .task-list [data-task-id="' + task_id + '"]').parent('li').css({'border-left-color': color});

                    $.ajax({
                        url: '<?php echo e(route('update.task.priority.color')); ?>',
                        method: 'PATCH',
                        data: {
                            'task_id': task_id,
                            'color': color,
                        },
                        success: function (data) {
                            $('.task-list-items').find('#' + task_id).attr('style', 'border-left:2px solid ' + color + ' !important');
                        }
                    });
                }
            }
        });
    });
</script>


<?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/project_task/view.blade.php ENDPATH**/ ?>