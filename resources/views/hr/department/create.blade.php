{{ Form::open(['url' => 'departments', 'method' => 'post']) }}
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('title', __('Title'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('description', __('Description'), ['class' => 'form-control-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('department_leads', __('Department Leads'), ['class' => 'form-control-label']) }}
            {{ Form::select('department_leads', $userList, null, ['class' => 'form-control main-element']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('parent_department', __('Parent Department'), ['class' => 'form-control-label']) }}
            {{ Form::select('parent_department', $departmentids, null, ['class' => 'form-control main-element']) }}
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}
