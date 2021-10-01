{{ Form::open(['url' => 'schedules', 'method' => 'post']) }}
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
                {{ Form::checkbox('all_day', null, false, ['class' => 'custom-control-input all_day','id' => 'all_day']) }}
                {{ Form::label('all_day', 'All Day', ['class' => 'custom-control-label']) }}
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
    <div class="col start_time">
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
    <div class="col end_time">
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
            {{ Form::label('agent_or_manager', __('Agent Or Manager'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::select('agent_or_manager', $contacts, null, ['class' => 'form-control main-element','placeholder' => 'Please Select', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            {{ Form::label('schedule_type', __('Schedule Type'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            <select name="schedule_type" id="schedule_type" class="form-control main-element" required >
                <option value="">{{__('Please Select')}}</option>
                @foreach(\App\Schedule::$schedule_type as $k => $v)
                    <option value="{{$k}}">{{__($v)}}</option>
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
                {{ Form::checkbox('all_notification', null, false, ['class' => 'custom-control-input all_notification','id' => 'all_notification']) }}
                {{ Form::label('all_notification', 'All notification', ['class' => 'custom-control-label']) }}
            </div>
        </div>
    </div>
</div>
<div class="row notification_allow d-none">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('email', __('Email'), ['class' => 'form-control-label']) }}
            {{ Form::email('email', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 pt-5 text-right">
        {{ Form::hidden('type', $type) }}
        {{ Form::hidden('id', $id) }}
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}
