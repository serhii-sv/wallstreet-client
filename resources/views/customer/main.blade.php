@extends('layouts.app')
@section('title', __('Home'))
@section('styles')
  <style>
      .offer-item {
          display: flex;
          justify-content: center;
          background: none;
      }
  </style>
@endsection
@section('content')
  <div class="main--body">
    
    <!--========== Preloader ==========-->
  {{--@include('layouts.app-preloader')--}}
  <!--========== Preloader ==========-->
    
    <!--=======Header-Section Starts Here=======-->
  @include('layouts.app-header')
  <!--=======Header-Section Ends Here=======-->
    
    
    <!--=======Banner-Section Starts Here=======-->
    <section class="banner-section" id="home">
      <div class="banner-bg d-lg-none">
        <img src="{{ asset('theme/images/banner/banner-bg2.jpg') }}" alt="banner">
      </div>
      <div class="banner-bg d-none d-lg-block bg_img" data-background="{{ asset('theme/images/banner/banner.jpg') }}">
        <div class="chart-1 wow fadeInLeft" data-wow-delay=".5s" data-wow-duration=".7s">
          <img src="{{ asset('theme/images/banner/chart1.png') }}" alt="banner">
        </div>
        <div class="chart-2 wow fadeInDown" data-wow-delay="1s" data-wow-duration=".7s">
          <img src="{{ asset('theme/images/banner/chart2.png') }}" alt="banner">
        </div>
        <div class="chart-3 wow fadeInRight" data-wow-delay="1.5s" data-wow-duration=".7s">
          <img src="{{ asset('theme/images/banner/chart3.png') }}" alt="banner">
        </div>
        <div class="chart-4 wow fadeInUp" data-wow-delay="2s" data-wow-duration=".7s">
          <img src="{{ asset('theme/images/banner/clock.png') }}" alt="banner">
        </div>
      </div>
      <div class="animation-area d-none d-lg-block">
        <div class="plot">
          <img src="{{ asset('theme/images/banner/plot.png') }}" alt="banner">
        </div>
        <div class="element-1 wow fadeIn" data-wow-delay="1s">
          <img src="{{ asset('theme/images/banner/light.png') }}" alt="banner">
        </div>
        <div class="element-2 wow fadeIn" data-wow-delay="1s">
          <img src="{{ asset('theme/images/banner/coin1.png') }}" alt="banner">
        </div>
        <div class="element-3 wow fadeIn" data-wow-delay="1s">
          <img src="{{ asset('theme/images/banner/coin2.png') }}" alt="banner">
        </div>
        <div class="element-4 wow fadeIn" data-wow-delay="1s">
          <img src="{{ asset('theme/images/banner/coin3.png') }}" alt="banner">
        </div>
        <div class="element-5 wow fadeIn" data-wow-delay="1s">
          <img src="{{ asset('theme/images/banner/coin4.png') }}" alt="banner">
        </div>
        <div class="element-6 wow fadeIn" data-wow-delay="1s">
          <img src="{{ asset('theme/images/banner/coin5.png') }}" alt="banner">
        </div>
        <div class="element-7 wow fadeIn" data-wow-delay="1s">
          <img src="{{ asset('theme/images/banner/coin6.png') }}" alt="banner">
        </div>
        <div class="element-8 wow fadeIn" data-wow-delay="1s">
          <img src="{{ asset('theme/images/banner/sheild.png') }}" alt="banner">
        </div>
        <div class="element-9 wow fadeIn" data-wow-delay="1s">
          <img src="{{ asset('theme/images/banner/coin7.png') }}" alt="banner">
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-xl-5 col-lg-6 offset-lg-6 offset-xl-7">
            <div class="banner-content">
              <h1 class="title">
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='main.title.first' contenteditable="true">
                    {{ __('main.title.first') }}
                  </editor_block>
                @else
                  {{ __('main.title.first') }}
                @endif
                <span>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='main.title.second' contenteditable="true">
                    {{ __('main.title.second') }}
                  </editor_block>
                  @else
                    {{ __('main.title.second') }}
                  @endif
                </span>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='main.title.third' contenteditable="true">
                    {{ __('main.title.third') }}
                  </editor_block>
                @else
                  {{ __('main.title.third') }}
                @endif</h1>
              <p>
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='main.subtitle.first' contenteditable="true">
                    {{ __('main.subtitle.first') }}
                  </editor_block>
                @else
                  {{ __('main.subtitle.first') }}
                @endif
              </p>
              <div class="button-group">
                <a href="" class="custom-button" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='main.first.btn' contenteditable="true">
                      {{ __('main.first.btn') }}
                    </editor_block>
                  @else
                    {{ __('main.first.btn') }}
                  @endif</a>
                <a href="https://www.youtube.com/watch?v=oocQ6r7YjSo" class="popup video-button">
                  <i class="flaticon-play"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=======Banner-Section Ends Here=======-->
    
    
    <!--=======Counter-Section Starts Here=======-->
    <div class="counter-section">
      <div class="container">
        <div class="row align-items-center mb-30-none justify-content-center">
          <div class="col-sm-6 col-md-4">
            <div class="counter-item">
              <div class="counter-thumb">
                <img src="{{ asset('theme/images/counter/counter01.png') }}" alt="counter">
              </div>
              <div class="counter-content">
                <div class="counter-header">
                  <h3 class="title odometer" data-odometer-final="36.9">0</h3>
                  <h3 class="title">M</h3>
                </div>
                <p>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Registered users' contenteditable="true">
                      {{ __('Registered users') }}
                    </editor_block>
                  @else
                    {{ __('Registered users') }}
                  @endif</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4">
            <div class="counter-item">
              <div class="counter-thumb">
                <img src="{{ asset('theme/images/counter/counter02.png') }}" alt="counter">
              </div>
              <div class="counter-content">
                <div class="counter-header">
                  <h3 class="title odometer" data-odometer-final="174">0</h3>
                </div>
                <p>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Countries Supported' contenteditable="true">
                      {{ __('Countries Supported') }}
                    </editor_block>
                  @else
                    {{ __('Countries Supported') }}
                  @endif</p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-4">
            <div class="counter-item">
              <div class="counter-thumb">
                <img src="{{ asset('theme/images/counter/counter03.png') }}" alt="counter">
              </div>
              <div class="counter-content">
                <div class="counter-header">
                  <h3 class="title">$</h3>
                  <h3 class="odometer title" data-odometer-final="10.8">0</h3>
                  <h3 class="title">M</h3>
                </div>
                <p>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Average Investment' contenteditable="true">
                      {{ __('Average Investment') }}
                    </editor_block>
                  @else
                    {{ __('Average Investment') }}
                  @endif</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--=======Counter-Section Ends Here=======-->
    
    
    <!--=======About-Section Starts Here=======-->
    <section class="about-section padding-top padding-bottom" id="about">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 d-none d-lg-block rtl">
            <img src="{{ asset('theme/images/about/about.png') }}" alt="about">
          </div>
          <div class="col-lg-6">
            <div class="section-header left-style">
              <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='main.second.span' contenteditable="true">
                      {{ __('main.second.span') }}
                    </editor_block>
                @else
                  {{ __('main.second.span') }}
                @endif</span>
              <h2 class="title">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='main.second.title' contenteditable="true">
                    {{ __('main.second.title') }}
                  </editor_block>
                @else
                  {{ __('main.second.title') }}
                @endif</h2>
              <p>
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='main.second.text' contenteditable="true">
                    {{ __('main.second.text') }}
                  </editor_block>
                @else
                  {{ __('main.second.text') }}
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
                      <editor_block data-name='main.second.list.title.1' contenteditable="true">
                        {{ __('main.second.list.title.1') }}
                      </editor_block>
                    @else
                      {{ __('main.second.list.title.1') }}
                    @endif</h5>
                  <p>@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='main.second.list.text.1' contenteditable="true">
                        {{ __('main.second.list.text.1') }}
                      </editor_block>
                    @else
                      {{ __('main.second.list.text.1') }}
                    @endif</p>
                </div>
              </div>
              <div class="about-item">
                <div class="about-thumb">
                  <img src="{{ asset('theme/images/about/about02.png') }}" alt="about">
                </div>
                <div class="about-content">
                  <h5 class="title">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='main.second.list.title.2' contenteditable="true">
                        {{ __('main.second.list.title.2') }}
                      </editor_block>
                    @else
                      {{ __('main.second.list.title.2') }}
                    @endif</h5>
                  <p>
                    @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='main.second.list.text.2' contenteditable="true">
                        {{ __('main.second.list.text.2') }}
                      </editor_block>
                    @else
                      {{ __('main.second.list.text.2') }}
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
                      <editor_block data-name='main.second.list.title.3' contenteditable="true">
                        {{ __('main.second.list.title.3') }}
                      </editor_block>
                    @else
                      {{ __('main.second.list.title.3') }}
                    @endif</h5>
                  <p>@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='main.second.list.text.3' contenteditable="true">
                        {{ __('main.second.list.text.3') }}
                      </editor_block>
                    @else
                      {{ __('main.second.list.text.3') }}
                    @endif</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=======About-Section Ends Here=======-->
    
    
    <!--=======Feature-Section Starts Here=======-->
    <section class="feature-section padding-top padding-bottom bg_img" data-background="{{ asset('theme/images/feature/feature-bg.png') }}" id="feature">
      <div class="ball-1" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60"
          data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{ asset('theme/images/balls/ball1.png') }}" alt="balls">
      </div>
      <div class="ball-2" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60"
          data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{ asset('theme/images/balls/ball2.png') }}" alt="balls">
      </div>
      <div class="ball-3" data-paroller-factor="0.30" data-paroller-factor-lg="-0.30"
          data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{ asset('theme/images/balls/ball3.png') }}" alt="balls">
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-10">
            <div class="section-header">
              <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='main.third.span' contenteditable="true">
                        {{ __('main.third.span') }}
                      </editor_block>
                @else
                  {{ __('main.third.span') }}
                @endif</span>
              <h2 class="title">
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='main.third.title' contenteditable="true">
                    {{ __('main.third.title') }}
                  </editor_block>
                @else
                  {{ __('main.third.title') }}
                @endif
              </h2>
              <p class="mw-100">
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='main.third.text' contenteditable="true">
                    {{ __('main.third.text') }}
                  </editor_block>
                @else
                  {{ __('main.third.text') }}
                @endif
              </p>
            </div>
          </div>
        </div>
        <div class="row justify-content-center feature-wrapper">
          <div class="col-md-6 col-sm-10 col-lg-4">
            <div class="feature-item">
              <div class="feature-thumb">
                <img src="{{ asset('theme/images/feature/feature01.png') }}" alt="feature">
              </div>
              <div class="feature-content">
                <h5 class="title">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='main.third.list.title.1' contenteditable="true">
                      {{ __('main.third.list.title.1') }}
                    </editor_block>
                  @else
                    {{ __('main.third.list.title.1') }}
                  @endif</h5>
                <p>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='main.third.list.text.1' contenteditable="true">
                      {{ __('main.third.list.text.1') }}
                    </editor_block>
                  @else
                    {{ __('main.third.list.text.1') }}
                  @endif</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-10 col-lg-4">
            <div class="feature-item">
              <div class="feature-thumb">
                <img src="{{ asset('theme/images/feature/feature02.png') }}" alt="feature">
              </div>
              <div class="feature-content">
                <h5 class="title">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='main.third.list.title.2' contenteditable="true">
                      {{ __('main.third.list.title.2') }}
                    </editor_block>
                  @else
                    {{ __('main.third.list.title.2') }}
                  @endif</h5>
                <p>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='main.third.list.text.2' contenteditable="true">
                      {{ __('main.third.list.text.2') }}
                    </editor_block>
                  @else
                    {{ __('main.third.list.text.2') }}
                  @endif</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-sm-10 col-lg-4">
            <div class="feature-item">
              <div class="feature-thumb">
                <img src="{{ asset('theme/images/feature/feature03.png') }}" alt="feature">
              </div>
              <div class="feature-content">
                <h5 class="title">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='main.third.list.title.3' contenteditable="true">
                      {{ __('main.third.list.title.3') }}
                    </editor_block>
                  @else
                    {{ __('main.third.list.title.3') }}
                  @endif</h5>
                <p>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='main.third.list.text.3' contenteditable="true">
                      {{ __('main.third.list.text.3') }}
                    </editor_block>
                  @else
                    {{ __('main.third.list.text.3') }}
                  @endif</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=======Feature-Section Ends Here=======-->
    
    
    <!--=======How-Section Starts Here=======-->
    <section class="get-section padding-top padding-bottom">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-10 col-lg-8">
            <div class="section-header">
              <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='main.fourth.span' contenteditable="true">
                        {{ __('main.fourth.span') }}
                      </editor_block>
                @else
                  {{ __('main.fourth.span') }}
                @endif</span>
              <h2 class="title">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='main.fourth.title' contenteditable="true">
                    {{ __('main.fourth.title') }}
                  </editor_block>
                @else
                  {{ __('main.fourth.title') }}
                @endif</h2>
              <p>
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='main.fourth.text' contenteditable="true">
                    {{ __('main.fourth.text') }}
                  </editor_block>
                @else
                  {{ __('main.fourth.text') }}
                @endif
              </p>
            </div>
          </div>
        </div>
        <div class="hover-tab">
          <div class="row justify-content-center">
            <div class="col-lg-6 d-lg-block d-none">
              <div class="hover-tab-area">
                <div class="tab-area">
                  <div class="tab-item active first">
                    <img src="{{ asset('theme/images/how/how01.png') }}" alt="how">
                  </div>
                  <div class="tab-item second">
                    <img src="{{ asset('theme/images/how/how02.png') }}" alt="how">
                  </div>
                  <div class="tab-item third">
                    <img src="{{ asset('theme/images/how/how03.png') }}" alt="how">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-9">
              <div class="hover-tab-menu">
                <ul class="tab-menu">
                  <li class="active">
                    <div class="menu-thumb">
                                          <span>
                                            01
                                          </span>
                    </div>
                    <div class="menu-content">
                      <h5 class="title">@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='main.fourth.list.title.1' contenteditable="true">
                            {{ __('main.fourth.list.title.1') }}
                          </editor_block>
                        @else
                          {{ __('main.fourth.list.title.1') }}
                        @endif</h5>
                      <p>
                        @if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='to fill the blank, our 256 SSL will Protect your privacy.' contenteditable="true">
                            {!!   __('to fill the blank, our 256 SSL will Protect your privacy.') !!}
                          </editor_block>
                        @else
                          {!!  __('to fill the blank, our 256 SSL will Protect your privacy.')  !!}
                        @endif
                      </p>
                    </div>
                  </li>
                  <li>
                    <div class="menu-thumb">
                                          <span>
                                            02
                                          </span>
                    </div>
                    <div class="menu-content">
                      <h5 class="title">@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='MAKE AN INVEST' contenteditable="true">
                            {{ __('MAKE AN INVEST') }}
                          </editor_block>
                        @else
                          {{ __('MAKE AN INVEST') }}
                        @endif</h5>
                      <p>
                        @if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='your account to click invest to start to earn the profit.' contenteditable="true">
                            {{ __('your account to click invest to start to earn the profit.') }}
                          </editor_block>
                        @else
                          {{ __('your account to click invest to start to earn the profit.') }}
                        @endif
                      </p>
                    </div>
                  </li>
                  <li>
                    <div class="menu-thumb">
                                          <span>
                                              03
                                          </span>
                    </div>
                    <div class="menu-content">
                      <h5 class="title">@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='get profit' contenteditable="true">
                            {{ __('get profit') }}
                          </editor_block>
                        @else
                          {{ __('get profit') }}
                        @endif
                      </h5>
                      <p>
                        @if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='You will get your profit on your profile, also you will get Instant Payment' contenteditable="true">
                            {{ __('You will get your profit on your profile, also you will get Instant Payment') }}
                          </editor_block>
                        @else
                          {{ __('You will get your profit on your profile, also you will get Instant Payment') }}
                        @endif
                      </p>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=======How-Section Ends Here=======-->
    
    
    <!--=======Check-Section Starts Here=======-->
    <section class="call-section call-overlay bg_img" data-background="{{ asset('theme/images/call/call-bg.jpg') }}">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7">
            <div class="call--item">
              <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Why We are always ready' contenteditable="true">
                            {{ __('Why We are always ready') }}
                          </editor_block>
                @else
                  {{ __('Why We are always ready') }}
                @endif</span>
              <h3 class="title">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Request a call back' contenteditable="true">
                    {{ __('Request a call back') }}
                  </editor_block>
                @else
                  {{ __('Request a call back') }}
                @endif</h3>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="call-button">
              <a href="Tel:0939303" class="call">
                <img src="{{ asset('theme/images/call/icon02.png') }}" alt="call">
              </a>
              <a href="#0" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif class="custom-button">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Contact Support' contenteditable="true">
                    {{ __('Contact Support') }}
                  </editor_block>
                @else
                  {{ __('Contact Support') }}
                @endif</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=======Check-Section Ends Here=======-->
    
    
    <!--=======Offer-Section Stars Here=======-->
    <section class="offer-section padding-top padding-bottom pb-max-md-0" id="plan">
      <div class="ball-group-1" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60"
          data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{ asset('theme/images/balls/ball-group1.png') }}" alt="balls">
      </div>
      <div class="ball-group-2" data-paroller-factor="0.30" data-paroller-factor-lg="-0.30"
          data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{ asset('theme/images/balls/ball-group2.png') }}" alt="balls">
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-xl-7">
            <div class="section-header">
              <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='INVESTMENT OFFER' contenteditable="true">
                    {{ __('INVESTMENT OFFER') }}
                  </editor_block>
                @else
                  {{ __('INVESTMENT OFFER') }}
                @endif</span>
              <h2 class="title">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='OUR INVESTMENT PLANS' contenteditable="true">
                    {{ __('OUR INVESTMENT PLANS') }}
                  </editor_block>
                @else
                  {{ __('OUR INVESTMENT PLANS') }}
                @endif</h2>
              <p>
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Hyipland provides a straightforward and transparent mechanism to attract investments and make more profits.' contenteditable="true">
                    {{ __('Hyipland provides a straightforward and transparent mechanism to attract investments and make more profits.') }}
                  </editor_block>
                @else
                  {{ __('Hyipland provides a straightforward and transparent mechanism to attract investments and make more profits.') }}
                @endif
              </p>
            </div>
          </div>
        </div>
      
      </div>
    </section>
    <!--=======Offer-Section Ends Here=======-->
    <div class="offer-wrapper owl-carousel owl-video-wrapper">
      
      <div class="offer-item">
        <iframe width="500" height="315" src="https://www.youtube.com/embed/SJms7JEKt8A" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="offer-item">
        <iframe width="500" height="315" src="https://www.youtube.com/embed/orPQs796ix8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
      <div class="offer-item">
        <iframe width="500" height="315" src="https://www.youtube.com/embed/eFhyyWUhezE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    
    </div>
    
    <!--=======Proit-Section Starts Here=======-->
    <section class="profit-section padding-top" id="profit">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-xl-7">
            <div class="section-header">
              <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Calculate the amazing profits' contenteditable="true">{{ __('Calculate the amazing profits') }}</editor_block>
                @else
                  {{ __('Calculate the amazing profits') }}
                @endif</span>
              <h2 class="title">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='You Can Earn' contenteditable="true">{{ __('You Can Earn') }}</editor_block>
                @else
                  {{ __('You Can Earn') }}
                @endif</h2>
              <p>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Calculate your profit before making an investment.' contenteditable="true">{{ __('Calculate your profit before making an investment.') }}</editor_block>
                @else
                  {{ __('Calculate your profit before making an investment.') }}
                @endif</p>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid p-0">
        <div class="profit-bg bg_img" data-background="{{ asset('theme/images/profit/profit-bg.png') }}">
          <div class="animation-group">
            <div class="platform">
              <img src="{{ asset('theme/images/profit/platform.png') }}" alt="profit">
            </div>
            <div class="light">
              <img src="{{ asset('theme/images/profit/light.png') }}" alt="profit">
            </div>
            <div class="coin-1 wow fadeOutDown" data-wow-delay="1s">
              <img src="{{ asset('theme/images/profit/coin6.png') }}" alt="profit">
            </div>
            <div class="coin-2 wow fadeOutDown" data-wow-delay="1s">
              <img src="{{ asset('theme/images/profit/coin2.png') }}" alt="profit">
            </div>
            <div class="coin-3 wow fadeOutDown" data-wow-delay="1s">
              <img src="{{ asset('theme/images/profit/coin3.png') }}" alt="profit">
            </div>
            <div class="coin-4 wow fadeOutDown" data-wow-delay="1s">
              <img src="{{ asset('theme/images/profit/coin4.png') }}" alt="profit">
            </div>
            <div class="coin-5 wow fadeOutDown" data-wow-delay="1s">
              <img src="{{ asset('theme/images/profit/coin5.png') }}" alt="profit">
            </div>
            <div class="coin-6 wow fadeOutDown" data-wow-delay="1s">
              <img src="{{ asset('theme/images/profit/coin1.png') }}" alt="profit">
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="calculate-wrapper tab">
          <div class="calculate--area">
            <div class="calculate-area">
              <div class="calculate-item">
                <h5 class="title" data-serial="01">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Select the plan' contenteditable="true">{{ __('Select the plan') }}</editor_block>
                  @else
                    {{ __('Select the plan') }}
                  @endif</h5>
                <select class="select-bar">
                  <option value="01">120% daily for 50 days</option>
                  <option value="02">110% daily for 30 days</option>
                  <option value="03">105% daily for 20 days</option>
                  <option value="04">102% daily for 10 days</option>
                  <option value="05">101% daily for 5 days</option>
                </select>
              </div>
              <div class="calculate-item">
                <h5 class="title" data-serial="02">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Select the currency' contenteditable="true">{{ __('Select the currency') }}</editor_block>
                  @else
                    {{ __('Select the currency') }}
                  @endif</h5>
                <ul class="tab-menu">
                  <li>@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='usd' contenteditable="true">{{ __('usd') }}</editor_block>
                    @else
                      {{ __('usd') }}
                    @endif</li>
                  <li class="active">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='btc' contenteditable="true">{{ __('btc') }}</editor_block>
                    @else
                      {{ __('btc') }}
                    @endif</li>
                  <li>@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='eth' contenteditable="true">{{ __('eth') }}</editor_block>
                    @else
                      {{ __('eth') }}
                    @endif</li>
                  <li>@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='rub' contenteditable="true">{{ __('rub') }}</editor_block>
                    @else
                      {{ __('rub') }}
                    @endif</li>
                </ul>
              </div>
              <div class="calculate-item">
                <h5 class="title" data-serial="03">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Enter the amount' contenteditable="true">{{ __('Enter the amount') }}</editor_block>
                  @else
                    {{ __('Enter the amount') }}
                  @endif</h5>
                <input type="number" value="100">
              </div>
            </div>
            <div class="tab-area">
              <div class="tab-item">
                <div class="profit-calc">
                  <div class="item">
                    <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Daily Profit' contenteditable="true">{{ __('Daily Profit') }}</editor_block>
                      @else
                        {{ __('Daily Profit') }}
                      @endif</span>
                    <h2 class="title cl-theme-1">0.026400 USD</h2>
                  </div>
                  <div class="item">
                    <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Total Profit' contenteditable="true">{{ __('Total Profit') }}</editor_block>
                      @else
                        {{ __('Total Profit') }}
                      @endif</span>
                    <h2 class="title cl-theme">1.320000 USD</h2>
                  </div>
                </div>
                <div class="invest-range-area">
                  <div class="main-amount">
                    <input type="text" class="calculator-invest" id="usd-amount" readonly>
                  </div>
                  <div class="invest-amount" data-min="1.00 USD" data-max="1000 USD">
                    <div id="usd-range" class="invest-range-slider"></div>
                  </div>
                  <button type="submit" class="custom-button" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='join now' contenteditable="true">{{ __('join now') }}</editor_block>
                    @else
                      {{ __('join now') }}
                    @endif</button>
                </div>
              </div>
              <div class="tab-item active">
                <div class="profit-calc">
                  <div class="item">
                  <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Daily Profit' contenteditable="true">{{ __('Daily Profit') }}</editor_block>
                    @else
                      {{ __('Daily Profit') }}
                    @endif</span>
                    <h2 class="title cl-theme-1">0.026400 BTC</h2>
                  </div>
                  <div class="item">
                    <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Total Profit' contenteditable="true">{{ __('Total Profit') }}</editor_block>
                      @else
                        {{ __('Total Profit') }}
                      @endif</span>
                    <h2 class="title cl-theme">1.320000 BTC</h2>
                  </div>
                </div>
                <div class="invest-range-area">
                  <div class="main-amount">
                    <input type="text" class="calculator-invest" id="btc-amount" readonly>
                  </div>
                  <div class="invest-amount" data-min="1.00 BTC" data-max="1000 BTC">
                    <div id="btc-range" class="invest-range-slider"></div>
                  </div>
                  <button type="submit" class="custom-button" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='join now' contenteditable="true">{{ __('join now') }}</editor_block>
                    @else
                      {{ __('join now') }}
                    @endif</button>
                </div>
              </div>
              <div class="tab-item">
                <div class="profit-calc">
                  <div class="item">
                    <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Daily Profit' contenteditable="true">{{ __('Daily Profit') }}</editor_block>
                      @else
                        {{ __('Daily Profit') }}
                      @endif</span>
                    <h2 class="title cl-theme-1">0.026400 ETH</h2>
                  </div>
                  <div class="item">
                     <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                         <editor_block data-name='Total Profit' contenteditable="true">{{ __('Total Profit') }}</editor_block>
                       @else
                         {{ __('Total Profit') }}
                       @endif</span>
                    <h2 class="title cl-theme">1.320000 ETH</h2>
                  </div>
                </div>
                <div class="invest-range-area">
                  <div class="main-amount">
                    <input type="text" class="calculator-invest" id="eth-amount" readonly>
                  </div>
                  <div class="invest-amount" data-min="1.00 ETH" data-max="1000 ETH">
                    <div id="eth-range" class="invest-range-slider"></div>
                  </div>
                  <button type="submit" class="custom-button" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='join now' contenteditable="true">{{ __('join now') }}</editor_block>
                    @else
                      {{ __('join now') }}
                    @endif</button>
                </div>
              </div>
              <div class="tab-item">
                <div class="profit-calc">
                  <div class="item">
                    <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Daily Profit' contenteditable="true">{{ __('Daily Profit') }}</editor_block>
                      @else
                        {{ __('Daily Profit') }}
                      @endif</span>
                    <h2 class="title cl-theme-1">0.026400 RUB</h2>
                  </div>
                  <div class="item">
                    <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Total Profit' contenteditable="true">{{ __('Total Profit') }}</editor_block>
                      @else
                        {{ __('Total Profit') }}
                      @endif</span>
                    <h2 class="title cl-theme">1.320000 RUB</h2>
                  </div>
                </div>
                <div class="invest-range-area">
                  <div class="main-amount">
                    <input type="text" class="calculator-invest" id="rub-amount" readonly>
                  </div>
                  <div class="invest-amount" data-min="1.00 RUB" data-max="1000 RUB">
                    <div id="rub-range" class="invest-range-slider"></div>
                  </div>
                  <button type="submit" class="custom-button" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='join now' contenteditable="true">{{ __('join now') }}</editor_block>
                    @else
                      {{ __('join now') }}
                    @endif</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=======Proit-Section Ends Here=======-->
    
    
    <!--=======Latest-Transaction-Section Starts Here=======-->
    <section class="latest-transaction padding-top padding-bottom" id="transaction">
      <div class="transaction-bg bg_img" data-background="{{ asset('theme/images/transaction/transaction-bg.png') }}">
        <span class="d-none">Image</span>
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-xl-7">
            <div class="section-header">
              <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Latest Transactions' contenteditable="true">{{ __('Latest Transactions') }}</editor_block>
                @else
                  {{ __('Latest Transactions') }}
                @endif</span>
              <h2 class="title">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Monthly Income Feed' contenteditable="true">{{ __('Monthly Income Feed') }}</editor_block>
                @else
                  {{ __('Monthly Income Feed') }}
                @endif</h2>
              <p>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Our goal is to simplify investing so that anyone can be an investor.Withthis in mind,
                we hand-pick the investments we offer on our platform.' contenteditable="true">{{ __('Our goal is to simplify investing so that anyone can be an investor.Withthis in mind,
                we hand-pick the investments we offer on our platform.') }}</editor_block>
                @else
                  {{ __('Our goal is to simplify investing so that anyone can be an investor.Withthis in mind,
                we hand-pick the investments we offer on our platform.') }}
                @endif</p>
            </div>
          </div>
        </div>
        <div class="tab transaction-tab d-flex flex-wrap justify-content-center">
          <ul class="tab-menu">
            @forelse($rate_groups as $rate_group)
              <li class="@if($loop->first) active @endif">
                <div class="thumb">
                  <i class="flaticon-wallet"></i>
                </div>
                <div class="content">
                  <span class="d-block">
                      @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='{{ $rate_group->name }}' contenteditable="true">{{ __($rate_group->name) }}</editor_block>
                    @else
                      {{ __($rate_group->name) }}
                    @endif
                  </span>
                </div>
              </li>
            @empty
            @endforelse
           
          </ul>
          <div class="tab-area">
            @forelse($rate_groups as $rate_group)
              <div class="tab-item @if($loop->first) active @endif">
                <div class="row justify-content-center mb-30-none">
                  @forelse($rates as $rate)
                    @if($rate->rate_group_id == $rate_group->id)
                      <div class="col-lg-4 col-xl-3 col-sm-6">
                        <div class="transaction-item">
                          <div class="transaction-header">
                            <h5 class="title">{{ $rate->name }}</h5>
                            <span class="title">
                                                            @if(canEditLang() && checkRequestOnEdit())
                                @if($rate->overall)
                                  <editor_block data-name='return deposit: true' contenteditable="true">{{ __('return deposit: true') }}</editor_block>
                                @else
                                  <editor_block data-name='return deposit: false' contenteditable="true">{{ __('return deposit: false') }}</editor_block>
                                @endif
                              
                              @else
                                @if($rate->overall)
                                  <span class="date">{{ __('return deposit: true') }}</span>
                                @else
                                  <span class="date">{{ __('return deposit: false') }}</span>
                                @endif
                              @endif

                                                        </span>
                            @if(canEditLang() && checkRequestOnEdit())
                              <div>
                                <editor_block data-name='Daily rate' contenteditable="true">{{ __('Daily rate') }} {{ $rate->daily }}%</editor_block>
                              </div>
                            @else
                              <span class="date">{{ __('Daily rate') }} {{ $rate->daily }}%</span>
                            @endif
                          </div>
                          <div class="transaction-thumb">
                         {{--   <img src="{{ asset('theme/images/transaction/transaction01.png') }}" alt="transaction">--}}
                          </div>
                          <div class="transaction-footer">
                                                  <span class="amount">
                                                      @if(canEditLang() && checkRequestOnEdit())
                                                      <editor_block data-name='Can deposit' contenteditable="true">{{ __('Can deposit') }}</editor_block>
                                                    @else
                                                      {{ __('Can deposit') }}
                                                    @endif
                                                  </span>
                            <h5 class="sub-title">{{ round($rate->min, 0) }} - {{ round($rate->max, 0) }}$</h5>
                          </div>
                        </div>
                      </div>
                    @endif
                  @empty
                  @endforelse
                </div>
              </div>
            @empty
            @endforelse
            {{--   <div class="tab-item active">
                   <div class="row justify-content-center mb-30-none">

                       <div class="col-lg-4 col-xl-3 col-sm-6">
                           <div class="transaction-item">
                               <div class="transaction-header">
                                   <h5 class="title">KimHowell21</h5>
                                   <span class="date">December 24, 17:57</span>
                               </div>
                               <div class="transaction-thumb">
                                   <img src="{{ asset('theme/images/transaction/transaction01.png') }}" alt="transaction">
                               </div>
                               <div class="transaction-footer">
             <span class="amount">@if(canEditLang() && checkRequestOnEdit())
                     <editor_block data-name='Amount' contenteditable="true">{{ __('Amount') }}</editor_block>
                 @else
                     {{ __('Amount') }}
                 @endif</span>
                                   <h5 class="sub-title">0.00449721 BTC</h5>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-4 col-xl-3 col-sm-6">
                           <div class="transaction-item">
                               <div class="transaction-header">
                                   <h5 class="title">ildar25864</h5>
                                   <span class="date">December 24, 17:57</span>
                               </div>
                               <div class="transaction-thumb">
                                   <img src="{{ asset('theme/images/transaction/transaction02.png') }}" alt="transaction">
                               </div>
                               <div class="transaction-footer">
             <span class="amount">@if(canEditLang() && checkRequestOnEdit())
                     <editor_block data-name='Amount' contenteditable="true">{{ __('Amount') }}</editor_block>
                 @else
                     {{ __('Amount') }}
                 @endif</span>
                                   <h5 class="sub-title">0.00449721 ETH</h5>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-4 col-xl-3 col-sm-6">
                           <div class="transaction-item">
                               <div class="transaction-header">
                                   <h5 class="title">Buha74</h5>
                                   <span class="date">December 24, 17:57</span>
                               </div>
                               <div class="transaction-thumb">
                                   <img src="{{ asset('theme/images/transaction/transaction03.png') }}" alt="transaction">
                               </div>
                               <div class="transaction-footer">
             <span class="amount">@if(canEditLang() && checkRequestOnEdit())
                     <editor_block data-name='Amount' contenteditable="true">{{ __('Amount') }}</editor_block>
                 @else
                     {{ __('Amount') }}
                 @endif</span>
                                   <h5 class="sub-title">0.00449721 LTC</h5>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="tab-item">
                   <div class="row justify-content-center mb-30-none">
                       <div class="col-lg-4 col-xl-3 col-sm-6">
                           <div class="transaction-item">
                               <div class="transaction-header">
                                   <h5 class="title">Doug9544</h5>
                                   <span class="date">December 24, 17:57</span>
                               </div>
                               <div class="transaction-thumb">
                                   <img src="{{ asset('theme/images/transaction/transaction07.png') }}" alt="transaction">
                               </div>
                               <div class="transaction-footer">
             <span class="amount">@if(canEditLang() && checkRequestOnEdit())
                     <editor_block data-name='Amount' contenteditable="true">{{ __('Amount') }}</editor_block>
                 @else
                     {{ __('Amount') }}
                 @endif</span>
                                   <h5 class="sub-title">0.00449721 USD</h5>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-4 col-xl-3 col-sm-6">
                           <div class="transaction-item">
                               <div class="transaction-header">
                                   <h5 class="title">Hector 951</h5>
                                   <span class="date">December 24, 17:57</span>
                               </div>
                               <div class="transaction-thumb">
                                   <img src="{{ asset('theme/images/transaction/transaction08.png') }}" alt="transaction">
                               </div>
                               <div class="transaction-footer">
             <span class="amount">@if(canEditLang() && checkRequestOnEdit())
                     <editor_block data-name='Amount' contenteditable="true">{{ __('Amount') }}</editor_block>
                 @else
                     {{ __('Amount') }}
                 @endif</span>
                                   <h5 class="sub-title">0.00449721 LTC</h5>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-4 col-xl-3 col-sm-6">
                           <div class="transaction-item">
                               <div class="transaction-header">
                                   <h5 class="title">KimHowell21</h5>
                                   <span class="date">December 24, 17:57</span>
                               </div>
                               <div class="transaction-thumb">
                                   <img src="{{ asset('theme/images/transaction/transaction01.png') }}" alt="transaction">
                               </div>
                               <div class="transaction-footer">
             <span class="amount">@if(canEditLang() && checkRequestOnEdit())
                     <editor_block data-name='Amount' contenteditable="true">{{ __('Amount') }}</editor_block>
                 @else
                     {{ __('Amount') }}
                 @endif</span>
                                   <h5 class="sub-title">0.00449721 BTC</h5>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="tab-item">
                   <div class="row justify-content-center mb-30-none">
                       <div class="col-lg-4 col-xl-3 col-sm-6">
                           <div class="transaction-item">
                               <div class="transaction-header">
                                   <h5 class="title">Buha74</h5>
                                   <span class="date">December 24, 17:57</span>
                               </div>
                               <div class="transaction-thumb">
                                   <img src="{{ asset('theme/images/transaction/transaction03.png') }}" alt="transaction">
                               </div>
                               <div class="transaction-footer">
             <span class="amount">@if(canEditLang() && checkRequestOnEdit())
                     <editor_block data-name='Amount' contenteditable="true">{{ __('Amount') }}</editor_block>
                 @else
                     {{ __('Amount') }}
                 @endif</span>
                                   <h5 class="sub-title">0.00449721 LTC</h5>
                               </div>
                           </div>
                       </div>
                       <div class="col-lg-4 col-xl-3 col-sm-6">
                           <div class="transaction-item">
                               <div class="transaction-header">
                                   <h5 class="title">Eduardo54</h5>
                                   <span class="date">December 24, 17:57</span>
                               </div>
                               <div class="transaction-thumb">
                                   <img src="{{ asset('theme/images/transaction/transaction04.png') }}" alt="transaction">
                               </div>
                               <div class="transaction-footer">
             <span class="amount">@if(canEditLang() && checkRequestOnEdit())
                     <editor_block data-name='Amount' contenteditable="true">{{ __('Amount') }}</editor_block>
                 @else
                     {{ __('Amount') }}
                 @endif</span>
                                   <h5 class="sub-title">0.00449721 XRP</h5>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>--}}
          </div>
        </div>
      </div>
    </section>
    <!--=======Latest-Transaction-Section Ends Here=======-->
    
    
    <!--=======Affiliate-Section Starts Here=======-->
    <section class="affiliate-programe" id="affiliate">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 padding-bottom padding-top">
            <div class="section-header left-style">
              <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='What You’ll Get As' contenteditable="true">{{ __('What You’ll Get As') }}</editor_block>
                @else
                  {{ __('What You’ll Get As') }}
                @endif</span>
              <h2 class="title fz-md-49">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Affiliate Program' contenteditable="true">{{ __('Affiliate Program') }}</editor_block>
                @else
                  {{ __('Affiliate Program') }}
                @endif</h2>
              <p>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='We give you the opportunity to earn money by recommending our website to others. You can start earning money even if you do not invest.' contenteditable="true">{{ __('We give you the opportunity to earn money by recommending our website to others. You can start earning money even if you do not invest.') }}</editor_block>
                @else
                  {{ __('We give you the opportunity to earn money by recommending our website to others. You can start earning money even if you do not invest.') }}
                @endif
              </p>
            </div>
            <div class="affiliate-wrapper">
              <div class="affiliate-item">
                <div class="affiliate-inner">
                  <div class="affiliate-thumb">
                    <h3 class="title">
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='affiliate percent 1' contenteditable="true">{{ __('affiliate percent 1') }}</editor_block>
                      @else
                        {{ __('affiliate percent 1') }}
                      @endif
                    </h3>
                    <span class="remainder">%</span>
                    <span class="cont">
                        @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='1st' contenteditable="true">{{ __('1st') }}</editor_block>
                      @else
                        {{ __('1st') }}
                      @endif
                       </span>
                  </div>
                </div>
              </div>
              <div class="affiliate-item cl-two">
                <div class="affiliate-inner">
                  <div class="affiliate-thumb">
                    <h3 class="title">
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='affiliate percent 2' contenteditable="true">{{ __('affiliate percent 2') }}</editor_block>
                      @else
                        {{ __('affiliate percent 2') }}
                      @endif
                    </h3>
                    <span class="remainder">%</span>
                    <span class="cont">
                                            @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='2nd' contenteditable="true">{{ __('2nd') }}</editor_block>
                      @else
                        {{ __('2nd') }}
                      @endif
                                        </span>
                  </div>
                </div>
              </div>
              <div class="affiliate-item cl-three">
                <div class="affiliate-inner">
                  <div class="affiliate-thumb">
                    <h3 class="title">
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='affiliate percent 3' contenteditable="true">{{ __('affiliate percent 3') }}</editor_block>
                      @else
                        {{ __('affiliate percent 3') }}
                      @endif
                    </h3>
                    <span class="remainder">%</span>
                    <span class="cont">
                                            @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='3rd' contenteditable="true">{{ __('3rd') }}</editor_block>
                      @else
                        {{ __('3rd') }}
                      @endif
                                        </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="affiliate-bottom">
              <h6 class="title">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Make money with hyipland' contenteditable="true">{{ __('Make money with hyipland') }}</editor_block>
                @else
                  {{ __('Make money with hyipland') }}
                @endif</h6>
              <a href="#0" class="custom-button" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='learn more' contenteditable="true">{{ __('learn more') }}</editor_block>
                @else
                  {{ __('learn more') }}
                @endif <i class="flaticon-right"></i>
              </a>
            </div>
          </div>
          <div class="col-lg-5 d-lg-block d-none">
            <div class="afiliate-thumb">
              <img src="{{ asset('theme/images/affiliate/affiliate.png') }}" alt="affiliate">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=======Affiliate-Section Ends Here=======-->
    
    
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
              <span class="cate">    @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='TESTIMONIALS' contenteditable="true">{{ __('TESTIMONIALS') }}</editor_block>
                @else
                  {{ __('TESTIMONIALS') }}
                @endif</span>
              <h2 class="title">
                <span>40,000</span>
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='HAPPY CLIENTS AROUND THE WORLD' contenteditable="true">{{ __('HAPPY CLIENTS AROUND THE WORLD') }}</editor_block>
                @else
                  {{ __('HAPPY CLIENTS AROUND THE WORLD') }}
                @endif
              </h2>
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
                      <img src="{{ asset('theme/images/client/ysb-logo-social-v2.png') }}" alt="client">
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
                      <img src="{{ asset('theme/images/client/binance-logo-og.jpg') }}" alt="client">
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
                      <img src="{{ asset('theme/images/client/DiUkB_nXUAIpGjR.jpeg') }}" alt="client">
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

@push('js')
  <script>
    $(document).ready(function () {
      $('.offer-wrapper').owlCarousel({
        loop: true,
        margin: 30,
        center: true,
        responsiveClass: true,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        responsive: {
          0: {
            items: 1,
          },
          500: {
            items: 1,
          },
          992: {
            items: 3,
          }
        }
      })
    });
  </script>
@endpush