{{-- <title>@yield('title') - {{env('APP_NAME')}}</title> --}}
<title> @yield('title') &dash; {{(Utility::getValByName('title_text')) ? Utility::getValByName('title_text') : config('app.name', 'ERPGo')}}</title>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
{{--toster --}}
<link rel="stylesheet" href="{{ asset('assets/libs/animate.css/animate.min.css') }}">
<!-- Favicon -->
@if(!empty(Utility::getValByName('company_favicon')))
    <link rel="icon" href="{{ asset(Storage::url('logo/'.Utility::getValByName('company_favicon'))) }}" type="image/png">
@else
    <link rel="icon" href="{{ asset(Storage::url('logo/favicon.png')) }}" type="image/png">
@endif
<!-- Font Awesome 5 -->
<link rel="stylesheet" href="{{ asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css')}}">
<!-- Page CSS -->
<link rel="stylesheet" href="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.css') }}">

<link rel="stylesheet" href="{{ asset('assets/libs/quill/dist/quill.core.css') }}" type="text/css">
<link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/dist/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/site.css') }}" id="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/ac.css') }}" id="stylesheet">
<!-- Data table -->
<link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}" id="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/stylesheet.css') }}" id="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" id="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}" id="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
@stack('css')
<style>
    d-none {
        display: none;
    }
</style>
