{{ Form::open(['url' => 'chart_of_accounts', 'method' => 'post']) }}
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('name', __('Name'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('code', __('Code'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('code', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('type', __('Account'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::select('type', $types, null, ['class' => 'form-control main-element']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('sub_type', __('Type'), ['class' => 'form-control-label']) }}
            <select class="form-control select2" name="sub_type" id="sub_type" required>

            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{Form::label('is_enabled',__('Is Enabled'),array('class'=>'form-control-label')) }}
            <div class="custom-control custom-switch">
                <input type="checkbox" class="email-template-checkbox custom-control-input" name="is_enabled" id="is_enabled" checked>
                <label class="custom-control-label form-control-label" for="is_enabled"></label>
            </div>
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