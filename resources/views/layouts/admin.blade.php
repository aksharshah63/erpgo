<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('include.admin.head')
</head>
<body class="application application-offset">
    {{-- <div> --}}
        <!-- Application container -->
        <div class="container-fluid container-application">
        <!-- Sidenav -->
        @include('include.admin.side_bar')
        <!-- Content -->
        <div class="main-content position-relative">
        <!-- Main nav -->
        @include('include.admin.topbar')
        <!-- Page title -->
        <div class="page-content">
            <div class="page-title mb-4">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
                        <div class="d-inline-block">
                        <h5 class="h4 d-inline-block font-weight-400 mb-0">@yield('title')</h5>
                        </div>
                    </div>
                    @yield('action-button')
                </div>
            </div>
        <!-- Page content -->
            @yield('content')
        </div>
            <!-- Footer -->
        @include('include.admin.footer')
    {{-- </div> --}}

    <div class="modal fade" tabindex="-1" role="dialog" id="commonModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

    {{--Side Modal--}}
<div class="modal fade fixed-right" id="commonModal-right" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="scrollbar-inner">
        <div class="min-h-300 mh-300">
        </div>
    </div>
</div>
{{--Side Modal End--}}
</body>
</html>
