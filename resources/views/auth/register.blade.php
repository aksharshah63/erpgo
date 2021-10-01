@extends('layouts.auth')
@section('content')
    <!-- Application container -->
    <div class="row justify-content-center">
        <div class="col-sm-8 col-lg-5">
            <div class="card shadow zindex-100 mb-0">
                                    <div class="card-body px-md-5 py-5">
                                        <div class="mb-5">
                                            <h6 class="h3">{{ __('Register') }}</h6>
                                            <p class="text-muted mb-0">Made with love by developers for developers.</p>
                                        </div>
                                        <span class="clearfix"></span>
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="input-group input-group-merge">
                                                <label for="name" class="form-control-label">{{ __('Name') }}</label>
                                                <div class="input-group input-group-merge">
                                                    <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">{{ __('E-Mail Address') }}</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    </div>
                                                    <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label class="form-control-label">{{ __('Password') }}</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                    </div>
                                                    <input id="input-password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                    <div class="input-group-append">
                                                    <span class="input-group-text">
                                                      <a href="#" data-toggle="password-text" data-target="#input-password">
                                                        <i class="fas fa-eye"></i>
                                                      </a>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-control-label">{{ __('Confirm Password') }}</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                                    </div>
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                </div>
                                            </div>
                                            <div class="mt-4"><button type="submit" class="btn btn-sm btn-primary btn-icon rounded-pill">
                                                    <span class="btn-inner--text">Create my account</span>
                                                    <span class="btn-inner--icon"><i class="fas fa-long-arrow-alt-right"></i></span>
                                                </button></div>
                                        </form>
                                    </div>
                                    <div class="card-footer px-md-5"><small>Already have an acocunt?</small>
                                        <a href="{{route('login')}}" class="small font-weight-bold">Sign in</a></div>
                                </div>
        </div>
    </div>
@endsection











