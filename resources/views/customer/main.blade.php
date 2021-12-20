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
                  <h3 class="title odometer" data-odometer-final="13.2">0</h3>
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
          <div class="col-lg-12">
            <div class="call--item">
              <span class="cate" style="color:white !important;">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Why We are always ready' contenteditable="true">
                            {{ __('Why We are always ready') }}
                          </editor_block>
                @else
                  {{ __('Why We are always ready') }}
                @endif</span>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=======Check-Section Ends Here=======-->


    <!--=======Offer-Section Stars Here=======-->
    <section class="offer-section padding-top pb-max-md-0" id="plan">
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
    <style>
        .owl-item {
            pointer-events: none;
        }

        .owl-item.center {
            pointer-events: auto;
        }
    </style>
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
                <select id="calcRateId">
                    @foreach(\App\Models\RateGroup::get() as $group)
                        <optgroup label="{{ $group->name }}">
                            @foreach(\App\Models\Rate::where('rate_group_id', $group->id)->orderBy('min')->get() as $rate)
                                @if($rate->daily > 0)
                                    <option value="{{ $rate->id }}">{{ __($rate->name) }}: {{ number_format($rate->daily, 2, '.', '') }}% в день, на {{ number_format($rate->duration, 0, '.', '') }} дней</option>
                                @else
                                 <option value="{{ $rate->id }}">{{ __($rate->name) }}: {{ number_format($rate->overall - 100, 2, '.', '') }}% через {{ $rate->duration }} дней</option>
                                @endif
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
              </div>
              <div class="calculate-item">
                <h5 class="title" data-serial="02">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Select the currency' contenteditable="true">{{ __('Select the currency') }}</editor_block>
                  @else
                    {{ __('Select the currency') }}
                  @endif</h5>
                <ul class="tab-menu" id="calcCurrency">
                    @foreach(\App\Models\Currency::whereIn('code', ['USD', 'BTC', 'ETH', 'RUB'])->get() as $currency)
                      <li class="{{ $currency->code == 'USD' ? 'active' : '' }}">
                          {{ $currency->code }}
                      </li>
                    @endforeach
                </ul>
              </div>
              <div class="calculate-item">
                <h5 class="title" data-serial="03">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Enter the amount' contenteditable="true">{{ __('Enter the amount') }}</editor_block>
                  @else
                    {{ __('Enter the amount') }}
                  @endif</h5>
                <input type="number" value="100" id="calcAmount">
              </div>
            </div>
            <div class="tab-area">

                @foreach(\App\Models\Currency::whereIn('code', ['USD', 'BTC', 'ETH', 'RUB'])->get() as $currency)
                  <div class="tab-item {{ $currency->code == 'USD' ? 'active' : '' }}">
                    <div class="profit-calc">
                      <div class="item">
                        <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Daily Profit' contenteditable="true">{{ __('Daily Profit') }}</editor_block>
                          @else
                            {{ __('Daily Profit') }}
                          @endif</span>
                          <h2 class="title cl-theme-1"><span id="calcResultDailyProfit{{ $currency->code }}">0</span> {{ $currency->code }}</h2>
                      </div>
                      <div class="item">
                        <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Total Profit' contenteditable="true">{{ __('Total Profit') }}</editor_block>
                          @else
                            {{ __('Total Profit') }}
                          @endif</span>
                        <h2 class="title cl-theme"><span id="calcResultTotalProfit{{ $currency->code }}">0</span> {{ $currency->code }}</h2>
                      </div>
                    </div>
                    <div class="invest-range-area">
                      <div class="main-amount">
                        <input type="text" class="calculator-invest" id="{{ $currency->code }}-amount" readonly>
                      </div>
                      <div style="margin-top:30px; width:100%;" class="invest-amount" data-min="{{ $currency->code == 'RUB' || $currency->code == 'USD' ? 1 : 0.0001 }} {{ $currency->code }}" data-max="{{ $currency->code == 'BTC' || $currency->code == 'ETH' ? 10 : 50000 }} {{ $currency->code }}">
                        <div id="{{ $currency->code }}-range" class="invest-range-slider"></div>
                      </div>
                    </div>
                  </div>
                    @endforeach

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
      </div>
        <div class="container" style="max-width:95%;">
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
                            <h5 class="title">
                                @if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='{{ $rate->name }}' contenteditable="true">{{ __($rate->name) }}</editor_block>
                                @else
                                    {{ __($rate->name) }}
                                @endif
                            </h5>
                              <p>&nbsp;</p>
                            <span class="title">
                                @if(canEditLang() && checkRequestOnEdit())
                                    <div style="text-align:left;">
                                <editor_block data-name='Daily earnings {{ $rate->id }}' contenteditable="true">{!! __('Daily earnings '.$rate->id) !!}</editor_block>
                                </div>
                                @else
                                    <span style="text-align:left;" class="date">{!! html_entity_decode(__('Daily earnings '.$rate->id)) !!}</span>
                                @endif

                                    @if(canEditLang() && checkRequestOnEdit())
                                        <div style="text-align:left;">
                                <editor_block data-name='Duration {{ $rate->id }}' contenteditable="true">{!! __('Duration '.$rate->id) !!}</editor_block>
                                </div>
                                    @else
                                        <div style="text-align:left;">
                                        <span  style="text-align:left;" class="date">{!! html_entity_decode(__('Duration '.$rate->id)) !!}</span>
                                        </div>
                                    @endif

                                                        </span>
                              @if(canEditLang() && checkRequestOnEdit())
                                  <div style="text-align:left;">
                                      <editor_block data-name='Daily rate {{ $rate->id }}' contenteditable="true">{!! __('Daily rate '.$rate->id) !!}</editor_block>
                                  </div>
                              @else
                                  <div style="text-align:left;">
                                      <span  style="text-align:left;" class="date">{!! html_entity_decode(__('Daily rate '.$rate->id)) !!}</span>
                                  </div>
                              @endif

                              @if(canEditLang() && checkRequestOnEdit())
                                  <div style="text-align:left;">
                                      <editor_block data-name='Add str {{ $rate->id }}' contenteditable="true">{!! __('Add str '.$rate->id) !!}</editor_block>
                                  </div>
                              @else
                                  <div style="text-align:left;">
                                      <span  style="text-align:left;" class="date">{!! html_entity_decode(__('Add str '.$rate->id)) !!}</span>
                                  </div>
                              @endif

                              @if(canEditLang() && checkRequestOnEdit())
                                  <div style="text-align:left;">
                                      <editor_block data-name='Add str 2 {{ $rate->id }}' contenteditable="true">{!! __('Add str 2 '.$rate->id) !!}</editor_block>
                                  </div>
                              @else
                                  <div style="text-align:left;">
                                      <span  style="text-align:left;" class="date">{!! html_entity_decode(__('Add str 2 '.$rate->id)) !!}</span>
                                  </div>
                              @endif

                              @if(canEditLang() && checkRequestOnEdit())
                                  <div style="text-align:left;">
                                      <editor_block data-name='Add str 3 {{ $rate->id }}' contenteditable="true">{!! __('Add str 3 '.$rate->id) !!}</editor_block>
                                  </div>
                              @else
                                  <div style="text-align:left;">
                                      <span  style="text-align:left;" class="date">{!! html_entity_decode(__('Add str 3 '.$rate->id)) !!}</span>
                                  </div>
                              @endif

                              @if(canEditLang() && checkRequestOnEdit())
                                  @if($rate->overall)
                                      <div style="text-align:left;">
                                          <editor_block style="text-align:left;" data-name='return deposit: true {{ $rate->id }}' contenteditable="true">{!! __('return deposit: true '.$rate->id) !!}</editor_block>
                                      </div>
                                  @else
                                      <div style="text-align:left;">
                                          <editor_block style="text-align:left;" data-name='return deposit: false {{ $rate->id }}' contenteditable="true">{!! __('return deposit: false '.$rate->id) !!}</editor_block>
                                      </div>
                                  @endif
                              @else
                                  <div style="text-align:left;">
                                      @if($rate->overall)
                                          <span style="text-align:left;" class="date">{!! html_entity_decode(__('return deposit: true '.$rate->id)) !!}</span>
                                      @else
                                          <span style="text-align:left;" class="date">{!! html_entity_decode(__('return deposit: false '.$rate->id)) !!}</span>
                                      @endif
                                  </div>
                              @endif

                              @if(canEditLang() && checkRequestOnEdit())
                                  <div style="text-align:left;">
                                      <editor_block data-name='Add str 4 {{ $rate->id }}' contenteditable="true">{!! __('Add str 4 '.$rate->id) !!}</editor_block>
                                  </div>
                              @else
                                  <div style="text-align:left;">
                                      <span  style="text-align:left;" class="date">{!! html_entity_decode(__('Add str 4 '.$rate->id)) !!}</span>
                                  </div>
                              @endif
                          </div>
                          <div class="transaction-thumb">
                            {{--   <img src="{{ asset('theme/images/transaction/transaction01.png') }}" alt="transaction">--}}
                          </div>
                            <p>&nbsp;</p>
                          <div style="text-align:center;" class="transaction-footer">
                                                  <span class="amount" style="text-align:center;">
                                                      @if(canEditLang() && checkRequestOnEdit())
                                                      <editor_block data-name='Can deposit {{ $rate->id }}' contenteditable="true">{!! __('Can deposit '.$rate->id) !!}</editor_block>
                                                    @else
                                                          {!! html_entity_decode(__('Can deposit '.$rate->id)) !!}
                                                    @endif
                                                  </span>
                              <h5 class="sub-title">
                                  @if(canEditLang() && checkRequestOnEdit())
                                      <editor_block data-name='Min {{ $rate->id }}' contenteditable="true">{!! __('Min '.$rate->id) !!}</editor_block>
                                  @else
                                      {!! html_entity_decode(__('Min '.$rate->id)) !!} {{ number_format($rate->min, 0, '.', '') }}$
                                  @endif
                              </h5>
                              <h5 class="sub-title">
                                  @if(canEditLang() && checkRequestOnEdit())
                                      <editor_block data-name='Max {{ $rate->id }}' contenteditable="true">{!! __('Max '.$rate->id) !!}</editor_block>
                                  @else
                                      {!! html_entity_decode(__('Max '.$rate->id)) !!} {{ number_format($rate->max, 0, '.', '') }}$
                                  @endif
                              </h5>
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
                        <editor_block data-name='affiliate percent 11' contenteditable="true">{{ __('affiliate percent 11') }}</editor_block>
                      @else
                        {{ __('affiliate percent 11') }}
                      @endif
                    </h3>
                    <span class="remainder">%</span>
                    <span class="cont">
                        @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='11st' contenteditable="true">{{ __('11st') }}</editor_block>
                      @else
                        {{ __('11st') }}
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
                        <editor_block data-name='affiliate percent 22' contenteditable="true">{{ __('affiliate percent 22') }}</editor_block>
                      @else
                        {{ __('affiliate percent 22') }}
                      @endif
                    </h3>
                    <span class="remainder">%</span>
                    <span class="cont">
                                            @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='22nd' contenteditable="true">{{ __('22nd') }}</editor_block>
                      @else
                        {{ __('22nd') }}
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
                        <editor_block data-name='affiliate percent 33' contenteditable="true">{{ __('affiliate percent 33') }}</editor_block>
                      @else
                        {{ __('affiliate percent 33') }}
                      @endif
                    </h3>
                    <span class="remainder">%</span>
                    <span class="cont">
                                            @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='33rd' contenteditable="true">{{ __('33rd') }}</editor_block>
                      @else
                        {{ __('33rd') }}
                      @endif
                                        </span>
                  </div>
                </div>
              </div>
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
          <div class="col-md-12">
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
                    <a href="/">
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
                    <a href="/">
                      <img src="{{ asset('theme/images/client/binance.svg') }}" alt="client" style="min-width:77px; min-height:77px;">
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
                    <a href="/">
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
        @foreach(\App\Models\Currency::whereIn('code', ['USD', 'BTC', 'ETH', 'RUB'])->get() as $currency)
        $( function() {
            $( "#{{ $currency->code }}-range" ).slider({
                range: "min",
                step: {{ $currency->code == 'RUB' || $currency->code == 'USD' ? 1 : 0.0001 }},
                value: {{ $currency->code == 'RUB' || $currency->code == 'USD' ? 100 : 0.0001 }},
                min: {{ $currency->code == 'RUB' || $currency->code == 'USD' ? 1 : 0.0001 }},
                max: {{ $currency->code == 'BTC' || $currency->code == 'ETH' ? 10 : 50000 }},
                slide: function( event, ui ) {
                    var calcAmount = ui.value;
                    var rateId = $('#calcRateId').val();

                    $( "#{{ $currency->code }}-amount" ).val( calcAmount + " {{ $currency->code }}" );
                    $('#calcAmount').val(calcAmount);

                    var dailyIncome = 0;
                    var totalIncome = 0;
                    var dailyPercent = 0;
                    var overall = 0;
                    var duration = 0;

                    @foreach(\App\Models\Rate::all() as $rate)
                    if(rateId == "{{ $rate->id }}"){
                        dailyPercent = {{ $rate->daily }};
                        overall = {{ $rate->overall }};
                        duration = {{ $rate->duration }};
                    }
                    @endforeach

                        dailyIncome = calcAmount / 100 * dailyPercent;

                    if (dailyPercent > 0) {
                        totalIncome = dailyIncome * duration;
                    } else {
                        totalIncome = calcAmount / 100 * (overall - 100);
                    }

                    $('#calcResultDailyProfit{{ $currency->code }}').html(dailyIncome.toFixed({{ $currency->code == 'BTC' || $currency->code == 'ETH' ? 5 : 2 }})); // daily income
                    $('#calcResultTotalProfit{{ $currency->code }}').html(totalIncome.toFixed({{ $currency->code == 'BTC' || $currency->code == 'ETH' ? 5 : 2 }})); // total income
                },
                change: function( event, ui ) {
                    var calcAmount = ui.value;
                    var rateId = $('#calcRateId').val();

                    $( "#{{ $currency->code }}-amount" ).val( calcAmount + " {{ $currency->code }}" );

                    var dailyIncome = 0;
                    var totalIncome = 0;
                    var dailyPercent = 0;
                    var overall = 0;
                    var duration = 0;

                    @foreach(\App\Models\Rate::all() as $rate)
                    if(rateId == "{{ $rate->id }}"){
                        dailyPercent = {{ $rate->daily }};
                        overall = {{ $rate->overall }};
                        duration = {{ $rate->duration }};
                    }
                    @endforeach

                        dailyIncome = calcAmount / 100 * dailyPercent;

                    if (dailyPercent > 0) {
                        totalIncome = dailyIncome * duration;
                    } else {
                        totalIncome = calcAmount / 100 * (overall - 100);
                    }

                    $('#calcResultDailyProfit{{ $currency->code }}').html(dailyIncome.toFixed({{ $currency->code == 'BTC' || $currency->code == 'ETH' ? 5 : 2 }})); // daily income
                    $('#calcResultTotalProfit{{ $currency->code }}').html(totalIncome.toFixed({{ $currency->code == 'BTC' || $currency->code == 'ETH' ? 5 : 2 }})); // total income
                },
            });

            @if($currency->code == 'BTC' || $currency->code == 'ETH')
            $( "#{{ $currency->code }}-range" ).slider("value", 0.1);
            @else
            $( "#{{ $currency->code }}-range" ).slider("value", 100);
            @endif

            $('#calcAmount').keyup(function(){
                $( "#{{ $currency->code }}-range" ).slider("value", $(this).val());
            });
            $('#calcRateId').change(function(){
                $( "#{{ $currency->code }}-range" ).slider("value", $('#calcAmount').val());
            });

            $( "#{{ $currency->code }}-amount" ).val( "{{ $currency->code }} " +  $( "#{{ $currency->code }}-range" ).slider( "value" ) );
        } );
        @endforeach




      $('.offer-wrapper').owlCarousel({
        loop: true,
        margin: 30,
        merge: true,
        center: true,
        responsiveClass: true,
        nav: false,
        dots: true,
        autoplay: true,
        video: true,
        autoplayTimeout: 4000,
        autoplayHoverPause: true,
        mouseDrag:true,
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
