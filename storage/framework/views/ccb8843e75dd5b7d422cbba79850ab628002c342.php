
<title> <?php echo $__env->yieldContent('title'); ?> &dash; <?php echo e((Utility::getValByName('title_text')) ? Utility::getValByName('title_text') : config('app.name', 'ERPGo')); ?></title>
<meta charset="utf-8">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<link rel="stylesheet" href="<?php echo e(asset('assets/libs/animate.css/animate.min.css')); ?>">
<!-- Favicon -->
<?php if(!empty(Utility::getValByName('company_favicon'))): ?>
    <link rel="icon" href="<?php echo e(asset(Storage::url('logo/'.Utility::getValByName('company_favicon')))); ?>" type="image/png">
<?php else: ?>
    <link rel="icon" href="<?php echo e(asset(Storage::url('logo/favicon.png'))); ?>" type="image/png">
<?php endif; ?>
<!-- Font Awesome 5 -->
<link rel="stylesheet" href="<?php echo e(asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css')); ?>">
<!-- Page CSS -->
<link rel="stylesheet" href="<?php echo e(asset('assets/libs/fullcalendar/dist/fullcalendar.min.css')); ?>">

<link rel="stylesheet" href="<?php echo e(asset('assets/libs/quill/dist/quill.core.css')); ?>" type="text/css">
<link rel="stylesheet" href="<?php echo e(asset('assets/libs/select2/dist/css/select2.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/libs/flatpickr/dist/flatpickr.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/css/site.css')); ?>" id="stylesheet">
<link rel="stylesheet" href="<?php echo e(asset('assets/css/ac.css')); ?>" id="stylesheet">
<!-- Data table -->
<link rel="stylesheet" href="<?php echo e(asset('assets/css/jquery.dataTables.min.css')); ?>" id="stylesheet">
<link rel="stylesheet" href="<?php echo e(asset('assets/css/stylesheet.css')); ?>" id="stylesheet">
<link rel="stylesheet" href="<?php echo e(asset('assets/css/custom.css')); ?>" id="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap-datepicker.min.css')); ?>" id="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<?php echo $__env->yieldPushContent('css'); ?>
<style>
    d-none {
        display: none;
    }
</style>
<?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/include/admin/head.blade.php ENDPATH**/ ?>