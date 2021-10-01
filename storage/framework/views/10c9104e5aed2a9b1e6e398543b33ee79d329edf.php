<?php echo e(Form::open(['url' => 'product_categories', 'method' => 'post'])); ?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('category_name', __('Category Name'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('category_name', null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('type', __('Category Type'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <select name="type" id="type" class="form-control main-element">
                <?php $__currentLoopData = \App\ProductCategory::$categoryType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($k); ?>"><?php echo e(__($v)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('color', __('Category Color'),['class'=>'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('color', '', array('class' => 'form-control colorpicker','required'=>'required'))); ?>

            <small><?php echo e(__('For chart representation')); ?></small>
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        <?php echo e(Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill'])); ?>

    </div>
</div>
<?php echo Form::close(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/accounting/products/product_categories/create.blade.php ENDPATH**/ ?>