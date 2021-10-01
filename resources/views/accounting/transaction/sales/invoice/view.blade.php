@extends('layouts.admin')
@section('title')
    {{ __('View Invoice') }}
@endsection
@if($invoice->status!=4)
@section('action-button')
    <div class="col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
        @can('Edit Invoice')
            <a href="{{ route('invoices.edit',$invoice->id) }}" class="btn btn-sm btn-icon-only rounded-circle btn btn-primary" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
            </a>
        @endcan
        
        @if($invoice->status==0)
            @can('Send Invoice')
                <a href="{{ route('invoice.sent',$invoice->id) }}" class="btn btn-sm btn-icon-only rounded-circle btn btn-primary" data-toggle="tooltip" data-original-title="{{__('Mark Sent')}}">
                    <span class="btn-inner--icon"><i class="fa fa-paper-plane"></i></span>
                </a>
            @endcan
        @endif
        
        @if($invoice->status!=0)
            @can('Create Payment Invoice')
                <a href="#" data-url="{{ route('invoice.payment',$invoice->id) }}" data-ajax-popup="true" data-title="{{__('Add Receipt')}}" class="btn btn-sm btn-icon-only rounded-circle btn btn-primary" data-toggle="tooltip" data-original-title="{{__('Add Receipt')}}">
                    <span class="btn-inner--icon"><i class="far fa-file"></i></span>
                </a>
            @endcan
        @endif
    </div>
@endsection
@endif
@section('content')
@can('Send Invoice')
    @if($invoice->status!=4)
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                            <div class="timeline-block">
                                <span class="timeline-step timeline-step-sm bg-primary border-primary text-white"><i class="fas fa-plus"></i></span>
                                <div class="timeline-content">
                                    <div class="text-sm h6">{{__('Create Invoice')}}</div>
                                    <small><i class="fas fa-clock mr-1"></i>{{__('Created on ')}} {{Utility::getDateFormated($invoice->transaction_date)}}</small>
                                </div>
                            </div>
                            <div class="timeline-block">
                                <span class="timeline-step timeline-step-sm bg-warning border-warning text-white"><i class="fas fa-envelope"></i></span>
                                <div class="timeline-content">
                                    <div class="text-sm h6 ">{{__('Send Invoice')}}</div>
                                    @if($invoice->status!=0)
                                        <small><i class="fas fa-clock mr-1"></i>{{__('Sent On')}} {{Utility::getDateFormated($invoice->send_date)}}</small>
                                    @else
                                        @can('Send Invoice')
                                            <small>{{__('Status')}} : {{__('Not Sent')}}</small>
                                        @endcan
                                    @endif
                                </div>
                            </div>
                            <div class="timeline-block">
                                <span class="timeline-step timeline-step-sm bg-info border-info text-white"><i class="far fa-money-bill-alt"></i></span>
                                <div class="timeline-content">
                                    <div class="text-sm h6 ">{{__('Get Paid')}}</div>
                                    <small>{{__('Awaiting payment')}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endcan
@if($invoice->created_by==\Auth::user()->id)
    @if($invoice->status!=0)
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                @if($invoice->status!=4)
                    <div class="all-button-box mx-2">
                        <a href="{{ route('invoice.payment.reminder',$invoice->id)}}" class="btn btn-sm btn-primary btn-icon rounded-pill">{{__('Receipt Reminder')}}</a>
                    </div>
                @endif
                <div class="all-button-box mx-2">
                    <a href="{{ route('invoice.resent',$invoice->id)}}" class="btn btn-sm btn-primary btn-icon rounded-pill">{{__('Resend Invoice')}}</a>
                </div>
                <div class="all-button-box">
                    <a href="{{ route('invoice.pdf', Crypt::encrypt($invoice->id))}}" target="_blank" class="btn btn-sm btn-primary btn-icon rounded-pill">{{__('Download')}}</a>
                </div>
            </div>
        </div>
    @endif
@endif
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="invoice">
                    <div class="invoice-print">
                        <div class="row invoice-title mt-2">
                            <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12">
                                <h2>{{__('Invoice')}}</h2>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-right">
                                <h3 class="invoice-number">{{ AUth::user()->invoiceNumberFormat($invoice->invoice_id) }}</h3>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <small class="font-style">
                                    <strong>{{__('Billed From')}} :</strong><br>
                                    {{!empty($settings['company_name'])?$settings['company_name']:''}}<br>
                                    {{!empty($settings['company_address'])?$settings['company_address']:''}}<br>
                                    {{!empty($settings['company_city'])?$settings['company_city']:''}}, {{!empty($settings['company_state'])?$settings['company_state']:''}} - {{!empty($settings['company_zipcode'])?$settings['company_zipcode']:''}}<br>
                                    {{!empty($settings['company_country'])?$settings['company_country']:''}}<br>
                                </small>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <small>
                                    <strong>{{__('Billed To')}} :</strong><br>
                                    {{!empty($customer->first_name)?__($customer->first_name):''}} {{!empty($customer->last_name)?__($customer->last_name):''}}<br>
                                    @if(!empty($customer->customerdetail->address1))
                                        {{__($customer->customerdetail->address1)}}<br>
                                    @endif
                                    @if(!empty($customer->customerdetail->address2))
                                        {{__($customer->customerdetail->address2)}}<br>
                                    @endif
                                    {{!empty($customer->customerdetail->city)?__($customer->customerdetail->city):''}} , {{!empty($customer->customerdetail->state)?__($customer->customerdetail->state):''}} - {{!empty($customer->customerdetail->post_code)?__($customer->customerdetail->post_code):''}}<br>
                                    {{!empty($customer->customerdetail->country)?__($customer->customerdetail->country):''}}<br>
                                </small>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-4">
                                <small>
                                    <strong>{{__('Status')}} :</strong><br>
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
                                </small>
                            </div>
                            <div class="col-md-4 text-md-center">
                                <small>
                                    <strong>{{__('Transaction Date')}} :</strong><br>
                                    {{\App\Utility::getDateFormated($invoice->transaction_date)}}<br><br>
                                </small>
                            </div>
                            <div class="col-md-4 text-md-right">
                                <small>
                                    <strong>{{__('Due Date')}} :</strong><br>
                                    {{\App\Utility::getDateFormated($invoice->due_date)}}<br><br>
                                </small>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="font-weight-bold">{{__('Product Summary')}}</div>
                                <small>{{__('All Items Here Cannot Be Deleted.')}}</small>
                                <div class="table-responsive mt-2">
                                    <table class="table mb-0 table-striped">
                                        <tr>
                                            <th data-width="40" class="text-dark">#</th>
                                            <th class="text-dark">{{__('Product')}}</th>
                                            <th class="text-dark">{{__('Quantity')}}</th>
                                            <th class="text-dark">{{__('Rate')}}</th>
                                            <th class="text-dark">{{__('Tax')}}</th>
                                            <th class="text-dark"></th>
                                            <th class="text-right text-dark" width="12%">{{__('Price')}}<br>
                                                <small class="text-danger font-weight-bold">{{__('Before Tax & Discount')}}</small>
                                            </th>
                                        </tr>
                                        @php
                                            $totalQuantity=0;
                                            $totalRate=0;
                                            $totalTaxPrice=0;
                                            $totalDiscount=0;
                                            $taxesData=[];
                                        @endphp
                                        @foreach($iteams as $key =>$iteam)
                                            @php
                                                $taxes=\Utility::tax($iteam->tax);
                                                $totalQuantity+=$iteam->quantity;
                                                $totalRate+=$iteam->price;
                                                foreach($taxes as $taxe){
                                                    $taxDataPrice=\Utility::taxRate($taxe->tax_rate,$iteam->price,$iteam->quantity);
                                                    if (array_key_exists($taxe->name,$taxesData))
                                                    {
                                                        $taxesData[$taxe->name] = $taxesData[$taxe->name]+$taxDataPrice;
                                                    }
                                                    else
                                                    {
                                                        $taxesData[$taxe->name] = $taxDataPrice;
                                                    }
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{!empty($iteam->product())?$iteam->product()->product_name:''}}</td>
                                                <td>{{$iteam->quantity}}</td>
                                                <td>{{\Auth::user()->priceFormat($iteam->price)}}</td>
                                                <td>
                                                    <table>
                                                        @php $totalTaxRate = 0;@endphp
                                                        @foreach($taxes as $tax)
                                                            @php
                                                                $taxPrice=\Utility::taxRate($tax->tax_rate,$iteam->price,$iteam->quantity);
                                                                $totalTaxPrice+=$taxPrice;
                                                            @endphp
                                                            <tr>
                                                                <td>{{$tax->name .' ('.$tax->tax_rate .'%)'}}</td>
                                                                <td>{{\Auth::user()->priceFormat($taxPrice)}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </td>
                                                <td> 
                                                </td>
                                                <td class="text-right">{{\Auth::user()->priceFormat(($iteam->price*$iteam->quantity))}}</td>

                                            </tr>

                                        @endforeach
                                        <tfoot>
                                        <tr>
                                            <td></td>
                                            <td><b>{{__('Total')}}</b></td>
                                            <td><b>{{$totalQuantity}}</b></td>
                                            <td><b>{{\Auth::user()->priceFormat($totalRate)}}</b></td>
                                            <td><b>{{\Auth::user()->priceFormat($totalTaxPrice)}}</b></td>
                                            <td>  
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="text-right"><b>{{__('Sub Total')}}</b></td>
                                            <td class="text-right">{{\Auth::user()->priceFormat($invoice->getSubTotal())}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="text-right"><b>{{__('Discount')}}</b></td>
                                            <td class="text-right">{{\Auth::user()->priceFormat($invoice->getTotalDiscount(true))}}</td>
                                        </tr>
                                        @if(!empty($taxesData))
                                            @foreach($taxesData as $taxName => $taxPrice)
                                                <tr>
                                                    <td colspan="5"></td>
                                                    <td class="text-right"><b>{{__($taxName)}}</b></td>
                                                    <td class="text-right">{{ \Auth::user()->priceFormat($taxPrice) }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="blue-text text-right"><b>{{__('Total')}}</b></td>
                                            <td class="blue-text text-right">{{\Auth::user()->priceFormat($invoice->getTotal())}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="text-right"><b>{{__('Paid')}}</b></td>
                                            <td class="text-right">{{\Auth::user()->priceFormat(($invoice->getTotal()-$invoice->getDue()))}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="text-right"><b>{{__('Due')}}</b></td>
                                            <td class="text-right">{{\Auth::user()->priceFormat($invoice->getDue())}}</td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <h5 class="h4 d-inline-block font-weight-400 mb-4">{{__('Receipt Summary')}}</h5>
            <div class="table-responsive">
                <table class="table table-striped">
                    <tr>
                        <th class="text-dark">{{__('Date')}}</th>
                        <th class="text-dark">{{__('Amount')}}</th>
                        <th class="text-dark">{{__('Payment Type')}}</th>
                        <th class="text-dark">{{__('Account')}}</th>
                        <th class="text-dark">{{__('Reference')}}</th>
                        <th class="text-dark">{{__('Description')}}</th>
                        <th class="text-dark">{{__('Receipt')}}</th>
                        <th class="text-dark">{{__('OrderId')}}</th>
                        @can('Delete Payment Invoice')
                            <th class="text-dark">{{__('Action')}}</th>
                        @endcan
                    </tr>
                    @if(count($invoice->payments) > 0)
                        @foreach($invoice->payments as $key =>$payment)
                            <tr>
                                <td>{{\App\Utility::getDateFormated($payment->date)}}</td>
                                <td>{{\Auth::user()->priceFormat($payment->amount)}}</td>
                                <td>{{$payment->payment_type}}</td>
                                <td>{{!empty($payment->bankAccount)?$payment->bankAccount->bank_name.' '.$payment->bankAccount->holder_name:'--'}}</td>
                                <td>{{!empty($payment->reference)?$payment->reference:'--'}}</td>
                                <td>{{!empty($payment->description)?$payment->description:'--'}}</td>
                                <td>@if(!empty($payment->receipt))<a href="{{$payment->receipt}}" target="_blank"> <i class="fas fa-file"></i></a>@else -- @endif</td>
                                <td>{{!empty($payment->order_id)?$payment->order_id:'--'}}</td>
                                @can('Delete Payment Invoice')
                                    <td>
                                        <a href="#" class="action-item text-danger" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This Action Can Not Be Undone. Do You Want To Continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$payment->id}}').submit();">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        {!! Form::open(['method' => 'post', 'route' => ['invoice.payment.destroy',$invoice->id,$payment->id],'id'=>'delete-form-'.$payment->id]) !!}
                                        {!! Form::close() !!}
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center text-dark"><p>{{__('No Data Found')}}</p></td>
                        </tr>
                    @endif
                </table>
            </div>
    </div>
</div>
@endsection