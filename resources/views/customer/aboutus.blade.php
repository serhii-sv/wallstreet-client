@extends('layouts.app')
@section('title', __('About us'))
@section('content')

  <div class="main--body">

  @include('layouts.app-preloader')

  <!--=======Header-Section Starts Here=======-->
  @include('layouts.app-header')
  <!--=======Header-Section Ends Here=======-->

    <div class="main--body section-bg">
      <!--========== Preloader ==========-->
        @include('layouts.app-preloader')
      <!--========== Preloader ==========-->


      <!--=======Header-Section Starts Here=======-->
      @include('layouts.app-header')
      <!--=======Header-Section Ends Here=======-->


      <!--=======Banner-Section Starts Here=======-->
      <section class="hero-section bg_img" data-background="{{asset('theme/images/about/hero-bg.png')}}">
        <div class="container">
          <div class="hero-content">
            <h1 class="title">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='About US' contenteditable="true">{{ __('About US') }}</editor_block>
              @else
                {{ __('About US') }}
              @endif
              </h1>
            <ul class="breadcrumb">
              <li>
                <a href="{{ route('customer.main') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Home' contenteditable="true">{{ __('Home') }}</editor_block>
                  @else
                    {{ __('Home') }}
                  @endif
                </a>
              </li>
              <li>
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='About Us' contenteditable="true">{{ __('About Us') }}</editor_block>
                @else
                  {{ __('About Us') }}
                @endif
              </li>
            </ul>
          </div>
        </div>
      </section>
      <!--=======Banner-Section Ends Here=======-->


      <!--=======About-Section Starts Here=======-->
      <section class="about-section padding-top padding-bottom section-bg">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6 d-none d-lg-block rtl">
              <img src="{{ asset('theme/images/about/about.png') }}" alt="about">
            </div>
            <div class="col-lg-6">
              <div class="section-header left-style">
                <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='WELCOME TO HYIPLAND' contenteditable="true">{{ __('WELCOME TO HYIPLAND') }}</editor_block>
                  @else
                    {{ __('WELCOME TO HYIPLAND') }}
                    @endif</span>
                <h2 class="title">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='about hyipland' contenteditable="true">{{ __('about hyipland') }}</editor_block>
                  @else
                    {{ __('about hyipland') }}
                    @endif</h2>
                <p>
                  @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='HYIPLAND is an investment company, whose team is working on making money from the volatility of cryptocurrencies and offer great returns to our clients.' contenteditable="true">{{ __('HYIPLAND is an investment company, whose team is working on making money from the volatility of cryptocurrencies and offer great returns to our clients.') }}</editor_block>
                  @else
                    {{ __('HYIPLAND is an investment company, whose team is working on making money from the volatility of cryptocurrencies and offer great returns to our clients.') }}
                    @endif
                </p>
              </div>
              <div class="about--content">
                <div class="about-item">
                  <div class="about-thumb">
                    <img src="{{ asset('theme/images/about/about01.png') }}" alt="about">
                  </div>
                  <div class="about-content">
                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Secure & Reliable' contenteditable="true">{{ __('Secure & Reliable') }}</editor_block>
                      @else
                        {{ __('Secure & Reliable') }}
                        @endif</h5>
                    <p>
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Secure assets fund for users' contenteditable="true">{{ __('Secure assets fund for users') }}</editor_block>
                      @else
                        {{ __('Secure assets fund for users') }}
                        @endif
                    </p>
                  </div>
                </div>
                <div class="about-item">
                  <div class="about-thumb">
                    <img src="{{ asset('theme/images/about/about02.png') }}" alt="about">
                  </div>
                  <div class="about-content">
                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Fast Withdrawals' contenteditable="true">{{ __('Fast Withdrawals') }}</editor_block>
                      @else
                        {{ __('Fast Withdrawals') }}
                        @endif</h5>
                    <p>
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Quick money withdrawals for users' contenteditable="true">{{ __('Quick money withdrawals for users') }}</editor_block>
                      @else
                        {{ __('Quick money withdrawals for users') }}
                        @endif
                    </p>
                  </div>
                </div>
                <div class="about-item">
                  <div class="about-thumb">
                    <img src="{{ asset('theme/images/about/about03.png') }}" alt="about">
                  </div>
                  <div class="about-content">
                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Guaranteed' contenteditable="true">{{ __('Guaranteed') }}</editor_block>
                      @else
                        {{ __('Guaranteed') }}
                        @endif</h5>
                    <p>
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Your return on investment is guaranteed' contenteditable="true">{{ __('Your return on investment is guaranteed') }}</editor_block>
                      @else
                        {{ __('Your return on investment is guaranteed') }}
                        @endif
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--=======About-Section Ends Here=======-->


      <!--=======CEO-Section Starts Here=======-->
      <section class="ceo-section padding-bottom padding-top bg_img" data-background="{{ asset('theme/images/about/ceo-bg.jpg') }}">
        <div class="container">
          <div class="row justify-content-between">
            <div class="col-lg-7 col-xl-6">
              <div class="ceo-content">
                <h3 class="title">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Our goal is to be at the heart of the financial services industry' contenteditable="true">{{ __('Our goal is to be at the heart of the financial services industry') }}</editor_block>
                  @else
                    {{ __('Our goal is to be at the heart of the financial services industry') }}
                    @endif</h3>
                <div class="author">
                  <h6 class="subtitle"><a href="#0" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Adam Phelps' contenteditable="true">{{ __('Adam Phelps') }}</editor_block>
                      @else
                        {{ __('Adam Phelps') }}
                        @endif</a></h6>
                  <span class="info">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='CEO of hyipland' contenteditable="true">{{ __('CEO of hyipland') }}</editor_block>
                    @else
                      {{ __('CEO of hyipland') }}
                      @endif</span>
                  <div class="sign">
                    <img src="{{ asset('theme/images/about/sign-ceo.png') }}" alt="about">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-xl-3">
              <div class="ceo-thumb">
                <img src="{{ asset('theme/images/about/certificate-ceo.png') }}" alt="about">
              </div>
              <a href="#0" class="custom-button"
                  @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Open Certificate' contenteditable="true">{{ __('Open Certificate') }}</editor_block>
                @else
                  {{ __('Open Certificate') }}
                  @endif</a>
            </div>
          </div>
        </div>
      </section>
      <!--=======CEO-Section Ends Here=======-->


      <!--=======Mission-Section Starts Here=======-->
      <section class="mission-section padding-top padding-bottom">
        <div class="mission-shape">
          <img src="{{ asset('theme/images/mission/mission-shape.png') }}" alt="about">
        </div>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
              <div class="section-header">
                <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Our Mission to help our user' contenteditable="true">{{ __('Our Mission to help our user') }}</editor_block>
                  @else
                    {{ __('Our Mission to help our user') }}
                    @endif</span>
                <h2 class="title">
                  @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='To maximize Money' contenteditable="true">{{ __('To maximize Money') }}</editor_block>
                  @else
                    {{ __('To maximize Money') }}
                  @endif
                </h2>
                <p class="mw-100">
                  @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='We are worldwide investment company who are committed to the principle of revenue maximization and reduction of the financial risks at investing.' contenteditable="true">{{ __('We are worldwide investment company who are committed to the principle of revenue maximization and reduction of the financial risks at investing.') }}</editor_block>
                  @else
                    {{ __('We are worldwide investment company who are committed to the principle of revenue maximization and reduction of the financial risks at investing.') }}
                    @endif
                </p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-5 rtl">
              <div class="mission--thumb">
                <img class="wow slideInLeft" src="{{ asset('theme/images/mission/mission.png') }}" alt="about">
              </div>
            </div>
            <div class="col-lg-7">
              <div class="mission-wrapper owl-theme owl-carousel">
                <div class="mission-item">
                  <div class="mission-thumb">
                    <img src="{{ asset('theme/images/mission/1.png') }}" alt="mission">
                  </div>
                  <div class="mission-content">
                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Low invest' contenteditable="true">{{ __('Low invest') }}</editor_block>
                      @else
                        {{ __('Low invest') }}
                        @endif</h5>
                    <p>
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Praesent sagittis nibh vehicula diam tesque' contenteditable="true">{{ __('Praesent sagittis nibh vehicula diam tesque') }}</editor_block>
                      @else
                        {{ __('Praesent sagittis nibh vehicula diam tesque') }}
                        @endif
                    </p>
                    <a href="#0" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Learn More' contenteditable="true">{{ __('Learn More') }}</editor_block>
                      @else
                        {{ __('Learn More') }}
                        @endif
                      <i class="flaticon-right-arrow"></i></a>
                  </div>
                </div>
                <div class="mission-item">
                  <div class="mission-thumb">
                    <img src="{{ asset('theme/images/mission/2.png') }}" alt="mission">
                  </div>
                  <div class="mission-content">
                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='One tap invest' contenteditable="true">{{ __('One tap invest') }}</editor_block>
                      @else
                        {{ __('One tap invest') }}
                        @endif</h5>
                    <p>
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Praesent sagittis nibh vehicula diam tesque' contenteditable="true">{{ __('Praesent sagittis nibh vehicula diam tesque') }}</editor_block>
                      @else
                        {{ __('Praesent sagittis nibh vehicula diam tesque') }}
                        @endif
                    </p>
                    <a href="#0" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Learn More' contenteditable="true">{{ __('Learn More') }}</editor_block>
                      @else
                        {{ __('Learn More') }}
                      @endif <i class="flaticon-right-arrow"></i></a>
                  </div>
                </div>
                <div class="mission-item">
                  <div class="mission-thumb">
                    <img src="{{ asset('theme/images/mission/3.png') }}" alt="mission">
                  </div>
                  <div class="mission-content">
                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Max. returns' contenteditable="true">{{ __('Max. returns') }}</editor_block>
                      @else
                        {{ __('Max. returns') }}
                        @endif</h5>
                    <p>
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Praesent sagittis nibh vehicula diam tesque' contenteditable="true">{{ __('Praesent sagittis nibh vehicula diam tesque') }}</editor_block>
                      @else
                        {{ __('Praesent sagittis nibh vehicula diam tesque') }}
                        @endif
                    </p>
                    <a href="#0" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Learn More' contenteditable="true">{{ __('Learn More') }}</editor_block>
                      @else
                        {{ __('Learn More') }}
                      @endif <i class="flaticon-right-arrow"></i></a>
                  </div>
                </div>
                <div class="mission-item">
                  <div class="mission-thumb">
                    <img src="{{ asset('theme/images/mission/4.png') }}" alt="mission">
                  </div>
                  <div class="mission-content">
                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Transparency' contenteditable="true">{{ __('Transparency') }}</editor_block>
                      @else
                        {{ __('Transparency') }}
                        @endif</h5>
                    <p>
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Praesent sagittis nibh vehicula diam tesque' contenteditable="true">{{ __('Praesent sagittis nibh vehicula diam tesque') }}</editor_block>
                      @else
                        {{ __('Praesent sagittis nibh vehicula diam tesque') }}
                        @endif
                    </p>
                    <a href="#0" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Learn More' contenteditable="true">{{ __('Learn More') }}</editor_block>
                      @else
                        {{ __('Learn More') }}
                      @endif <i class="flaticon-right-arrow"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--=======Mission-Section Ends Here=======-->


      <!--=======Investor-Section Starts Here=======-->
      <section class="investor-section padding-bottom padding-top pt-max-lg-0">
        <div class="ball-group-1 ball-group-4" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60" data-paroller-type="foreground" data-paroller-direction="horizontal">
          <img src="{{ asset('theme/images/balls/ball-group4.png') }}" alt="balls">
        </div>
        <div class="ball-group-2 ball-group-3" data-paroller-factor="0.30" data-paroller-factor-lg="-0.30" data-paroller-type="foreground" data-paroller-direction="horizontal">
          <img src="{{ asset('theme/images/balls/ball-group3.png') }}" alt="balls">
        </div>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-xl-6">
              <div class="section-header">
                <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='TRANDING PEOPLE' contenteditable="true">{{ __('TRANDING PEOPLE') }}</editor_block>
                  @else
                    {{ __('TRANDING PEOPLE') }}
                    @endif</span>
                <h2 class="title">
                  @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Our Top Investors' contenteditable="true">{{ __('Our Top Investors') }}</editor_block>
                  @else
                    {{ __('Our Top Investors') }}
                    @endif
                </h2>
                <p>
                  @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='A look at the top ten investors of all time and the strategies they used to make their money.' contenteditable="true">{{ __('A look at the top ten investors of all time and the strategies they used to make their money.') }}</editor_block>
                  @else
                    {{ __('A look at the top ten investors of all time and the strategies they used to make their money.') }}
                    @endif
                </p>
              </div>
            </div>
          </div>
          <div class="owl-carousel owl-theme investor-slider">
            <div class="investor-item">
              <div class="investor-thumb">
                <img src="{{ asset('theme/images/investor/investor1.png') }}" alt="investor">
              </div>
              <div class="investor-content">
                <h5 class="title"><a href="#0">Sean Obrien</a></h5>
                <h3 class="amount">$50,000.00</h3>
              </div>
            </div>
            <div class="investor-item">
              <div class="investor-thumb">
                <img src="{{ asset('theme/images/investor/investor2.png') }}" alt="investor">
              </div>
              <div class="investor-content">
                <h5 class="title"><a href="#0">Sylvia Fox</a></h5>
                <h3 class="amount">$50,000.00</h3>
              </div>
            </div>
            <div class="investor-item">
              <div class="investor-thumb">
                <img src="{{ asset('theme/images/investor/investor3.png') }}" alt="investor">
              </div>
              <div class="investor-content">
                <h5 class="title"><a href="#0">Dexter Nichols</a></h5>
                <h3 class="amount">$50,000.00</h3>
              </div>
            </div>
            <div class="investor-item">
              <div class="investor-thumb">
                <img src="{{ asset('theme/images/investor/investor4.png') }}" alt="investor">
              </div>
              <div class="investor-content">
                <h5 class="title"><a href="#0">Tami Oliver</a></h5>
                <h3 class="amount">$50,000.00</h3>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--=======Investor-Section Ends Here=======-->


      <!--=======Check-Section Starts Here=======-->
      <section class="call-section call-overlay bg_img" data-background="{{ asset('theme/images/call/call-bg.jpg') }}">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-7 col-xl-6">
              <div class="call-item text-center text-sm-left">
                <div class="call-icon">
                  <img src="{{ asset('theme/images/call/icon01.png') }}" alt="call">
                </div>
                <div class="call-content">
                  <h5 class="title">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Ready To Start Your Earnings Through Crypto Currency' contenteditable="true">{{ __('Ready To Start Your Earnings Through Crypto Currency') }}</editor_block>
                    @else
                      {{ __('Ready To Start Your Earnings Through Crypto Currency') }}
                      @endif</h5>
                </div>
              </div>
            </div>
            <div class="col-md-5 col-xl-6 text-center text-sm-left text-md-right">
              <a href="#0" class="custom-button" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='learn more' contenteditable="true">{{ __('learn more') }}</editor_block>
                @else
                  {{ __('learn more') }}
                  @endif <i class="flaticon-right"></i></a>
            </div>
          </div>
        </div>
      </section>
      <!--=======Check-Section Ends Here=======-->


      <!--=======Check-Section Starts Here=======-->
      <section class="client-section padding-bottom padding-top">
        <div class="background-map">
          <img src="{{ asset('theme/images/client/client-bg.png') }}" alt="client">
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 col-md-10">
              <div class="section-header left-style">
                <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='TESTIMONIALS' contenteditable="true">{{ __('TESTIMONIALS') }}</editor_block>
                  @else
                    {{ __('TESTIMONIALS') }}
                  @endif</span>
                <h2 class="title"><span>@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='40,000' contenteditable="true">{{ __('40,000') }}</editor_block>
                    @else
                      {{ __('40,000') }}
                    @endif</span> @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='HAPPY CLIENTS AROUND THE WORLD' contenteditable="true">{{ __('HAPPY CLIENTS AROUND THE WORLD') }}</editor_block>
                  @else
                    {{ __('HAPPY CLIENTS AROUND THE WORLD') }}
                  @endif</h2>
                <p class="mw-500">
                  @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='We have many happy investors invest with us .Some impresions from our Customers!' contenteditable="true">{{ __('We have many happy investors invest with us .Some impresions from our Customers!') }}</editor_block>
                  @else
                    {{ __('We have many happy investors invest with us .Some impresions from our Customers!') }}
                  @endif
                </p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-9">
              <div class="m--30">
                <div class="client-slider owl-carousel owl-theme">
                  <div class="client-item">
                    <div class="client-content">
                      <p>
                        @if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Perfect work to start on, support is awesome' contenteditable="true">{{ __('Perfect work to start on, support is awesome') }}</editor_block>
                        @else
                          {{ __('Perfect work to start on, support is awesome') }}
                          @endif
                      </p>
                      <div class="rating">
                        <span>
                            <i class="fas fa-star"></i>
                        </span>
                        <span>
                            <i class="fas fa-star"></i>
                        </span>
                        <span>
                            <i class="fas fa-star"></i>
                        </span>
                        <span>
                            <i class="fas fa-star"></i>
                        </span>
                        <span>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                      </div>
                    </div>
                    <div class="client-thumb">
                      <a href="#0">
                        <img src="{{ asset('theme/images/client/client01.png') }}" alt="client">
                      </a>
                    </div>
                  </div>
                  <div class="client-item">
                    <div class="client-content">
                      <p>
                        @if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Very easy to use, perfect for invest' contenteditable="true">{{ __('Very easy to use, perfect for invest') }}</editor_block>
                        @else
                          {{ __('Very easy to use, perfect for invest') }}
                          @endif
                      </p>
                      <div class="rating">
                        <span>
                            <i class="fas fa-star"></i>
                        </span>
                        <span>
                            <i class="fas fa-star"></i>
                        </span>
                        <span>
                            <i class="fas fa-star"></i>
                        </span>
                        <span>
                            <i class="fas fa-star"></i>
                        </span>
                        <span>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                      </div>
                    </div>
                    <div class="client-thumb">
                      <a href="#0">
                        <img src="{{ asset('theme/images/client/client02.png') }}" alt="client">
                      </a>
                    </div>
                  </div>
                  <div class="client-item">
                    <div class="client-content">
                      <p>
                        @if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Awesome hyipland most profitable site!' contenteditable="true">{{ __('Awesome hyipland most profitable site!') }}</editor_block>
                        @else
                          {{ __('Awesome hyipland most profitable site!') }}
                        @endif
                      </p>
                      <div class="rating">
                        <span>
                            <i class="fas fa-star"></i>
                        </span>
                        <span>
                            <i class="fas fa-star"></i>
                        </span>
                        <span>
                            <i class="fas fa-star"></i>
                        </span>
                        <span>
                            <i class="fas fa-star"></i>
                        </span>
                        <span>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                      </div>
                    </div>
                    <div class="client-thumb">
                      <a href="#0">
                        <img src="{{ asset('theme/images/client/client03.png') }}" alt="client">
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--=======Check-Section Ends Here=======-->


      <!-- ==========Footer-Section Starts Here========== -->
    @include('layouts.app-footer')
    <!-- ==========Footer-Section Ends Here========== -->
    </div>
@endsection
