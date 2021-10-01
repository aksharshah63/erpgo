@extends('layouts.admin')
@section('title')
    {{ __('Vendor Info') }}
@endsection
@section('action-button')
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <a href="{{ route('vendors.index') }}" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary">
            <span class="btn-inner--icon"><i class="fas fa-arrow-left"></i></span>
        </a>
    </div>
@endsection
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <div class="media align-items-center">
                        <a href="#" class="avatar avatar-lg rounded-circle mr-3">
                            <img class="avatar avatar-lg" {{ $vendor->vendordetail->img_image }} alt="Owner">
                        </a>
                        <div class="media-body">
                            <div>
                                {{ Form::open(['route' => ['update.vendor.profile'],'enctype'=>'multipart/form-data','id' => 'update_avatar']) }}
                                <input type="file" name="image" id="image" class="custom-input-file custom-input-file-link" data-multiple-caption="{count} files selected" multiple/>
                                <input type="hidden" name="id" value="{{ $vendor->vendordetail->vendor_id }}"/>
                                <label for="image">
                                    <span style="cursor: pointer;"><b>{{__('Change Avatar')}}</b></span>
                                </label>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <span class="text-sm text-muted p-2">{{ __('Name') }}</span>
                    <span class="d-block h6 mb-0 p-2">{{ $vendor->first_name.' '.$vendor->last_name }}</span>
                </div>
                <div class="col-3">
                    <span class="text-sm text-muted p-2">{{ __('Email') }}</span>
                    <span class="d-block h6 mb-0 p-2"><a href="mailto:{{ $vendor->email }}">{{ $vendor->email }}</a></span>
                </div>
                <div class="col-3">
                    <span class="text-sm text-muted p-2">{{ __('Phone') }}</span>
                    <span class="d-block h6 mb-0 p-2"><a href="tel:{{ $vendor->vendordetail->phone_no }}">{{ !empty($vendor->vendordetail->phone_no) ? $vendor->vendordetail->phone_no : '-' }}</a></span>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-3">
                    <span class="text-sm text-muted p-2">{{ __('Website') }}</span>
                    <span class="d-block h6 mb-0 p-2">{{ !empty($vendor->vendordetail->website) ? $vendor->vendordetail->website : '-' }}</span>
                </div>  
                <div class="col-3">
                    <span class="text-sm text-muted p-2">{{ __('Address') }}</span>
                    <span class="d-block h6 mb-0 p-2">{{ !empty($vendor->vendordetail->address1) ? $vendor->vendordetail->address1.' '.$vendor->vendordetail->address2 : '-' }}</span>
                </div>
                <div class="col-3">
                    <span class="text-sm text-muted p-2">{{ __('Mobile') }}</span>
                    <span class="d-block h6 mb-0 p-2"><a href="tel:{{ $vendor->vendordetail->mobile_no }}">{{ !empty($vendor->vendordetail->mobile_no) ? $vendor->vendordetail->mobile_no : '-' }}</a></span>
                </div>
                <div class="col-3">
                    <span class="text-sm text-muted p-2">{{ __('Fax') }}</span>
                    <span class="d-block h6 mb-0 p-2">{{ !empty($vendor->vendordetail->fax_no) ? $vendor->vendordetail->fax_no : '-' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h5 class="h4 d-inline-block font-weight-400 mb-4">{{__('Company Info')}}</h5>
        <div class="card pb-0">
            <div class="row">
                @php
                        $totalBillSum=$vendor->vendorTotalBillSum($vendor['id']);
                        $totalBill=$vendor->vendorTotalBill($vendor['id']);
                        $averageSale=($totalBillSum!=0)?$totalBillSum/$totalBill:0;
                @endphp
                <div class="col-md-3 col-sm-6">
                    <div class="p-4">
                         <span class="text-sm text-muted p-2">{{__('Vendor Id')}}</span>
                         <span class="d-block h6 mb-0 p-2">{{AUth::user()->vendorNumberFormat($vendor['vendor_id'])}}</span>
                         <span class="text-sm text-muted p-2">{{__('Total Sum of Bills')}}</span>
                         <span class="d-block h6 mb-0 p-2">{{\Auth::user()->priceFormat($totalBillSum)}}</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="p-4">
                        <span class="text-sm text-muted p-2">{{__('Date of Creation')}}</span>
                        <span class="d-block h6 mb-0 p-2">{{\App\Utility::getDateFormated($vendor['created_at'])}}</span>
                        <span class="text-sm text-muted p-2">{{__('Quantity of Invoice')}}</span>
                        <span class="d-block h6 mb-0 p-2">{{$totalBill}}</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="p-4">
                        <span class="text-sm text-muted p-2">{{__('Balance')}}</span>
                        <span class="d-block h6 mb-0 p-2">{{\Auth::user()->priceFormat($vendor['balance'])}}</span>
                        <span class="text-sm text-muted p-2">{{__('Average Sales')}}</span>
                        <span class="d-block h6 mb-0 p-2">{{\Auth::user()->priceFormat($averageSale)}}</span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="p-4">
                        <span class="text-sm text-muted p-2">{{__('Overdue')}}</span>
                            <span class="d-block h6 mb-0 p-2">{{\Auth::user()->priceFormat($vendor->vendorOverdue($vendor['id']))}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-12">
    <h5 class="h4 d-inline-block font-weight-400 mb-4">{{__('Bills')}}</h5>
        <div class="card pb-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0 dataTable">
                    <thead>
                    <tr>
                        <th>{{__('Bill')}}</th>
                        <th>{{__('Transaction Date')}}</th>
                        <th>{{__('Due Date')}}</th>
                        <th>{{__('Due Amount')}}</th>
                        <th>{{__('Status')}}</th>
                        @if(Gate::check('Duplicate Bill') || Gate::check('View Bill') || Gate::check('Edit Bill') || Gate::check('Delete Bill'))
                            <th> {{__('Action')}}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendor->vendorInvoice($vendor->id) as $bill)
                            <tr>
                                <td class="Id"><a href="{{ route('bills.show',$bill->id) }}">{{ Auth::user()->billNumberFormat($bill->bill_id) }}</a></td>
                                <td>{{ Utility::getDateFormated($bill->transaction_date) }}</td>
                                <td>{{ Utility::getDateFormated($bill->due_date) }}</td>
                                <td>{{\Auth::user()->priceFormat($bill->getDue())}}</td>
                                <td>
                                    @if($bill->status == 0)
                                        <span class="badge badge-pill badge-primary">{{ __(\App\Bill::$statues[$bill->status]) }}</span>
                                    @elseif($bill->status == 1)
                                        <span class="badge badge-pill badge-warning">{{ __(\App\Bill::$statues[$bill->status]) }}</span>
                                    @elseif($bill->status == 2)
                                        <span class="badge badge-pill badge-danger">{{ __(\App\Bill::$statues[$bill->status]) }}</span>
                                    @elseif($bill->status == 3)
                                        <span class="badge badge-pill badge-info">{{ __(\App\Bill::$statues[$bill->status]) }}</span>
                                    @elseif($bill->status == 4)
                                        <span class="badge badge-pill badge-success">{{ __(\App\Bill::$statues[$bill->status]) }}</span>
                                    @endif
                                </td>
                                @if(Gate::check('Duplicate Bill') || Gate::check('View Bill') || Gate::check('Edit Bill') || Gate::check('Delete Bill'))
                                    <td class="Action">
                                        @can('Duplicate Bill')
                                            <a href="#" class="action-item" data-toggle="tooltip" data-original-title="{{__('Duplicate')}}" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('You want to confirm duplicate this Bill.').'|'.__('Press Yes to continue or Cancel to go back')}}" data-confirm-yes="document.getElementById('duplicate-form-{{$bill->id}}').submit();">
                                                <i class="fas fa-copy"></i>
                                                {!! Form::open(['method' => 'get', 'route' => ['bill.duplicate', $bill->id],'id'=>'duplicate-form-'.$bill->id]) !!}
                                                    {!! Form::close() !!}
                                            </a>    
                                        @endcan
                                        @can('View Bill')                       
                                            <a href="{{ route('bills.show',$bill->id) }}" class="action-item" data-toggle="tooltip" data-original-title="{{__('Detail')}}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endcan
                                        @can('Edit Bill')
                                            <a href="{{ route('bills.edit',$bill->id) }}" class="action-item" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endcan
                                        @can('Delete Bill')
                                            <a href="#" class="action-item text-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This Action Can Not Be Undone. Do You Want To Continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$bill->id}}').submit();">
                                            <i class="fas fa-trash"></i>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['bills.destroy', $bill->id],'id'=>'delete-form-'.$bill->id]) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
@endsection
@push('script')
<script>
$(document).on('change', '#image', function() {
    $('#update_avatar').submit();
});
</script>
@endpush