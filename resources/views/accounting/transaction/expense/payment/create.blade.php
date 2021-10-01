{{ Form::open(['url' => 'payments', 'method' => 'post']) }}
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('date', __('Date'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('date', null, ['class' => 'form-control datepicker']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('amount', __('Amount'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::number('amount', null, ['class' => 'form-control','step'=>'0.01']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('account_id', __('Account'),['class'=>'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::select('account_id',$accounts, null, ['class' => 'form-control main-element','id'=>'customer','required'=>'required']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('vendor_id', __('Vendor'),['class'=>'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::select('vendor_id',$vendors, null, ['class' => 'form-control main-element','id'=>'customer','required'=>'required']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('description', __('Description'),['class'=>'form-control-label']) }}
            {{ Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) }}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('category_id', __('Category'),['class'=>'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::select('category_id',$categories, null, ['class' => 'form-control main-element','id'=>'customer','required'=>'required']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('reference', __('Reference'),['class'=>'form-control-label']) }}
            {{ Form::text('reference', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Save', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}