@extends('layouts.admin')
@section('title')
    {{__('Tax Summary')}}
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
    </script>
@endpush
@section('action-button')
<div class="col-xl-8 col-lg-8 col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
    <div class="row d-flex justify-content-end">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-12 col-12">
            {{ Form::open(array('route' => array('tax.summary.report'),'method' => 'GET','id'=>'report_tax_summary')) }}
            <div class="all-select-box">
                <div class="btn-box">
                    {{ Form::label('year', __('Year'),['class'=>'text-xs text-primary']) }}
                    {{ Form::select('year',$yearList,isset($_GET['year'])?$_GET['year']:'', array('class' => 'form-control select2')) }}
                </div>
            </div>
        </div>
        <div class="col-auto my-auto">
            <a href="#" class="apply-btn" onclick="document.getElementById('report_tax_summary').submit(); return false;" data-toggle="tooltip" data-original-title="{{__('Apply')}}">
                <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
            </a>
            <a href="{{route('tax.summary.report')}}" class="reset-btn" data-toggle="tooltip" data-original-title="{{__('Reset')}}">
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
                <input type="hidden" value="{{__('Tax Summary').' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange']}}" id="filename">
                <div class="card p-4 mb-4">
                    <span class="h6 font-weight mb-0 ">{{__('Report')}} :</span>
                    <h6 class="text-muted mb-1">{{__('Tax Summary')}}</h6>
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
                <h5>{{__('Income')}}</h5>
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-12">
                            <div>
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{__('Tax')}}</th>
                                        @foreach($monthList as $month)
                                            <th>{{$month}}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse(array_keys($incomes) as $k=> $taxName)
                                        <tr>
                                            <td>{{$taxName}}</td>
                                            @foreach(array_values($incomes)[$k] as $price)
                                                <td>{{\Auth::user()->priceFormat($price)}}</td>
                                            @endforeach
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="13" class="text-center">{{__('Income Tax Not Found')}}</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <h5>{{__('Expense')}}</h5>
                <div class="card">
                    <div class="card-body">
                        <div class="col-sm-12">
                            <div>
                                <table class="table table-striped mb-0">
                                    <thead>
                                    <tr>
                                        <th>{{__('Tax')}}</th>
                                        @foreach($monthList as $month)
                                            <th>{{$month}}</th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse(array_keys($expenses) as $k=> $taxName)
                                        <tr>
                                            <td>{{$taxName}}</td>
                                            @foreach(array_values($expenses)[$k] as $price)
                                                <td>{{\Auth::user()->priceFormat($price)}}</td>
                                            @endforeach
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="13" class="text-center">{{__('Expense Tax Not Found')}}</td>
                                        </tr>
                                    @endforelse
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