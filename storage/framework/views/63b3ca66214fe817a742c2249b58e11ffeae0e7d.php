<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Products')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Product')): ?>
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="<?php echo e(__('Add New Product')); ?>" data-size='md' data-url="<?php echo e(route('product_and_services.create')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Product Name')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Sale Price')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Cost Price')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Product Category')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Tax')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Product Type')); ?></th>
                <?php if(Gate::check('Edit Product') || Gate::check('Delete Product')): ?>
                    <th><?php echo e(__('Action')); ?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody class="list">
            <?php $__currentLoopData = $productandservices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productandservice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($productandservice->product_name); ?></td>
                    <td><?php echo e(!empty(number_format($productandservice->sale_price,2)) ? number_format($productandservice->sale_price,2) : '0'); ?></td>
                    <td><?php echo e(!empty(number_format($productandservice->cost_price,2)) ? number_format($productandservice->cost_price,2) : '0'); ?></td>
                    <td><?php echo e(!empty($productandservice->productcategory->name) ? $productandservice->productcategory->name : '-'); ?></td>
                    <td>
                        <?php
                            $taxes=\Utility::tax($productandservice->tax_rate_id);
                        ?>

                        <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e(!empty($tax) ? $tax->name : '-'); ?><br>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    </td>
                    <td><?php echo e(__(\App\ProductAndService::$product_type[$productandservice->product_type])); ?></td>
                    <?php if(Gate::check('Edit Product') || Gate::check('Delete Product')): ?>
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Product')): ?>
                                    <a href="#" class="action-item"
                                        data-url="<?php echo e(route('product_and_services.edit', $productandservice->id)); ?>" data-ajax-popup="true"
                                        data-title="<?php echo e(__('Edit Product')); ?>" data-toggle="tooltip"
                                        data-original-title="<?php echo e(__('Edit')); ?>" data-size='md'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Product')): ?>
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="<?php echo e(__('Delete')); ?>"
                                        data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                        data-confirm-yes="document.getElementById('delete-form-<?php echo e($productandservice->id); ?>').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['product_and_services.destroy', $productandservice->id], 'id' => 'delete-form-' . $productandservice->id])); ?>

                                    <?php echo e(Form::close()); ?>

                                <?php endif; ?>
                            </div>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/accounting/products/product_and_service/index.blade.php ENDPATH**/ ?>