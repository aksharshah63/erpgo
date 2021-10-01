@extends('layouts.admin')
@section('title')
    {{ __('Head Count') }}
@endsection
@section('action-button')
    <div class="col-md-6 d-flex align-items-center justify-content-between justify-content-md-end">
        <a href="#" class="btn btn-sm btn-icon-only rounded-circle ml-4 btn btn-primary" onclick="saveAsPDF()" data-toggle="tooltip" data-original-title="{{__('Download')}}">
            <span class="btn-inner--icon"><i class="fas fa-download"></i></span>
        </a>
    </div>
@endsection
@section('content')
<div id="head_count">
    <div class="card">
        <div class="card-body">
            <canvas id="canvas" height="200" width="600"></canvas>
        </div>
    </div>
    <div class="card-wrapper mt-3">
        <div class="table-responsive mt-3">
            <table class="table align-items-center">
                <thead>
                    <tr>
                        <th scope="col" class="sort" data-sort="status">{{ __('Name') }}</th>
                        <th scope="col" class="sort" data-sort="status">{{ __('Hire Date') }}</th>
                        <th scope="col" class="sort" data-sort="status">{{ __('Department') }}</th>
                        <th scope="col" class="sort" data-sort="status">{{ __('Location') }}</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @if(count($userdetails) > 0)
                        @foreach($userdetails as $userdetail)
                            <tr>
                                <td><a style="color:#0073aa;" href="{{ route('users.show', $userdetail->id) }}" class="action-item">{{ucfirst($userdetail->name)}}</a></td>
                                <td>{{!empty($userdetail->date_of_hire) ? \App\Utility::getDateFormated($userdetail->date_of_hire) : '-'}}</td>
                                <td>{{(!empty($userdetail->userdetail->departmentDesc->title) ?  $userdetail->userdetail->departmentDesc->title : '-')}}</td>
                                <td>{{!empty($userdetail->location) ? $userdetail->location : '-'}}</td>
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
                    scales: {
                        yAxes: [{
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
        var element = document.getElementById('head_count');
        var opt = {
            margin: 0.3,
            filename: 'head_count_report',
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 4, dpi: 72, letterRendering: true},
            jsPDF: {unit: 'in', format: 'A2'}
        };
        html2pdf().set(opt).from(element).save();
    }
    </script>
@endpush