@extends('layouts.admin')
@section('title')
    {{ __('Calendar') }}
@endsection

@section('action-button')
<div class="col-md-3 d-flex align-items-center justify-content-between justify-content-md-end">
    <select name="" class="form-control main-element" id="depatment" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
        @foreach($departmentList as $key => $list)
            <option value="{{route('leave_calender.index',$key)}}" {{($id == $key) ? 'selected' : ''}}>{{$list}}</option>
        @endforeach
    </select>
</div>
@endsection

@section('content')
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
                <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="month">{{__('Month')}}</a>
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
@endsection
@push('script')
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
@endpush