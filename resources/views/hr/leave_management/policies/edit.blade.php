{{ Form::model($policy, ['route' => ['policies.update', $policy->id], 'method' => 'PUT']) }}
<div class="row">
    <div class="col">
        <div class="form-group">
            {{ Form::label('policy_name', __('Policy Name'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('policy_name', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            {{ Form::label('department', __('Department'), ['class' => 'form-control-label']) }}
            {{ Form::select('department', $departmentList, $policy->department, ['class' => 'form-control main-element']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            {{ Form::label('description', __('Description'), ['class' => 'form-control-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control editor', 'rows' => '4', 'cols' => '50']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}
