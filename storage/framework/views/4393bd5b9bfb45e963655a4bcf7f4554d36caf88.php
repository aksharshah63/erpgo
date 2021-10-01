<?php echo e(Form::open(['url' => 'customers', 'method' => 'post', 'enctype' => 'multipart/form-data'])); ?>

<div class="row">
    <div class="col-sm-12">
        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab"
                    aria-controls="general" aria-selected="true"><?php echo e(__('General info')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="other-tab" data-toggle="tab" href="#other" role="tab" aria-controls="other"
                    aria-selected="false"><?php echo e(__('Others info')); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="additional-tab" data-toggle="tab" href="#additional" role="tab"
                    aria-controls="additional" aria-selected="false"><?php echo e(__('Additional info')); ?></a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('first_name', __('First Name'), ['class' => 'form-control-label'])); ?><span
                                class="text-danger">*</span>
                            <?php echo e(Form::text('first_name', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('last_name', __('Last Name'), ['class' => 'form-control-label'])); ?><span
                                class="text-danger">*</span>
                            <?php echo e(Form::text('last_name', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('email', __('Email'), ['class' => 'form-control-label'])); ?><span
                                class="text-danger">*</span>
                            <?php echo e(Form::email('email', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('phone_no', __('Phone'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::text('phone_no', null, ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('company', __('Company'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::text('company', null, ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('mobile', __('Mobile'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::number('mobile', null, ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('website', __('Website'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::text('website', null, ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('fax_number', __('Fax'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::number('fax_number', null, ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('address1', __('Address1'), ['class' => 'form-control-label'])); ?><span
                            class="text-danger">*</span>
                            <?php echo e(Form::text('address1', null, ['class' => 'form-control','required' => 'required'])); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('address2', __('Address2'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::text('address2', null, ['class' => 'form-control'])); ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('city', __('City'), ['class' => 'form-control-label'])); ?><span
                            class="text-danger">*</span>
                            <?php echo e(Form::text('city', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('country', __('Country'), ['class' => 'form-control-label'])); ?><span
                            class="text-danger">*</span>
                            <?php echo e(Form::text('country', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('province_state', __('Province / State'), ['class' => 'form-control-label'])); ?><span
                            class="text-danger">*</span>
                            <?php echo e(Form::text('province_state', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('post_code', __('Post Code / Zip Code'), ['class' => 'form-control-label'])); ?><span
                            class="text-danger">*</span>
                            <?php echo e(Form::text('post_code', null, ['class' => 'form-control', 'required' => 'required'])); ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="additional" role="tabpanel" aria-labelledby="additional-tab">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <?php echo e(Form::label('notes', __('Note'), ['class' => 'form-control-label'])); ?>

                            <?php echo e(Form::textarea('notes', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50'])); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        <?php echo e(Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill'])); ?>

    </div>
</div>
<?php echo Form::close(); ?>

<?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/accounting/users/customer/create.blade.php ENDPATH**/ ?>