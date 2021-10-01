{{ Form::model($holiday, ['route' => ['holidays.update', $holiday->id], 'method' => 'PUT']) }}
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('holiday_name', __('Holiday Name'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('holiday_name', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('start_date', __('Start Date'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('start_date', null, ['class' => 'form-control datepicker', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="customSwitch1">
                {{ Form::checkbox('range', null, $holiday->range, ['class' => 'custom-control-input range','id' => 'range']) }}
                {{ Form::label('range', __('Range'), ['class' => 'custom-control-label']) }}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12 enddate {{$holiday->range != 1 ? 'd-none' : ''}}">
        <div class="form-group">
            {{ Form::label('end_date', __('End Date'), ['class' => 'form-control-label']) }}
            {{ Form::text('end_date', null, ['class' => 'form-control datepicker']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('description', __('Description'), ['class' => 'form-control-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}
