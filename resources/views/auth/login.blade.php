@extends('layouts.auth')
@section('content')
    <!-- Application container -->
    <div class="row justify-content-center">
        <div class="col-sm-8 col-lg-4">
            <div class="card shadow zindex-100 mb-0">
                                    <div class="card-body px-md-5 py-5">
                                        <div class="mb-5">
                                            <h6 class="h3">Login</h6>
                                            <p class="text-muted mb-0">Sign in to your account to continue.</p>
                                        </div>
                                        <span class="clearfix"></span>
                                        <form method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="form-control-label">{{ __('E-Mail Address') }}</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group mb-4">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <label class="form-control-label">Password</label>
                                                    </div>
                                                    <div class="mb-2">
                                                        @if (Route::has('password.request'))
                                                            <a class="btn-link small text-muted text-underline--dashed border-primary" href="{{ route('password.request') }}">
                                                                {{ __('Forgot Your Password?') }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                    </div>
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row d-none">
                                                <div class="col-md-6 offset-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="remember">
                                                            {{ __('Remember Me') }}
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <button type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                                    <a href="#"><span class="btn-inner--text text-white">Sign in</span></a>
                                                    <span class="btn-inner--icon"><i class="fas fa-long-arrow-alt-right"></i></span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer px-md-5"><small>Not registered?</small>
                                        <a href="{{ url('register') }}" class="small font-weight-bold">Create account</a></div>
                                </div>
        </div>
    </div>
@endsection











