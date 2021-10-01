@extends('layouts.admin')
@section('title')
    {{ __('HR Management') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-4 order-lg-2">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title mb-0"><b>{{$userlist}}</b></h1>
                    <h5 class="card-title mt-2">{{__('Total Users')}}</h5>
                </div>
                <div class="card-body card-desc">
                    <a href="{{route('users.index')}}" class="btn btn-sm btn-primary card-btn">{{__('View Employees')}}</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 order-lg-2">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title mb-0"><b>{{$departmentlist}}</b></h1>
                    <h5 class="card-title mt-2">{{__('Total Departments')}}</h5>
                </div>
                <div class="card-body card-desc">
                    <a href="{{route('departments.index')}}" class="btn btn-sm btn-primary card-btn">{{__('View Departments')}}</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 order-lg-2">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title mb-0"><b>{{$designationlist}}</b></h1>
                    <h5 class="card-title mt-2">{{__('Total Designations')}}</h5>
                </div>
                <div class="card-body card-desc">
                    <a href="{{route('designations.index')}}" class="btn btn-sm btn-primary card-btn">{{__('View Designations')}}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 order-lg-2">
            <i class="fas fa-microphone" aria-hidden="true"></i><h5 class="card-title mb-0" style="display: inline;margin-left: 5px;">{{__('Latest Announcement')}}</h5>
            <div class="card mt-3">
                <div class="card-header">
                    <table class="table">
                        <tbody>
                            @if (count($announcements) > 0)
                                @foreach ($announcements as $announcement)
                                    <tr>
                                        <td class="border-top-0 p-3 note-content" width="90%"><a style="color:#0073aa;" href="#" class="action-item"
                                            data-url="{{ route('announcements.show', $announcement->id) }}" data-ajax-popup="true"
                                            data-title="{{ __('View ').ucfirst($announcement->title) }}" data-size='lg'>
                                            {{ucfirst($announcement->title)}}</a></td>
                                        <td class="border-top-0 p-3 note-content" width="10%">{{\App\Utility::getDateFormated($announcement->created_at)}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <h5>{{__('No Latest Announcement Found')}}</h5>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if(isset($arrschedules))
    <div class="row">
        <div class="col-lg-12 order-lg-2">
            <div class="card author-box card-primary">
                <div class="card-header">
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
                                <button class="fullcalendar-btn-today btn btn-sm btn-neutral" type="button">{{__('Today')}}</button>
                            </div>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="#" class="btn btn-sm btn-neutral active" data-calendar-view="month">{{__('Month')}}</a>
                                <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicWeek">{{__('Week')}}</a>
                                <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicDay">{{__('Day')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id='calendar-container'>
                        <div id='calendar' data-toggle="my-calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
@push('script')
<script>
    @if(isset($arrschedules))
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
    }), $("body").on("click", ".fullcalendar-btn-today", function (t) {
    t.preventDefault(), e.fullCalendar("today")
}));
@endif
</script>
@endpush