@extends('layouts.admin')
@section('title')
    {{ __('View Schedule') }}
@endsection
@section('content')
<ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#myschedule" role="tab" aria-controls="pills-home" aria-selected="true">{{__('My Schedule')}}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#allschedule" role="tab" aria-controls="pills-profile" aria-selected="false">{{__('All Schedule')}}</a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="myschedule" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="page-title">
            <div class="row justify-content-between align-items-center full-calender">
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
                        <a href="#" class="btn btn-sm btn-neutral active" data-calendar-view="month">{{__('Month')}}</a>
                        <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicWeek">{{__('Week')}}</a>
                        <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicDay">{{__('Day')}}</a>
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
    </div>
    <div class="tab-pane fade" id="allschedule" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="page-title">
            <div class="row justify-content-between align-items-center full-calender">
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
                        <a href="#" class="btn btn-sm btn-neutral active" data-calendar-view="month">{{__('Month')}}</a>
                        <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicWeek">{{__('Week')}}</a>
                        <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicDay">{{__('Day')}}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card overflow-hidden">
                    <div class="allcalendar" data-toggle="all-calendar" id="allcalendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
@push('script')
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    var e, t, a = $('[data-toggle="my-calendar"]');
    a.length && (t = {
        header: {right: "", center: "", left: ""},
        buttonIcons: {prev: "calendar--prev", next: "calendar--next"},
        theme: !1,
        selectable: !0,
        selectHelper: !0,
        editable: !0,
        events: {!! json_encode($arrschedules) !!} ,
        eventStartEditable: !1,
        locale: '{{basename(App::getLocale())}}',
        viewRender: function (t) {
            e.fullCalendar("getDate").month(), $(".fullcalendar-title").html(t.title)
        },
        dayClick: function (e) {
            var t = moment(e).toISOString();
                $("#commonModal .modal-title").html("{{__('Add Schedule')}}");
                $("#commonModal .modal-dialog").addClass('modal-lg');
                $("#commonModal").modal('show');
                $.get("{{route('calender_schedules.create')}}", function (data) {
                    $('#commonModal .modal-body').html(data);
                    $('#date').val(t);
                });
                return false;
            $("#commonModal").modal("show"), $(".new-event--title").val(""), $(".new-event--start").val(t), $(".new-event--end").val(t)
        },
        eventClick: function (e, t) {
            var title = e.title;
            var url = e.url;
            if (typeof url != 'undefined') {
                $("#commonModal .modal-title").html("{{__('View Schedule')}}");
                $("#commonModal .modal-dialog").addClass('modal-md');
                $("#commonModal").modal('show');
                $.get(url, {}, function (data) {
                    $('#commonModal .modal-body').html(data);
                });
                return false;
            }
        }
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

    setTimeout(function(){
        var e, t, a = $('[data-toggle="all-calendar"]');
    a.length && (t = {
        header: {right: "", center: "", left: ""},
        buttonIcons: {prev: "calendar--prev", next: "calendar--next"},
        theme: !1,
        selectable: !0,
        selectHelper: !0,
        editable: !0,
        events: {!! json_encode($allSchedules) !!} ,
        eventStartEditable: !1,
        locale: '{{basename(App::getLocale())}}',
        viewRender: function (t) {
            e.fullCalendar("getDate").month(), $(".fullcalendar-title").html(t.title)
        },
        dayClick: function (e) {
            var t = moment(e).toISOString();
                $("#commonModal .modal-title").html("{{__('Add Schedule')}}");
                $("#commonModal .modal-dialog").addClass('modal-lg');
                $("#commonModal").modal('show');
                $.get("{{route('calender_schedules.create')}}", function (data) {
                    $('#commonModal .modal-body').html(data);
                    $('#date').val(t);
                });
                return false;
            $("#commonModal").modal("show"), $(".new-event--title").val(""), $(".new-event--start").val(t), $(".new-event--end").val(t)
        },
        eventClick: function (e, t) {
            var title = e.title;
            var url = e.url;
            if (typeof url != 'undefined') {
                $("#commonModal .modal-title").html("{{__('View Schedule')}}");
                $("#commonModal .modal-dialog").addClass('modal-md');
                $("#commonModal").modal('show');
                $.get(url, {}, function (data) {
                    $('#commonModal .modal-body').html(data);
                });
                return false;
            }
        }
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
    }, 500);
    
</script>
@endpush