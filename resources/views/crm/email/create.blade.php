{{ Form::open(['url' => 'emails', 'method' => 'post']) }}
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('email', __('Email'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('subject', __('Subject'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('subject', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('description', __('Description'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::textarea('description', null, ['class' => 'form-control editor', 'rows' => '4', 'cols' => '50', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::hidden('type', $type) }}
        {{ Form::hidden('id', $id) }}
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}
