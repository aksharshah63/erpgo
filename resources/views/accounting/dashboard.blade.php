@extends('layouts.admin')
@section('title')
    {{ __('Dashboard') }}
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-3">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title mb-0"><b>{{!empty($customers) ? $customers : 0}}</b></h1>
                    <h5 class="card-title mt-2">{{__('Customers')}}</h5>
                </div>
                <div class="card-body card-desc">
                    <a href="{{route('customers.index')}}" class="btn btn-sm btn-primary card-btn">{{__('View Customers')}}</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-3">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title mb-0"><b>{{!empty($vendors) ? $vendors :0}}</b></h1>
                    <h5 class="card-title mt-2">{{__('Vendors')}}</h5>
                </div>
                <div class="card-body card-desc">
                    <a href="{{route('vendors.index')}}" class="btn btn-sm btn-primary card-btn">{{__('View Vendors')}}</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-3">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title mb-0"><b>{{!empty($invoices) ? $invoices : 0}}</b></h1>
                    <h5 class="card-title mt-2">{{__('Invoices')}}</h5>
                </div>
                <div class="card-body card-desc">
                    <a href="{{route('invoices.index')}}" class="btn btn-sm btn-primary card-btn">{{__('View Invoices')}}</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-3">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title mb-0"><b>{{!empty($bills) ? $bills : 0}}</b></h1>
                    <h5 class="card-title mt-2">{{__('Bills')}}</h5>
                </div>
                <div class="card-body card-desc">
                    <a href="{{route('bills.index')}}" class="btn btn-sm btn-primary card-btn">{{__('View Bills')}}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div>
                <h4 class="h4 font-weight-400 float-left">{{__('Cashflow')}}</h4>
                <h6 class="last-day-text">{{__('Last')}} <span>{{'15'. __('Days')}}</span></h6>
            </div>
            <div class="card">
                <div class="card-body">
                    <canvas id="canvas3" height="230" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-4">
            <h4 class="h4 font-weight-400">{{__('Income Vs Expense')}}</h4>
            <div class="card bg-none dashboard-box-1">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <tbody class="list">
                        <tr>
                            <td>
                                <h4 class="mb-0">{{__('Income')}}</h4>
                                <h5 class="mb-0">{{__('Today')}}</h5>
                            </td>
                            <td>
                                <h3 class="green-text">{{\Auth::user()->priceFormat(\Auth::user()->todayIncome())}}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4 class="mb-0">{{__('Expense')}}</h4>
                                <h5 class="mb-0">{{__('Today')}}</h5>
                            </td>
                            <td>
                                <h3 class="red-text">{{\Auth::user()->priceFormat(\Auth::user()->todayExpense())}}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4 class="mb-0">{{__('Income This')}}</h4>
                                <h5 class="mb-0">{{__('Month')}}</h5>
                            </td>
                            <td>
                                <h3 class="green-text">{{\Auth::user()->priceFormat(\Auth::user()->incomeCurrentMonth())}}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4 class="mb-0">{{__('Expense This')}}</h4>
                                <h5 class="mb-0">{{__('Month')}}</h5>
                            </td>
                            <td>
                                <h3 class="red-text">{{\Auth::user()->priceFormat(\Auth::user()->expenseCurrentMonth())}}</h3>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-8 col-md-8">
            <div class="">
                <h4 class="h4 font-weight-400 float-left">{{__('Account Balance')}}</h4>
            </div>
            <div class="card bg-none dashboard-box-1">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                        <tr>
                            <th>{{__('Bank')}}</th>
                            <th>{{__('Holder Name')}}</th>
                            <th>{{__('Balance')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($bankaccounts as $bankaccount)
                            <tr class="font-style">
                                <td>{{$bankaccount->bank_name}}</td>
                                <td>{{$bankaccount->holder_name}}</td>
                                <td>{{\Auth::user()->priceFormat($bankaccount->opening_balance)}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="text-center">
                                        <h6>{{__('There Is No Account Balance')}}</h6>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div>
                <h4 class="h4 font-weight-400 float-left">{{__('Income & Expense')}}</h4>
                <h6 class="last-day-text">{{__('Current Year').' - '.$data['currentYear']}}</h6>
            </div>
            <div class="card">
                <div class="card-body">
                    <canvas id="canvas2" height="230" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-12 col-12 col-sm-12">
            <div>
                <h4 class="h4 font-weight-400 float-left">{{__('Income By Category')}}</h4>
                <h6 class="last-day-text">{{__('Current Year').' - '.$data['currentYear']}}</h6>
            </div>
            <div class="card">
                <div class="card-body">
                    <canvas id="canvas" height="230" width="600"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-12 col-sm-12">
            <div>
                <h4 class="h4 font-weight-400 float-left">{{__('Expense By Category')}}</h4>
                <h6 class="last-day-text">{{__('Current Year').' - '.$data['currentYear']}}</h6>
            </div>
            <div class="card">
                <div class="card-body">
                    <canvas id="canvas1" height="230" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="">
                <h4 class="h4 font-weight-400 float-left">{{__('Latest Income')}}</h4>
                <a href="{{route('invoices.index')}}" class="more-text history-text float-right">{{__('View All')}}</a>
            </div>
            <div class="card bg-none dashboard-box-1">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Customer')}}</th>
                            <th>{{__('Amount Due')}}</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @forelse($data['latestIncome'] as $income)
                            <tr>
                                <td>{{!empty($income->transaction_date) ? \App\Utility::getDateFormated($income->transaction_date) : '-'}}</td>
                                <td>{{!empty($income->customer)?$income->customer->first_name.' '.$income->customer->last_name:'-'}}</td>
                                <td>{{$income->getDue()}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="text-center">
                                        <h6>{{__('There Is No Latest Income')}}</h6>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6">
            <div class="">
                <h4 class="h4 font-weight-400 float-left">{{__('Latest Expense')}}</h4>
                <a href="{{route('payments.index')}}" class="more-text history-text float-right">{{__('View All')}}</a>
            </div>
            <div class="card bg-none dashboard-box-1">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th>{{__('Date')}}</th>
                            <th>{{__('Customer')}}</th>
                            <th>{{__('Amount Due')}}</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @forelse($data['latestExpense'] as $expense)
                            <tr>
                                <td>{{!empty($expense->date) ? \App\Utility::getDateFormated($expense->date) :'-'}}</td>
                                <td>{{!empty($expense->vendor)?$expense->vendor->first_name.' '.$expense->vendor->last_name:'-'}}</td>
                                <td>{{!empty($expense->amount) ? \Auth::user()->priceFormat($expense->amount) :'-'}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="text-center">
                                        <h6>{{__('There Is No Latest Expense')}}</h6>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="">
                <h4 class="h4 font-weight-400 float-left">{{__('Invoices')}}</h4>
            </div>
            <div class="card bg-none invo-tab dashboard-box-2">
                <ul class="nav nav-tabs" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#weekly_statistics" role="tab" aria-controls="pills-home" aria-selected="true">{{__('Weekly Statistics')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#monthly_statistics" role="tab" aria-controls="pills-home" aria-selected="false">{{__('Monthly Statistics')}}</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="weekly_statistics" class="tab-pane in active">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <tbody class="list">
                                <tr>
                                    <td>
                                        <h4 class="mb-0">{{__('Total')}}</h4>
                                        <h5 class="mb-0">{{__('Invoice Generated')}}</h5>
                                    </td>
                                    <td>
                                        <h3 class="green-text">{{\Auth::user()->priceFormat($data['weeklyInvoice']['invoiceTotal'])}}</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="mb-0">{{__('Total')}}</h4>
                                        <h5 class="mb-0">{{__('Paid')}}</h5>
                                    </td>
                                    <td>
                                        <h3 class="red-text">{{\Auth::user()->priceFormat($data['weeklyInvoice']['invoicePaid'])}}</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="mb-0">{{__('Total')}}</h4>
                                        <h5 class="mb-0">{{__('Due')}}</h5>
                                    </td>
                                    <td>
                                        <h3 class="green-text">{{\Auth::user()->priceFormat($data['weeklyInvoice']['invoiceDue'])}}</h3>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="monthly_statistics" class="tab-pane">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0 ">
                                <tbody class="list">
                                <tr>
                                    <td>
                                        <h4 class="mb-0">{{__('Total')}}</h4>
                                        <h5 class="mb-0">{{__('Invoice Generated')}}</h5>
                                    </td>
                                    <td>
                                        <h3 class="green-text">{{\Auth::user()->priceFormat($data['monthlyInvoice']['invoiceTotal'])}}</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="mb-0">{{__('Total')}}</h4>
                                        <h5 class="mb-0">{{__('Paid')}}</h5>
                                    </td>
                                    <td>
                                        <h3 class="red-text">{{\Auth::user()->priceFormat($data['monthlyInvoice']['invoicePaid'])}}</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="mb-0">{{__('Total')}}</h4>
                                        <h5 class="mb-0">{{__('Due')}}</h5>
                                    </td>
                                    <td>
                                        <h3 class="green-text">{{\Auth::user()->priceFormat($data['monthlyInvoice']['invoiceDue'])}}</h3>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8 col-md-6">
            <div class="">
                <h4 class="h4 font-weight-400 float-left">{{__('Recent Invoices')}}</h4>
            </div>
            <div class="card bg-none dashboard-box-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Customer')}}</th>
                            <th>{{__('Issue Date')}}</th>
                            <th>{{__('Due Date')}}</th>
                            <th>{{__('Amount')}}</th>
                            <th>{{__('Status')}}</th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @forelse($data['recentInvoice'] as $invoice)
                            <tr>
                                <td>{{\Auth::user()->invoiceNumberFormat($invoice->invoice_id)}}</td>
                                <td>{{!empty($invoice->customer)? $invoice->customer->first_name.' '.$invoice->customer->last_name:'-' }} </td>
                                <td>{{ \App\Utility::getDateFormated($invoice->transaction_date) }}</td>
                                <td>{{  \App\Utility::getDateFormated($invoice->due_date) }}</td>
                                <td>{{\Auth::user()->priceFormat($invoice->getTotal())}}</td>
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
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <div class="text-center">
                                        <h6>{{__('There Is No Recent Invoice')}}</h6>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
            <div class="col-xl-9 col-lg-8 col-md-6">
                <div class="">
                    <h4 class="h4 font-weight-400 float-left">{{__('Recent Bills')}}</h4>
                </div>
                <div class="card bg-none dashboard-box-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('Vendor')}}</th>
                                <th>{{__('Bill Date')}}</th>
                                <th>{{__('Due Date')}}</th>
                                <th>{{__('Amount')}}</th>
                                <th>{{__('Status')}}</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @forelse($data['recentBill'] as $bill)
                                <tr>
                                    <td>{{\Auth::user()->billNumberFormat($bill->bill_id)}}</td>
                                    <td>{{!empty($bill->vender)? $bill->vender->first_name.' '.$bill->vender->last_name:'' }} </td>
                                    <td>{{ \App\Utility::getDateFormated($bill->transaction_date) }}</td>
                                    <td>{{ \App\Utility::getDateFormated($bill->due_date) }}</td>
                                    <td>{{\Auth::user()->priceFormat($bill->getTotal())}}</td>
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
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="text-center">
                                            <h6>{{__('There Is No Recent Bill')}}</h6>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="">
                    <h4 class="h4 font-weight-400 float-left">{{__('Bills')}}</h4>
                </div>
                <div class="card bg-none invo-tab dashboard-box-2">
                    <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#bill_weekly_statistics" role="tab" aria-controls="pills-home" aria-selected="true">{{__('Weekly Statistics')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#bill_monthly_statistics" role="tab" aria-controls="pills-home" aria-selected="false">{{__('Monthly Statistics')}}</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="bill_weekly_statistics" class="tab-pane in active">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <tbody class="list">
                                    <tr>
                                        <td>
                                            <h4 class="mb-0">{{__('Total')}}</h4>
                                            <h5 class="mb-0">{{__('Bill Generated')}}</h5>
                                        </td>
                                        <td>
                                            <h3 class="green-text">{{\Auth::user()->priceFormat($data['weeklyBill']['billTotal'])}}</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="mb-0">{{__('Total')}}</h4>
                                            <h5 class="mb-0">{{__('Paid')}}</h5>
                                        </td>
                                        <td>
                                            <h3 class="red-text">{{\Auth::user()->priceFormat($data['weeklyBill']['billPaid'])}}</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="mb-0">{{__('Total')}}</h4>
                                            <h5 class="mb-0">{{__('Due')}}</h5>
                                        </td>
                                        <td>
                                            <h3 class="green-text">{{\Auth::user()->priceFormat($data['weeklyBill']['billDue'])}}</h3>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="bill_monthly_statistics" class="tab-pane">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <tbody class="list">
                                    <tr>
                                        <td>
                                            <h4 class="mb-0">{{__('Total')}}</h4>
                                            <h5 class="mb-0">{{__('Bill Generated')}}</h5>
                                        </td>
                                        <td>
                                            <h3 class="green-text">{{\Auth::user()->priceFormat($data['monthlyBill']['billTotal'])}}</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="mb-0">{{__('Total')}}</h4>
                                            <h5 class="mb-0">{{__('Paid')}}</h5>
                                        </td>
                                        <td>
                                            <h3 class="red-text">{{\Auth::user()->priceFormat($data['monthlyBill']['billPaid'])}}</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="mb-0">{{__('Total')}}</h4>
                                            <h5 class="mb-0">{{__('Due')}}</h5>
                                        </td>
                                        <td>
                                            <h3 class="green-text">{{\Auth::user()->priceFormat($data['monthlyBill']['billDue'])}}</h3>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('script')
<script src="{{ asset('assets/js/Chart.min.js')}}"></script>
<script>
    var barChartData = {
        type: 'pie',
        data: {
            datasets: [{
                data: {!! json_encode($data['incomeCatAmount']) !!},
                backgroundColor: {!! json_encode($data['incomeCategoryColor']) !!}
            }],
            labels: {!! json_encode($data['incomeCategory']) !!}
        },
        options:{
            legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        fontColor: '#333',
                        usePointStyle: true,
                    }
                },
        }
    };

    var barChartData1 = {
        type: 'pie',
        data: {
            datasets: [{
                data: {!! json_encode($data['expenseCatAmount']) !!},
                backgroundColor: {!! json_encode($data['expenseCategoryColor']) !!}
            }],
            labels: {!! json_encode($data['expenseCategory']) !!}
        },
        options:{
            legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        fontColor: '#333',
                        usePointStyle: true,
                    }
                },
        }
    };

    var barChartData2 = {
        type: 'bar',
        data:{
            datasets: [
                        {
                            label: "Income",
                            backgroundColor: {!! json_encode($data['incExpBarChartData']['income_color']) !!},
                            data: {!! json_encode($data['incExpBarChartData']['income']) !!}
                        },
                        {
                            label: "Expense",
                            backgroundColor: {!! json_encode($data['incExpBarChartData']['expense_color']) !!},
                            data: {!! json_encode($data['incExpBarChartData']['expense']) !!}
                        },
            ],
            labels: {!! json_encode($data['incExpBarChartData']['month']) !!},
        },
        options: {
            barValueSpacing: 20,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            precision: 0
                        }
                    }]
                },
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        fontColor: '#333',
                        usePointStyle: true,
                    }
                },
        }
    
    };

    var barChartData3 = {
        type: 'line',
        data:{
            datasets: [
                        {
                            label: "{{__('Income')}}",
                            borderWidth: 3,
                            borderColor: {!! json_encode($data['incExpLineChartData']['income_color']) !!},
                            fill: false,
                            data: {!! json_encode($data['incExpBarChartData']['income']) !!}
                        },
                        {
                            label: "{{__('Expense')}}",
                            borderWidth: 3,
                            borderColor: {!! json_encode($data['incExpLineChartData']['expense_color']) !!},
                            fill: false,
                            data: {!! json_encode($data['incExpLineChartData']['expense']) !!}
                        },
            ],
            labels: {!! json_encode($data['incExpLineChartData']['day']) !!},
        },
        options: {
            barValueSpacing: 20,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                            precision: 0
                        }
                    }]
                },
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        fontColor: '#333',
                        usePointStyle: true,
                    }
                },
        }
    
    };


    window.onload = function() {
    window.myBar = new Chart(document.getElementById("canvas"), barChartData);
    window.myBar1 = new Chart(document.getElementById("canvas1"), barChartData1);
    window.myBar2 = new Chart(document.getElementById("canvas2"), barChartData2);
    window.myBar3 = new Chart(document.getElementById("canvas3"), barChartData3);
};
</script>
@endpush