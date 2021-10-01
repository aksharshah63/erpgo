@extends('layouts.admin')
@section('title')
    {{ __('Growth Report') }}
@endsection
@section('action-button')
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="{{__('Download')}}">
            <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
        </a>
    </div>
@endsection
@section('content')
<div class="card-wrapper">
    <!-- Files -->
    <div class="card mb-3 border shadow-none" id="growth_report">
        <canvas id="canvas" height="280" width="600"></canvas>
    </div>
</div>
@endsection
@push('script')
<script src="{{ asset('assets/js/html2pdf.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/Chart.min.js')}}"></script>
<script>
function saveAsPDF() {
    var element = document.getElementById('growth_report');
    var opt = {
        margin: 0.3,
        filename: 'growth_report',
        image: {type: 'jpeg', quality: 1},
        html2canvas: {scale: 4, dpi: 72, letterRendering: true},
        jsPDF: {unit: 'in', format: 'A2'}
    };
    html2pdf().set(opt).from(element).save();
}

var month = {!! json_encode($months) !!};
var barChartData = {
    labels: month,
    datasets: {!! json_encode($arrResponse) !!}
};

window.onload = function() {
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
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
    });
};
</script>
@endpush