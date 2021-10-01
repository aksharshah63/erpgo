{{ Form::open(['url' => 'bank_accounts', 'method' => 'post']) }}
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('holder_name', __('Bank Holder Name'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('holder_name', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('bank_name', __('Bank Name'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('bank_name', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('account_number', __('Account Number'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('account_number', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('opening_balance', __('Opening Balance'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::number('opening_balance', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('contact_number', __('Contact Number'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('contact_number', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('bank_address', __('Bank Address'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::textarea('bank_address', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) }}
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}