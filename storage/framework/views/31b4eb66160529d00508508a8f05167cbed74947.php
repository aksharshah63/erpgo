<div class="list-group list-group-flush mb-4">
    <div class="row">
        <?php if(count($users) > 0): ?>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6">
                    <div class="list-group-item px-0">
                        <div class="row align-items-center">
                            <div class="col-auto ml-3">
                                <a href="#" class="avatar avatar-sm rounded-circle">
                                    <img <?php echo e($user->userdetail->img_image); ?> />
                                </a>
                            </div>
                            <div class="col ml-n2">
                                <p class="d-block h6 text-sm mb-0"><?php echo e($user->name); ?></p>
                                <p class="card-text text-sm text-muted mb-0"><?php echo e($user->email); ?></p>
                            </div>
                            <div class="col-auto text-right invite_usr" data-id="<?php echo e($user->id); ?>">
                                <button type="button" class="btn btn-xs btn-animated btn-primary rounded-pill btn-animated-y mr-3">
                                <span class="btn-inner--visible">
                                <i class="fas fa-plus" id="usr_icon_<?php echo e($user->id); ?>"></i>
                                </span>
                                    <span class="btn-inner--hidden" id="usr_txt_<?php echo e($user->id); ?>"><?php echo e(__('Add')); ?></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="col-12 text-center">
                <h5><?php echo e(__('No User Exist')); ?></h5>
            </div>
        <?php endif; ?>
    </div>
    <?php echo e(Form::hidden('project_id', $project_id,['id'=>'project_id'])); ?>

</div><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/projects/invite.blade.php ENDPATH**/ ?>