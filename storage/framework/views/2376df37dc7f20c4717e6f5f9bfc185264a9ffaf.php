<?php $__env->startSection('title'); ?>
    <?php echo e(__('View Contact')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <a href="<?php echo e(route('contacts.index')); ?>" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary">
            <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
        </a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-4 order-lg-2">
            <div class="card">
                <div class="list-group list-group-flush" id="tabs">
                    <div data-href="#accountcontact" class="list-group-item text-primary">
                        <div class="media">
                            <i class="fas fa-user"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1"><?php echo e(__('Basic Info')); ?></a>
                            </div>
                        </div>
                    </div>
                    <div data-href="#tag" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-tags"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1"><?php echo e(__('Tag')); ?></a>
                            </div>
                        </div>
                    </div>
                    <div data-href="#assign_com" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-industry"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1"><?php echo e(__('Companies')); ?></a>
                            </div>
                        </div>
                    </div>
                    <div data-href="#assign_con" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-users"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1"><?php echo e(__('Contact Group')); ?></a>
                            </div>
                        </div>
                    </div>
                    <div data-href="#accountopportunities" class="list-group-item">
                        <div class="media">
                            <i class="fas fa-history"></i>
                            <div class="media-body ml-3">
                                <a href="#" class="stretched-link h6 mb-1"><?php echo e(__('Activities')); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 order-lg-1">
            <div class="card bg-gradient-primary hover-shadow-lg border-0">
                <div class="card-body py-3">
                    <div class="row row-grid align-items-center">
                        <div class="col-lg-8">
                            <div class="media align-items-center">
                                <a href="#" class="avatar avatar-lg rounded-circle mr-3">
                                    <img class="avatar avatar-lg" <?php echo e($contact->contactdetail->img_image); ?> alt="Owner">
                                </a>
                                <div class="media-body">
                                    <h5 class="text-white mb-0"> <?php echo e(ucfirst($contact->name)); ?></h5>
                                    <div>
                                        <?php echo e(Form::open(['route' => ['update.contact.profile'], 'enctype' => 'multipart/form-data', 'id' => 'update_avatar'])); ?>

                                        <input type="file" name="image" id="image"
                                            class="custom-input-file custom-input-file-link"
                                            data-multiple-caption="{count} files selected" multiple />
                                        <input type="hidden" name="id"
                                            value="<?php echo e($contact->contactdetail->contact_id); ?>" />
                                        <label for="image">
                                            <span class="text-white" style="cursor: pointer;"><?php echo e(__('Change Avatar')); ?></span>
                                        </label>
                                        <?php echo e(Form::close()); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="accountcontact" class="tabs-card">
                <div class="card">
                    <div class="card-header">
                        <h5 class=" h6 mb-0"><?php echo e(__('Basic Info')); ?></h5>
                    </div>
                    <div class="card-body">
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Name')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><?php echo e($contact->name); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Email')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><a
                                        href="mailto:<?php echo e($contact->email); ?>"><?php echo e($contact->email); ?></a></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Date Of Birth')); ?></span>
                                <span
                                    class="d-block h6 mb-0 p-2"><?php echo e(!empty($contact->contactdetail->date_of_birth) ? Utility::getDateFormated($contact->contactdetail->date_of_birth) : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Age')); ?></span>
                                <span
                                    class="d-block h6 mb-0 p-2"><?php echo e(!empty($contact->contactdetail->age) ? $contact->contactdetail->age : '-'); ?></span>
                            </div>
                        </dl>
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Phone')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><a
                                        href="tel:<?php echo e($contact->contactdetail->phone_no); ?>"><?php echo e(!empty($contact->contactdetail->phone_no) ? $contact->contactdetail->phone_no : '-'); ?></a></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Mobile')); ?></span>
                                <span class="d-block h6 mb-0 p-2"><a
                                        href="tel:<?php echo e($contact->contactdetail->mobile_no); ?>"><?php echo e(!empty($contact->contactdetail->mobile_no) ? $contact->contactdetail->mobile_no : '-'); ?></a></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Life Stage')); ?></span>
                                <span
                                    class="d-block h6 mb-0 p-2"><?php echo e(__(\App\Contact::$lifestage[$contact->contactdetail->life_stage])); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Website')); ?></span>
                                <span
                                    class="d-block h6 mb-0 p-2"><?php echo e(!empty($contact->contactdetail->website) ? $contact->contactdetail->website : '-'); ?></span>
                            </div>
                        </dl>
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Fax')); ?></span>
                                <span
                                    class="d-block h6 mb-0 p-2"><?php echo e(!empty($contact->contactdetail->fax_no) ? $contact->contactdetail->fax_no : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Address1')); ?></span>
                                <span
                                    class="d-block h6 mb-0 p-2"><?php echo e(!empty($contact->contactdetail->address1) ? $contact->contactdetail->address1 : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Address2')); ?></span>
                                <span
                                    class="d-block h6 mb-0 p-2"><?php echo e(!empty($contact->contactdetail->address2) ? $contact->contactdetail->address2 : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('City')); ?></span>
                                <span
                                    class="d-block h6 mb-0 p-2"><?php echo e(!empty($contact->contactdetail->city) ? $contact->contactdetail->city : '-'); ?></span>
                            </div>
                        </dl>
                        <dl class="row p-2">
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Country')); ?></span>
                                <span
                                    class="d-block h6 mb-0 p-2"><?php echo e(!empty($contact->contactdetail->country) ? $contact->contactdetail->country : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('State')); ?></span>
                                <span
                                    class="d-block h6 mb-0 p-2"><?php echo e(!empty($contact->contactdetail->state) ? $contact->contactdetail->state : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Postel Code')); ?></span>
                                <span
                                    class="d-block h6 mb-0 p-2"><?php echo e(!empty($contact->contactdetail->zip_code) ? $contact->contactdetail->zip_code : '-'); ?></span>
                            </div>
                            <div class="col-3">
                                <span class="text-sm text-muted p-2"><?php echo e(__('Source')); ?></span>
                                <span
                                    class="d-block h6 mb-0 p-2"><?php echo e(!empty($contact->contactdetail->contact_source) ? __(\App\Contact::$contactsource[$contact->contactdetail->contact_source]) : '-'); ?></span>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
            <div id="accountopportunities" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('New Note')); ?></h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="<?php echo e(__('Add New Note')); ?>"
                                        data-size='lg'
                                        data-url="<?php echo e(route('notes.create', ['type' => 'contact', 'id' => $contact->id])); ?>"
                                        class="action-item"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="95%"><?php echo e(__('Note')); ?>

                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="5%"><?php echo e(__('Action')); ?>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php if(count($notes) > 0): ?>
                                        <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-wrap" width="75%"><?php echo $note->note; ?></td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                    data-url="<?php echo e(route('notes.edit', $note->id)); ?>"
                                                                    data-ajax-popup="true"
                                                                    data-title="<?php echo e(__('Edit Note')); ?>"
                                                                    data-original-title="<?php echo e(__('Edit')); ?>"
                                                                    data-size='lg'><?php echo e(__('Edit')); ?></a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="<?php echo e(__('Delete')); ?>"
                                                                    data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                                                    data-confirm-yes="document.getElementById('delete-form-<?php echo e($note->id); ?>').submit();">
                                                                    <?php echo e(__('Remove')); ?>

                                                                </a>
                                                                <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['notes.destroy', $note->id], 'id' => 'delete-form-' . $note->id])); ?>

                                                                <?php echo e(Form::close()); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('Log Activity')); ?></h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="<?php echo e(__('Add New Log')); ?>"
                                        data-size='lg'
                                        data-url="<?php echo e(route('log_activities.create', ['type' => 'contact', 'id' => $contact->id])); ?>"
                                        class="action-item"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Note')); ?>

                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Type')); ?>

                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">
                                            <?php echo e(__('Start Date')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Time')); ?>

                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Action')); ?>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php if(count($logactivities) > 0): ?>
                                        <?php $__currentLoopData = $logactivities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $logactivity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td class="text-wrap" width="50%"><?php echo $logactivity->note; ?></td>
                                                <td><?php echo e(__(\App\LogActivity::$type[$logactivity->type])); ?></td>
                                                <td><?php echo e(Utility::getDateFormated($logactivity->start_date)); ?></td>
                                                <td><?php echo e(Utility::timeFormat($logactivity->time)); ?></td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                    data-url="<?php echo e(route('log_activities.edit', $logactivity->id)); ?>"
                                                                    data-ajax-popup="true"
                                                                    data-title="<?php echo e(__('Edit Log Activity')); ?>"
                                                                    data-original-title="<?php echo e(__('Edit')); ?>"
                                                                    data-size='lg'><?php echo e(__('Edit')); ?></a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="<?php echo e(__('Delete')); ?>"
                                                                    data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                                                    data-confirm-yes="document.getElementById('delete-form-<?php echo e($logactivity->id); ?>').submit();">
                                                                    <?php echo e(__('Remove')); ?>

                                                                </a>
                                                                <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['log_activities.destroy', $logactivity->id], 'id' => 'delete-form-' . $logactivity->id])); ?>

                                                                <?php echo e(Form::close()); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('Schedule')); ?></h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="<?php echo e(__('Add New Schedule')); ?>"
                                        data-size='lg'
                                        data-url="<?php echo e(route('schedules.create', ['type' => 'contact', 'id' => $contact->id])); ?>"
                                        class="action-item"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="20%">
                                            <?php echo e(__('Schedule Title')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">
                                            <?php echo e(__('Start Date')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('End Date')); ?>

                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Note')); ?>

                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Action')); ?>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php if(count($schesules) > 0): ?>
                                        <?php $__currentLoopData = $schesules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $schedule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($schedule->title); ?></td>
                                                <td><?php echo e(Utility::getDateFormated($schedule->start_date)); ?></td>
                                                <td><?php echo e(Utility::getDateFormated($schedule->end_date)); ?></td>
                                                <td class="text-wrap" width="50%"><?php echo $schedule->note; ?></td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                    data-url="<?php echo e(route('schedules.edit', $schedule->id)); ?>"
                                                                    data-ajax-popup="true"
                                                                    data-title="<?php echo e(__('Edit Schedule')); ?>"
                                                                    data-original-title="<?php echo e(__('Edit')); ?>"
                                                                    data-size='lg'><?php echo e(__('Edit')); ?></a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="<?php echo e(__('Delete')); ?>"
                                                                    data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                                                    data-confirm-yes="document.getElementById('delete-form-<?php echo e($schedule->id); ?>').submit();">
                                                                    <?php echo e(__('Remove')); ?>

                                                                </a>
                                                                <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['schedules.destroy', $schedule->id], 'id' => 'delete-form-' . $schedule->id])); ?>

                                                                <?php echo e(Form::close()); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('Email')); ?></h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="<?php echo e(__('Add New Email')); ?>"
                                        data-size='lg'
                                        data-url="<?php echo e(route('emails.create', ['type' => 'contact', 'id' => $contact->id])); ?>"
                                        class="action-item"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Email')); ?>

                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Subject')); ?>

                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">
                                            <?php echo e(__('Description')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"></th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Action')); ?>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php if(count($emails) > 0): ?>
                                        <?php $__currentLoopData = $emails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($email->email); ?></td>
                                                <td><?php echo e($email->subject); ?></td>
                                                <td class="text-wrap" width="50%"><?php echo $email->description; ?></td>
                                                <td><?php echo e($email->created_at->diffForHumans()); ?></td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                    data-url="<?php echo e(route('emails.show', $email->id)); ?>"
                                                                    data-ajax-popup="true"
                                                                    data-title="<?php echo e(__('View Email')); ?>"
                                                                    data-original-title="<?php echo e(__('View')); ?>"
                                                                    data-size='lg'><?php echo e(__('View')); ?></a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="<?php echo e(__('Delete')); ?>"
                                                                    data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                                                    data-confirm-yes="document.getElementById('delete-form-<?php echo e($email->id); ?>').submit();">
                                                                    <?php echo e(__('Remove')); ?>

                                                                </a>
                                                                <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['emails.destroy', $email->id], 'id' => 'delete-form-' . $email->id])); ?>

                                                                <?php echo e(Form::close()); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0"><?php echo e(__('Task')); ?></h6>
                            </div>
                            <div class="text-right">
                                <div class="actions">
                                    <a href="#" data-ajax-popup="true" data-title="<?php echo e(__('Add New Task')); ?>"
                                        data-size='lg'
                                        data-url="<?php echo e(route('tasks.create', ['type' => 'contact', 'id' => $contact->id])); ?>"
                                        class="action-item"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-wrapper p-3">
                        <!-- Files -->
                        <div class="card mb-3 border shadow-none">
                            <table class="table dataTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Title')); ?>

                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Manager')); ?>

                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Date')); ?>

                                        </th>
                                        <th scope="col" class="sort" data-sort="status" width="20%">
                                            <?php echo e(__('Description')); ?></th>
                                        <th scope="col" class="sort" data-sort="status" width="20%"><?php echo e(__('Action')); ?>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php if(count($tasks) > 0): ?>
                                        <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($task->title); ?></td>
                                                <td><?php echo e($task->agent_or_manager); ?></td>
                                                <td><?php echo e(Utility::getDateFormated($task->date)); ?></td>
                                                <td class="text-wrap" width="50%"><?php echo $task->description; ?></td>
                                                <td data-name="buttons">
                                                    <div class="col-auto actions">
                                                        <div class="dropdown" data-toggle="dropdown">
                                                            <a href="#" class="action-item" role="button"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                                <i class="fas fa-ellipsis-h"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a href="#" class="dropdown-item"
                                                                    data-url="<?php echo e(route('tasks.edit', $task->id)); ?>"
                                                                    data-ajax-popup="true"
                                                                    data-title="<?php echo e(__('Edit Task')); ?>"
                                                                    data-original-title="<?php echo e(__('Edit')); ?>"
                                                                    data-size='lg'><?php echo e(__('Edit')); ?></a>
                                                                <a href="#" class="dropdown-item"
                                                                    data-original-title="<?php echo e(__('Delete')); ?>"
                                                                    data-confirm="<?php echo e(__('Are You Sure?|This action can not be undone. Do you want to continue?')); ?>"
                                                                    data-confirm-yes="document.getElementById('delete-form-<?php echo e($task->id); ?>').submit();">
                                                                    <?php echo e(__('Remove')); ?>

                                                                </a>
                                                                <?php echo e(Form::open(['method' => 'DELETE', 'route' => ['tasks.destroy', $task->id], 'id' => 'delete-form-' . $task->id])); ?>

                                                                <?php echo e(Form::close()); ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tag" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <h5 class=" h6 mb-0"><?php echo e(__('Tag')); ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <?php echo e(Form::open(['url' => 'add-tag', 'method' => 'post'])); ?>

                                <div class="form-group">
                                    <?php echo e(Form::text('tag', isset($contact->tag) ? $contact->tag->text : '', ['class' => 'form-control', 'data-toggle' => 'tags'])); ?>

                                </div>
                                <div class="col-12 pt-5 text-right">
                                    <?php echo e(Form::hidden('type', 'contact')); ?>

                                    <?php echo e(Form::hidden('id', $contact->id)); ?>

                                    <button type="submit"
                                        class="btn btn-sm btn-primary btn-icon rounded-pill "><?php echo e(__('Save')); ?></button>
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="assign_com" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <h5 class="h6 mb-0"><?php echo e(__('Companies')); ?></h5>
                    </div>
                    <div class="card-body">
                        <?php echo e(Form::model($contact, ['route' => ['add.company', $contact->id], 'method' => 'PUT'])); ?>

                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <?php echo e(Form::select('company', $companies, null, ['class' => 'form-control main-element'])); ?>

                                </div>
                            </div>
                            <div class="col-12 pt-5 text-right">
                                <button type="submit"
                                    class="btn btn-sm btn-primary btn-icon rounded-pill"><?php echo e(__('Save')); ?></button>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
            <div id="assign_con" class="tabs-card d-none">
                <div class="card">
                    <div class="card-header">
                        <h5 class=" h6 mb-0"><?php echo e(__('Contact Group')); ?></h5>
                    </div>
                    <div class="card-body">
                        <?php echo e(Form::model($contact, ['route' => ['update.contact-groups', $contact->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                            <div class="row">
                                <div class="col-sm-12 col-md-8">
                                    <div class="form-group">
                                        <?php $__currentLoopData = Auth::user()->contact_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contactgroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="custom-control custom-checkbox">
                                                <?php echo e(Form::checkbox('contact_group[]', $contactgroup->name, in_array($contactgroup->name, explode(',', $contact->contactdetail->assign_group)), ['class' => 'custom-control-input', 'id' => $contactgroup->name])); ?>

                                                <?php echo e(Form::label($contactgroup->name, $contactgroup->name, ['class' => 'custom-control-label'])); ?>

                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                                <div class="col-12 pt-5 text-right">
                                    <?php echo e(Form::submit('Update', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill'])); ?>

                                </div>
                            </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '.all_day', function() {
                if ($(this).prop("checked") == true) {
                    $(".start_time").addClass('d-none');
                    $(".end_time").addClass('d-none');
                } else if ($(this).prop("checked") == false) {
                    $(".start_time").removeClass('d-none');
                    $(".end_time").removeClass('d-none');
                }
            });

            $(document).on('change', '.all_notification', function() {
                if ($('.all_notification').is(":checked"))
                    $(".notification_allow").removeClass('d-none');
                else
                    $(".notification_allow").addClass('d-none');
            });

            $(document).on('change', '#image', function() {
                $('#update_avatar').submit();
            });
        });

    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/crm/contacts/view.blade.php ENDPATH**/ ?>