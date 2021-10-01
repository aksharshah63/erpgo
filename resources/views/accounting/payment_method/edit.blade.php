{{ Form::model($paymentMethod, ['route' => ['payment_methods.update', $paymentMethod->id], 'method' => 'PUT']) }}
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('name', __('Name'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('name', $paymentMethod->name, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Update', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}