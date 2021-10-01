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

    <!-- Styles --><div class="footer pt-5 pb-4 footer-light" id="footer-main">
    <div class="row text-center text-sm-left align-items-sm-center">
        <div class="col-sm-6">
            <p class="text-sm mb-0">&copy; 2019 <a href="https://webpixels.io" class="h6 text-sm" target="_blank">Webpixels</a>. All rights reserved.</p>
        </div>
        <div class="col-sm-6 mb-md-0">
            <ul class="nav justify-content-center justify-content-md-end">
                <li class="nav-item dropdown border-right">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img alt="Image placeholder" src="assets/img/icons/flags/ro.svg">
                        <span class="h6 text-sm mb-0">RO</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <a href="#" class="dropdown-item"><img alt="Image placeholder" src="assets/img/icons/flags/es.svg" class="mr-2">Spanish</a>
                        <a href="#" class="dropdown-item"><img alt="Image placeholder" src="assets/img/icons/flags/us.svg" class="mr-2">English</a>
                        <a href="#" class="dropdown-item"><img alt="Image placeholder" src="assets/img/icons/flags/gr.svg" class="mr-2">Greek</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Support</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Terms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pr-0" href="#">Privacy</a>
                </li>
            </ul>
        </div>
</div>
</div>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle Navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        {{--                            @if($numberOfUpdatesPending)--}}
                        {{--                            <li class="nav-item">--}}
                        {{--                                <a class="nav-link" href="{{ route('LaravelUpdater::welcome') }}">{{ __('Update') }}</a>--}}
                        {{--                            </li>--}}
                        {{--                            @endif--}}
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
