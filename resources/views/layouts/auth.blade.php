<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}" type="image/png">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="{{ asset('assets/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/site.css')}}" id="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css')}}">
</head>
<body class="application application-offset sidenav-pinned ready">
<div id="app">
    <main class="py-4">
        <div class="container-fluid container-application">
            <!-- Content -->
            <div class="main-content position-relative">
                <!-- Page content -->
                <div class="page-content">
                    <div class="min-vh-100 py-5 d-flex align-items-center">
                        <div class="w-100">
                             @yield('content')
                        </div>
                    </div>
                </div>
    </main>
</div>
<!-- Scripts -->
<!-- Core JS - includes jquery, bootstrap, popper, in-view and sticky-kit -->
<script src="{{ asset('assets/js/site.core.js')}}"></script>
<!-- Page JS -->
<script src="{{ asset('assets/libs/progressbar.js/dist/progressbar.min.js')}}"></script>
<script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
<script src="{{ asset('assets/libs/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<script src="{{ asset('assets/js/site.js')}}"></script>
<!-- Demo JS - remove it when starting your project -->
<script src="{{ asset('assets/js/demo.js')}}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
</body>
</html>
