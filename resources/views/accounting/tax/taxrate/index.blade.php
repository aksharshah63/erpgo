@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Tax Rates') }}
@endsection
@section('action-button')
    @can('Create Tax')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New Tax Rate') }}" data-size='md' data-url="{{ route('taxrates.create') }}">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    @endcan
@endsection

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status">{{ __('Component Name') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Tax Rate(%)') }}</th>
                @if(Gate::check('Edit Tax') || Gate::check('Delete Tax'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($taxrates as $taxrate)
                <tr>
                    <td>{{ $taxrate->name }}</td>
                    <td>{{ $taxrate->tax_rate }}</td>
                    @if(Gate::check('Edit Tax') || Gate::check('Delete Tax'))
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                @can('Edit Tax')
                                    <a href="#" class="action-item"
                                        data-url="{{ route('taxrates.edit', $taxrate->id) }}" data-ajax-popup="true"
                                        data-title="{{ __('Edit Tax Rate') }}" data-toggle="tooltip"
                                        data-original-title="{{ __('Edit') }}" data-size='md'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                @endcan
                                @can('Delete Tax')
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $taxrate->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['taxrates.destroy', $taxrate->id], 'id' => 'delete-form-' . $taxrate->id]) }}
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
