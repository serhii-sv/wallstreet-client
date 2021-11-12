@extends('layouts.app')

@section('content')
    {{--@include('layouts.app-preloader')--}}

    <div class="account-section bg_img" data-background="{{ asset('theme/images/about/account-bg.jpg') }}">
        <div class="container">
            <div class="account-title text-center">
                <a href="#" onclick="window.history.back()" class="back-home">
                    <i class="fas fa-angle-left"></i><span>Back</span>
                </a>
                <a href="/" class="logo">
                    <img src="{{ asset('accountPanel/images/logo/sprint_bank_fin-02.png') }}" alt="logo">
                </a>
            </div>
            <div class="account-wrapper">
                <div class="account-body">
                    <h4 class="title mb-20">Welcome To Hyipland</h4>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('password.update') }}" class="account-form">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label for="sign-up">Your Email </label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sign-up">New password </label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sign-up">Confirm password </label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="mt-2 mb-2">{{ __('Reset Password') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
