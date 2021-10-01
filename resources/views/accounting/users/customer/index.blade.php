@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Customers') }}
@endsection
@section('action-button')
    @can('Create Customer')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New Customer') }}" data-size='lg' data-url="{{ route('customers.create') }}">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    @endcan
@endsection

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status">{{ __('Customer Id') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Name') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Company') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Email') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Phone') }}</th>
                @if(Gate::check('View Customer') || Gate::check('Edit Customer') || Gate::check('Delete Customer'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($customers as $customer)
                <tr>
                    <td class="Id"><a href="{{ route('customers.show',$customer->id) }}">{{ Auth::user()->customerNumberFormat($customer->customer_id) }}</a></td>
                    <td>{{ $customer->first_name.' '. $customer->last_name }}</td>
                    <td>{{ (!empty($customer->customerdetail->company) ? $customer->customerdetail->company : '-') }}</td>
                    <td>{{ __($customer->email) }}</td>
                    <td>{{ (!empty($customer->customerdetail->phone_no) ? $customer->customerdetail->phone_no : '-') }}</td>
                    @if(Gate::check('View Customer') || Gate::check('Edit Customer') || Gate::check('Delete Customer'))
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                @can('View Customer')
                                    <a href="{{ route('customers.show', $customer->id) }}" class="action-item"
                                        data-toggle="tooltip" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @endcan
                                @can('Edit Customer')
                                    <a href="#" class="action-item"
                                        data-url="{{ route('customers.edit', $customer->id) }}" data-ajax-popup="true"
                                        data-title="{{ __('Edit Customer') }}" data-toggle="tooltip"
                                        data-original-title="{{ __('Edit') }}" data-size='lg'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                @endcan
                                @can('Delete Customer')
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $customer->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['customers.destroy', $customer->id], 'id' => 'delete-form-' . $customer->id]) }}
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
