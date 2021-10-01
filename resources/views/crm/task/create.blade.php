{{ Form::open(['url' => 'tasks', 'method' => 'post']) }}
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('title', __('Title'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('agent_or_manager', __('Agent Or Manager'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::select('agent_or_manager', $contacts, null, ['class' => 'form-control main-element','placeholder' => 'Please Select', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {{ Form::label('date', __('Date'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('date', null, ['class' => 'form-control datepicker', 'required' => 'required']) }}
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
            {{ Form::label('description', __('Description'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::textarea('description', null, ['class' => 'form-control editor', 'rows' => '4', 'cols' => '50', 'required' => 'required']) }}
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
