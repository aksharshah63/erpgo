<?php echo e(Form::open(['url' => 'product_and_services', 'method' => 'post'])); ?>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('product_name', __('Product Name'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <?php echo e(Form::text('product_name', null, ['class' => 'form-control', 'required' => 'required'])); ?>

        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group" style="border-bottom: 1px solid;">
            <?php echo e(Form::label('Product/Service Details', __('Product/Service Details'), ['class' => 'form-control-label'])); ?>

        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('product_type', __('Product Type'), ['class' => 'form-control-label'])); ?><span class="text-danger">*</span>
            <select name="product_type" id="product_type" class="form-control main-element">
                <?php $__currentLoopData = \App\ProductAndService::$product_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($k); ?>"><?php echo e(__($v)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('category', __('Category'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::select('category',$categoryids, null, ['class' => 'form-control main-element'])); ?>

        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group" style="border-bottom: 1px solid;">
            <?php echo e(Form::label('Product Information', __('Product Information'), ['class' => 'form-control-label'])); ?>

        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('cost_price', __('Cost Price'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::text('cost_price', null, ['class' => 'form-control'])); ?>

        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <?php echo e(Form::label('sale_price', __('Sale Price'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::text('sale_price', null, ['class' => 'form-control'])); ?>

        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group" style="border-bottom: 1px solid;">
            <?php echo e(Form::label('Miscellaneous', __('Miscellaneous'), ['class' => 'form-control-label'])); ?>

        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <?php echo e(Form::label('tax', __('Tax'), ['class' => 'form-control-label'])); ?>

            <?php echo e(Form::select('tax',$taxids, null, ['class' => 'form-control main-element select2-dropdown','multiple'=>'multiple','name'=>'tax[]'])); ?>

        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        <?php echo e(Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill'])); ?>

    </div>
</div>
<?php echo Form::close(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/accounting/products/product_and_service/create.blade.php ENDPATH**/ ?>