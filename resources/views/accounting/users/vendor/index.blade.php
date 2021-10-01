@extends('layouts.admin')
@section('content')
@section('title')
    {{ __('Manage Vendors') }}
@endsection
@section('action-button')
    @can('Create Vendor')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" data-ajax-popup="true"
                data-title="{{ __('Add New Vendor') }}" data-size='lg' data-url="{{ route('vendors.create') }}">
                <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
            </a>
        </div>
    @endcan
@endsection

<div class="table-responsive">
    <table class="table align-items-center dataTable">
        <thead>
            <tr>
                <th scope="col" class="sort" data-sort="status">{{ __('Vendor Id') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Name') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Company') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Email') }}</th>
                <th scope="col" class="sort" data-sort="status">{{ __('Phone') }}</th>
                @if(Gate::check('View Vendor') || Gate::check('Edit Vendor') || Gate::check('Delete Vendor'))
                    <th>{{ __('Action') }}</th>
                @endif
            </tr>
        </thead>
        <tbody class="list">
            @foreach ($vendors as $vendor)
                <tr>
                    <td class="Id"><a href="{{ route('vendors.show',$vendor->id) }}">{{Auth::user()->vendorNumberFormat($vendor->vendor_id) }}</a></td>
                    <td>{{ $vendor->first_name.' '. $vendor->last_name }}</td>
                    <td>{{ (!empty($vendor->vendordetail->company) ? $vendor->vendordetail->company : '-') }}</td>
                    <td>{{ $vendor->email }}</td>
                    <td>{{ (!empty($vendor->vendordetail->phone_no) ? $vendor->vendordetail->phone_no : '-') }}</td>
                    @if(Gate::check('View Vendor') || Gate::check('Edit Vendor') || Gate::check('Delete Vendor'))
                        <td>
                            <!-- Actions -->
                            <div class="actions ml-12">
                                @can('View Vendor')
                                    <a href="{{ route('vendors.show', $vendor->id) }}" class="action-item"
                                        data-toggle="tooltip" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                @endcan
                                @can('Edit Vendor')
                                    <a href="#" class="action-item"
                                        data-url="{{ route('vendors.edit', $vendor->id) }}" data-ajax-popup="true"
                                        data-title="{{ __('Edit Vendor') }}" data-toggle="tooltip"
                                        data-original-title="{{ __('Edit') }}" data-size='lg'>
                                        <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                                    </a>
                                @endcan
                                @can('Delete Vendor')
                                    <a href="#" class="action-item text-danger" data-toggle="tooltip"
                                        data-original-title="{{ __('Delete') }}"
                                        data-confirm="{{__('Are You Sure?|This action can not be undone. Do you want to continue?')}}"
                                        data-confirm-yes="document.getElementById('delete-form-{{ $vendor->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['vendors.destroy', $vendor->id], 'id' => 'delete-form-' . $vendor->id]) }}
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
