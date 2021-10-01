@extends('layouts.admin')
@section('title')
    {{ __('CRM Dashboard') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-4 col-md-4">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h5 font-weight mb-0 ">{{__("Today's Schedules")}}</span>
                            <h6 class="text-muted mb-1">{{!empty($schedules) ? $schedules : 0}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h5 font-weight mb-0 ">{{__("Upcomming Schedules")}}</span>
                            <h6 class="text-muted mb-1">{{!empty($upcomingschedules) ? $upcomingschedules :0}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <span class="h5 font-weight mb-0">{{__("Total Emails")}}</span>
                            <h6 class="text-muted mb-1">{{!empty($emails) ? $emails : 0}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-md-6">
            <div class="card card-fluid">
                <div class="card-body text-center d-flex flex-column justify-content-center">
                    <span class="h5 font-weight mb-4">{{__("Total Contacts")}}</span>
                    <h2 class="mb-4">{{$contact_life_stage['result']}}</h2>
                    <div class="d-flex mt-4">
                        <div class="col">
                            <span class="d-block badge badge-dot badge-lg h6">
                                <i class="bg-danger"></i>{{!empty($contact_life_stage['customers']) ? $contact_life_stage['customers'] : 0}} {{__('Customer')}}
                            </span>
                            <span class="d-block badge badge-dot badge-lg h6">
                                      <i class="bg-success"></i>{{!empty($contact_life_stage['leads']) ? $contact_life_stage['leads'] : 0}} {{__('Leads')}}
                            </span>
                        </div>
                        <div class="col">
                            <span class="d-block badge badge-dot badge-lg h6">
                                <i class="bg-warning"></i>{{!empty($contact_life_stage['opportunities']) ? $contact_life_stage['opportunities'] : 0}} {{__('Opportunities')}}
                            </span>
                            <span class="d-block badge badge-dot badge-lg h6">
                                      <i class="bg-primary"></i> {{!empty($contact_life_stage['subscriber']) ? $contact_life_stage['subscriber'] : 0}} {{__('Subscribers')}}
                            </span>
                        </div>
                    </div>
                    <a href="{{route('contacts.index')}}" class="btn btn-block btn-primary mt-auto">{{__('View All Contacts')}}</a>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-6">
            <div class="card card-fluid">
                <div class="card-body text-center d-flex flex-column justify-content-center">
                    <span class="h5 font-weight mb-4">{{__('Total Companies')}}</span>
                    <h2 class="mb-4">{{$company_life_stage['result']}}</h2>
                    <div class="d-flex mt-4">
                        <div class="col">
                            <span class="d-block badge badge-dot badge-lg h6">
                                <i class="bg-danger"></i>{{!empty($company_life_stage['customers']) ? $company_life_stage['customers'] : 0}} {{__('Customer')}}
                            </span>
                            <span class="d-block badge badge-dot badge-lg h6">
                                      <i class="bg-success"></i>{{!empty($company_life_stage['leads']) ? $company_life_stage['leads'] : 0}} {{__('Leads')}}
                            </span>
                        </div>
                        <div class="col">
                            <span class="d-block badge badge-dot badge-lg h6">
                                <i class="bg-warning"></i>{{!empty($company_life_stage['opportunities']) ? $company_life_stage['opportunities'] : 0}} {{__('Opportunities')}}
                            </span>
                            <span class="d-block badge badge-dot badge-lg h6">
                                      <i class="bg-primary"></i>{{!empty($company_life_stage['subscriber']) ? $company_life_stage['subscriber'] : 0}} {{__('Subscribers')}}
                            </span>
                        </div>
                    </div>
                    <a href="{{route('companies.index')}}" class="btn btn-block btn-primary mt-auto">{{__('View All Companies')}}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8">
            <div class="page-title">
                <div class="row pb-3">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <h5 class="h4 d-inline-block font-weight-400 mb-0">{{__('My Schedules')}}</h5>
                    </div>
                </div>
                <div class="row justify-content-between align-items-center full-calender">
                    <div class="col d-flex align-items-center">
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
                                            <a href="#" class="btn btn-sm btn-neutral active" data-calendar-view="month">{{__('Month')}}</a>
                                            <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicWeek">{{__('Week')}}</a>
                                            <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicDay">{{__('Day')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id='calendar-container'>
                                    <div data-toggle="my-calendar" id="mycalendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">{{__('Recently Added Contacts')}}</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @if(count($contacts) > 0)
                            @foreach($contacts as $contact)
                                <a href="{{ route('contacts.show', $contact->id) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="{{$contact->created_at->diffForHumans()}}" data-original-title="" title="">
                                        <div>
                                            <img class="avatar bg-primary text-white rounded-circle avatar-md" {{ $contact->contactdetail->img_image }} alt="Owner">
                                        </div>
                                        <div class="flex-fill ml-3">
                                            <div class="h6 text-sm mb-0">{{ $contact->name }} <small class="float-right text-muted">{{$contact->created_at->diffForHumans()}}  <i class="fas fa-clock" aria-hidden="true"></i></small></div>
                                            <p class="text-sm lh-140 mb-0">
                                                {{ __(\App\Contact::$lifestage[$contact->contactdetail->life_stage]) }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <h6 class="mb-0">{{__('No Recently Added Contacts Found')}}</h6>   
                        @endif 
                    </div>
                </div>
            </div>
                
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{__('Recently Added Companies')}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="list-group list-group-flush">
                        @if(count($companies) > 0)
                            @foreach($companies as $company)
                                <a href="{{ route('companies.show', $company->id) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="{{$company->created_at->diffForHumans()}}" data-original-title="" title="">
                                        <div>
                                            <img class="avatar bg-primary text-white rounded-circle avatar-md" {{ $company->companydetail->img_image }} alt="Owner">
                                        </div>
                                        <div class="flex-fill ml-3">
                                            <div class="h6 text-sm mb-0">{{ $company->name }} <small class="float-right text-muted">{{$company->created_at->diffForHumans()}}  <i class="fas fa-clock" aria-hidden="true"></i></small></div>
                                            <p class="text-sm lh-140 mb-0">
                                                {{ __(\App\Company::$lifestage[$company->companydetail->life_stage]) }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <h6 class="mb-0">{{__('No Recently Added Companies Found')}}</h6>   
                        @endif 
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
                $("#commonModal .modal-title").html('{{__('View Schedule')}}');
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
</script>
@endpush
