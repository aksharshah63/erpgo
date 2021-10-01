@php
    $currantLang = \Auth::user()->lang;
@endphp
<div class="footer pt-5 pb-4 footer-light" id="footer-main">
    <div class="row text-center text-sm-left align-items-sm-center">
        <div class="col-sm-6">
            <p class="text-lg mb-0">Copyright &copy; {{(Utility::getValByName('footer_title')) ? Utility::getValByName('footer_title') : config('app.name', 'ERPGo')}} {{date('Y')}} </p>
        </div>
        <div class="col-sm-6 mb-md-0">
            <ul class="nav justify-content-center justify-content-md-end">
                <li class="nav-item dropdown border-right">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="h6 text-sm mb-0">{{Str::upper(\Auth::user()->lang)}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        @if(\Auth::user()->type=='Admin')
                            <a href="{{route('manage.language',[$currantLang])}}" class="dropdown-item">{{ __('Create & Customize') }}</a>
                        @endif
                        @foreach(Utility::languages() as $language)
                            <a href="{{route('change.language',$language)}}" class="dropdown-item @if($language == \Auth::user()->lang) text-dark @endif">{{Str::upper($language)}}</a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{\Auth::user()->footer_link_title_1()}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">{{\Auth::user()->footer_link_title_2()}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pr-0" href="#">{{\Auth::user()->footer_link_title_3()}}</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Core JS - includes jquery, bootstrap, popper, in-view and sticky-kit -->
<script src="{{ asset('assets/js/site.core.js') }}"></script>
<!--oppotunities-->
<script src="{{ asset('assets/libs/dragula/dist/dragula.min.js') }}"></script>
<script src="{{ asset('assets/libs/autosize/dist/autosize.min.js') }}"></script>
<!-- Page JS -->
<script src="{{ asset('assets/libs/progressbar.js/dist/progressbar.min.js') }}"></script>
<script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.js') }}"></script>

<!-- Data table -->
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<!--create-lead-->
<script src="{{ asset('assets/libs/dropzone/dist/min/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/libs/quill/dist/quill.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/libs/flatpickr/dist/flatpickr.min.js') }}"></script>

<script src="{{ asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
{{--toster js--}}
<script src="{{ asset('assets/libs/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<!--Create event-->
<script src="{{ asset('assets/libs/jquery-mask-plugin/dist/jquery.mask.min.js') }}"></script>

<script src="{{ asset('assets/js/site.js') }}"></script>

<script src="{{ asset('assets/js/letter.avatar.js') }}"></script>

@stack('script')
{{--custom js--}}
<script src="{{ asset('assets/js/custom.js') }}"></script>

@if(Session::has('success'))
    <script>
        show_toastr('{{__('Success')}}', '{!! session('success') !!}', 'success');
    </script>
    {{ Session::forget('success') }}
@endif
@if(Session::has('errors'))
    <script>
        show_toastr('{{__('Error')}}', '{!! session('errors') !!}', 'errors');
    </script>
    {{ Session::forget('errors') }}
@endif



