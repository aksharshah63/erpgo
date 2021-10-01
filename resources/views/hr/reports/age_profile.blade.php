@extends('layouts.admin')
@section('title')
    {{ __('Age Profile') }}
@endsection
@section('action-button')
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="{{__('Download')}}">
            <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
        </a>
    </div>
@endsection
@section('content')
<div id="age_profile">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-0">{{ __(' User Age Breakdown by Department') }}</h6>
                </div>
            </div>
            <canvas id="canvas" height="200" width="600"></canvas>
        </div>
    </div>
    <div class="card-wrapper mt-3">
        <!-- Files -->
        <div class="table-responsive mt-3">
            <table class="table align-items-center">
                <thead>
                    <tr>
                        <th scope="col" class="sort" data-sort="status">{{ __('Department') }}</th>
                        <th scope="col" class="sort" data-sort="status">{{ __('Under 18 year') }}</th>
                        <th scope="col" class="sort" data-sort="status">{{'18' . __('To') .'25'. __('Year')}}</th>
                        <th scope="col" class="sort" data-sort="status">{{'26' . __('To') .'35'. __('Year')}}</th>
                        <th scope="col" class="sort" data-sort="status">{{'36' . __('To') .'45'. __('Year')}}</th>
                        <th scope="col" class="sort" data-sort="status">{{'46' . __('To') .'55'. __('Year')}}</th>
                        <th scope="col" class="sort" data-sort="status">{{'56' . __('To') .'65'. __('Year')}}</th>
                        <th scope="col" class="sort" data-sort="status">{{'65+'. __('Year') }}</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @if(count($arrResponse) > 0)
                        @foreach($arrResponse as $key=>$value)
                            <tr>
                                <td>{{$key}}</td>
                                @foreach($value as $v)
                                    <td>{{$v}}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    @else
                        <tr class="font-style">
                            <td colspan="6" class="text-center">
                                <h6 class="text-center">{{ __('No Users Found.') }}</h6>
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
window.onload = function() {
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'horizontalBar',
        data: {
                labels: {!! json_encode($arrChart['labels']) !!},
                datasets: {!! json_encode($arrChart['data']) !!}
            },
            options: {
                        scales: {
                            xAxes: [{
                            ticks: {
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
    });
};
</script>

<script>
    function saveAsPDF() {
        var element = document.getElementById('age_profile');
        var opt = {
            margin: 0.3,
            filename: 'age_profile_report',
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 4, dpi: 72, letterRendering: true},
            jsPDF: {unit: 'in', format: 'A2'}
        };
        html2pdf().set(opt).from(element).save();
    }
    </script>
@endpush