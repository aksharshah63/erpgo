<?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
        <th scope="row">
            <div class="media align-items-center">
                <div>
                    <img <?php echo e($user->userdetail->img_image); ?> class="avatar rounded-circle avatar-sm">
                </div>
                <div class="media-body ml-3">
                    <a class="name mb-0 h6 text-sm"><?php echo e($user->name); ?></a>
                    <br>
                    <a class="text-sm text-muted"><?php echo e($user->email); ?></a>
                </div>
            </div>
        </th>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/projects/users.blade.php ENDPATH**/ ?>