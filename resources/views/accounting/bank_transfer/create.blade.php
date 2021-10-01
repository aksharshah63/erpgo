{{ Form::open(['url' => 'transfers', 'method' => 'post']) }}
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('from_account', __('From Account'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::select('from_account', $bankAccount, null, ['class' => 'form-control main-element']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('to_account', __('To Account'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::select('to_account', $bankAccount, null, ['class' => 'form-control main-element']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('amount', __('Amount'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::number('amount', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('date', __('Date'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('date', null, ['class' => 'form-control datepicker']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('reference', __('Reference'), ['class' => 'form-control-label']) }}
            {{ Form::text('reference', null, ['class' => 'form-control']) }}
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
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}