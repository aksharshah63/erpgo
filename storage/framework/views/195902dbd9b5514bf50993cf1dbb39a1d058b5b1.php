<?php $__env->startSection('title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php
    $logo=asset(Storage::url('logo/'));
    $company_logo=Utility::getValByName('company_logo');
    $company_favicon=Utility::getValByName('company_favicon');
    $landing_logo=Utility::getValByName('landing_logo');
?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <section class="nav-tabs">
                <div class="col-lg-12 our-system">
                    <div class="row">
                        <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item">
                                <a data-toggle="pill" href="#business-setting" class="nav-link active" id="pills-home-tab" role="tab" aria-controls="pills-home" aria-selected="true"><?php echo e(__('Business Setting')); ?></a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="pill" href="#system-setting" class="nav-link" id="pills-home-tab" role="tab" aria-controls="pills-home" aria-selected="false"><?php echo e(__('System Setting')); ?> </a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="pill" href="#company-setting" class="nav-link" id="pills-home-tab" role="tab" aria-controls="pills-home" aria-selected="false"><?php echo e(__('Company Setting')); ?> </a>
                            </li>
                            <?php if(\Auth::user()->can('Manage System Settings')): ?>
                                <li class="nav-item">
                                    <a data-toggle="pill" href="#email-setting" class="nav-link" id="pills-home-tab" role="tab" aria-controls="pills-home" aria-selected="false"><?php echo e(__('Email Setting')); ?> </a>
                                </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a data-toggle="pill" href="#proposal-template-setting" class="nav-link" id="pills-home-tab" role="tab" aria-controls="pills-home" aria-selected="false"><?php echo e(__('Proposal Print Setting')); ?> </a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="pill" href="#invoice-template-setting" class="nav-link" id="pills-home-tab" role="tab" aria-controls="pills-home" aria-selected="false"><?php echo e(__('Invoice Print Setting')); ?> </a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="pill" href="#bill-template-setting" class="nav-link" id="pills-home-tab" role="tab" aria-controls="pills-home" aria-selected="false"><?php echo e(__('Bill Print Setting')); ?> </a>
                            </li>
                            <?php if(\Auth::user()->can('Manage Stripe Settings')): ?>
                                <li class="annual-billing">
                                    <a data-toggle="pill" href="#payment-setting" class="nav-link" id="pills-home-tab" role="tab" aria-controls="pills-home" aria-selected="false"><?php echo e(__('Payment Setting')); ?> </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="business-setting" class="tab-pane in active">
                        <?php echo e(Form::model($settings,array('route'=>'business.setting','method'=>'POST','enctype' => "multipart/form-data"))); ?>

                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Business Settings')); ?></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4><?php echo e(__('Logo')); ?></h4>
                                <div class="card setting-card setting-logo-box">
                                    <div class="logo-content">
                                        <img src="<?php echo e($logo.'/'.(isset($company_logo) && !empty($company_logo)?$company_logo:'logo.png')); ?>" class="big-logo" alt=""/>
                                    </div>
                                    <div class="choose-file mt-4">
                                        <label for="company_logo">
                                            <div><?php echo e(__('Choose File Here')); ?></div>
                                            <input type="file" class="form-control" name="company_logo" id="company_logo" data-filename="edit-company_logo">
                                        </label>
                                        <p class="edit-company_logo"></p>
                                    </div>
                                    <p class="mt-3 text-primary"> <?php echo e(__('These Logo Will Appear On Bill And Invoice As Well.')); ?></p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4><?php echo e(__('Favicon')); ?></h4>
                                <div class="card setting-card setting-logo-box">
                                    <div class="logo-content">
                                        <img src="<?php echo e($logo.'/'.(isset($company_favicon) && !empty($company_favicon)?$company_favicon:'favicon.png')); ?>" class="small-logo" alt=""/>
                                    </div>
                                    <div class="choose-file mt-5">
                                        <label for="company_favicon">
                                            <div><?php echo e(__('Choose File Here')); ?></div>
                                            <input type="file" class="form-control" name="company_favicon" id="company_favicon" data-filename="edit-company-favicon">
                                        </label>
                                        <p class="edit-company-favicon"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4><?php echo e(__('Landing Page Logo')); ?></h4>
                                <div class="card setting-card setting-logo-box">
                                    <div class="logo-content">
                                        <img src="<?php echo e($logo.'/'.(isset($landing_logo) && !empty($landing_logo)?$landing_logo:'landing_logo.png')); ?>" class="small-logo" alt=""/>
                                    </div>
                                    <div class="choose-file mt-5">
                                        <label for="company_favicon">
                                            <div><?php echo e(__('Choose File Here')); ?></div>
                                            <input type="file" class="form-control" name="landing_logo" id="landing_logo" data-filename="edit-company-favicon">
                                        </label>
                                        <p class="edit-landing-logo"></p>
                                    </div>
                                    <div class="col-12">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="enable_landing" id="enable_landing" <?php echo e((\App\Utility::getValByName('enable_landing') == 'yes') ? 'checked' : ''); ?>>
                                            <label class="custom-control-label form-control-label" for="enable_landing"><?php echo e(__('Enable Landing Page')); ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-md-6">
                                <h4><?php echo e(__('Settings')); ?></h4>
                                <div class="card setting-card setting-logo-box">
                                    <div class="form-group">
                                        <?php echo e(Form::label('title_text',__('Title Text'),array('class'=>'form-control-label'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('title_text',null,array('class'=>'form-control','placeholder'=>__('Title Text')))); ?>

                                        <?php $__errorArgs = ['title_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-title_text" role="alert">
                                             <strong class="text-danger"><?php echo e($message); ?></strong>
                                             </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::label('footer_title',__('Footer Title'),array('class'=>'form-control-label'),array('class'=>'form-control-label'))); ?>

                                        <?php echo e(Form::text('footer_title',null,array('class'=>'form-control','placeholder'=>__('Footer Title')))); ?>

                                        <?php $__errorArgs = ['footer_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-footer_title" role="alert">
                                             <strong class="text-danger"><?php echo e($message); ?></strong>
                                             </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-lg-12 text-right">
                                <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                    <div id="system-setting" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('System Settings')); ?></h4>
                                </div>
                            </div>
                            <div class="card bg-none">
                                <?php echo e(Form::model($settings,array('route'=>'system.settings','method'=>'post'))); ?>

                                <div class="card-body pd-0">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('site_currency',__('Currency *'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('site_currency',null,array('class'=>'form-control font-style'))); ?>

                                            <small> <?php echo e(__('Note: Add Currency Code As Per Three-Letter ISO Code.')); ?> <a href="https://stripe.com/docs/currencies" target="_blank"><?php echo e(__('You Can Find Out Here..')); ?></a></small> <br>
                                            <?php $__errorArgs = ['site_currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-site_currency" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('site_currency_symbol',__('Currency Symbol *'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('site_currency_symbol',null,array('class'=>'form-control'))); ?>

                                            <?php $__errorArgs = ['site_currency_symbol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-site_currency_symbol" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="example3cols3Input"><?php echo e(__('Currency Symbol Position')); ?></label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="custom-control custom-radio mb-3">

                                                            <input type="radio" id="customRadio5" name="site_currency_symbol_position" value="pre" class="custom-control-input" <?php if(@$settings['site_currency_symbol_position'] == 'pre'): ?> checked <?php endif; ?>>
                                                            <label class="custom-control-label" for="customRadio5"><?php echo e(__('Pre')); ?></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="custom-control custom-radio mb-3">
                                                            <input type="radio" id="customRadio6" name="site_currency_symbol_position" value="post" class="custom-control-input" <?php if(@$settings['site_currency_symbol_position'] == 'post'): ?> checked <?php endif; ?>>
                                                            <label class="custom-control-label" for="customRadio6"><?php echo e(__('Post')); ?></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="site_date_format" class="form-control-label"><?php echo e(__('Date Format')); ?></label>
                                            <select type="text" name="site_date_format" class="form-control select2" id="site_date_format">
                                                <option value="M j, Y" <?php if(@$settings['site_date_format'] == 'M j, Y'): ?> selected="selected" <?php endif; ?>><?php echo e(date('M j, Y')); ?></option>
                                                <option value="d-m-Y" <?php if(@$settings['site_date_format'] == 'd-m-Y'): ?> selected="selected" <?php endif; ?>><?php echo e(date('d-m-y')); ?></option>
                                                <option value="m-d-Y" <?php if(@$settings['site_date_format'] == 'm-d-Y'): ?> selected="selected" <?php endif; ?>><?php echo e(date('m-d-y')); ?></option>
                                                <option value="Y-m-d" <?php if(@$settings['site_date_format'] == 'Y-m-d'): ?> selected="selected" <?php endif; ?>><?php echo e(date('y-m-d')); ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="site_time_format" class="form-control-label"><?php echo e(__('Time Format')); ?></label>
                                            <select type="text" name="site_time_format" class="form-control select2" id="site_time_format">
                                                <option value="g:i A" <?php if(@$settings['site_time_format'] == 'g:i A'): ?> selected="selected" <?php endif; ?>><?php echo e(date('g:i A')); ?></option>
                                                <option value="g:i a" <?php if(@$settings['site_time_format'] == 'g:i a'): ?> selected="selected" <?php endif; ?>><?php echo e(date('g:i a')); ?></option>
                                                <option value="H:i" <?php if(@$settings['site_time_format'] == 'H:i'): ?> selected="selected" <?php endif; ?>><?php echo e(date('H:i')); ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('invoice_prefix',__('Invoice Prefix'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('invoice_prefix',null,array('class'=>'form-control'))); ?>

                                            <?php $__errorArgs = ['invoice_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-invoice_prefix" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('proposal_prefix',__('Proposal Prefix'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('proposal_prefix',null,array('class'=>'form-control'))); ?>

                                            <?php $__errorArgs = ['proposal_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-proposal_prefix" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('bill_prefix',__('Bill Prefix'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('bill_prefix',null,array('class'=>'form-control'))); ?>

                                            <?php $__errorArgs = ['bill_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-bill_prefix" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('customer_prefix',__('Customer Prefix'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('customer_prefix',null,array('class'=>'form-control'))); ?>

                                            <?php $__errorArgs = ['customer_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-customer_prefix" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('vender_prefix',__('Vender Prefix'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('vender_prefix',null,array('class'=>'form-control'))); ?>

                                            <?php $__errorArgs = ['vender_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-vender_prefix" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('user_prefix',__('User Prefix'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('user_prefix',null,array('class'=>'form-control'))); ?>

                                            <?php $__errorArgs = ['user_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-user_prefix" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('journal_prefix',__('Journal Prefix'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('journal_prefix',null,array('class'=>'form-control'))); ?>

                                            <?php $__errorArgs = ['journal_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-journal_prefix" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('footer_title',__('Invoice/Bill Footer Title'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('footer_title',null,array('class'=>'form-control'))); ?>

                                            <?php $__errorArgs = ['footer_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-footer_title" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('decimal_number',__('Decimal Number Format'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::number('decimal_number', null, ['class'=>'form-control'])); ?>

                                            <?php $__errorArgs = ['decimal_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-decimal_number" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        

                                        
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('footer_notes',__('Invoice/Bill Footer Notes'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::textarea('footer_notes', null, ['class'=>'form-control','rows'=>'3'])); ?>

                                            <?php $__errorArgs = ['footer_notes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-footer_notes" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('footer_link_title_1',__('Footer Link Title 1'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('footer_link_title_1',null,array('class'=>'form-control'))); ?>

                                            <?php $__errorArgs = ['footer_link_title_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-footer_link_title_1" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('footer_link_href_1',__('Footer Link href 1'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('footer_link_href_1',null,array('class'=>'form-control'))); ?>

                                            <?php $__errorArgs = ['footer_link_href_1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-footer_link_href_1" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('footer_link_title_2',__('Footer Link Title 2'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('footer_link_title_2',null,array('class'=>'form-control'))); ?>

                                            <?php $__errorArgs = ['footer_link_title_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-footer_link_title_2" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('footer_link_href_2',__('Footer Link href 2'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('footer_link_href_2',null,array('class'=>'form-control'))); ?>

                                            <?php $__errorArgs = ['footer_link_href_2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-footer_link_href_2" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('footer_link_title_3',__('Footer Link Title 3'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('footer_link_title_3',null,array('class'=>'form-control'))); ?>

                                            <?php $__errorArgs = ['footer_link_title_3'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-footer_link_title_3" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('footer_link_href_3',__('Footer Link href 3'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('footer_link_href_3',null,array('class'=>'form-control'))); ?>

                                            <?php $__errorArgs = ['footer_link_href_3'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-footer_link_href_3" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12  text-right">
                                    <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                    <div id="company-setting" class="tab-pane">
                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Company Settings')); ?></h4>
                                </div>
                            </div>
                            <div class="card bg-none">
                                <?php echo e(Form::model($settings,array('route'=>'company.settings','method'=>'post'))); ?>

                                <div class="card-body pd-0">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('company_name *',__('Company Name *'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('company_name',null,array('class'=>'form-control font-style'))); ?>

                                            <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_name" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('company_address',__('Address'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('company_address',null,array('class'=>'form-control font-style'))); ?>

                                            <?php $__errorArgs = ['company_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_address" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('company_city',__('City'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('company_city',null,array('class'=>'form-control font-style'))); ?>

                                            <?php $__errorArgs = ['company_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_city" role="alert">
                                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('company_state',__('State'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('company_state',null,array('class'=>'form-control font-style'))); ?>

                                            <?php $__errorArgs = ['company_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_state" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('company_zipcode',__('Zip/Post Code'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('company_zipcode',null,array('class'=>'form-control'))); ?>

                                            <?php $__errorArgs = ['company_zipcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_zipcode" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group  col-md-6">
                                            <?php echo e(Form::label('company_country',__('Country'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('company_country',null,array('class'=>'form-control font-style'))); ?>

                                            <?php $__errorArgs = ['company_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_country" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('company_telephone',__('Telephone'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('company_telephone',null,array('class'=>'form-control'))); ?>

                                            <?php $__errorArgs = ['company_telephone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_telephone" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('company_email',__('System Email *'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('company_email',null,array('class'=>'form-control'))); ?>

                                            <?php $__errorArgs = ['company_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_email" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php echo e(Form::label('company_email_from_name',__('Email (From Name) *'),array('class'=>'form-control-label'))); ?>

                                            <?php echo e(Form::text('company_email_from_name',null,array('class'=>'form-control font-style'))); ?>

                                            <?php $__errorArgs = ['company_email_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-company_email_from_name" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        

                                        

                                    </div>
                                </div>
                                <div class="col-lg-12  text-right">
                                    <input class="btn btn-sm btn-primary btn-icon rounded-pill" type="submit" value="<?php echo e(__('Save Changes')); ?>">
                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                    <div id="proposal-template-setting" class="tab-pane">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Proposal Print Settings')); ?></h4>
                            </div>
                        </div>
                        <div class="card">
                            <form id="setting-form" method="post" action="<?php echo e(route('proposal.template.setting')); ?>">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <form id="setting-form" method="post" action="<?php echo e(route('proposal.template.setting')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="form-group">
                                                    <label for="address" class="form-control-label"><?php echo e(__('Proposal Template')); ?></label>
                                                    <select class="form-control select2" name="proposal_template">
                                                        <?php $__currentLoopData = Utility::templateData()['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($key); ?>" <?php echo e((isset($settings['proposal_template']) && $settings['proposal_template'] == $key) ? 'selected' : ''); ?>><?php echo e($template); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label form-control-label"><?php echo e(__('Color Input')); ?></label>
                                                    <div class="row gutters-xs">
                                                        <?php $__currentLoopData = Utility::templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-auto">
                                                                <label class="colorinput">
                                                                    <input name="proposal_color" type="radio" value="<?php echo e($color); ?>" class="colorinput-input" <?php echo e((isset($settings['proposal_color']) && $settings['proposal_color'] == $color) ? 'checked' : ''); ?>>
                                                                    <span class="colorinput-color" style="background: #<?php echo e($color); ?>"></span>
                                                                </label>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                                <button class="btn btn-sm btn-primary rounded-pill">
                                                    <?php echo e(__('Save')); ?>

                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-10">
                                            <?php if(isset($settings['proposal_template']) && isset($settings['proposal_color'])): ?>
                                                <iframe id="proposal_frame" class="w-100 h-1450" frameborder="0" src="<?php echo e(route('proposal.preview',[$settings['proposal_template'],$settings['proposal_color']])); ?>"></iframe>
                                            <?php else: ?>
                                                <iframe id="proposal_frame" class="w-100 h-1450" frameborder="0" src="<?php echo e(route('proposal.preview',['template1','fffff'])); ?>"></iframe>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-sm btn-primary rounded-pill">
                                        <?php echo e(__('Save')); ?>

                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="invoice-template-setting" class="tab-pane">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Invoice Print Settings')); ?></h4>
                            </div>
                        </div>
                        <div class="card">
                            <form id="setting-form" method="post" action="<?php echo e(route('proposal.template.setting')); ?>">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <form id="setting-form" method="post" action="<?php echo e(route('template.setting')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="form-group">
                                                    <label for="address" class="form-control-label"><?php echo e(__('Invoice Template')); ?></label>
                                                    <select class="form-control select2" name="invoice_template">
                                                        <?php $__currentLoopData = Utility::templateData()['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($key); ?>" <?php echo e((isset($settings['invoice_template']) && $settings['invoice_template'] == $key) ? 'selected' : ''); ?>><?php echo e($template); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label form-control-label"><?php echo e(__('Color Input')); ?></label>
                                                    <div class="row gutters-xs">
                                                        <?php $__currentLoopData = Utility::templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-auto">
                                                                <label class="colorinput">
                                                                    <input name="invoice_color" type="radio" value="<?php echo e($color); ?>" class="colorinput-input" <?php echo e((isset($settings['invoice_color']) && $settings['invoice_color'] == $color) ? 'checked' : ''); ?>>
                                                                    <span class="colorinput-color" style="background: #<?php echo e($color); ?>"></span>
                                                                </label>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                                <button class="btn btn-sm btn-primary btn-icon rounded-pill">
                                                    <?php echo e(__('Save')); ?>

                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-10">
                                            <?php if(isset($settings['invoice_template']) && isset($settings['invoice_color'])): ?>
                                                <iframe id="invoice_frame" class="w-100 h-1450" frameborder="0" src="<?php echo e(route('invoice.preview',[$settings['invoice_template'],$settings['invoice_color']])); ?>"></iframe>
                                            <?php else: ?>
                                                <iframe id="invoice_frame" class="w-100 h-1450" frameborder="0" src="<?php echo e(route('invoice.preview',['template1','fffff'])); ?>"></iframe>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-sm btn-primary btn-icon rounded-pill">
                                        <?php echo e(__('Save')); ?>

                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="bill-template-setting" class="tab-pane">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Bill Print Settings')); ?></h4>
                            </div>
                        </div>
                        <div class="card">
                            <form id="setting-form" method="post" action="<?php echo e(route('proposal.template.setting')); ?>">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <form id="setting-form" method="post" action="<?php echo e(route('bill.template.setting')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <div class="form-group">
                                                    <label for="address" class="form-control-label"><?php echo e(__('Bill Template')); ?></label>
                                                    <select class="form-control" name="bill_template">
                                                        <?php $__currentLoopData = Utility::templateData()['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($key); ?>" <?php echo e((isset($settings['bill_template']) && $settings['bill_template'] == $key) ? 'selected' : ''); ?>><?php echo e($template); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="form-group form-control-label">
                                                    <label class="form-label"><?php echo e(__('Color Input')); ?></label>
                                                    <div class="row gutters-xs">
                                                        <?php $__currentLoopData = Utility::templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="col-auto">
                                                                <label class="colorinput">
                                                                    <input name="bill_color" type="radio" value="<?php echo e($color); ?>" class="colorinput-input" <?php echo e((isset($settings['bill_color']) && $settings['bill_color'] == $color) ? 'checked' : ''); ?>>
                                                                    <span class="colorinput-color" style="background: #<?php echo e($color); ?>"></span>
                                                                </label>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </div>
                                                </div>
                                                <button class="btn btn-sm btn-primary rounded-pill">
                                                    <?php echo e(__('Save')); ?>

                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-10">
                                            <?php if(isset($settings['bill_template']) && isset($settings['bill_color'])): ?>
                                                <iframe id="bill_frame" class="w-100 h-1450" frameborder="0" src="<?php echo e(route('bill.preview',[$settings['bill_template'],$settings['bill_color']])); ?>"></iframe>
                                            <?php else: ?>
                                                <iframe id="bill_frame" class="w-100 h-1450" frameborder="0" src="<?php echo e(route('bill.preview',['template1','fffff'])); ?>"></iframe>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-sm btn-primary rounded-pill">
                                        <?php echo e(__('Save')); ?>

                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php if(\Auth::user()->can('Manage System Settings')): ?>
                        <div id="email-setting" class="tab-pane">
                            <div class="col-md-12">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                        <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Email Settings')); ?></h4>
                                    </div>
                                </div>
                                <div class="card bg-none">
                                    <?php echo e(Form::model($settings,array('route'=>'email.settings','method'=>'post'))); ?>

                                    <div class="card-body pd-0">
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <?php echo e(Form::label('mail_driver',__('Mail Driver'),array('class'=>'form-control-label'))); ?>

                                                <?php echo e(Form::text('mail_driver',env('MAIL_DRIVER'),array('class'=>'form-control font-style'))); ?>

                                                <?php $__errorArgs = ['mail_driver'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_driver" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <?php echo e(Form::label('mail_host',__('Mail Host'),array('class'=>'form-control-label'))); ?>

                                                <?php echo e(Form::text('mail_host',env('MAIL_HOST'),array('class'=>'form-control font-style'))); ?>

                                                <?php $__errorArgs = ['mail_host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_host" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <?php echo e(Form::label('mail_port',__('Mail Port'),array('class'=>'form-control-label'))); ?>

                                                <?php echo e(Form::text('mail_port',env('MAIL_PORT'),array('class'=>'form-control font-style'))); ?>

                                                <?php $__errorArgs = ['mail_port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_port" role="alert">
                                                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                                                    </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <?php echo e(Form::label('mail_username',__('Mail Username'),array('class'=>'form-control-label'))); ?>

                                                <?php echo e(Form::text('mail_username',env('MAIL_USERNAME'),array('class'=>'form-control font-style'))); ?>

                                                <?php $__errorArgs = ['mail_username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_username" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-3">
                                                <?php echo e(Form::label('mail_password',__('Mail Password'),array('class'=>'form-control-label'))); ?>

                                                <?php echo e(Form::text('mail_password',env('MAIL_PASSWORD'),array('class'=>'form-control'))); ?>

                                                <?php $__errorArgs = ['mail_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_password" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group  col-md-3">
                                                <?php echo e(Form::label('mail_encryption',__('Mail Encryption'),array('class'=>'form-control-label'))); ?>

                                                <?php echo e(Form::text('mail_encryption',env('MAIL_ENCRYPTION'),array('class'=>'form-control font-style'))); ?>

                                                <?php $__errorArgs = ['mail_encryption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_encryption" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <?php echo e(Form::label('mail_from_address',__('Mail From Address'),array('class'=>'form-control-label'))); ?>

                                                <?php echo e(Form::text('mail_from_address',env('MAIL_FROM_ADDRESS'),array('class'=>'form-control'))); ?>

                                                <?php $__errorArgs = ['mail_from_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_from_address" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <?php echo e(Form::label('mail_from_name',__('Mail From Name'),array('class'=>'form-control-label'))); ?>

                                                <?php echo e(Form::text('mail_from_name',env('MAIL_FROM_NAME'),array('class'=>'form-control'))); ?>

                                                <?php $__errorArgs = ['mail_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-mail_from_name" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 ">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <a href="#" data-url="<?php echo e(route('test.mail')); ?>" data-ajax-popup="true" data-title="Send Test Mail" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                                    <?php echo e(__('Send Test Mail')); ?>

                                                </a>
                                            </div>
                                            <div class="form-group col-md-6 text-right">
                                                <input type="submit" value="Save Changes" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo e(Form::close()); ?>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(\Auth::user()->can('Manage Stripe Settings')): ?>
                        <div id="payment-setting" class="tab-pane">
                            <div class="col-md-12">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                        <h4 class="h4 font-weight-400 float-left pb-2"><?php echo e(__('Payment settings')); ?></h4>
                                    </div>
                                </div>
                                <div class="card bg-none">
                                    <?php echo e(Form::model($settings,['route'=>'payment.settings', 'method'=>'POST'])); ?>

                                    <div class="card-body pd-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('currency_symbol',__('Currency Symbol *'),array('class'=>'form-control-label'))); ?>

                                                    <?php echo e(Form::text('currency_symbol',env('CURRENCY_SYMBOL'),array('class'=>'form-control','required','placeholder'=>__('Enter Currency Symbol')))); ?>

                                                    <?php $__errorArgs = ['currency_symbol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-currency_symbol" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('currency',__('Currency *'),array('class'=>'form-control-label'))); ?>

                                                    <?php echo e(Form::text('currency',env('CURRENCY'),array('class'=>'form-control font-style','required','placeholder'=>__('Enter Currency')))); ?>

                                                    <small> <?php echo e(__('Note: Add currency code as per three-letter ISO code.')); ?><a href="https://stripe.com/docs/currencies" target="_blank"><?php echo e(__('you can find out here..')); ?></a></small> <br>
                                                    <?php $__errorArgs = ['currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-currency" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                            <div class="col-6 py-2">
                                                <h5 class="h5"><?php echo e(__('Stripe')); ?></h5>
                                            </div>
                                            <div class="col-6 py-2 text-right">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" name="enable_stripe" id="enable_stripe" <?php echo e(env('ENABLE_STRIPE') == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="custom-control-label form-control-label" for="enable_stripe"><?php echo e(__('Enable Stripe')); ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('stripe_key',__('Stripe Key'),array('class'=>'form-control-label'))); ?>

                                                    <?php echo e(Form::text('stripe_key',env('STRIPE_KEY'),['class'=>'form-control','placeholder'=>__('Enter Stripe Key')])); ?>

                                                    <?php $__errorArgs = ['stripe_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-stripe_key" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo e(Form::label('stripe_secret',__('Stripe Secret'),array('class'=>'form-control-label'))); ?>

                                                    <?php echo e(Form::text('stripe_secret',env('STRIPE_SECRET'),['class'=>'form-control ','placeholder'=>__('Enter Stripe Secret')])); ?>

                                                    <?php $__errorArgs = ['stripe_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="invalid-stripe_secret" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
        
                                            <div class="col-12">
                                                <hr>
                                            </div>
                                            <div class="col-6 py-2">
                                                <h5 class="h5"><?php echo e(__('PayPal')); ?></h5>
                                            </div>
                                            <div class="col-6 py-2 text-right">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" name="enable_paypal" id="enable_paypal" <?php echo e(env('ENABLE_PAYPAL') == 'on' ? 'checked="checked"' : ''); ?>>
                                                    <label class="custom-control-label form-control-label" for="enable_paypal"><?php echo e(__('Enable Paypal')); ?></label>
                                                </div>
                                            </div>
        
                                            <div class="col-md-12 pb-4">
                                                <label class="paypal-label form-control-label" for="paypal_mode"><?php echo e(__('Paypal Mode')); ?></label> <br>
                                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                                    <label class="btn btn-primary btn-sm  <?php echo e(env('PAYPAL_MODE') == '' || env('PAYPAL_MODE') == 'sandbox' ? 'active' : ''); ?>">
                                                        <input type="radio" name="paypal_mode" value="sandbox"><?php echo e(__('Sandbox')); ?>

                                                    </label>
                                                    <label class="btn btn-primary btn-sm  <?php echo e(env('PAYPAL_MODE') == 'live' ? 'active' : ''); ?>">
                                                        <input type="radio" name="paypal_mode" value="live"><?php echo e(__('Live')); ?>

                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paypal_client_id"><?php echo e(__('Client ID')); ?></label>
                                                    <input type="text" name="paypal_client_id" id="paypal_client_id" class="form-control" value="<?php echo e(env('PAYPAL_CLIENT_ID')); ?>" placeholder="<?php echo e(__('Client ID')); ?>"/>
                                                    <?php if($errors->has('paypal_client_id')): ?>
                                                        <span class="invalid-feedback d-block">
                                                    <?php echo e($errors->first('paypal_client_id')); ?>

                                                </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="paypal_secret_key"><?php echo e(__('Secret Key')); ?></label>
                                                    <input type="text" name="paypal_secret_key" id="paypal_secret_key" class="form-control" value="<?php echo e(env('PAYPAL_SECRET_KEY')); ?>" placeholder="<?php echo e(__('Secret Key')); ?>"/>
                                                    <?php if($errors->has('paypal_secret_key')): ?>
                                                        <span class="invalid-feedback d-block">
                                                    <?php echo e($errors->first('paypal_secret_key')); ?>

                                                </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12  text-right">
                                        <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                    </div>
                                    <?php echo e(Form::close()); ?>

                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        $(document).on("change", "select[name='proposal_template'], input[name='proposal_color']", function () {
            var template = $("select[name='proposal_template']").val();
            var color = $("input[name='proposal_color']:checked").val();
            $('#proposal_frame').attr('src', '<?php echo e(url('/proposal/preview')); ?>/' + template + '/' + color);
        });

        $(document).on("change", "select[name='invoice_template'], input[name='invoice_color']", function () {
            var template = $("select[name='invoice_template']").val();
            var color = $("input[name='invoice_color']:checked").val();
            $('#invoice_frame').attr('src', '<?php echo e(url('/invoices/preview')); ?>/' + template + '/' + color);
        });

        $(document).on("change", "select[name='bill_template'], input[name='bill_color']", function () {
            var template = $("select[name='bill_template']").val();
            var color = $("input[name='bill_color']:checked").val();
            $('#bill_frame').attr('src', '<?php echo e(url('/bill/preview')); ?>/' + template + '/' + color);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/settings/company.blade.php ENDPATH**/ ?>