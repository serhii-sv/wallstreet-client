@extends('layouts.app')

@section('content')
  {{-- @include('layouts.app-preloader')--}}
  <style>
      .language {
          text-transform: uppercase;
          font-weight: 700;
          position: absolute;
          right: 0;
          top: 50%;
          -webkit-transform: translateY(-50%);
          -ms-transform: translateY(-50%);
          transform: translateY(-50%);
          display: block;
          font-size: 12px;
          letter-spacing: .5px
      }

      .language__name {
          color: white;
          margin-bottom: 0;
          height: 29px;
          border-radius: 15px;
          border: solid 2px #fbc800;
          display: -webkit-box;
          display: -webkit-flex;
          display: -ms-flexbox;
          display: flex;
          -webkit-box-align: center;
          -webkit-align-items: center;
          -ms-flex-align: center;
          align-items: center;
          -webkit-box-pack: center;
          -webkit-justify-content: center;
          -ms-flex-pack: center;
          justify-content: center;
          padding-right: 20px;
          padding-left: 13px;
          cursor: pointer;
          position: relative;
          -webkit-transition: all .2s ease;
          transition: all .2s ease
      }

      .language__name:after {
          content: '';
          width: 5px;
          display: block;
          height: 5px;
          border-left: solid 1px white;
          border-bottom: solid 1px white;
          -webkit-transform: rotate(-45deg);
          -ms-transform: rotate(-45deg);
          transform: rotate(-45deg);
          margin-left: 10px;
          position: absolute;
          top: 50%;
          margin-top: -5px;
          right: 8px
      }

      .language:hover .language__list {

          visibility: visible;
          opacity: 1;
          -webkit-transform: none;
          -ms-transform: none;
          transform: none
      }

      .language__list {
          width: 120px;
          list-style: none;
          position: absolute;
          background: #fff;
          border: solid 2px #fbc800;
          box-shadow: .5px .9px 62px 0 rgba(201, 201, 201, .6);
          border-radius: 15px;
          top: 100%;
          margin-top: -2px;
          left: 0;
          right: 0;
          z-index: 5;
          text-align: left;
          visibility: hidden;
          opacity: 0;
          -webkit-transform: translateY(10px);
          -ms-transform: translateY(10px);
          transform: translateY(10px);
          -webkit-transition: all .3s ease;
          transition: all .3s ease
      }

      .language__item, .language__item a {
          width: 100%;
          margin-left: 0 !important;
      }

      .language__item:last-child {
          border: none
      }

      .language__button {
          width: 100%;
          border: none;
          color: #000;
          text-transform: uppercase;
          font-weight: 700;
          padding: 3px;
          cursor: pointer;
          background: 0 0
      }

      .language__button:hover {
          color: #fbc800
      }
  </style>
  <div class="account-section bg_img" data-background="{{ asset('theme/images/about/account-bg.jpg') }}">
    <div class="container">
      <div class="account-title text-center mb-3">
        <a href="#" onclick="window.history.back()" class="back-home">
          <i class="fas fa-angle-left"></i>
          <span>Back</span>
        </a>
        <a href="/" class="logo">
          <img src="{{ asset('accountPanel/images/logo/sprint_bank_fin-02.png') }}" width="100" alt="logo">
        </a>

      </div>
      <div class="account-wrapper">
        <div class="account-body">
          <h4 class="title mb-20">Авторизация с помощью телефона</h4>
          @include('partials.inform')
          <form method="POST" action="{{ route('login.verify.code') }}" class="account-form">
            @csrf
            <input type="hidden" name="g-recaptcha-response" id="recaptcha">
            <div class="form-group">
              <label for="sign-up">Введите код из смс сообщения</label>
              <input id="email" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" autofocus>

              @error('code')
              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
              @enderror
            </div>

            @if($last_sms)
              <span>Отправить код повторно можно будет через {{ 300 - Carbon\Carbon::parse($last_sms->created_at)->diffInSeconds(Carbon\Carbon::now()) }} секунд</span>
            @else
              <a href="{{ route('login.send.verify.code') }}">Отправить код повторно</a>
            @endif

            @if(!auth()->user()->phone_verified)
            <div class="form-group">
                <label for="sign-up">Вы можете сменить номер телефона</label>
                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? auth()->user()->phone }}">
            </div>
            @endif

            <div class="form-group text-center">
              <button type="submit" class="mt-2 mb-2">Подтвердить</button>

              @if(!auth()->user()->phone_verified)
              <button type="submit" name="skip_code" class="mt-2 mb-2">Подтвердить позже</button>
              @endif
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')

@endpush
