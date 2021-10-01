{{ Form::model($productCategory, ['route' => ['product_categories.update', $productCategory->id], 'method' => 'PUT']) }}
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('category_name', __('Category Name'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('category_name',$productCategory->name, ['class' => 'form-control', 'required' => 'required']) }}
        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('type', __('Category Type'), ['class' => 'form-control-label']) }}<span class="text-danger">*</span>
            <select name="type" id="type" class="form-control main-element">
                @foreach(\App\ProductCategory::$categoryType as $k => $v)
                    <option value="{{$k}}" {{ ($productCategory->type == $k) ? 'selected' : ''}}>{{__($v)}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            {{ Form::label('color', __('Category Color'),['class'=>'form-control-label']) }}<span class="text-danger">*</span>
            {{ Form::text('color', null, array('class' => 'form-control colorpicker','required'=>'required')) }}
            <small>{{__('For chart representation')}}</small>
        </div>
    </div>
    <div class="col-12 pt-5 text-right">
        {{ Form::submit('Update', ['class' => 'btn btn-sm btn-primary btn-icon rounded-pill']) }}
    </div>
</div>
{!! Form::close() !!}