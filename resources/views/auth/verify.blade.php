@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A Fresh Verification Link Has Been Sent To Your Email Address.') }}
                        </div>
                    @endif

                    {{ __('Before Proceeding, Please Check Your Email For A Verification Link.') }}
                    {{ __('If You Did Not Receive The Email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Click Here To Request Another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
