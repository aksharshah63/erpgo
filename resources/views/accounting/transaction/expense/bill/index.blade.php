@extends('layouts.admin')
@section('title')
    {{__('Manage Bills')}}
@endsection
@section('action-button')
    @can('Create Bill')
        <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-6 col-12">
                <div class="all-button-box">
                    <a href="{{ route('bills.create') }}" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary">
                        <i class="fas fa-plus"></i> 
                    </a>
                </div>
            </div>
        </div>
    @endcan
@endsection
@section('content')
@if($bills->count() > 0)
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
                            <th> {{__('Bill')}}</th>
                            <th>{{__('Vendor')}}</th>
                            <th>{{__('Category')}}</th>
                            <th>{{__('Transaction Date')}}</th>
                            <th>{{__('Due Date')}}</th>
                            <th>{{__('Due Amount')}}</th>
                            <th>{{__('Status')}}</th>
                            @if(Gate::check('Edit Bill') || Gate::check('Delete Bill') || Gate::check('View Bill') || Gate::check('Duplicate Bill'))
                                <th>{{__('Action')}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($bills as $bill)
                            <tr>
                                <td class="Id"><a href="{{ route('bills.show',$bill->id) }}">{{ Auth::user()->billNumberFormat($bill->bill_id) }}</a></td>
                                <td> {{!empty($bill->vendor)? $bill->vendor->first_name. ' '.$bill->vendor->last_name:'' }} </td>
                                <td> {{!empty($bill->category->name)? $bill->category->name : '' }} </td>
                                <td>{{Utility::getDateFormated($bill->transaction_date) }}</td>
                                <td>{{Utility::getDateFormated($bill->due_date) }}</td>
                                <td>{{\Auth::user()->priceFormat($bill->getDue())}}</td>
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
                                @if(Gate::check('Edit Bill') || Gate::check('Delete Bill') || Gate::check('View Bill') || Gate::check('Duplicate Bill'))
                                    <td class="Action">
                                        @can('Duplicate Bill')
                                            <a href="#" class="action-item" data-toggle="tooltip" data-original-title="{{__('Duplicate')}}" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('You want to confirm duplicate this Bill.').'|'.__('Press Yes to continue or Cancel to go back')}}" data-confirm-yes="document.getElementById('duplicate-form-{{$bill->id}}').submit();">
                                                <i class="fas fa-copy"></i>
                                                {!! Form::open(['method' => 'get', 'route' => ['bill.duplicate', $bill->id],'id'=>'duplicate-form-'.$bill->id]) !!}
                                                {!! Form::close() !!}
                                            </a>
                                        @endcan
                                        @can('View Bill')
                                            <a href="{{ route('bills.show',$bill->id) }}" class="action-item" data-toggle="tooltip" data-original-title="{{__('Detail')}}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endcan
                                        @can('Edit Bill')
                                            <a href="{{ route('bills.edit',$bill->id) }}" class="action-item" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        @endcan
                                        @can('Delete Bill')
                                            <a href="#" class="action-item text-danger " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This Action Can Not Be Undone. Do You Want To Continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{$bill->id}}').submit();">
                                            <i class="fas fa-trash"></i>
                                            </a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['bills.destroy', $bill->id],'id'=>'delete-form-'.$bill->id]) !!}
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
    @if($bills->count() > 0)
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
                    }
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