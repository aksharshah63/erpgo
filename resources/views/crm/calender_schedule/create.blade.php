{{ Form::open(['url' => 'calender_schedules', 'method' => 'post']) }}
<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('type', __('Type'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::select('type', ['log_a_call' => 'Log A Call', 'log_a_email' => 'Log A Email', 'log_a_sms' => 'Log A SMS', 'log_a_meeting' => 'Log A Meeting'], null, ['class' => 'form-control main-element','placeholder' => 'Please Select', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('date', __('Date'), ['class' => 'form-control-label']) }}
            {{ Form::text('date', null, ['class' => 'form-control','readonly' => true]) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('time', __('Time'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::time('time', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('note', __('Note'), ['class' => 'form-control-label']) }}
            {{ Form::textarea('note', null, ['class' => 'form-control editor', 'rows' => '4', 'cols' => '50']) }}
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}
