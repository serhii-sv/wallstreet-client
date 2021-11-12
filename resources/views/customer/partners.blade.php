@extends('layouts.app')
@section('title', __('For partners'))
@section('content')

  <div class="main--body">
    <!--========== Preloader ==========-->
  {{--  @include('layouts.app-preloader')--}}
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
            <div class="affiliate-wrapper">
              <div class="affiliate-item cl-4">
                <div class="affiliate-inner">
                  <div class="affiliate-thumb">
                    <h3 class="title">
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='affiliate percent 4' contenteditable="true">{{ __('affiliate percent 4') }}</editor_block>
                      @else
                        {{ __('affiliate percent 4') }}
                      @endif
                    </h3>
                    <span class="remainder">%</span>
                    <span class="cont">
                        @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='4st' contenteditable="true">{{ __('4st') }}</editor_block>
                      @else
                        {{ __('4st') }}
                      @endif
                       </span>
                  </div>
                </div>
              </div>
              <div class="affiliate-item cl-5">
                <div class="affiliate-inner">
                  <div class="affiliate-thumb">
                    <h3 class="title">
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='affiliate percent 5' contenteditable="true">{{ __('affiliate percent 5') }}</editor_block>
                      @else
                        {{ __('affiliate percent 5') }}
                      @endif
                    </h3>
                    <span class="remainder">%</span>
                    <span class="cont">
                                            @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='5nd' contenteditable="true">{{ __('5nd') }}</editor_block>
                      @else
                        {{ __('5nd') }}
                      @endif
                                        </span>
                  </div>
                </div>
              </div>
              <div class="affiliate-item cl-6">
                <div class="affiliate-inner">
                  <div class="affiliate-thumb">
                    <h3 class="title">
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='affiliate percent 6' contenteditable="true">{{ __('affiliate percent 6') }}</editor_block>
                      @else
                        {{ __('affiliate percent 6') }}
                      @endif
                    </h3>
                    <span class="remainder">%</span>
                    <span class="cont">
                                            @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='6rd' contenteditable="true">{{ __('6rd') }}</editor_block>
                      @else
                        {{ __('6rd') }}
                      @endif
                                        </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="affiliate-wrapper">
              <div class="affiliate-item cl-7">
                <div class="affiliate-inner">
                  <div class="affiliate-thumb">
                    <h3 class="title">
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='affiliate percent 7' contenteditable="true">{{ __('affiliate percent 7') }}</editor_block>
                      @else
                        {{ __('affiliate percent 7') }}
                      @endif
                    </h3>
                    <span class="remainder">%</span>
                    <span class="cont">
                        @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='7st' contenteditable="true">{{ __('7st') }}</editor_block>
                      @else
                        {{ __('7st') }}
                      @endif
                       </span>
                  </div>
                </div>
              </div>
              <div class="affiliate-item cl-8">
                <div class="affiliate-inner">
                  <div class="affiliate-thumb">
                    <h3 class="title">
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='affiliate percent 8' contenteditable="true">{{ __('affiliate percent 8') }}</editor_block>
                      @else
                        {{ __('affiliate percent 8') }}
                      @endif
                    </h3>
                    <span class="remainder">%</span>
                    <span class="cont">
                                            @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='8nd' contenteditable="true">{{ __('8nd') }}</editor_block>
                      @else
                        {{ __('8nd') }}
                      @endif
                                        </span>
                  </div>
                </div>
              </div>
              <div class="affiliate-item cl-9">
                <div class="affiliate-inner">
                  <div class="affiliate-thumb">
                    <h3 class="title">
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='affiliate percent 9' contenteditable="true">{{ __('affiliate percent 9') }}</editor_block>
                      @else
                        {{ __('affiliate percent 9') }}
                      @endif
                    </h3>
                    <span class="remainder">%</span>
                    <span class="cont">
                                            @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='9rd' contenteditable="true">{{ __('9rd') }}</editor_block>
                      @else
                        {{ __('9rd') }}
                      @endif
                                        </span>
                  </div>
                </div>
              </div>
            </div>
            <div class="affiliate-bottom">

            </div>
          </div>
          <div class="col-lg-5 d-lg-block d-none">
            <div class="afiliate-thumb">
              <img src="{{ asset('theme/images/affiliate/affiliate.png') }}" alt="affiliate">
            </div>
            <h6 class="title">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Make money with hyipland' contenteditable="true">{{ __('Make money with hyipland') }}</editor_block>
              @else
                {{ __('Make money with hyipland') }}
              @endif</h6>
          </div>
        </div>
      </div>
    </section>
    <!--=======Affiliate-Section Ends Here=======-->


    <!--=======Check-Section Starts Here=======-->
    <section class="call-section call-overlay bg_img" data-background="{{ asset('theme/images/call/call-bg.jpg') }}">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12 ">
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


    <!-- ==========Total-Affiliate-Section Starts Here========== -->
    <section class="total-affiliate-section padding-bottom padding-top">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12">
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
                  <editor_block data-name='Total Commissions Paid to Our Affiliates 2' contenteditable="true">{{ __('Total Commissions Paid to Our Affiliates 2') }}</editor_block>
                @else
                  {{ __('Total Commissions Paid to Our Affiliates 2') }}
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

      <div class="row" style="margin:-10px 0 25px 0; text-align: left;width:60%;margin-left:20%;">
          @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='New descr 123' contenteditable="true">{{ __('New descr 123') }}</editor_block>
          @else
              {{ __('New descr 123') }}
          @endif
      </div>

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
                @endif
              </h2>
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
                <a href="/" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Join Now' contenteditable="true">{{ __('Join Now') }}</editor_block>
                  @else
                    {{ __('Join Now') }}
                  @endif
                  <i class="flaticon-right"></i></a>
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
                <a href="/" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Tracking Link' contenteditable="true">{{ __('Tracking Link') }}</editor_block>
                  @else
                    {{ __('Tracking Link') }}
                  @endif
                  <i class="flaticon-right"></i></a>
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
                <a href="/" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Commission Model' contenteditable="true">{{ __('Commission Model') }}</editor_block>
                  @else
                    {{ __('Commission Model') }}
                  @endif
                  <i class="flaticon-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ==========How-Section Ends Here========== -->

    <div class="partner-table">
      <div class="container">
          <h2 class="title">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Title 1313' contenteditable="true">{{ __('Title 1313') }}</editor_block>
              @else
                  {{ __('Title 1313') }}
              @endif</h2>
        <div class="row">
          <div class="col responsive-table mt-3">
            <table class="table white border-radius-4 pt-1 table-bordered">
              <thead>
                <tr class="border-none" style="text-align: center">
                  <th style="vertical-align: middle;" rowspan="2" colspan="2">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Career status' contenteditable="true">{{ __('Career status') }}</editor_block>@else {{ __('Career status') }} @endif
                  </th>
                  <th style="vertical-align: middle;" colspan="2">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Deposit turnover' contenteditable="true">{{ __('Deposit turnover') }}</editor_block>@else {{ __('Deposit turnover') }} @endif
                  </th>
                  <th style="vertical-align: middle;" rowspan="2">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Reward' contenteditable="true">{{ __('Reward') }}</editor_block>@else {{ __('Reward') }} @endif
                  </th>
                  <th style="vertical-align: middle;" rowspan="2">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Leadership bonus' contenteditable="true">{{ __('Leadership bonus') }}</editor_block>@else {{ __('Leadership bonus') }} @endif
                  </th>
                </tr>
                <tr class="border-none">
                  <th>@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Personal turnover' contenteditable="true">{{ __('Personal turnover') }}</editor_block>@else {{ __('Personal turnover') }} @endif
                  </th>
                  <th>@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Structural turnover' contenteditable="true">{{ __('Structural turnover') }}</editor_block>@else {{ __('Structural turnover') }} @endif
                  </th>
                </tr>
              </thead>
              <tbody>
                @if($deposit_turnovers)
                  @foreach($deposit_turnovers as $item)
                    <tr class="bonus-list" style="text-align: center">
                      <td>
                          @if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='name {{$item->id}}' contenteditable="true">{{ __('name '.$item->id) }}</editor_block>
                          @else {{ __('name '.$item->id) }}
                          @endif
                      </td>
                      <td>
                          @if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='stage {{$item->id}}' contenteditable="true">{{ __('stage '.$item->id) }}</editor_block>
                          @else
                              {{ __('stage '. $item->id) }}
                          @endif
                      </td>
                      <td>
                        @if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='item personal turnover {{ $item->id }}' contenteditable="true">{{ __('item personal turnover '.$item->id) }}</editor_block>
                          @else
                              {{ __('item personal turnover '.$item->id) }}
                          @endif
                      </td>
                        <td>
                            @if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='item total turnover {{ $item->id }}' contenteditable="true">{{ __('item total turnover '.$item->id) }}</editor_block>
                            @else
                                {{ __('item total turnover '.$item->id) }}
                            @endif
                        </td>
                        <td>
                            @if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='item reward turnover {{ $item->id }}' contenteditable="true">{{ __('item reward turnover '.$item->id) }}</editor_block>
                            @else
                                {{ __('item reward turnover '.$item->id) }}
                            @endif
                        </td>
                      <td>
                        @if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='bonus {{$item->id}}' contenteditable="true">{{ __('bonus '.$item->id) }}</editor_block>@else {{ __('bonus '.$item->id) }} @endif
                      </td>
                    </tr>
                  @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


    <!-- ==========Why-Affiliate-Section Starts Here========== -->
    <section class="why-affiliate-section padding-bottom pt-4 pt-max-lg-0">
      <div class="why--thumb">
        <img src="{{ asset('theme/images/why/how.png') }}" alt="why">
      </div>
      <div class="container">
        <div class="row align-items-end">
          <div class="col-lg-12">
            <div class="why-affiliate-content">
              <div class="section-header left-style">

                <h2 class="title">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Join affiliate?' contenteditable="true">{{ __('Join affiliate?') }}</editor_block>
                  @else
                    {{ __('Join affiliate?') }}
                  @endif</h2>

                  <div class="row" style="margin:25px 0 25px 0; text-align: left;width:60%;margin-left:0%;">
                      @if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='New descr 1234' contenteditable="true">{{ __('New descr 1234') }}</editor_block>
                      @else
                          {{ __('New descr 1234') }}
                      @endif
                  </div>

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
{{--              <a href="/" class="custom-button" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())--}}
{{--                  <editor_block data-name='Join Now!' contenteditable="true">{{ __('Join Now!') }}</editor_block>--}}
{{--                @else--}}
{{--                  {{ __('Join Now!') }}--}}
{{--                @endif</a>--}}
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
