@extends('layouts.admin')
@section('title')
    {{ __('Customer Report') }}
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
        <table class="table dataTable" id="customer_report">
            <thead>
                <tr>
                    <th class="border-top-0">{{ __('Label') }}</th>
                    @foreach (array_keys($arr) as $item)
                        <th class="border-top-0">{{ __($item) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border-top-1 p-3 note-content">{{ __('All') }}</td>
                    @foreach (array_values($arr) as $item)
                        <td class="border-top-1 p-3 note-content">{{__($item)}}</td>
                    @endforeach
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
    var element = document.getElementById('customer_report');
    var opt = {
        margin: 0.3,
        filename: 'customer_report',
        image: {type: 'jpeg', quality: 1},
        html2canvas: {scale: 4, dpi: 72, letterRendering: true},
        jsPDF: {unit: 'in', format: 'A2'}
    };
    html2pdf().set(opt).from(element).save();
}
</script>
@endpush