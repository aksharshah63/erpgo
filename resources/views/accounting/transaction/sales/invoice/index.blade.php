@extends('layouts.admin')
@section('title')
    {{__('Manage Invoices')}}
@endsection
@section('action-button')
    @can('Create Invoice')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-12">
                <div class="all-button-box">
                    <a href="{{ route('invoices.create') }}" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary">
                        <i class="fas fa-plus"></i> {{__('Create')}}
                    </a>
                </div>
            </div>
        </div>
    @endcan
@endsection
@section('content')
    @if($invoices->count() > 0)
        <div class="row">
            <div class="col-md-6">
                <h5 class="h5 d-inline-block font-weight-400 mb-4">{{__('Status')}}</h5>
                <div class="card">
                    <div class="card-body">
                        <canvas id="canvas" height="200" width="600"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h5 class="h5 d-inline-block font-weight-400 mb-4">{{__('Payment')}}</h5>
                <div class="card">
                    <div class="card-body">
                        <canvas id="canvas-invoice" height="200" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table align-items-center dataTable">
                    <thead>
                        <tr>
                            <th> {{__('Invoice')}}</th>
                            <th>{{__('Customer')}}</th>
                            <th>{{__('Transaction Date')}}</th>
                            <th>{{__('Due Date')}}</th>
                            <th>{{__('Due Amount')}}</th>
                            <th>{{__('Status')}}</th>
                            @if(Gate::check('Edit Invoice') || Gate::check('Delete Invoice') || Gate::check('View Invoice') || Gate::check('Duplicate Invoice'))
                                <th>{{__('Action')}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td class="Id"><a href="{{ route('invoices.show',$invoice->id) }}">{{ Auth::user()->invoiceNumberFormat($invoice->invoice_id) }}</a></td>
                                <td> {{!empty($invoice->customer)? $invoice->customer->first_name. ' '.$invoice->customer->last_name:'' }} </td>
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
                                @if(Gate::check('Edit Invoice') || Gate::check('Delete Invoice') || Gate::check('View Invoice') || Gate::check('Duplicate Invoice'))
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
<script src="{{ asset('assets/js/Chart.min.js')}}"></script>
<script>
    @if($invoices->count() > 0)
    var barChartData = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: {!! json_encode(array_values($statusCnts)) !!},
                backgroundColor: ['#051C4B','#ffc107','#dc3545','#17a2b8','#28a745']
            }],
            labels: {!! json_encode(array_keys($statusCnts)) !!}
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
        type: 'doughnut',
        data: {
            datasets: [{
                data: {!! json_encode(array_values($incPercentage)) !!},
                backgroundColor: ['#051C4B','#ffc107']
            }],
            labels: {!! json_encode(array_keys($incPercentage)) !!}
        },
        options:{
            legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        fontColor: '#333',
                        usePointStyle: true,
                    },
                },
        }
    };

    window.onload = function() {
    window.myBar = new Chart(document.getElementById("canvas"), barChartData);
    window.myBar1 = new Chart(document.getElementById("canvas-invoice"), barChartData1);
};
@endif
</script>
@endpush