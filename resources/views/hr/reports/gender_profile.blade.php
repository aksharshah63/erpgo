@extends('layouts.admin')
@section('title')
    {{ __('Gender Profile') }}
@endsection
@section('action-button')
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="{{__('Download')}}">
            <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
        </a>
    </div>
@endsection
@section('content')

<div id="gender_profile">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">{{ __('User Gender Count') }}</h6>
                        </div>
                    </div>
                    @if(count($user) > 0)
                        <canvas id="canvas" height="230" width="600"></canvas>
                    @else
                        <h5 class="text-center">{{__('User Gender Count Not Found')}}</h5>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6">
            <div class="card">
                <div class="card-body">
                        <table class="table align-items-center">
                            <thead>
                                <tr>
                                    <th class="border-top-0">{{ __('Gender') }}</th>
                                    <th class="border-top-0">{{ __('Count') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                    <td>{{__("Male")}}
                                    <td>{{$gender['male']}}
                            </tr>
                            <tr>
                                    <td>{{__("Female")}}
                                    <td>{{$gender['female']}}
                            </tr>
                            <tr>
                                    <td>{{__("Other")}}
                                    <td>{{$gender['other']}}
                            </tr>
                            <tr>
                                    <td class="text-dark">{{__("Total")}}
                                    <td class="text-dark">{{$gender['total']}}
                            </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card-wrapper mt-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="mb-0">{{ __('User Gender By Department') }}</h6>
            </div>
        </div>
        <div class="table-responsive mt-3">
            <table class="table align-items-center">
                <thead>
                    <tr>
                        <th class="border-top-0">{{ __('Department') }}</th>
                        <th class="border-top-0">{{ __('Male') }}</th>
                        <th class="border-top-0">{{ __('Female') }}</th>
                        <th class="border-top-0">{{ __('Other') }}</th>
                        <th class="border-top-0 text-dark">{{ __('Total') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($departments) > 0)
                        @foreach($departments as $department)
                            <tr>
                                <td>{{ucfirst($department->title)}}</td>
                                <td>{{$department->Male}}</td>
                                <td>{{$department->Female}}</td>
                                <td>{{$department->Other}}</td>
                                <td class="text-dark">{{$department->Total}}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">
                                <h5 class="text-center">{{__('User Gneder By Department Not Found ')}}</h5>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('script')
<script src="{{ asset('assets/js/Chart.min.js')}}"></script>
<script src="{{ asset('assets/js/html2pdf.bundle.min.js') }}"></script>
<script>
@if(count($user) > 0)
    var barChartData = {
        labels: {!! json_encode(array_keys($user)) !!},
        datasets: [{
            backgroundColor: ['#051C4B','#ffc107','#dc3545'],
            data: {!! json_encode(array_values($user)) !!},
        }],
    };

    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'doughnut',
            data: barChartData,
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
        });
    };
@endif
</script>

<script>
    function saveAsPDF() {
        var element = document.getElementById('gender_profile');
        var opt = {
            margin: 0.3,
            filename: 'gender_profile_report',
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 4, dpi: 72, letterRendering: true},
            jsPDF: {unit: 'in', format: 'A2'}
        };
        html2pdf().set(opt).from(element).save();
    }
    </script>
@endpush