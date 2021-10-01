@extends('layouts.admin')
@section('title')
    {{ __('View Proposal') }}
@endsection
@if($proposal->status!=4)
@section('action-button')
    <div class="col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
        @can('Edit Invoice Proposal')
            <a href="{{ route('proposals.edit',$proposal->id) }}" class="btn btn-sm btn-icon-only rounded-circle btn btn-primary" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
            </a>
        @endcan
        @if($proposal->status==0)
            @can('Send Invoice Proposal')
                <a href="{{ route('proposal.sent',$proposal->id) }}" class="btn btn-sm btn-icon-only rounded-circle btn btn-primary" data-toggle="tooltip" data-original-title="{{__('Mark Sent')}}">
                    <span class="btn-inner--icon"><i class="fa fa-paper-plane"></i></span>
                </a>
            @endcan
        @endif
    </div>
@endsection
@endif
@section('content')
@can('Send Invoice Proposal')
    @if($proposal->status!=4)
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                            <div class="timeline-block">
                                <span class="timeline-step timeline-step-sm bg-primary border-primary text-white"><i class="fas fa-plus"></i></span>
                                <div class="timeline-content">
                                    <div class="text-sm h6">{{__('Create Proposal')}}</div>
                                    <small><i class="fas fa-clock mr-1"></i>{{__('Created on ')}} {{__(Utility::getDateFormated($proposal->transaction_date))}}</small>
                                </div>
                            </div>
                            <div class="timeline-block">
                                <span class="timeline-step timeline-step-sm bg-warning border-warning text-white"><i class="fas fa-envelope"></i></span>
                                <div class="timeline-content">
                                    <div class="text-sm h6 ">{{__('Send Proposal')}}</div>
                                    @if($proposal->status!=0)
                                        <small><i class="fas fa-clock mr-1"></i>{{__('Sent On')}} {{__(Utility::getDateFormated($proposal->send_date))}}</small>
                                    @else
                                            <small>{{__('Status')}} : {{__('Not Sent')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="timeline-block">
                                <span class="timeline-step timeline-step-sm bg-info border-info text-white"><i class="far fa-money-bill-alt"></i></span>
                                <div class="timeline-content">
                                    <span class="text-sm h6 ">{{__('Proposal Status')}}</span>
                                    <div class="float-right" data-toggle="tooltip" data-original-title="{{__('Click To Change Status')}}">
                                        <select class="form-control status_change select2" name="status" data-url="{{route('proposal.status.change',$proposal->id)}}">
                                            @foreach($status as $k=>$val)
                                                <option value="{{$k}}" {{($proposal->status==$k)?'selected':''}}>{{__($val)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>
                                    <small>
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
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endcan
@if($proposal->created_by==\Auth::user()->id)
    @if($proposal->status!=0)
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                <div class="all-button-box mx-2">
                    <a href="{{ route('proposal.resent',$proposal->id) }}" class="btn btn-sm btn-primary btn-icon rounded-pill">{{__('Resend Proposal')}}</a>
                </div>
                <div class="all-button-box">
                    <a href="{{ route('proposal.pdf', Crypt::encrypt($proposal->id))}}" class="btn btn-sm btn-primary btn-icon rounded-pill" target="_blank">{{__('Download')}}</a>
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
                                <h2>{{__('Proposal')}}</h2>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-right">
                                <h3 class="invoice-number">{{ AUth::user()->proposalNumberFormat($proposal->proposal_id) }}</h3>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <small class="font-style">
                                    <strong>{{__('From')}} :</strong><br>
                                    {{!empty($settings['company_name'])?$settings['company_name']:''}}<br>
                                    {{!empty($settings['company_address'])?$settings['company_address']:''}}<br>
                                    {{!empty($settings['company_city'])?$settings['company_city']:''}}, {{!empty($settings['company_state'])?$settings['company_state']:''}} - {{!empty($settings['company_zipcode'])?$settings['company_zipcode']:''}}<br>
                                    {{!empty($settings['company_country'])?$settings['company_country']:''}}<br>
                                </small>
                            </div>
                            <div class="col-md-6 text-md-right">
                                <small>
                                    <strong>{{__('To')}} :</strong><br>
                                    {{!empty($customer->first_name)?$customer->first_name:''}} {{!empty($customer->last_name)?$customer->last_name:''}}<br>
                                    @if(!empty($customer->customerdetail->address1))
                                        {{$customer->customerdetail->address1}}<br>
                                    @endif
                                    @if(!empty($customer->customerdetail->address2))
                                        {{$customer->customerdetail->address2}}<br>
                                    @endif
                                    {{!empty($customer->customerdetail->city)?$customer->customerdetail->city:''}} , {{!empty($customer->customerdetail->state)?$customer->customerdetail->state:''}} - {{!empty($customer->customerdetail->post_code)?$customer->customerdetail->post_code:''}}<br>
                                    {{!empty($customer->customerdetail->country)?$customer->customerdetail->country:''}}<br>
                                </small>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-md-4">
                                <small>
                                    <strong>{{__('Status')}} :</strong><br>
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
                                </small>
                            </div>
                            <div class="col-md-8 text-md-right">
                                <small>
                                    <strong>{{__('Transaction Date')}} :</strong><br>
                                    {{\App\Utility::getDateFormated($proposal->transaction_date)}}<br><br>
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
                                                <td>{{!empty($iteam->product)?$iteam->product->product_name:''}}</td>
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
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="text-right"><b>{{__('Sub Total')}}</b></td>
                                            <td class="text-right">{{\Auth::user()->priceFormat($proposal->getSubTotal())}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="text-right"><b>{{__('Discount')}}</b></td>
                                            <td class="text-right">{{\Auth::user()->priceFormat($proposal->getTotalDiscount(true))}}</td>
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
                                            <td class="blue-text text-right">{{\Auth::user()->priceFormat($proposal->getTotal())}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="text-right"><b>{{__('Paid')}}</b></td>
                                            <td class="text-right">{{\Auth::user()->priceFormat(($proposal->getTotal()-$proposal->getDue()))}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="text-right"><b>{{__('Due')}}</b></td>
                                            <td class="text-right">{{\Auth::user()->priceFormat($proposal->getDue())}}</td>
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
</div>
@endsection
@push('script')
    <script>
        $(document).on('change', '.status_change', function () {
            var status = this.value;
            var url = $(this).data('url');
            $.ajax({
                url: url + '?status=' + status,
                type: 'GET',
                cache: false,
                success: function (data) {
                    location.reload();
                },
            });
        });
    </script>
@endpush