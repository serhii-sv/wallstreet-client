@extends('layouts.app')
@section('title', __('For partners'))
@section('content')

  <div class="main--body">
    <!--========== Preloader ==========-->
  @include('layouts.app-preloader')
  <!--========== Preloader ==========-->


    <!--=======Header-Section Starts Here=======-->
  @include('layouts.app-header')
  <!--=======Header-Section Ends Here=======-->


    <!--=======Banner-Section Starts Here=======-->
    <section class="bg_img hero-section-2 " data-background="{{ asset('theme/images/about/hero-bg4.png') }}">
      <div class="container">
        <div class="hero-content text-white">
          <h1 class="title">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Affiliates' contenteditable="true">{{ __('Affiliates') }}</editor_block>
            @else
              {{ __('Affiliates') }}
              @endif</h1>
          <ul class="breadcrumb">
            <li>
              <a href="{{ route('customer.main') }}">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Home' contenteditable="true">{{ __('Home') }}</editor_block>
                @else
                  {{ __('Home') }}
                  @endif</a>
            </li>
            <li>
              @if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Affiliates' contenteditable="true">{{ __('Affiliates') }}</editor_block>
              @else
                {{ __('Affiliates') }}
                @endif
            </li>
          </ul>
        </div>
      </div>
    </section>
    <!--=======Banner-Section Ends Here=======-->


    <!--=======Affiliate-Section Starts Here=======-->
    <section class="affiliate-programe padding-top pt-max-lg-0">
      <div class="ball-3" data-paroller-factor="0.30" data-paroller-factor-lg="-0.30"
          data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{ asset('theme/images/balls/ball4.png') }}" alt="balls">
      </div>
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
              <p>
                @if(canEditLang() && checkRequestOnEdit())
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
                    <h3 class="title">2</h3>
                    <span class="remainder">%</span>
                    <span class="cont">1st</span>
                  </div>
                </div>
              </div>
              <div class="affiliate-item cl-two">
                <div class="affiliate-inner">
                  <div class="affiliate-thumb">
                    <h3 class="title">5</h3>
                    <span class="remainder">%</span>
                    <span class="cont">2nd</span>
                  </div>
                </div>
              </div>
              <div class="affiliate-item cl-three">
                <div class="affiliate-inner">
                  <div class="affiliate-thumb">
                    <h3 class="title">12</h3>
                    <span class="remainder">%</span>
                    <span class="cont">3rd</span>
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


    <!-- ==========Total-Affiliate-Section Starts Here========== -->
    <section class="total-affiliate-section padding-bottom padding-top">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="section-header">
              <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='You’re Part of something Big' contenteditable="true">{{ __('You’re Part of something Big') }}</editor_block>
                @else
                  {{ __('You’re Part of something Big') }}
                  @endif</span>
              <h2 class="title">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='$50,257,285.47' contenteditable="true">{{ __('$50,257,285.47') }}</editor_block>
                @else
                  {{ __('$50,257,285.47') }}
                @endif</h2>
              <p>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Amount' contenteditable="true">{{ __('Amount') }}</editor_block>
                @else
                  {{ __('Total Commissions Paid to Our Affiliates') }}
                  @endif</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 d-lg-block d-none">
            <div class="total-thumb rtl">
              <img src="{{ asset('theme/images/affiliate/total-1.png') }}" alt="affiliate">
            </div>
          </div>
          <div class="col-lg-7">
            <div class="total-content">
              <div class="total-bg">
                <img src="{{ asset('theme/images/affiliate/affiliate-bg2.png') }}" alt="affiliate">
              </div>
              <div class="tot-wrapper">
                <div class="tot-area">
                  <div class="tot-item">
                    <div class="tot-thumb">
                      <img src="{{ asset('theme/images/affiliate/tot1.png') }}" alt="affiliate">
                    </div>
                    <div class="tot-content">
                      <div class="counter--item">
                        <div class="counter-header">
                          <h2 class="title odometer" data-odometer-final="20">0</h2>
                        </div>
                        <p>
                          @if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Supported Languages' contenteditable="true">{{ __('Supported Languages') }}</editor_block>
                          @else
                            {{ __('Supported Languages') }}
                            @endif
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="tot-item">
                    <div class="tot-thumb">
                      <img src="{{ asset('theme/images/affiliate/tot3.png') }}" alt="affiliate">
                    </div>
                    <div class="tot-content">
                      <div class="counter--item">
                        <div class="counter-header">
                          <h2 class="title odometer" data-odometer-final="4.5">0</h2>
                          <h2 class="title">M</h2>
                        </div>
                        <p>
                          @if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Users Worldwide' contenteditable="true">{{ __('Users Worldwide') }}</editor_block>
                          @else
                            {{ __('Users Worldwide') }}
                            @endif
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tot-area">
                  <div class="tot-item">
                    <div class="tot-thumb">
                      <img src="{{ asset('theme/images/affiliate/tot3.png') }}" alt="affiliate">
                    </div>
                    <div class="tot-content">
                      <div class="counter--item">
                        <div class="counter-header">
                          <h2 class="title odometer" data-odometer-final="800">0</h2>
                          <h2 class="title">k</h2>
                        </div>
                        <p>
                          @if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Popular Investors' contenteditable="true">{{ __('Popular Investors') }}</editor_block>
                          @else
                            {{ __('Popular Investors') }}
                            @endif
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ==========Total-Affiliate-Section Ends Here========== -->


    <!-- ==========How-Section Starts Here========== -->
    <section class="how-section bg_img padding-top padding-bottom pt-max-md-0" data-background="{{ asset('theme/images/affiliate/affiliate-bg.png') }}">
      <div class="ball-3" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60"
          data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{ asset('theme/images/balls/ball-group9.png') }}" alt="balls">
      </div>
      <div class="ball-2" data-paroller-factor="0.30" data-paroller-factor-lg="-0.30"
          data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{ asset('theme/images/balls/ball-group10.png') }}" alt="balls">
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="section-header">
              <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Here’s how it works' contenteditable="true">{{ __('Here’s how it works') }}</editor_block>
                @else
                  {{ __('Here’s how it works') }}
                  @endif</span>
              <h2 class="title">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Getting started? It’s simple' contenteditable="true">{{ __('Getting started? It’s simple') }}</editor_block>
                @else
                  {{ __('Getting started? It’s simple') }}
                  @endif</h2>
              <p>
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='The affiliate program is our special feature for loyal Investors.Invite users and earn 40% of the fee on their exchange transactions!' contenteditable="true">{{ __('The affiliate program is our special feature for loyal Investors.Invite users and earn 40% of the fee on their exchange transactions!') }}</editor_block>
                @else
                  {{ __('The affiliate program is our special feature for loyal Investors.Invite users and earn 40% of the fee on their exchange transactions!') }}
                  @endif
              </p>
            </div>
          </div>
        </div>
        <div class="row justify-content-center mb-30-none">
          <div class="col-md-6 col-lg-4 col-sm-10">
            <div class="how-item">
              <div class="how-thumb-area">
                <div class="how-thumb">
                  <img src="{{ asset('theme/images/how/how4.png') }}" alt="how">
                </div>
              </div>
              <div class="how-content">
                <h5 class="title">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Join Program' contenteditable="true">{{ __('Join Program') }}</editor_block>
                  @else
                    {{ __('Join Program') }}
                    @endif</h5>
                <a href="#0" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>Join Now <i class="flaticon-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-sm-10">
            <div class="how-item active">
              <div class="how-thumb-area">
                <div class="how-thumb">
                  <img src="{{ asset('theme/images/how/how5.png') }}" alt="how">
                </div>
              </div>
              <div class="how-content">
                <h5 class="title">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Promote' contenteditable="true">{{ __('Promote') }}</editor_block>
                  @else
                    {{ __('Promote') }}
                    @endif</h5>
                <a href="#0" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>Tracking Link <i class="flaticon-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 col-sm-10">
            <div class="how-item">
              <div class="how-thumb-area">
                <div class="how-thumb">
                  <img src="{{ asset('theme/images/how/how6.png') }}" alt="how">
                </div>
              </div>
              <div class="how-content">
                <h5 class="title">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Earn' contenteditable="true">{{ __('Earn') }}</editor_block>
                  @else
                    {{ __('Earn') }}
                    @endif</h5>
                <a href="#0" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>Commission Model <i class="flaticon-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ==========How-Section Ends Here========== -->


    <!-- ==========Why-Affiliate-Section Starts Here========== -->
    <section class="why-affiliate-section padding-bottom padding-top pt-max-lg-0">
      <div class="why--thumb">
        <img src="{{ asset('theme/images/why/how.png') }}" alt="why">
      </div>
      <div class="container">
        <div class="row align-items-end">
          <div class="col-lg-6">
            <div class="why-affiliate-content">
              <div class="section-header left-style">
                <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Why Should You' contenteditable="true">{{ __('Why Should You') }}</editor_block>
                  @else
                    {{ __('Why Should You') }}
                    @endif</span>
                <h2 class="title">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Join affiliate?' contenteditable="true">{{ __('Join affiliate?') }}</editor_block>
                  @else
                    {{ __('Join affiliate?') }}
                    @endif</h2>
                <p>
                  @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='The affiliate program is our special feature for loyal Investors.' contenteditable="true">{{ __('The affiliate program is our special feature for loyal Investors.') }}</editor_block>
                  @else
                    {{ __('The affiliate program is our special feature for loyal Investors.') }}
                    @endif
                </p>
              </div>
              <div class="why-area">
                <div class="why-item">
                  <div class="why-inner">
                    <div class="why-thumb">
                      <img src="{{ asset('theme/images/why/why1.png') }}" alt="why">
                    </div>
                    <div class="why-content">
                      <h6 class="title">@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Joining free' contenteditable="true">{{ __('Joining free') }}</editor_block>
                        @else
                          {{ __('Joining free') }}
                          @endif</h6>
                    </div>
                  </div>
                </div>
                <div class="why-item">
                  <div class="why-inner">
                    <div class="why-thumb">
                      <img src="{{ asset('theme/images/why/why2.png') }}" alt="why">
                    </div>
                    <div class="why-content">
                      <h6 class="title">@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Instant Payout' contenteditable="true">{{ __('Instant Payout') }}</editor_block>
                        @else
                          {{ __('Instant Payout') }}
                          @endif</h6>
                    </div>
                  </div>
                </div>
                <div class="why-item">
                  <div class="why-inner">
                    <div class="why-thumb">
                      <img src="{{ asset('theme/images/why/why3.png') }}" alt="why">
                    </div>
                    <div class="why-content">
                      <h6 class="title">@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Performance Bonues' contenteditable="true">{{ __('Performance Bonues') }}</editor_block>
                        @else
                          {{ __('Performance Bonues') }}
                          @endif</h6>
                    </div>
                  </div>
                </div>
                <div class="why-item">
                  <div class="why-inner">
                    <div class="why-thumb">
                      <img src="{{ asset('theme/images/why/why4.png') }}" alt="why">
                    </div>
                    <div class="why-content">
                      <h6 class="title">@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Unlimited affiliates' contenteditable="true">{{ __('Unlimited affiliates') }}</editor_block>
                        @else
                          {{ __('Unlimited affiliates') }}
                          @endif</h6>
                    </div>
                  </div>
                </div>
              </div>
              <a href="#0" class="custom-button" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Join Now!' contenteditable="true">{{ __('Join Now!') }}</editor_block>
                @else
                  {{ __('Join Now!') }}
                  @endif</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ==========Why-Affiliate-Section Ends Here========== -->


    <!-- ==========Footer-Section Starts Here========== -->
  @include('layouts.app-footer')
  <!-- ==========Footer-Section Ends Here========== -->


  </div>

@endsection
