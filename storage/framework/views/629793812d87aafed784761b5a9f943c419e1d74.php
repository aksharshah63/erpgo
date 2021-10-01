<?php echo e(Form::open(['url' => 'policies', 'method' => 'post'])); ?>

<div class="row">
    <div class="col">
        <div class="form-group">
            <?php echo e(Form::label('policy_name', __('Policy Name'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('policy_name', null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            <?php echo e(Form::label('department', __('Department'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::select('department', $departmentList, null, ['class' => 'form-control main-element'])); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::textarea('description', null, ['class' => 'form-control editor', 'rows' => '4', 'cols' => '50'])); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 pt-5 text-right">
        <?php echo e(Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill'])); ?>

    </div>
</div>
<?php echo Form::close(); ?>

<?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/hr/leave_management/policies/create.blade.php ENDPATH**/ ?>