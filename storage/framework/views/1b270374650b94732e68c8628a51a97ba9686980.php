<?php echo e(Form::open(['url' => 'projects', 'method' => 'post','enctype' => 'multipart/form-data'])); ?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('project_name', __('Project Name'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('project_name', null, ['class' => 'form-control'])); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::text('start_date', null, ['class' => 'form-control datepicker'])); ?>

        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::text('end_date', null, ['class' => 'form-control datepicker'])); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('project_image', __('Project Image'), ['class' => 'form-control-label'])); ?>

            <input type="file" name="project_image" id="image" class="custom-input-file" accept="image/*">
            <label for="image">
                <i class="fa fa-upload"></i>
                <span>Choose a file…</span>
            </label>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('budget', __('Budget'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::number('budget', null, ['class' => 'form-control'])); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50'])); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('tag', __('Tag'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::text('tag', null, ['class' => 'form-control', 'data-toggle' => 'tags'])); ?>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('status', __('Status'), ['class' => 'form-control-label'])); ?>

            <select name="status" id="status" class="form-control main-element">
                <?php $__currentLoopData = \App\Project::$project_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($k); ?>"><?php echo e(__($v)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        <?php echo e(Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill'])); ?>

    </div>
</div>
<?php echo Form::close(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/projects/create.blade.php ENDPATH**/ ?>