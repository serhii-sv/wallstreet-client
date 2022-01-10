@extends('layouts.app')

@section('content')
  {{--@include('layouts.app-preloader')--}}

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
  <!--============= Sign In Section Starts Here =============-->
  <div class="account-section bg_img" data-background="{{ asset('theme/images/about/account-bg.jpg') }}">
    <div class="container">
      <div class="account-title text-center">
        <a href="#" onclick="window.history.back()" class="back-home">
          <i class="fas fa-angle-left"></i>
          <span>Назад</span>
        </a>
        <a href="/" class="logo">
          <img src="{{ asset('accountPanel/images/logo/sprint_bank_fin-02.png') }}" alt="logo" width="290">
        </a>
        <div class="language" style="margin-top: 10px">
          <p class="language__name">
            <span>{{ session()->get('language') }}</span>
          </p>
          <ul class="language__list">
            @foreach($languages as $lang)
              <li class="language__item">
                <a href="{{ route('set.lang', $lang->code) }}">
                  <button class="language__button">{{ $lang->name }}</button>
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="account-wrapper">
        <div class="account-header">
          <h4 class="title">Давайте начнем</h4>
          <a href="{{ $google_auth_url }}" class="sign-in-with">
            <img src="{{ asset('theme/images/icon/google.png') }}" alt="icon">
            <span>Зарегистрироваться через Google</span>
          </a>
        </div>
        <div class="or">
          <span>Или</span>
        </div>
        <div class="account-body">
          <span class="d-block mb-20">Авторизоваться с вашей рабочей почтой</span>
          <form method="POST" action="{{ route('register') }}" class="account-form">
            @csrf
            <div class="form-group">
              <label for="sign-up">Ваш Email</label>
              <input type="text" placeholder="Ваш email" id="sign-up" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">

              @error('email')
              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="sign-up">Ваше имя</label>
              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Ваше имя"
                  name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

              @error('name')
              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="login">Ваш логин</label>
              <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" placeholder="Логин"
                  name="login" value="{{ old('login') }}" required autocomplete="name" autofocus>

              @error('login')
              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
              @enderror
            </div>
            <div class="form-group">
              <label for="login">Ваш телефон<br>обязательно вводите номер с кодом страны например +7 или +3</label>
              <input id="phone" type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Телефон" value="{{ old('phone') }}"/>

              @error('phone')
              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="password">Пароль </label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="********"
                  name="password" required autocomplete="new-password">

              @error('password')
              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="password-confirm">Подтвердите пароль</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="********"
                  required autocomplete="new-password">

            </div>

            <div class="form-group">
              <label for="partner_id">ID партнёра (не обязательно)</label>
              <input id="partner_id" type="text" class="form-control @error('partner_id') is-invalid @enderror" name="partner_id"
                  value="{{ $_COOKIE["partner_id"] ??  old('partner_id')  }}" autofocus>

              @error('partner_id')
              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
              @enderror
            </div>

            <div class="form-group text-center">
              <button type="submit">Зарегистрироваться</button>
              <span class="d-block mt-15">Уже есть аккаунт?? <a href="{{ route('login') }}">Авторизоваться</a></span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
    <script>
        $(function () {
            $('#phone').mask('+000000000000');
        })
    </script>
@endpush
