{{ Form::open(['url' => 'leave_requests', 'method' => 'post']) }}
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('user', __('User'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::select('user', $userList, null, ['class' => 'form-control main-element', 'id' => 'user', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('from', __('From'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('from', null, ['class' => 'form-control', 'id' => 'from', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('to', __('To'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('to', null, ['class' => 'form-control', 'id' => 'to', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('reason', __('Reason'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::textarea('reason', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50', 'required' => 'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            {{ Form::label('note', __('Note'), ['class' => 'form-control-label']) }}<span class="text-danger text-sm"><p>{{__('Sunday Is Not Count In Your Leave')}}</p></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 pt-5 text-right">
        {{ Form::hidden('days', null, ['class' => 'form-control datepicker', 'id' => 'days']) }}
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}
