@extends('layouts.admin')
@section('title')
    {{__('Income Vs Expense Summary')}}
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
        <div class="col">
            {{ Form::open(array('route' => array('income.vs.expense.summary.report'),'method' => 'GET','id'=>'income_vs_expense_summary')) }}
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('year', __('Year'),['class'=>'text-xs text-primary']) }}
                    {{ Form::select('year',$yearList,isset($_GET['year'])?$_GET['year']:'', array('class' => 'form-control select2')) }}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('category', __('Category'),['class'=>'text-xs text-primary']) }}
                    {{ Form::select('category',$category,isset($_GET['category'])?$_GET['category']:'', array('class' => 'form-control select2')) }}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('customer', __('Customer'),['class'=>'text-xs text-primary']) }}
                    {{ Form::select('customer',$customer,isset($_GET['customer'])?$_GET['customer']:'', array('class' => 'form-control select2')) }}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('vendor', __('Vendor'),['class'=>'text-xs text-primary']) }}
                    {{ Form::select('vendor',$vendor,isset($_GET['vendor'])?$_GET['vendor']:'', array('class' => 'form-control select2')) }}
                </div>
            </div>
        </div>
        <div class="col-auto my-auto">
            <a href="#" class="apply-btn" onclick="document.getElementById('income_vs_expense_summary').submit(); return false;" data-toggle="tooltip" data-original-title="{{__('Apply')}}">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="{{route('income.vs.expense.summary.report')}}" class="reset-btn" data-toggle="tooltip" data-original-title="{{__('Reset')}}">
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
                <input type="hidden" value="{{$filter['category'].' '.__('Income Vs Expense Summary').' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange']}}" id="filename">
                <div class="card p-4 mb-4">
                    <span class="h6 font-weight mb-0 ">{{__('Report')}} :</span>
                    <h6 class="text-muted mb-1">{{__('Income Vs Expense Summary')}}</h6>
                </div>
            </div>
            @if($filter['category']!= __('All'))
                <div class="col">
                    <div class="card p-4 mb-4">
                        <span class="h6 font-weight mb-0 ">{{__('Category')}} :</span>
                        <h6 class="text-muted mb-1">{{$filter['category'] }}</h6>
                    </div>
                </div>
            @endif
            @if($filter['customer']!= __('All'))
                <div class="col">
                    <div class="card p-4 mb-4">
                        <span class="h6 font-weight mb-0 ">{{__('Customer')}} :</span>
                        <h6 class="text-muted mb-1">{{$filter['customer'] }}</h6>
                    </div>
                </div>
            @endif
            @if($filter['vendor']!= __('All'))
                <div class="col">
                    <div class="card p-4 mb-4">
                        <span class="h6 font-weight mb-0 ">{{__('Vendor')}} :</span>
                        <h6 class="text-muted mb-1">{{$filter['vendor'] }}</h6>
                    </div>
                </div>
            @endif
            <div class="col">
                <div class="card p-4 mb-4">
                    <span class="h6 font-weight mb-0 ">{{__('Duration')}} :</span>
                    <h6 class="text-muted mb-1">{{$filter['startDateRange'].' to '.$filter['endDateRange']}}</h6>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12" id="chart-container">
                <div class="card">
                    <div class="card-body">
                        <canvas id="canvas" height="280" width="600"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <table class="table table-striped mb-0" id="dataTable-manual">
                                <thead>
                                <tr>
                                    <th>{{__('Type')}}</th>
                                    @foreach($monthList as $month)
                                        <th>{{$month}}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td colspan="13" class="text-dark"><span>{{__('Income')}} : </span></td>
                                </tr>
                                <tr>
                                    <td>{{(__('Invoice'))}}</td>
                                    @foreach($invoiceIncomeTotal as $invoice)
                                        <td>{{\Auth::user()->priceFormat($invoice)}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td colspan="13" class="text-dark"><span>{{__('Expense')}} : </span></td>
                                </tr>
                                <tr>
                                    <td>{{(__('Payment'))}}</td>
                                    @foreach($paymentExpenseTotal as $payment)
                                        <td>{{\Auth::user()->priceFormat($payment)}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td>{{(__('Bill'))}}</td>
                                    @foreach($billExpenseTotal as $bill)
                                        <td>{{\Auth::user()->priceFormat($bill)}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <td colspan="13" class="text-dark"><span>Profit = Income - Expense</span></td>
                                </tr>
                                <tr>
                                    <td>{{(__('Profit'))}}</td>
                                    @foreach($profit as $prft)
                                        <td>{{\Auth::user()->priceFormat($prft)}}</td>
                                    @endforeach
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
    var ctx = document.getElementById("canvas").getContext("2d");

var data = {
  labels: {!! json_encode($monthList) !!},
  datasets: [{
    pointBackgroundColor: "#011c4b",
    borderColor: "#011c4b",
    fill: false,
    data: {!! json_encode($profit) !!}
  }]
};

var myBarChart = new Chart(ctx, {
  type: 'line',
  data: data,
  options: {
    barValueSpacing: 20,
    scales: {
      yAxes: [{
        ticks: {
          min: 0,
        }
      }]
    },
    legend: {
        display: false
    },
    tooltips: {
        callbacks: {
           label: function(tooltipItem) {
                  return tooltipItem.yLabel;
           }
        }
    }
  }
});

</script>
@endpush