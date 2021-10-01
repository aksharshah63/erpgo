<?php $__env->startComponent('mail::message'); ?>
<span><b><?php echo e(__('Description')); ?></b></span> : <span><?php echo e(strip_tags($details['description'])); ?></span><br/>

<?php echo e(__('Thanks,')); ?><br>
<?php echo e(config('app.name')); ?>

<?php if (isset($__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d)): ?>
<?php $component = $__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d; ?>
<?php unset($__componentOriginal2dab26517731ed1416679a121374450d5cff5e0d); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/crm/email/mail.blade.php ENDPATH**/ ?>