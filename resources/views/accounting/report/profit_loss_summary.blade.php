@extends('layouts.admin')
@section('title')
    {{__('Profit & Loss Summary')}}
@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('assets/js/html2pdf.bundle.min.js') }}"></script>
    <script>
        var year = '{{$currentYear}}';
        var filename = $('#filename').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {type: 'jpeg', quality: 1},
                html2canvas: {scale: 4, dpi: 72, letterRendering: true},
                jsPDF: {unit: 'in', format: 'A2'}
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>
@endpush
@section('action-button')
<div class="col-xl-8 col-lg-8 col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
    <div class="row d-flex justify-content-end">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12">
            {{ Form::open(array('route' => array('profit.loss.summary.report'),'method' => 'GET','id'=>'report_profit_loss_summary')) }}
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('year', __('Year'),['class'=>'text-xs text-primary']) }}
                    {{ Form::select('year',$yearList,isset($_GET['year'])?$_GET['year']:'', array('class' => 'form-control select2')) }}
                </div>
            </div>
        </div>
        <div class="col-auto my-auto">
            <a href="#" class="apply-btn" onclick="document.getElementById('report_profit_loss_summary').submit(); return false;" data-toggle="tooltip" data-original-title="{{__('Apply')}}">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="{{route('profit.loss.summary.report')}}" class="reset-btn" data-toggle="tooltip" data-original-title="{{__('Reset')}}">
                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
            </a>
            <a href="#" class="action-btn" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="{{__('Download')}}">
                <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
            </a>
        </div>
    </div>
</div>
    {{ Form::close() }}


@endsection
@section('content')
    <div id="printableArea">
        <div class="row mt-3">
            <div class="col">
                <input type="hidden" value="{{__('Profit && Loss Summary').' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange']}}" id="filename">
                <div class="card p-4 mb-4">
                    <span class="h6 font-weight mb-0 ">{{__('Report')}} :</span>
                    <h6 class="text-muted mb-1">{{__('Profit && Loss Summary')}}</h6>
                </div>
            </div>
            <div class="col">
                <div class="card p-4 mb-4">
                    <span class="h6 font-weight mb-0 ">{{__('Duration')}} :</span>
                    <h6 class="text-muted mb-1">{{$filter['startDateRange'].' to '.$filter['endDateRange']}}</h6>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h5 class="pb-3">{{__('Income')}}</h5>
                <div class="card">
                    <div class="card-body">
                            <div class="col-sm-12">
                                <div>
                                    <table class="table table-striped mb-0">
                                        <thead>
                                        <tr>
                                            <th width="25%">{{__('Category')}}</th>
                                            @foreach($month as $m)
                                                <th width="15%">{{$m}}</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($revenueIncomeArray))
                                            @foreach($revenueIncomeArray as $i=>$revenue)
                                                <tr>
                                                    <td>{{$revenue['category']}}</td>
                                                    @foreach($revenue['amount'] as $j=>$amount)
                                                        <td width="15%">{{\Auth::user()->priceFormat($amount)}}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        @endif

                                        <tr>
                                            <td colspan="13" class="text-dark"><span>{{__('Invoice')}} : </span></td>
                                        </tr>
                                        @if(!empty($invoiceIncomeArray))
                                            @foreach($invoiceIncomeArray as $i=>$invoice)
                                                <tr>
                                                    <td>{{$invoice['category']}}</td>
                                                    @foreach($invoice['amount'] as $j=>$amount)
                                                        <td width="15%">{{\Auth::user()->priceFormat($amount)}}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        @endif
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-flush border">
                                                    <tbody>
                                                    <tr>
                                                        <td colspan="13" class="text-dark"><span>Total Income =  Invoice</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="25%" class="text-dark">{{__('Total Income')}}</td>
                                                        @foreach($totalIncome as $income)
                                                            <td width="15%">{{\Auth::user()->priceFormat($income)}}</td>
                                                        @endforeach
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <h5 class="pb-3">{{__('Expense')}}</h5>
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-12">
                            <div>
                                <table class="table table-striped mb-0" id="dataTable-manual">
                                    <thead>
                                    <tr>
                                        <th width="25%">{{__('Category')}}</th>
                                        @foreach($month as $m)
                                            <th width="15%">{{$m}}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="13" class="text-dark"><span>{{__('Payment')}} :</span></td>
                                    </tr>
                                    @if(!empty($expenseArray))
                                        @foreach($expenseArray as $i=>$expense)
                                            <tr>
                                                <td>{{$expense['category']}}</td>
                                                @foreach($expense['amount'] as $j=>$amount)
                                                    <td width="15%">{{\Auth::user()->priceFormat($amount)}}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    @endif
                                    <tr>
                                        <td colspan="13" class="text-dark"><span>{{__('Bill')}} : </span></td>
                                    </tr>
                                    @if(!empty($billExpenseArray))
                                        @foreach($billExpenseArray as $i=>$bill)
                                            <tr>
                                                <td>{{$bill['category']}}</td>
                                                @foreach($bill['amount'] as $j=>$amount)
                                                    <td width="15%">{{\Auth::user()->priceFormat($amount)}}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    @endif
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-flush border" id="dataTable-manual">
                                                <tbody>
                                                <tr>
                                                    <td colspan="13" class="text-dark"><span>Total Expense =  Payment + Bill </span></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-dark">{{__('Total Expenses')}}</td>
                                                    @foreach($totalExpense as $expense)
                                                        <td width="15%">{{\Auth::user()->priceFormat($expense)}}</td>
                                                    @endforeach
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
