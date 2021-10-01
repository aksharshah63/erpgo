<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Companies')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Company')): ?>
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="<?php echo e(__('Add New Company')); ?>" data-size='lg' data-url="<?php echo e(route('companies.create')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Company Name')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Email Address')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Phone')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Life stage')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Owner')); ?></th>
                <?php if(Gate::check('View Company') || Gate::check('Edit Company') || Gate::check('Delete Company')): ?>
                    <th><?php echo e(__('Action')); ?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody class="list">
            <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($company->name); ?></td>
                    <td><?php echo e($company->email); ?></td>
                    <td><?php echo e((!empty($company->companydetail->phone_no) ?  $company->companydetail->phone_no : '-')); ?></td>
                    <td><?php echo e((!empty($company->companydetail->life_stage) ? __(\App\Company::$lifestage[$company->companydetail->life_stage]) : '-')); ?></td>
                    <td><?php echo e((!empty($company->companydetail->user->name) ?  $company->companydetail->user->name : '-')); ?></td>
                    <?php if(Gate::check('View Company') || Gate::check('Edit Company') || Gate::check('Delete Company')): ?>
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Company')): ?>
                                    <a href="<?php echo e(route('companies.show', $company->id)); ?>" class="action-item"
                                        data-toggle="tooltip" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Company')): ?>
                                    <a href="#" class="action-item"
                                        data-url="<?php echo e(route('companies.edit', $company->id)); ?>" data-ajax-popup="true"
                                        data-title="<?php echo e(__('Edit Comapny')); ?>" data-toggle="tooltip"
                                        data-original-title="<?php echo e(__('Edit')); ?>" data-size='lg'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Company')): ?>
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="<?php echo e(__('Delete')); ?>"
                                        data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                        data-confirm-yes="document.getElementById('delete-form-<?php echo e($company->id); ?>').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['companies.destroy', $company->id], 'id' => 'delete-form-' . $company->id])); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/crm/company/index.blade.php ENDPATH**/ ?>