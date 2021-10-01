@extends('layouts.admin')
@section('title')
    {{__('Transaction Summary')}}
@endsection

@push('script')
    <script type="text/javascript" src="{{ asset('assets/js/html2pdf.bundle.min.js') }}"></script>
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
                jsPDF: {unit: 'in', format: 'A4'}
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
            {{ Form::open(array('route' => array('accounting.transaction.report'),'method'=>'get','id'=>'transaction_report')) }}
            <div class="all-select-box">
                <div class="btn-box">
                    {{Form::label('start_month',__('Start Month'),['class'=>'text-xs text-primary'])}}
                    {{Form::month('start_month',isset($_GET['start_month'])?$_GET['start_month']:date('Y-m'),array('class'=>'form-control'))}}
                </div>
            </div>
        </div>
        <div class="col">
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
                    {{ Form::select('account', $account,isset($_GET['account'])?$_GET['account']:'', array('class' => 'form-control select2')) }}
                </div>
            </div>
        </div>
        <div class="col">
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('category', __('Category'),['class'=>'text-xs text-primary']) }}
                    {{ Form::select('category', $category,isset($_GET['category'])?$_GET['category']:'', array('class' => 'form-control select2')) }}
                </div>
            </div>
        </div>
        <div class="col-auto my-auto">
            <a href="#" class="apply-btn" onclick="document.getElementById('transaction_report').submit(); return false;" data-toggle="tooltip" data-original-title="{{__('Apply')}}">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="{{route('accounting.transaction.report')}}" class="reset-btn" data-toggle="tooltip" data-original-title="{{__('Reset')}}">
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
                <input type="hidden" value="{{$filter['category'].' '.__('Category').' '.__('Transaction').' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange']}}" id="filename">
                <div class="card p-4 mb-4">
                    <span class="h6 font-weight mb-0 ">{{__('Report')}} :</span>
                    <h6 class="text-muted mb-1">{{__('Transaction Summary')}}</h6>
                </div>
            </div>
            @if($filter['account']!= __('All'))
                <div class="col">
                    <div class="card p-4 mb-4">
                        <span class="h6 font-weight mb-0 ">{{__('Account')}} :</span>
                        <h6 class="text-muted mb-1">{{$filter['account']}}</h6>
                    </div>
                </div>
            @endif
            @if($filter['category']!= __('All'))
                <div class="col">
                    <div class="card p-4 mb-4">
                        <span class="h6 font-weight mb-0 ">{{__('Category')}} :</span>
                        <h6 class="text-muted mb-1">{{$filter['category']}}</h6>
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
            @foreach($accounts as $account)
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
                                <th>{{__('Account')}}</th>
                                <th>{{__('Type')}}</th>
                                <th>{{__('Category')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Amount')}}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if(count($transactions) > 0)
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ \App\Utility::getDateFormated($transaction->date)}}</td>
                                        <td>
                                            @if(!empty($transaction->bankAccount()) && $transaction->bankAccount()->holder_name=='Cash')
                                                {{$transaction->bankAccount()->holder_name}}
                                            @else
                                                {{!empty($transaction->bankAccount())?$transaction->bankAccount()->bank_name.' '.$transaction->bankAccount()->holder_name:'-'}}
                                            @endif
                                        </td>
                                        <td>{{$transaction->type}}</td>
                                        <td>{{$transaction->category}}</td>
                                        <td>{{  !empty($transaction->description)?$transaction->description:'-'}}</td>
                                        <td>{{\Auth::user()->priceFormat($transaction->amount)}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">
                                        <h5 class="text-center">{{__('Transaction Not Found ')}}</h5>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
