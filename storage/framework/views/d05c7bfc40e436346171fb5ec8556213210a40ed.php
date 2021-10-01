<?php echo e(Form::open(['url' => 'leave_requests', 'method' => 'post'])); ?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('user', __('User'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::select('user', $userList, null, ['class' => 'form-control main-element', 'id' => 'user', 'required' => 'required'])); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('from', __('From'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('from', null, ['class' => 'form-control', 'id' => 'from', 'required' => 'required'])); ?>

        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('to', __('To'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('to', null, ['class' => 'form-control', 'id' => 'to', 'required' => 'required'])); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('reason', __('Reason'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::textarea('reason', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50', 'required' => 'required'])); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            <?php echo e(Form::label('note', __('Note'), ['class' => 'form-control-label'])); ?><span class="text-danger text-sm"><p><?php echo e(__('Sunday Is Not Count In Your Leave')); ?></p></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 pt-5 text-right">
        <?php echo e(Form::hidden('days', null, ['class' => 'form-control datepicker', 'id' => 'days'])); ?>

        <?php echo e(Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill'])); ?>

    </div>
</div>
<?php echo Form::close(); ?>

<?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/hr/leave_management/leave_request/create.blade.php ENDPATH**/ ?>