<?php $__env->startSection('title'); ?>
    <?php echo e(__('View Activity')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#note" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo e(__('Note')); ?></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#task" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo e(__('Task')); ?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#email" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo e(__('Email')); ?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#log_activity" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo e(__('Log Activity')); ?></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#schedule" role="tab" aria-controls="pills-profile" aria-selected="false"><?php echo e(__('Schedule')); ?></a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="note" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-7 mx-auto">
                        <div class="timeline timeline-two-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                            <?php if(count($results) > 0): ?>
                                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($result)): ?>  
                                        <div class="timeline-block">
                                            <span class="timeline-step timeline-step-sm bg-primary border-primary text-white"><i class="fas fa-file"></i></span>
                                            <div class="timeline-content">
                                                <span class="text-muted text-sm"><?php echo e(__('You Created A Note For')); ?> <?php echo e($result['name']); ?></span>
                                                <a href="#" class="d-block h6 text-sm mb-0"><?php echo $result['note']; ?></a>
                                                <small><i class="far fa-clock mr-1"></i><?php echo e(\App\Utility::getDateFormated($result['created_at'])); ?></small>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                            <?php else: ?>
                                <h5 class="text-center"><?php echo e(__('No Notes Found')); ?></h5>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="task" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-7 mx-auto">
                        <div class="timeline timeline-two-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                            <?php if(count($results1) > 0): ?>
                                <?php $__currentLoopData = $results1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($result)): ?>  
                                        <div class="timeline-block">
                                            <span class="timeline-step timeline-step-sm bg-primary border-primary text-white"><i class="fas fa-tasks"></i></span>
                                            <div class="timeline-content">
                                                <span class="text-muted text-sm"><?php echo e(__('You Created A Task For')); ?> <?php echo e($result['agent_or_manager']); ?></span>
                                                <a href="#" class="d-block h6 text-sm mb-0"><?php echo $result['note']; ?></a>
                                                <small><i class="far fa-clock mr-1"></i><?php echo e(\App\Utility::getDateFormated($result['created_at'])); ?></small>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                            <?php else: ?>
                                <h5 class="text-center"><?php echo e(__('No Tasks Found')); ?></h5>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-7 mx-auto">
                        <div class="timeline timeline-two-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                            <?php if(count($results2) > 0): ?>
                                <?php $__currentLoopData = $results2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($result)): ?>  
                                        <div class="timeline-block">
                                            <span class="timeline-step timeline-step-sm bg-primary border-primary text-white"><i class="fas fa-envelope"></i></span>
                                            <div class="timeline-content">
                                                <span class="text-muted text-sm"><?php echo e(__('You Created A Email For')); ?> <?php echo e($result['email']); ?></span>
                                                <a href="#" class="d-block h6 text-sm mb-0"><?php echo $result['note']; ?></a>
                                                <small><i class="far fa-clock mr-1"></i><?php echo e(\App\Utility::getDateFormated($result['created_at'])); ?></small>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                            <?php else: ?>
                                <h5 class="text-center"><?php echo e(__('No Emails Found')); ?></h5>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="log_activity" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-7 mx-auto">
                        <div class="timeline timeline-two-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                            <?php if(count($results3) > 0): ?>
                                <?php $__currentLoopData = $results3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($result)): ?>  
                                        <div class="timeline-block">
                                            <span class="timeline-step timeline-step-sm bg-primary border-primary text-white"><i class="fas fa-history"></i></span>
                                            <div class="timeline-content">
                                                <span class="text-muted text-sm"><?php echo e(__('You')); ?> <?php echo e(\App\LogActivity::$type[$result['type']]); ?> <?php echo e(__('On')); ?> <?php echo e(\App\Utility::getDateFormated($result['start_date'])); ?> <?php echo e(__('At')); ?> <?php echo e(\App\Utility::timeFormat($result['time'])); ?> <?php echo e(__('For')); ?> <?php echo e($result['name']); ?></span>
                                                <a href="#" class="d-block h6 text-sm mb-0"><?php echo $result['note']; ?></a>
                                                <small><i class="far fa-clock mr-1"></i><?php echo e(\App\Utility::getDateFormated($result['created_at'])); ?></small>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                            <?php else: ?>
                                <h5 class="text-center"><?php echo e(__('No Log Activities Found')); ?></h5>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-7 mx-auto">
                        <div class="timeline timeline-two-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                            <?php if(count($results4) > 0): ?>
                                <?php $__currentLoopData = $results4; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($result)): ?>  
                                        <div class="timeline-block">
                                            <span class="timeline-step timeline-step-sm bg-primary border-primary text-white"><i class="fas fa-calendar"></i></span>
                                            <div class="timeline-content">
                                                <span class="text-muted text-sm"><?php echo e(__('You')); ?> <?php echo e(\App\Schedule::$schedule_type[$result['type']]); ?> <?php echo e(__('On')); ?> <?php echo e(\App\Utility::getDateFormated($result['start_date'])); ?> <?php echo e(__('At')); ?> <?php echo e(\App\Utility::timeFormat($result['time'])); ?> <?php echo e(__('For')); ?> <?php echo e($result['name']); ?></span>
                                                <a href="#" class="d-block h6 text-sm mb-0"><?php echo $result['note']; ?></a>
                                                <small><i class="far fa-clock mr-1"></i><?php echo e(\App\Utility::getDateFormated($result['created_at'])); ?></small>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                            <?php else: ?>
                                <h5 class="text-center"><?php echo e(__('No Schedules Found')); ?></h5>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/crm/activity/view.blade.php ENDPATH**/ ?>