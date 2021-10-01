{{ Form::open(['url' => 'educations ', 'method' => 'post']) }}
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('school_name', __('School Name'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('school_name', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('degree', __('Degree'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('degree', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('field_of_study', __('Field of Study'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('field_of_study', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('year_of_completion', __('Year of Completion'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('year_of_completion', null, ['class' => 'form-control yearpicker', 'required' => 'required']) }}
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
        {{ Form::hidden('id', $id) }}
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}
