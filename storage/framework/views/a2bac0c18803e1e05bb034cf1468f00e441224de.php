<?php
    $currantLang = \Auth::user()->lang;
?>
<div class="footer pt-5 pb-4 footer-light" id="footer-main">
    <div class="row text-center text-sm-left align-items-sm-center">
        <div class="col-sm-6">
            <p class="text-lg mb-0">Copyright &copy; <?php echo e((Utility::getValByName('footer_title')) ? Utility::getValByName('footer_title') : config('app.name', 'ERPGo')); ?> <?php echo e(date('Y')); ?> </p>
        </div>
        <div class="col-sm-6 mb-md-0">
            <ul class="nav justify-content-center justify-content-md-end">
                <li class="nav-item dropdown border-right">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="h6 text-sm mb-0"><?php echo e(Str::upper(\Auth::user()->lang)); ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <?php if(\Auth::user()->type=='Admin'): ?>
                            <a href="<?php echo e(route('manage.language',[$currantLang])); ?>" class="dropdown-item"><?php echo e(__('Create & Customize')); ?></a>
                        <?php endif; ?>
                        <?php $__currentLoopData = Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('change.language',$language)); ?>" class="dropdown-item <?php if($language == \Auth::user()->lang): ?> text-dark <?php endif; ?>"><?php echo e(Str::upper($language)); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo e(\Auth::user()->footer_link_title_1()); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo e(\Auth::user()->footer_link_title_2()); ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pr-0" href="#"><?php echo e(\Auth::user()->footer_link_title_3()); ?></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Core JS - includes jquery, bootstrap, popper, in-view and sticky-kit -->
<script src="<?php echo e(asset('assets/js/site.core.js')); ?>"></script>
<!--oppotunities-->
<script src="<?php echo e(asset('assets/libs/dragula/dist/dragula.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/autosize/dist/autosize.min.js')); ?>"></script>
<!-- Page JS -->
<script src="<?php echo e(asset('assets/libs/progressbar.js/dist/progressbar.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/apexcharts/dist/apexcharts.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/moment/min/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/fullcalendar/dist/fullcalendar.min.js')); ?>"></script>

<!-- Data table -->
<script src="<?php echo e(asset('assets/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')); ?>"></script>
<!--create-lead-->
<script src="<?php echo e(asset('assets/libs/dropzone/dist/min/dropzone.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/quill/dist/quill.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/select2/dist/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/libs/flatpickr/dist/flatpickr.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/bootstrap-datepicker.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/libs/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>
<!--Create event-->
<script src="<?php echo e(asset('assets/libs/jquery-mask-plugin/dist/jquery.mask.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/site.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/letter.avatar.js')); ?>"></script>

<?php echo $__env->yieldPushContent('script'); ?>

<script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>

<?php if(Session::has('success')): ?>
    <script>
        show_toastr('<?php echo e(__('Success')); ?>', '<?php echo session('success'); ?>', 'success');
    </script>
    <?php echo e(Session::forget('success')); ?>

<?php endif; ?>
<?php if(Session::has('errors')): ?>
    <script>
        show_toastr('<?php echo e(__('Error')); ?>', '<?php echo session('errors'); ?>', 'errors');
    </script>
    <?php echo e(Session::forget('errors')); ?>

<?php endif; ?>



<?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/include/admin/footer.blade.php ENDPATH**/ ?>