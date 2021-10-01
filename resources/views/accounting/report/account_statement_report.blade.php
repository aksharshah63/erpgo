@extends('layouts.admin')
@section('title')
    {{__('Account Statement')}}
@endsection
@push('script')
    <script type="text/javascript" src="{{ asset('assets/js/html2pdf.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jspdf.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('assets/js/jszip.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pdfmake.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/vfs_fonts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/dataTables.buttons.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/buttons.html5.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/buttons.print.min.js') }}"></script>

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
                    },  {
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
        <div class="col-auto">
            {{ Form::open(array('route' => array('account.statement.report'),'method'=>'get','id'=>'report_account')) }}
            <div class="all-select-box">
                <div class="btn-box">
                    {{Form::label('start_month',__('Start Month'),['class'=>'text-xs text-primary'])}}
                    {{Form::month('start_month',isset($_GET['start_month'])?$_GET['start_month']:date('Y-m'),array('class'=>'form-control'))}}
                </div>
            </div>
        </div>
        <div class="col-auto">
            <div class="all-select-box">
                <div class="btn-box">
                    {{Form::label('end_month',__('End Month'),['class'=>'text-xs text-primary'])}}
                    {{Form::month('end_month',isset($_GET['end_month'])?$_GET['end_month']:date('Y-m', strtotime("-5 month")),array('class'=>'form-control'))}}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="all-select-box">
                <div class="btn-box">
                    {{Form::label('account',__('Account'),['class'=>'text-xs text-primary'])}}
                    {{Form::select('account', $account,isset($_GET['account'])?$_GET['account']:'', array('class' => 'form-control select2')) }}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('type', __('Type'),['class'=>'text-xs text-primary']) }}
                    {{ Form::select('type',$types,isset($_GET['type'])?$_GET['type']:'', array('class' => 'form-control select2')) }}
                </div>
            </div>
        </div>
        <div class="col-auto my-auto">
            <a href="#" class="apply-btn" onclick="document.getElementById('report_account').submit(); return false;" data-toggle="tooltip" data-original-title="{{__('Apply')}}">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="{{route('account.statement.report')}}" class="reset-btn" data-toggle="tooltip" data-original-title="{{__('Reset')}}">
                <span class="btn-inner--icon"><i class="fas fa-trash-restore-alt"></i></span>
            </a>
            <a href="#" class="action-btn" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="{{__('Download')}}">
                <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
            </a>
        </div>
        {{ Form::close() }}
    </div>
</div>

@endsection

@section('content')
    <div id="printableArea">
        <div class="row mt-3">
            <div class="col">
                <input type="hidden" value="{{__('Account Statement').' '.$filter['type'].' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange']}}" id="filename">
                <div class="card p-4 mb-4">
                    <span class="h6 font-weight mb-0 ">{{__('Report')}} :</span>
                    <h6 class="text-muted mb-1">{{__('Account Statement Summary')}}</h6>
                </div>
            </div>
            @if($filter['account']!=__('All'))
                <div class="col">
                    <div class="card p-4 mb-4">
                        <span class="h6 font-weight mb-0 ">{{__('Account')}} :</span>
                        <h6 class="text-muted mb-1">{{$filter['account']}}</h6>
                    </div>
                </div>
            @endif
            @if($filter['type']!=__('All'))
                <div class="col">
                    <div class="card p-4 mb-4">
                        <span class="h6 font-weight mb-0 ">{{__('Type')}} :</span>
                         <h6 class="text-muted mb-1">{{$filter['type']}}</h6>
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
        @if(!empty($reportData['paymentAccounts']))
            <div class="row">
                @foreach($reportData['paymentAccounts'] as $account)
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="card p-4 mb-4">
                            @if($account->holder_name =='Cash')
                               <span class="h6 font-weight mb-0 ">{{$account->holder_name}}</span>
                            @elseif(empty($account->holder_name))
                               <span class="h6 font-weight mb-0 ">{{__('Stripe / Paypal')}}</span>
                            @else
                               <span class="h6 font-weight mb-0 ">{{$account->holder_name.' - '.$account->bank_name}}</span>
                            @endif
                            <h6 class="text-muted mb-1">{{\Auth::user()->priceFormat($account->total)}}</h6>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="pt-4">
                        <table class="table table-striped mb-0" id="report-dataTable">
                            <thead>
                            <tr>
                                <th>{{__('Date')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Amount')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($reportData['payments']))
                                @foreach ($reportData['payments'] as $payments)
                                    <tr class="font-style">
                                        <td>{{ \App\Utility::getDateFormated($payments->date) }}</td>
                                        <td>{{!empty($payments->description)?$payments->description:'-'}} </td>
                                        <td>{{ Auth::user()->priceFormat($payments->amount) }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
