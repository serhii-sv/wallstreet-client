@extends('layouts.app')

@section('content')
    @include('layouts.app-preloader')

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
                <div class="account-body">
                    <h4 class="title mb-20">Welcome To Hyipland</h4>
                    <form method="POST" action="{{ route('login') }}" class="account-form">
                        @csrf
                        <div class="form-group">
                            <label for="sign-up">Your Email </label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pass">Password</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <span class="sign-in-recovery">Forgot your password? <a href="{{route('password.request')}}">recover password</a></span>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="mt-2 mb-2">Sign In</button>
                        </div>
                    </form>
                </div>
                <div class="or">
                    <span>OR</span>
                </div>
                <div class="account-header pb-0">
                    <span class="d-block mb-30 mt-2">Sign up with your work email</span>
                    <a href="#0" class="sign-in-with"><img src="{{ asset('theme/images/icon/google.png') }}" alt="icon"><span>Sign Up with Google</span></a>
                    <span class="d-block mt-15">Don't have an account? <a href="{{ route('register') }}">Sign Up Here</a></span>
                </div>
            </div>
        </div>
    </div>
@endsection






