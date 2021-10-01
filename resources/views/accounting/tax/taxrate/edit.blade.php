{{ Form::model($taxrate, ['route' => ['taxrates.update', $taxrate->id], 'method' => 'PUT']) }}
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('name', __('Name'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('name', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('tax_rate', __('Tax Rate'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::number('tax_rate', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Update', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}