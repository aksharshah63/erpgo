@extends('layouts.admin')
@section('title')
    {{ __('Activity Report') }}
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
    <div class="card mb-3 border shadow-none">
        <table class="table dataTable" id="activity_report">
            <thead>
                <tr>
                    <th class="border-top-0" width="95%">{{ __('Types') }}</th>
                    <th class="border-top-0" width="5%">{{ __('Count') }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border-top-1 p-3 note-content">{{ __('Schedules')}}</td>
                    <td class="border-top-1 p-3 note-content">{{__($schedules)}}</td>
                </tr>
                <tr>
                    <td class="border-top-1 p-3 note-content">{{ __('Notes')}}</td>
                    <td class="border-top-1 p-3 note-content">{{__($notes)}}</td>
                </tr>
                <tr>
                    <td class="border-top-1 p-3 note-content text-dark">{{ __('Total')}}</td>
                    <td class="border-top-1 p-3 note-content text-dark">{{__($schedules + $notes)}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('script')
<script src="{{ asset('assets/js/html2pdf.bundle.min.js') }}"></script>
<script>
function saveAsPDF() {
    var element = document.getElementById('activity_report');
    var opt = {
        margin: 0.3,
        filename: 'activity_report',
        image: {type: 'jpeg', quality: 1},
        html2canvas: {scale: 4, dpi: 72, letterRendering: true},
        jsPDF: {unit: 'in', format: 'A2'}
    };
    html2pdf().set(opt).from(element).save();
}
</script>
@endpush