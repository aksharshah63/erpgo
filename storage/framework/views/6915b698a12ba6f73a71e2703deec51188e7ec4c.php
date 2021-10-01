<?php $__env->startSection('content'); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Contacts')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Contact')): ?>
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="<?php echo e(__('Add New Contact')); ?>" data-size='lg' data-url="<?php echo e(route('contacts.create')); ?>">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Contact Name')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Email Address')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Phone')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Life stage')); ?></th>
                <th scope="col" class="sort" data-sort="status"><?php echo e(__('Owner')); ?></th>
                <?php if(Gate::check('View Contact') || Gate::check('Edit Contact') || Gate::check('Delete Contact')): ?>
                    <th><?php echo e(__('Action')); ?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody class="list">
            <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($contact->name); ?></td>
                    <td><?php echo e($contact->email); ?></td>
                    <td><?php echo e((!empty($contact->contactdetail->phone_no) ?  $contact->contactdetail->phone_no : '-')); ?></td>
                    <td><?php echo e((!empty($contact->contactdetail->life_stage) ? __(\App\Contact::$lifestage[$contact->contactdetail->life_stage]) : '-')); ?></td>
                    <td><?php echo e((!empty($contact->contactdetail->user->name) ?  $contact->contactdetail->user->name : '-')); ?></td>
                    <?php if(Gate::check('View Contact') || Gate::check('Edit Contact') || Gate::check('Delete Contact')): ?>
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Contact')): ?>
                                    <a href="<?php echo e(route('contacts.show', $contact->id)); ?>" class="action-item"
                                        data-toggle="tooltip" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Contact')): ?>
                                    <a href="#" class="action-item"
                                        data-url="<?php echo e(route('contacts.edit', $contact->id)); ?>" data-ajax-popup="true"
                                        data-title="<?php echo e(__('Edit Contact')); ?>" data-toggle="tooltip"
                                        data-original-title="<?php echo e(__('Edit')); ?>" data-size='lg'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Contact')): ?>
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="<?php echo e(__('Delete')); ?>"
                                        data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                        data-confirm-yes="document.getElementById('delete-form-<?php echo e($contact->id); ?>').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['contacts.destroy', $contact->id], 'id' => 'delete-form-' . $contact->id])); ?>

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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/crm/contacts/index.blade.php ENDPATH**/ ?>