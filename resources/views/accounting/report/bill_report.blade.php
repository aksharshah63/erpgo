@extends('layouts.admin')
@section('title')
    {{__('Bill Summary')}}
@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('assets/js/html2pdf.bundle.min.js') }}"></script>
    <script>
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

        $(document).ready(function () {
            var filename = $('#filename').val();
            $('#report-dataTable').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        title: filename
                    },
                    {
                        extend: 'pdf',
                        title: filename
                    }, {
                        extend: 'csv',
                        title: filename
                    }
                ]
            });
        });
    </script>
@endpush
@section('action-button')
<div class="col-xl-8 col-lg-8 col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
    <div class="row d-flex justify-content-end">
        <div class="col">
            {{ Form::open(array('route' => array('bill.summary.report'),'method' => 'GET','id'=>'report_bill_summary')) }}
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('start_month', __('Start Month'),['class'=>'text-xs text-primary']) }}
                    {{ Form::month('start_month',isset($_GET['start_month'])?$_GET['start_month']:'', array('class' => 'form-control')) }}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('end_month', __('End Month'),['class'=>'text-xs text-primary']) }}
                    {{ Form::month('end_month',isset($_GET['end_month'])?$_GET['end_month']:'', array('class' => 'form-control')) }}
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
        <div class="col">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('status', __('Status'),['class'=>'text-xs text-primary']) }}
                    {{ Form::select('status', [''=>'All']+$status,isset($_GET['status'])?$_GET['status']:'', array('class' => 'form-control select2')) }}
                </div>
            </div>
        </div>
        <div class="col-auto my-auto">
            <a href="#" class="apply-btn" onclick="document.getElementById('report_bill_summary').submit(); return false;" data-toggle="tooltip" data-original-title="{{__('Apply')}}">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="{{route('bill.summary.report')}}" class="reset-btn" data-toggle="tooltip" data-original-title="{{__('Reset')}}">
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
                <input type="hidden" value="{{$filter['status'].' '.__('Bill').' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange'].' '.__('Of').' '.$filter['vendor']}}" id="filename">
                <div class="card p-4 mb-4">
                    <span class="h6 font-weight mb-0 ">{{__('Report')}} :</span>
                     <h6 class="text-muted mb-1">{{__('Bill Summary')}}</h6>
                </div>
            </div>
            @if($filter['vendor']!= __('All'))
                <div class="col">
                    <div class="card p-4 mb-4">
                        <span class="h6 font-weight mb-0 ">{{__('Vendor')}} :</span>
                         <h6 class="text-muted mb-1">{{$filter['vendor'] }}</h6>
                    </div>
                </div>
            @endif
            @if($filter['status']!= __('All'))
                <div class="col">
                    <div class="card p-4 mb-4">
                        <span class="h6 font-weight mb-0 ">{{__('Status')}} :</span>
                         <h6 class="text-muted mb-1">{{$filter['status'] }}</h6>
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
            <div class="col-xl-4 col-md-6 col-lg-4">
                <div class="card p-4 mb-4">
                    <span class="h6 font-weight mb-0 ">{{__('Total Bill')}}</span>
                     <h6 class="text-muted mb-1">{{Auth::user()->priceFormat($totalBill)}}</h6>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4">
                <div class="card p-4 mb-4">
                    <span class="h6 font-weight mb-0 ">{{__('Total Paid')}}</span>
                     <h6 class="text-muted mb-1">{{Auth::user()->priceFormat($totalPaidBill)}}</h6>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 col-lg-4">
                <div class="card p-4 mb-4">
                    <span class="h6 font-weight mb-0 ">{{__('Total Due')}}</span>
                     <h6 class="text-muted mb-1">{{Auth::user()->priceFormat($totalDueBill)}}</h6>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12" id="invoice-container">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between w-100">
                            <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#summary" role="tab" aria-controls="pills-home" aria-selected="true">{{__('Summary')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#invoices" role="tab" aria-controls="pills-home" aria-selected="false">{{__('Bills')}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade fade" id="invoices" role="tabpanel" aria-labelledby="profile-tab3">
                                        <table class="table table-flush" id="report-dataTable">
                                            <thead>
                                            <tr>
                                                <th> {{__('Bill')}}</th>
                                                <th> {{__('Date')}}</th>
                                                <th> {{__('Vendor')}}</th>
                                                <th> {{__('Category')}}</th>
                                                <th> {{__('Status')}}</th>
                                                <th> {{__('Paid Amount')}}</th>
                                                <th> {{__('Due Amount')}}</th>
                                                <th> {{__('Payment Date')}}</th>
                                                <th> {{__('Amount')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($bills as $bill)
                                                <tr>
                                                    <td class="Id">
                                                        <a href="{{ route('bills.show',$bill->id) }}">{{ AUth::user()->billNumberFormat($bill->bill_id) }}</a>
                                                    </td>
                                                    <td>{{\App\Utility::getDateFormated($bill->send_date)}}</td>
                                                    <td>{{!empty($bill->vendor)? $bill->vendor->first_name.' '.$bill->vendor->last_name:'-' }} </td>
                                                    <td>{{!empty($bill->category)?$bill->category->name:'-'}}</td>
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
                                                    <td> {{\Auth::user()->priceFormat($bill->getTotal()-$bill->getDue())}}</td>
                                                    <td> {{\Auth::user()->priceFormat($bill->getDue())}}</td>
                                                    <td>{{!empty($bill->lastPayments)?\App\Utility::getDateFormated($bill->lastPayments->date):''}}</td>
                                                    <td> {{\Auth::user()->priceFormat($bill->getTotal())}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="tab-pane fade fade show active" id="summary" role="tabpanel" aria-labelledby="profile-tab3">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <canvas id="canvas" height="280" width="600"></canvas>
                                                </div>
                                            </div>
                                        </div>
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
<script src="{{ asset('assets/js/Chart.min.js')}}"></script>
<script>
    var ctx = document.getElementById("canvas").getContext("2d");

var data = {
  labels: {!! json_encode($monthList) !!},
  datasets: [{
    backgroundColor: "#011c4b",
    data: {!! json_encode($billTotal) !!}
  }]
};

var myBarChart = new Chart(ctx, {
  type: 'bar',
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
