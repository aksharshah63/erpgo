<?php $__env->startSection('content'); ?>

<div class="card">
    <div class="task-stage-repeater" data-value="<?php echo e(json_encode($task_stages)); ?>">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h5 class="h6 mb-0"><?php echo e(__('Task Stage')); ?></h5>
                </div>
                <div class="col-md-6 text-right">
                    <div class="actions" data-repeater-create>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Task Stage')): ?>
                            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary">
                                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <?php echo e(Form::open(['route' => ['task_stages.store']])); ?>

            <table class="table align-items-center table-hover task-stages-list" width="100%" data-repeater-list="stages">
                <tbody>
                <tr data-repeater-item class="main-stage-tr">
                    <td class="stage-input">
                        <input type="hidden" name="id"/>
                        <input type="text" name="name" class="form-control repeater-input" required/>
                    </td>
                    <td class="stage-move text-right"><i class="fas fa-arrows-alt task-sort-handler"></i></td>
                    <td class="stage-remove text-right">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Task Stage')): ?>
                            <button type="button" class="btn close stage-remove-button" data-type="tasks">
                                <span aria-hidden="true"><i class="fas fa-trash-alt text-danger text-sm"></i></span>
                            </button>
                        <?php endif; ?>
                        <button data-repeater-delete type="button" class="btn close trigger-close-button d-none" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="stage-save-button text-right mb-4 mr-4">
                <button type="submit" class="btn btn-sm btn-primary rounded-pill"><?php echo e(__('Save')); ?></button>
            </div>
            <?php echo e(Form::close()); ?>

        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/jquery-ui.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/repeater.js')); ?>"></script>
    <script>
        var $taskDragAndDrop = $("body .task-stage-repeater tbody").sortable({
            handle: '.task-sort-handler'
        });

        var $taskRepeater = $('.task-stage-repeater').repeater({
            initEmpty: true,
            defaultValues: {},
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },
            ready: function (setIndexes) {
                $taskDragAndDrop.on('drop', setIndexes);
            },
            isFirstItemUndeletable: true
        });

        var value = JSON.parse($(".task-stage-repeater").attr('data-value'));
        if (typeof value != 'undefined' && value.length > 0) {
            $taskRepeater.setList(value);
        }

        $(document).on('click', '.stage-remove-button', function (e) {
            e.preventDefault();

            var ele = $(this);
            var stage_id = ele.parents('.main-stage-tr').children('.stage-input').find('input')[0].value;

            if (!stage_id) {
                ele.next('button').trigger('click');
            } else {
                var stages = ele.attr('data-type');
                var url = '<?php echo e(route('stage.tasks', '__stage_id')); ?>'.replace('__stage_id', stage_id);

                $.ajax({
                    url: url,
                    success: function (data) {
                        if (data == 0) {
                            if (confirm('<?php echo e(__("Are you sure you want to delete this stage?")); ?>')) {
                                ele.next('button').trigger('click');
                            }
                        } else {
                            alert('<?php echo e(__("There is some tasks in this stage. Please move tasks from this stage.")); ?>');
                        }
                    }
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/task_stage/index.blade.php ENDPATH**/ ?>