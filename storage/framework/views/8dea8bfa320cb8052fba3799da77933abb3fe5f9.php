<?php $__env->startSection('title'); ?>
    <?php echo e(__('Calendar')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
<div class="col-md-3 d-flex align-items-center justify-content-between justify-content-md-end">
    <select name="" class="form-control main-element" id="depatment" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
        <?php $__currentLoopData = $departmentList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e(route('leave_calender.index',$key)); ?>" <?php echo e(($id == $key) ? 'selected' : ''); ?>><?php echo e($list); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-title">
    <div class="row justify-content-between align-items-center">
        <div class="col d-flex align-items-center">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="#" class="fullcalendar-btn-prev btn btn-sm btn-neutral">
                    <i class="fas fa-angle-left"></i>
                </a>
                <a href="#" class="fullcalendar-btn-next btn btn-sm btn-neutral">
                    <i class="fas fa-angle-right"></i>
                </a>
            </div>
            <h5 class="fullcalendar-title h4 d-inline-block font-weight-400 mb-0"></h5>
        </div>
        <div class="col-lg-6 mt-3 mt-lg-0 text-lg-right">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="month"><?php echo e(__('Month')); ?></a>
                <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicWeek"><?php echo e(__('Week')); ?></a>
                <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicDay"><?php echo e(__('Day')); ?></a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card overflow-hidden">
            <div class="mycalendar" data-toggle="my-calendar" id="mycalendar"></div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
<script>
    var e, t, a = $('[data-toggle="my-calendar"]');
    a.length && (t = {
        header: {right: "", center: "", left: ""},
        buttonIcons: {prev: "calendar--prev", next: "calendar--next"},
        theme: !1,
        selectable: !0,
        selectHelper: !0,
        editable: !0,
        events: <?php echo json_encode($arrschedules); ?> ,
        eventStartEditable: !1,
        locale: '<?php echo e(basename(App::getLocale())); ?>',
        viewRender: function (t) {
            e.fullCalendar("getDate").month(), $(".fullcalendar-title").html(t.title)
        },
    }, (e = a).fullCalendar(t),
        $("body").on("click", "[data-calendar-view]", function (t) {
            t.preventDefault(), $("[data-calendar-view]").removeClass("active"), $(this).addClass("active");
            var a = $(this).attr("data-calendar-view");
            e.fullCalendar("changeView", a)
        }), $("body").on("click", ".fullcalendar-btn-next", function (t) {
        t.preventDefault(), e.fullCalendar("next")
    }), $("body").on("click", ".fullcalendar-btn-prev", function (t) {
        t.preventDefault(), e.fullCalendar("prev")
    }));
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/lampp/htdocs/erpgo/resources/views/hr/leave_management/calender/index.blade.php ENDPATH**/ ?>