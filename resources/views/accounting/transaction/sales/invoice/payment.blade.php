{{ Form::open(array('route' => array('invoice.payment', $invoice->id),'method'=>'post')) }}
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('date', __('Date'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('date', '', array('class' => 'form-control datepicker','required'=>'required')) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('amount', __('Amount'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('amount',$invoice->getDue(), array('class' => 'form-control','required'=>'required')) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('account_id', __('Account'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::select('account_id',$accounts,null, array('class' => 'form-control','required'=>'required')) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('reference', __('Reference'), ['class' => 'form-control-label']) }}
            {{ Form::text('reference', '', array('class' => 'form-control')) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('description', __('Description')) }}
            {{ Form::textarea('description', '', array('class' => 'form-control','rows'=>3)) }}
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}