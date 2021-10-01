<?php echo e(Form::open(['url' => 'emails', 'method' => 'post'])); ?>

<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('email', __('Email'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::email('email', null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('subject', __('Subject'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('subject', null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::textarea('description', null, ['class' => 'form-control editor', 'rows' => '4', 'cols' => '50', 'required' => 'required'])); ?>

        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        <?php echo e(Form::hidden('type', $type)); ?>

        <?php echo e(Form::hidden('id', $id)); ?>

        <?php echo e(Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill'])); ?>

    </div>
</div>
<?php echo Form::close(); ?>

<?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/crm/email/create.blade.php ENDPATH**/ ?>