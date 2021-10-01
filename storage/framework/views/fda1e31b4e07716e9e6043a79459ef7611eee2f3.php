<?php echo e(Form::open(['url' => 'announcements', 'method' => 'post'])); ?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('title', __('Title'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('title', null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::textarea('description', null, ['class' => 'form-control editor', 'rows' => '4', 'cols' => '50'])); ?>

        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('send_announcement_to', __('Send Announcement To'), ['class' => 'form-control-label'])); ?>

            <select name="send_announcement_to" id="send_announcement_to" class="form-control main-element">
                <option value=""><?php echo e(__('Please Select')); ?></option>
                <?php $__currentLoopData = \App\Announcement::$send_announcement_to; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($k); ?>"><?php echo e(__($v)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 annoucement_choise d-none" id="selected_user">
        <div class="form-group">
            <?php echo e(Form::label('select_users', __('Select Users'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::select('select_users', $users, null, ['class' => 'form-control main-element select2-dropdown','multiple'=>'multiple','name'=>'select_users[]'])); ?>

        </div>
    </div>
    <div class="col-sm-12 col-md-12 annoucement_choise d-none" id="by_department">
        <div class="form-group">
            <?php echo e(Form::label('by_department', __('By Departments'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::select('by_department', $departments, null, ['class' => 'form-control main-element select2-dropdown','multiple'=>'multiple','name'=>'by_department[]'])); ?>

        </div>
    </div>
    <div class="col-sm-12 col-md-12 annoucement_choise d-none" id="by_designation">
        <div class="form-group">
            <?php echo e(Form::label('by_designation', __('By Designation'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::select('by_designation', $designations, null, ['class' => 'form-control main-element select2-dropdown','multiple'=>'multiple','name'=>'by_designation[]'])); ?>

        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        <?php echo e(Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill'])); ?>

    </div>
</div>
<?php echo Form::close(); ?>

<?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/hr/announcement/create.blade.php ENDPATH**/ ?>