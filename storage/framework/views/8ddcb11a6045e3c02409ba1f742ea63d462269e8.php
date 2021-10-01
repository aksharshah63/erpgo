<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <?php echo $__env->make('include.admin.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body class="application application-offset">
    
        <!-- Application container -->
        <div class="container-fluid container-application">
        <!-- Sidenav -->
        <?php echo $__env->make('include.admin.side_bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Content -->
        <div class="main-content position-relative">
        <!-- Main nav -->
        <?php echo $__env->make('include.admin.topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- Page title -->
        <div class="page-content">
            <div class="page-title mb-4">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                        <div class="d-inline-block">
                        <h5 class="h4 d-inline-block font-weight-400 mb-0"><?php echo $__env->yieldContent('title'); ?></h5>
                        </div>
                    </div>
                    <?php echo $__env->yieldContent('action-button'); ?>
                </div>
            </div>
        <!-- Page content -->
            <?php echo $__env->yieldContent('content'); ?>
        </div>
            <!-- Footer -->
        <?php echo $__env->make('include.admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

    <div class="modal fade" tabindex="-1" role="dialog" id="commonModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

    
<div class="modal fade fixed-right" id="commonModal-right" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="scrollbar-inner">
        <div class="min-h-300 mh-300">
        </div>
    </div>
</div>

</body>
</html>
<?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/layouts/admin.blade.php ENDPATH**/ ?>