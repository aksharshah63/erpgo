{{ Form::model($workExperience, ['route' => ['work_experiences.update', $workExperience->id], 'method' => 'PUT']) }}
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('previous_company', __('Previous Company'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('previous_company', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('job_title', __('Job Title'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('job_title', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('from', __('From'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('from', null, ['class' => 'form-control datepicker', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('to', __('To'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('to', null, ['class' => 'form-control datepicker', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('job_description', __('Job Description'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::textarea('job_description', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}
