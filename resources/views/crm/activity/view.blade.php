@extends('layouts.admin')
@section('title')
    {{ __('View Activity') }}
@endsection
@section('content')
<ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#note" role="tab" aria-controls="pills-home" aria-selected="true">{{__('Note')}}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#task" role="tab" aria-controls="pills-profile" aria-selected="false">{{__('Task')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#email" role="tab" aria-controls="pills-profile" aria-selected="false">{{__('Email')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#log_activity" role="tab" aria-controls="pills-profile" aria-selected="false">{{__('Log Activity')}}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#schedule" role="tab" aria-controls="pills-profile" aria-selected="false">{{__('Schedule')}}</a>
    </li>
</ul>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="note" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-7 mx-auto">
                        <div class="timeline timeline-two-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                            @if(count($results) > 0)
                                @foreach($results as $result)
                                    @if(!empty($result))  
                                        <div class="timeline-block">
                                            <span class="timeline-step timeline-step-sm bg-primary border-primary text-white"><i class="fas fa-file"></i></span>
                                            <div class="timeline-content">
                                                <span class="text-muted text-sm">{{__('You Created A Note For')}} {{$result['name']}}</span>
                                                <a href="#" class="d-block h6 text-sm mb-0">{!! $result['note'] !!}</a>
                                                <small><i class="far fa-clock mr-1"></i>{{\App\Utility::getDateFormated($result['created_at'])}}</small>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach  
                            @else
                                <h5 class="text-center">{{__('No Notes Found')}}</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="task" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-7 mx-auto">
                        <div class="timeline timeline-two-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                            @if(count($results1) > 0)
                                @foreach($results1 as $result)
                                    @if(!empty($result))  
                                        <div class="timeline-block">
                                            <span class="timeline-step timeline-step-sm bg-primary border-primary text-white"><i class="fas fa-tasks"></i></span>
                                            <div class="timeline-content">
                                                <span class="text-muted text-sm">{{__('You Created A Task For')}} {{$result['agent_or_manager']}}</span>
                                                <a href="#" class="d-block h6 text-sm mb-0">{!! $result['note'] !!}</a>
                                                <small><i class="far fa-clock mr-1"></i>{{\App\Utility::getDateFormated($result['created_at'])}}</small>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach  
                            @else
                                <h5 class="text-center">{{__('No Tasks Found')}}</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-7 mx-auto">
                        <div class="timeline timeline-two-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                            @if(count($results2) > 0)
                                @foreach($results2 as $result)
                                    @if(!empty($result))  
                                        <div class="timeline-block">
                                            <span class="timeline-step timeline-step-sm bg-primary border-primary text-white"><i class="fas fa-envelope"></i></span>
                                            <div class="timeline-content">
                                                <span class="text-muted text-sm">{{__('You Created A Email For')}} {{$result['email']}}</span>
                                                <a href="#" class="d-block h6 text-sm mb-0">{!! $result['note'] !!}</a>
                                                <small><i class="far fa-clock mr-1"></i>{{\App\Utility::getDateFormated($result['created_at'])}}</small>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach  
                            @else
                                <h5 class="text-center">{{__('No Emails Found')}}</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="log_activity" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-7 mx-auto">
                        <div class="timeline timeline-two-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                            @if(count($results3) > 0)
                                @foreach($results3 as $result)
                                    @if(!empty($result))  
                                        <div class="timeline-block">
                                            <span class="timeline-step timeline-step-sm bg-primary border-primary text-white"><i class="fas fa-history"></i></span>
                                            <div class="timeline-content">
                                                <span class="text-muted text-sm">{{__('You')}} {{\App\LogActivity::$type[$result['type']]}} {{__('On')}} {{\App\Utility::getDateFormated($result['start_date'])}} {{__('At')}} {{\App\Utility::timeFormat($result['time'])}} {{__('For')}} {{$result['name']}}</span>
                                                <a href="#" class="d-block h6 text-sm mb-0">{!!$result['note'] !!}</a>
                                                <small><i class="far fa-clock mr-1"></i>{{\App\Utility::getDateFormated($result['created_at'])}}</small>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach  
                            @else
                                <h5 class="text-center">{{__('No Log Activities Found')}}</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="schedule" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-7 mx-auto">
                        <div class="timeline timeline-two-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                            @if(count($results4) > 0)
                                @foreach($results4 as $result)
                                    @if(!empty($result))  
                                        <div class="timeline-block">
                                            <span class="timeline-step timeline-step-sm bg-primary border-primary text-white"><i class="fas fa-calendar"></i></span>
                                            <div class="timeline-content">
                                                <span class="text-muted text-sm">{{__('You')}} {{\App\Schedule::$schedule_type[$result['type']]}} {{__('On')}} {{\App\Utility::getDateFormated($result['start_date'])}} {{__('At')}} {{\App\Utility::timeFormat($result['time'])}} {{__('For')}} {{$result['name']}}</span>
                                                <a href="#" class="d-block h6 text-sm mb-0">{!!$result['note'] !!}</a>
                                                <small><i class="far fa-clock mr-1"></i>{{\App\Utility::getDateFormated($result['created_at'])}}</small>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach  
                            @else
                                <h5 class="text-center">{{__('No Schedules Found')}}</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
</div>
@endsection