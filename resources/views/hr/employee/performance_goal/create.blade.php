{{ Form::open(['url' => 'performance_goals', 'method' => 'post']) }}
<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('set_date', __('Set Date'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('set_date', null, ['class' => 'form-control datepicker', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('completion_date', __('Completion Date'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('completion_date', null, ['class' => 'form-control datepicker', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('supervisor', __('Supervisor'), ['class' => 'form-control-label']) }}
            {{ Form::select('supervisor', $userList, null, ['class' => 'form-control main-element']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('goal_description', __('Goal Description'), ['class' => 'form-control-label']) }}
            {{ Form::textarea('goal_description', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('employee_assessment', __('Employee Assessment'), ['class' => 'form-control-label']) }}
            {{ Form::textarea('employee_assessment', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('supervisor_assessment', __('Supervisor Assessment'), ['class' => 'form-control-label']) }}
            {{ Form::textarea('supervisor_assessment', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 pt-5 text-right">
        {{ Form::hidden('id', $id) }}
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}
