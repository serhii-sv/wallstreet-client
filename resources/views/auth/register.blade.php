@extends('layouts.app')

@section('content')
    @include('layouts.app-preloader')

    <!--============= Sign In Section Starts Here =============-->
    <div class="account-section bg_img" data-background="{{ asset('theme/images/about/account-bg.jpg') }}">
        <div class="container">
            <div class="account-title text-center">
                <a href="#" onclick="window.history.back()" class="back-home">
                    <i class="fas fa-angle-left"></i><span>Back</span>
                </a>
                <a href="#0" class="logo">
                    <img src="{{ asset('theme/images/logo/footer-logo.png') }}" alt="logo">
                </a>
            </div>
            <div class="account-wrapper">
                {{--<div class="account-header">
                    <h4 class="title">Let's get started</h4>
                    <a href="#0" class="sign-in-with"><img src="{{ asset('theme/images/icon/google.png') }}" alt="icon"><span>Sign Up with Google</span></a>
                </div>
                <div class="or">
                    <span>OR</span>
                </div>--}}
                <div class="account-body">
                    <span class="d-block mb-20">Sign up with your work email</span>
                    <form method="POST" action="{{ route('register') }}" class="account-form">
                        @csrf
                        <div class="form-group">
                            <label for="sign-up">Your Email </label>
                            <input type="text" placeholder="Enter Your Email " id="sign-up" class="form-control @error('name') is-invalid @enderror" name="email" value="{{ old('email') }}">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="sign-up">Your Name </label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Your name"
                                   name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="login">Your Login </label>
                            <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" placeholder="Your Login"
                                   name="login" value="{{ old('login') }}" required autocomplete="name" autofocus>

                            @error('login')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password">Password </label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="********"
                                   name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="********"
                                   required autocomplete="new-password">

                        </div>

                        <div class="form-group">
                            <label for="partner_id">Partner ID </label>
                            <input id="partner_id" type="text" class="form-control @error('partner_id') is-invalid @enderror" name="partner_id"
                                   value="{{ $_COOKIE["partner_id"] ??  old('partner_id')  }}" autofocus>

                            @error('partner_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group text-center">
                            <button type="submit">{{ __('Register') }}</button>
                            <span class="d-block mt-15">Already have an account? <a href="{{ route('login') }}">Sign In</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
