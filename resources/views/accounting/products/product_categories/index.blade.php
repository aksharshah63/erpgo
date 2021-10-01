@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Product-Service & Income-Expense Category') }}
@endsection
@section('action-button')
    @can('Create Product Category')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New Product Category') }}" data-size='md' data-url="{{ route('product_categories.create') }}">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    @endcan
@endsection

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status">{{ __('Category Name') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Type') }}</th>
                @if(Gate::check('Edit Product Category') || Gate::check('Delete Product Category'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($productcategories as $product_category)
                <tr>
                    <td>{{ $product_category->name }}</td>
                    <td>{{ \App\ProductCategory::$categoryType[$product_category->type] }}</td>
                    @if(Gate::check('Edit Product Category') || Gate::check('Delete Product Category'))
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                @can('Edit Product Category')
                                    <a href="#" class="action-item"
                                        data-url="{{ route('product_categories.edit', $product_category->id) }}" data-ajax-popup="true"
                                        data-title="{{ __('Edit Product Category') }}" data-toggle="tooltip"
                                        data-original-title="{{ __('Edit') }}" data-size='md'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                @endcan
                                @can('Delete Product Category')
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $product_category->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['product_categories.destroy', $product_category->id], 'id' => 'delete-form-' . $product_category->id]) }}
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
@push('script')
<script src="{{ asset('assets/js/bootstrap-colorpicker.min.js') }}"></script>
@endpush
