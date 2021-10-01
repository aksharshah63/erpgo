@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Products') }}
@endsection
@section('action-button')
    @can('Create Product')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New Product') }}" data-size='md' data-url="{{ route('product_and_services.create') }}">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    @endcan
@endsection

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status">{{ __('Product Name') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Sale Price') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Cost Price') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Product Category') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Tax') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Product Type') }}</th>
                @if(Gate::check('Edit Product') || Gate::check('Delete Product'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($productandservices as $productandservice)
                <tr>
                    <td>{{ $productandservice->product_name }}</td>
                    <td>{{ !empty(number_format($productandservice->sale_price,2)) ? number_format($productandservice->sale_price,2) : '0' }}</td>
                    <td>{{ !empty(number_format($productandservice->cost_price,2)) ? number_format($productandservice->cost_price,2) : '0'}}</td>
                    <td>{{ !empty($productandservice->productcategory->name) ? $productandservice->productcategory->name : '-' }}</td>
                    <td>
                        @php
                            $taxes=\Utility::tax($productandservice->tax_rate_id);
                        @endphp

                        @foreach($taxes as $tax)
                            {{ !empty($tax) ? $tax->name : '-'  }}<br>
                        @endforeach 
                    </td>
                    <td>{{ __(\App\ProductAndService::$product_type[$productandservice->product_type]) }}</td>
                    @if(Gate::check('Edit Product') || Gate::check('Delete Product'))
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                @can('Edit Product')
                                    <a href="#" class="action-item"
                                        data-url="{{ route('product_and_services.edit', $productandservice->id) }}" data-ajax-popup="true"
                                        data-title="{{ __('Edit Product') }}" data-toggle="tooltip"
                                        data-original-title="{{ __('Edit') }}" data-size='md'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                @endcan
                                @can('Delete Product')
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $productandservice->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['product_and_services.destroy', $productandservice->id], 'id' => 'delete-form-' . $productandservice->id]) }}
                                    {{ Form::close() }}
                                @endcan
                            </div>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection

