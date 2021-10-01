{{ Form::model($productAndService, ['route' => ['product_and_services.update', $productAndService->id], 'method' => 'PUT']) }}
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('product_name', __('Product Name'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('product_name', null, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group" style="border-bottom: 1px solid;">
            {{ Form::label('Product/Service Details', __('Product/Service Details'), ['class' => 'form-control-label']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('product_type', __('Product Type'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            <select name="product_type" id="product_type" class="form-control main-element">
                @foreach(\App\ProductAndService::$product_type as $k => $v)
                    <option value="{{$k}}" {{ ($productAndService->product_type == $k) ? 'selected' : ''}}>{{__($v)}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('category', __('Category'), ['class' => 'form-control-label']) }}
            {{ Form::select('category',$categoryids, $productAndService->category, ['class' => 'form-control main-element']) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group" style="border-bottom: 1px solid;">
            {{ Form::label('Product Information', __('Product Information'), ['class' => 'form-control-label']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('cost_price', __('Cost Price'), ['class' => 'form-control-label']) }}
            {{ Form::text('cost_price', (isset($productAndService->cost_price) ? $productAndService->cost_price : '0'), ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            {{ Form::label('sale_price', __('Sale Price'), ['class' => 'form-control-label']) }}
            {{ Form::text('sale_price', (isset($productAndService->sale_price) ? $productAndService->sale_price : '0'), ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group" style="border-bottom: 1px solid;">
            {{ Form::label('Miscellaneous', __('Miscellaneous'), ['class' => 'form-control-label']) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('tax', __('Tax'), ['class' => 'form-control-label']) }}
            {{ Form::select('tax',$taxids, explode(',',$productAndService->tax_rate_id), ['class' => 'form-control main-element select2-dropdown','multiple'=>'multiple','name'=>'tax[]']) }}
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Update', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}