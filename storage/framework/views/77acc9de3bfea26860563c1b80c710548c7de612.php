<?php echo e(Form::open(['url' => 'schedules', 'method' => 'post'])); ?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('title', __('Title'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('title', null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="customSwitch1">
                <?php echo e(Form::checkbox('all_day', null, false, ['class' => 'custom-control-input all_day','id' => 'all_day'])); ?>

                <?php echo e(Form::label('all_day', 'All Day', ['class' => 'custom-control-label'])); ?>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('start_date', null, ['class' => 'form-control datepicker', 'required' => 'required'])); ?>

        </div>
    </div>
    <div class="col start_time">
        <div class="form-group">
            <?php echo e(Form::label('start_time', __('Time'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::time('start_time', null, ['class' => 'form-control'])); ?>

        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('end_date', null, ['class' => 'form-control datepicker', 'required' => 'required'])); ?>

        </div>
    </div>
    <div class="col end_time">
        <div class="form-group">
            <?php echo e(Form::label('end_time', __('Time'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::time('end_time', null, ['class' => 'form-control'])); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('note', __('Note'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::textarea('note', null, ['class' => 'form-control editor', 'rows' => '4', 'cols' => '50', 'required' => 'required'])); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('agent_or_manager', __('Agent Or Manager'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('agent_or_manager', $contacts, null, ['class' => 'form-control main-element','placeholder' => 'Please Select', 'required' => 'required'])); ?>

        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('schedule_type', __('Schedule Type'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <select name="schedule_type" id="schedule_type" class="form-control main-element" required >
                <option value=""><?php echo e(__('Please Select')); ?></option>
                <?php $__currentLoopData = \App\Schedule::$schedule_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($k); ?>"><?php echo e(__($v)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="customSwitch1">
                <?php echo e(Form::checkbox('all_notification', null, false, ['class' => 'custom-control-input all_notification','id' => 'all_notification'])); ?>

                <?php echo e(Form::label('all_notification', 'All notification', ['class' => 'custom-control-label'])); ?>

            </div>
        </div>
    </div>
</div>
<div class="row notification_allow d-none">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('email', __('Email'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::email('email', null, ['class' => 'form-control'])); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 pt-5 text-right">
        <?php echo e(Form::hidden('type', $type)); ?>

        <?php echo e(Form::hidden('id', $id)); ?>

        <?php echo e(Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill'])); ?>

    </div>
</div>
<?php echo Form::close(); ?>

<?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/crm/schedule/create.blade.php ENDPATH**/ ?>