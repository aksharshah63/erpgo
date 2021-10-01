{{ Form::model($Schedule, ['route' => ['schedules.update', $Schedule->id], 'method' => 'PUT']) }}
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('title', __('Title'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="customSwitch1">
                {{ Form::checkbox('all_day', null, $Schedule->all_day , ['class' => 'custom-control-input all_day','id' => 'all_day']) }}
                {{ Form::label('all_day', __('All Day'), ['class' => 'custom-control-label']) }}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            {{ Form::label('start_date', __('Start Date'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('start_date', null, ['class' => 'form-control datepicker', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col start_time {{$Schedule->all_day == 0 ? '' : 'd-none'}}">
        <div class="form-group">
            {{ Form::label('start_time', __('Time'), ['class' => 'form-control-label']) }}
            {{ Form::time('start_time', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {{ Form::label('end_date', __('End Date'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('end_date', null, ['class' => 'form-control datepicker', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col end_time {{$Schedule->all_day == 0 ? '' : 'd-none'}}">
        <div class="form-group">
            {{ Form::label('end_time', __('Time'), ['class' => 'form-control-label']) }}
            {{ Form::time('end_time', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('note', __('Note'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::textarea('note', null, ['class' => 'form-control editor', 'rows' => '4', 'cols' => '50', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('agent_or_manager', __('Agent or manager'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::select('agent_or_manager', Auth::user()->contacts->pluck('name','name')->toArray(), $Schedule->agent_or_manager, ['class' => 'form-control main-element', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('schedule_type', __('Schedule Type'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{-- {{ Form::select('schedule_type', ['meeting' => 'Meeting', 'call' => 'Call'], null, ['class' => 'form-control main-element', 'required' => 'required']) }} --}}
            <select name="schedule_type" id="schedule_type" class="form-control main-element" required>
                <option value="">{{__('Please Select')}}</option>
                @foreach(\App\Schedule::$schedule_type as $k => $v)
                    <option value="{{$k}}" {{ ($Schedule->schedule_type == $k) ? 'selected' : ''}}>{{__($v)}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="customSwitch1">
                {{ Form::checkbox('all_notification', null, $Schedule->all_notification, ['class' => 'custom-control-input all_notification','id' => 'all_notification']) }}
                {{ Form::label('all_notification', __('All Notification'), ['class' => 'custom-control-label']) }}
            </div>
        </div>
    </div>
</div>
<div class="row notification_allow {{$Schedule->all_notification != 1 ? 'd-none' : ''}}">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('email', __('Email'), ['class' => 'form-control-label']) }}
            {{ Form::email('email', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Update', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}
