<?php echo e(Form::open(['url' => 'contact_groups', 'method' => 'post'])); ?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('name', __('Name'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('name', null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50'])); ?>

        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('private', __('Private'), ['class' => 'form-control-label'])); ?>

            <div class="row px-3">
                <div class="custom-control custom-radio custom-control-inline">
                    <?php echo e(Form::radio('private', '1', true, ['class' => 'custom-control-input', 'id' => 'yes'])); ?>

                    <?php echo e(Form::label('yes', __('Yes'), ['class' => 'custom-control-label'])); ?>

                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <?php echo e(Form::radio('private', '2', true, ['class' => 'custom-control-input', 'id' => 'no'])); ?>

                    <?php echo e(Form::label('no', __('No'), ['class' => 'custom-control-label'])); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        <?php echo e(Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill'])); ?>

    </div>
</div>
<?php echo Form::close(); ?>

<?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/crm/contact_group/create.blade.php ENDPATH**/ ?>