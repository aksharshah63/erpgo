@extends('layouts.admin')
@section('title')
    {{ __('Customer Info') }}
@endsection
@section('action-button')
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <a href="{{ route('customers.index') }}" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary">
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
                                <img class="avatar avatar-lg" {{ $customer->customerdetail->img_image }} alt="Owner">
                            </a>
                            <div class="media-body">
                                <div>
                                    {{ Form::open(['route' => ['update.customer.profile'],'enctype'=>'multipart/form-data','id' => 'update_avatar']) }}
                                    <input type="file" name="image" id="image" class="custom-input-file custom-input-file-link" data-multiple-caption="{count} files selected" multiple/>
                                    <input type="hidden" name="id" value="{{ $customer->customerdetail->customer_id }}"/>
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
                        <span class="d-block h6 mb-0 p-2">{{ $customer->first_name.' '.$customer->last_name }}</span>
                    </div>
                    <div class="col-3">
                        <span class="text-sm text-muted p-2">{{ __('Email') }}</span>
                        <span class="d-block h6 mb-0 p-2"><a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a></span>
                    </div>
                    <div class="col-3">
                        <span class="text-sm text-muted p-2">{{ __('Phone') }}</span>
                        <span class="d-block h6 mb-0 p-2"><a href="tel:{{ $customer->customerdetail->phone_no }}">{{ !empty($customer->customerdetail->phone_no) ? $customer->customerdetail->phone_no : '-' }}</a></span>
                    </div>
                </div>
                <div class="row pt-3">
                    <div class="col-3">
                        <span class="text-sm text-muted p-2">{{ __('Website') }}</span>
                        <span class="d-block h6 mb-0 p-2">{{ !empty($customer->customerdetail->website) ? $customer->customerdetail->website : '-' }}</span>
                    </div>  
                    <div class="col-3">
                        <span class="text-sm text-muted p-2">{{ __('Address') }}</span>
                        <span class="d-block h6 mb-0 p-2">{{ !empty($customer->customerdetail->address1) ? $customer->customerdetail->address1.' '.$customer->customerdetail->address2 : '-' }}</span>
                    </div>
                    <div class="col-3">
                        <span class="text-sm text-muted p-2">{{ __('Mobile') }}</span>
                        <span class="d-block h6 mb-0 p-2"><a href="tel:{{ $customer->customerdetail->mobile_no }}">{{ !empty($customer->customerdetail->mobile_no) ? $customer->customerdetail->mobile_no : '-' }}</a></span>
                    </div>
                    <div class="col-3">
                        <span class="text-sm text-muted p-2">{{ __('Fax') }}</span>
                        <span class="d-block h6 mb-0 p-2">{{ !empty($customer->customerdetail->fax_no) ? $customer->customerdetail->fax_no : '-' }}</span>
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
                        $totalInvoiceSum=$customer->customerTotalInvoiceSum($customer['id']);
                        $totalInvoice=$customer->customerTotalInvoice($customer['id']);
                        $averageSale=($totalInvoiceSum!=0)?$totalInvoiceSum/$totalInvoice:0;
                    @endphp
                    <div class="col-md-3 col-sm-6">
                        <div class="p-4">
                            <span class="text-sm text-muted p-2">{{__('Customer Id')}}</span>
                            <span class="d-block h6 mb-0 p-2">{{AUth::user()->customerNumberFormat($customer['customer_id'])}}</span>
                            <span class="text-sm text-muted p-2">{{__('Total Sum of Invoices')}}</span>
                            <span class="d-block h6 mb-0 p-2">{{\Auth::user()->priceFormat($totalInvoiceSum)}}</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="p-4">
                            <span class="text-sm text-muted p-2">{{__('Date of Creation')}}</span>
                            <span class="d-block h6 mb-0 p-2">{{\App\Utility::getDateFormated($customer['created_at'])}}</span>
                            <span class="text-sm text-muted p-2">{{__('Quantity of Invoice')}}</span>
                            <span class="d-block h6 mb-0 p-2">{{$totalInvoice}}</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="p-4">
                            <span class="text-sm text-muted p-2">{{__('Balance')}}</span>
                            <span class="d-block h6 mb-0 p-2">{{\Auth::user()->priceFormat($customer['balance'])}}</span>
                            <span class="text-sm text-muted p-2">{{__('Average Sales')}}</span>
                            <span class="d-block h6 mb-0 p-2">{{\Auth::user()->priceFormat($averageSale)}}</span>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="p-4">
                            <span class="text-sm text-muted p-2">{{__('Overdue')}}</span>
                            <span class="d-block h6 mb-0 p-2">{{\Auth::user()->priceFormat($customer->customerOverdue($customer['id']))}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h5 class="h4 d-inline-block font-weight-400 mb-4">{{__('Proposal')}}</h5>
                <div class="card pb-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 dataTable">
                            <thead>
                            <tr>
                                <th>{{__('Proposal')}}</th>
                                <th>{{__('Transaction Date')}}</th>
                                <th>{{__('Amount')}}</th>
                                <th>{{__('Status')}}</th>
                                @if(Gate::check('Duplicate Invoice Proposal') || Gate::check('View Invoice Proposal') || Gate::check('Edit Invoice Proposal') || Gate::check('Delete Invoice Proposal'))
                                    <th> {{__('Action')}}</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($customer->customerProposal($customer->id) as $proposal)
                                <tr>
                                    <td class="Id">
                                            <a href="{{ route('proposals.show',$proposal->id) }}">{{AUth::user()->proposalNumberFormat($proposal->proposal_id) }}
                                            </a>
                                    </td>
                                    <td>{{ \App\Utility::getDateFormated($proposal->transaction_date) }}</td>
                                    <td>{{ Auth::user()->priceFormat($proposal->getTotal()) }}</td>
                                    <td>
                                        @if($proposal->status == 0)
                                            <span class="badge badge-pill badge-primary">{{ __(\App\Proposal::$statues[$proposal->status]) }}</span>
                                        @elseif($proposal->status == 1)
                                            <span class="badge badge-pill badge-info">{{ __(\App\Proposal::$statues[$proposal->status]) }}</span>
                                        @elseif($proposal->status == 2)
                                            <span class="badge badge-pill badge-success">{{ __(\App\Proposal::$statues[$proposal->status]) }}</span>
                                        @elseif($proposal->status == 3)
                                            <span class="badge badge-pill badge-warning">{{ __(\App\Proposal::$statues[$proposal->status]) }}</span>
                                        @elseif($proposal->status == 4)
                                            <span class="badge badge-pill badge-danger">{{ __(\App\Proposal::$statues[$proposal->status]) }}</span>
                                        @endif
                                    </td>
                                    @if(Gate::check('Duplicate Invoice Proposal') || Gate::check('View Invoice Proposal') || Gate::check('Edit Invoice Proposal') || Gate::check('Delete Invoice Proposal'))
                                        <td class="Action">
                                            @can('Duplicate Invoice Proposal')
                                                <a href="#" class="action-item" data-toggle="tooltip" data-original-title="{{__('Duplicate')}}" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('You want to confirm duplicate this Proposal.').'|'.__('Press Yes to continue or Cancel to go back')}}" data-confirm-yes="document.getElementById('duplicate-form-{{$proposal->id}}').submit();">
                                                <i class="fas fa-copy"></i>
                                                {!! Form::open(['method' => 'get', 'route' => ['proposal.duplicate', $proposal->id],'id'=>'duplicate-form-'.$proposal->id]) !!}
                                                    {!! Form::close() !!}
                                                </a>
                                            @endcan
                                            @can('View Invoice Proposal')
                                                <a href="{{ route('proposals.show',$proposal->id) }}" class="action-item" data-toggle="tooltip" data-original-title="{{__('Detail')}}">
                                                <i class="fas fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('Edit Invoice Proposal')
                                                <a href="{{ route('proposals.edit',$proposal->id) }}" class="action-item" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                                <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            @endcan
                                            @can('Delete Invoice Proposal')
                                                <a href="#" class="action-item text-danger" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This Action Can Not Be Undone. Do You Want To Continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$proposal->id}}').submit();">
                                                <i class="fas fa-trash"></i>
                                                </a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['proposals.destroy', $proposal->id],'id'=>'delete-form-'.$proposal->id]) !!}
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
    </div>
    <div class="col-12">
        <h5 class="h4 d-inline-block font-weight-400 mb-4">{{__('Invoice')}}</h5>
            <div class="card pb-0">
                <div class="table-responsive">
                    <table class="table table-striped mb-0 dataTable">
                        <thead>
                        <tr>
                            <th>{{__('Invoice')}}</th>
                            <th>{{__('Transaction Date')}}</th>
                            <th>{{__('Due Date')}}</th>
                            <th>{{__('Due Amount')}}</th>
                            <th>{{__('Status')}}</th>
                            @if(Gate::check('Duplicate Invoice') || Gate::check('View Invoice') || Gate::check('Edit Invoice') || Gate::check('Delete Invoice'))
                                <th> {{__('Action')}}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($customer->customerInvoice($customer->id) as $invoice)
                                <tr>
                                    <td class="Id"><a href="{{ route('invoices.show',$invoice->id) }}">{{ Auth::user()->invoiceNumberFormat($invoice->invoice_id) }}</a></td>
                                    <td>{{ Utility::getDateFormated($invoice->transaction_date) }}</td>
                                    <td>{{ Utility::getDateFormated($invoice->due_date) }}</td>
                                    <td>{{\Auth::user()->priceFormat($invoice->getDue())}}</td>
                                    <td>
                                        @if($invoice->status == 0)
                                            <span class="badge badge-pill badge-primary">{{ __(\App\Invoice::$statues[$invoice->status]) }}</span>
                                        @elseif($invoice->status == 1)
                                            <span class="badge badge-pill badge-warning">{{ __(\App\Invoice::$statues[$invoice->status]) }}</span>
                                        @elseif($invoice->status == 2)
                                            <span class="badge badge-pill badge-danger">{{ __(\App\Invoice::$statues[$invoice->status]) }}</span>
                                        @elseif($invoice->status == 3)
                                            <span class="badge badge-pill badge-info">{{ __(\App\Invoice::$statues[$invoice->status]) }}</span>
                                        @elseif($invoice->status == 4)
                                            <span class="badge badge-pill badge-success">{{ __(\App\Invoice::$statues[$invoice->status]) }}</span>
                                        @endif
                                    </td>
                                    @if(Gate::check('Duplicate Invoice') || Gate::check('View Invoice') || Gate::check('Edit Invoice') || Gate::check('Delete Invoice'))
                                        <td class="Action">  
                                            @can('Duplicate Invoice')
                                                <a href="#" class="action-item" data-toggle="tooltip" data-original-title="{{__('Duplicate')}}" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('You want to confirm duplicate this Invoice.').'|'.__('Press Yes to continue or Cancel to go back')}}" data-confirm-yes="document.getElementById('duplicate-form-{{$invoice->id}}').submit();">
                                                    <i class="fas fa-copy"></i>
                                                    {!! Form::open(['method' => 'get', 'route' => ['invoice.duplicate', $invoice->id],'id'=>'duplicate-form-'.$invoice->id]) !!}
                                                        {!! Form::close() !!}
                                                </a> 
                                            @endcan    
                                            @can('View Invoice')                      
                                                <a href="{{ route('invoices.show',$invoice->id) }}" class="action-item" data-toggle="tooltip" data-original-title="{{__('Detail')}}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('Edit Invoice')
                                                <a href="{{ route('invoices.edit',$invoice->id) }}" class="action-item" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            @endcan
                                            @can('Delete Invoice')
                                                <a href="#" class="action-item text-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This Action Can Not Be Undone. Do You Want To Continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$invoice->id}}').submit();">
                                                <i class="fas fa-trash"></i>
                                                </a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['invoices.destroy', $invoice->id],'id'=>'delete-form-'.$invoice->id]) !!}
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