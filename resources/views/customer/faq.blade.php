@extends('layouts.app')
@section('title', __('FAQ'))
@section('content')
  <div class="main--body">
    <!--========== Preloader ==========-->
{{--  @include('layouts.app-preloader')--}}
  <!--========== Preloader ==========-->


    <!--=======Header-Section Starts Here=======-->
  @include('layouts.app-header')
  <!--=======Header-Section Ends Here=======-->


    <!--=======Banner-Section Starts Here=======-->
    <section class="bg_img hero-section-2" data-background="{{ asset('theme/images/about/hero-bg3.jpg') }}">
      <div class="container">
        <div class="hero-content text-white">
          <h1 class="title">
              @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='faq' contenteditable="true">{{ __('faq') }}</editor_block>
            @else
              {{ __('faq') }}
            @endif
          </h1>
          <ul class="breadcrumb">
            <li>
              <a href="{{ route('customer.main') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Home' contenteditable="true">{{ __('Home') }}</editor_block>
                @else
                  {{ __('Home') }}
                @endif</a>
            </li>
            <li>
              @if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='faq' contenteditable="true">{{ __('faq') }}</editor_block>
              @else
                {{ __('faq') }}
              @endif
            </li>
          </ul>
        </div>
      </div>
      <div class="hero-shape">
        <img class="wow slideInUp" src="{{ asset('theme/images/about/hero-shape1.png') }}" alt="about" data-wow-duration="1s">
      </div>
    </section>
    <!--=======Banner-Section Ends Here=======-->


    <!--=======Feature-Section Starts Here=======-->
    <section class="faq-section padding-top padding-bottom mb-xl-5">
      <div class="ball-group-1" data-paroller-factor="-0.30" data-paroller-factor-lg="0.60"
          data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{ asset('theme/images/balls/ball-group7.png') }}" alt="balls">
      </div>
      <div class="ball-group-2 rtl" data-paroller-factor="0.30" data-paroller-factor-lg="-0.30"
          data-paroller-type="foreground" data-paroller-direction="horizontal">
        <img src="{{ asset('theme/images/balls/ball-group8.png') }}" alt="balls">
      </div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-10">
            <div class="section-header">
              <span class="cate">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='You have questions' contenteditable="true">{{ __('You have questions') }}</editor_block>
                @else
                  {{ __('You have questions') }}
                @endif</span>
              <h2 class="title">
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='we have answers' contenteditable="true">{{ __('we have answers') }}</editor_block>
                @else
                  {{ __('we have answers') }}
                @endif
              </h2>
              <p class="mw-100">
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name="Do not hesitate to send us an email if you can't find what you're looking for." contenteditable="true">{{ __("Do not hesitate to send us an email if you can't find what you're looking for.") }}</editor_block>
                @else
                  {{ __("Do not hesitate to send us an email if you can't find what you're looking for.") }}
                @endif
              </p>
            </div>
          </div>
        </div>
        <div class="tab faq-tab">
          {{--          <ul class="tab-menu">--}}
          {{--            <li>@if(canEditLang() && checkRequestOnEdit())--}}
          {{--                <editor_block data-name='BASIC' contenteditable="true">{{ __('BASIC') }}</editor_block>--}}
          {{--              @else--}}
          {{--                {{ __('BASIC') }}--}}
          {{--                @endif</li>--}}
          {{--            <li class="active">@if(canEditLang() && checkRequestOnEdit())--}}
          {{--                <editor_block data-name='FINANCIAL' contenteditable="true">{{ __('FINANCIAL') }}</editor_block>--}}
          {{--              @else--}}
          {{--                {{ __('FINANCIAL') }}--}}
          {{--                @endif</li>--}}
          {{--            <li>@if(canEditLang() && checkRequestOnEdit())--}}
          {{--                <editor_block data-name='Affiliate' contenteditable="true">{{ __('Affiliate') }}</editor_block>--}}
          {{--              @else--}}
          {{--                {{ __('Affiliate') }}--}}
          {{--                @endif</li>--}}
          {{--          </ul>--}}
          <div class="tab-area">
            {{--            <div class="tab-item">--}}
            {{--              <div class="faq-wrapper">--}}
            {{--                <div class="faq-item">--}}
            {{--                  <div class="faq-title">--}}
            {{--                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='What is the minimum percentage that an investor can earn on Hyipland?' contenteditable="true">{{ __('What is the minimum percentage that an investor can earn on Hyipland?') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('What is the minimum percentage that an investor can earn on Hyipland?') }}--}}
            {{--                        @endif</h5>--}}
            {{--                    <span class="right-icon"></span>--}}
            {{--                  </div>--}}
            {{--                  <div class="faq-content">--}}
            {{--                    <p>--}}
            {{--                      @if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.' contenteditable="true">{{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}--}}
            {{--                        @endif--}}
            {{--                    </p>--}}
            {{--                  </div>--}}
            {{--                </div>--}}
            {{--                <div class="faq-item active open">--}}
            {{--                  <div class="faq-title">--}}
            {{--                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='Can i invest using cryptocurrency?' contenteditable="true">{{ __('Can i invest using cryptocurrency?') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('Can i invest using cryptocurrency?') }}--}}
            {{--                        @endif</h5>--}}
            {{--                    <span class="right-icon"></span>--}}
            {{--                  </div>--}}
            {{--                  <div class="faq-content">--}}
            {{--                    <p>--}}
            {{--                      @if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.' contenteditable="true">{{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}--}}
            {{--                        @endif--}}
            {{--                    </p>--}}
            {{--                  </div>--}}
            {{--                </div>--}}
            {{--                <div class="faq-item">--}}
            {{--                  <div class="faq-title">--}}
            {{--                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='What are the minimum and maximum deposit amounts?' contenteditable="true">{{ __('What are the minimum and maximum deposit amounts?') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('What are the minimum and maximum deposit amounts?') }}--}}
            {{--                        @endif</h5>--}}
            {{--                    <span class="right-icon"></span>--}}
            {{--                  </div>--}}
            {{--                  <div class="faq-content">--}}
            {{--                    <p>--}}
            {{--                      @if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.' contenteditable="true">{{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}--}}
            {{--                        @endif--}}
            {{--                    </p>--}}
            {{--                  </div>--}}
            {{--                </div>--}}
            {{--                <div class="faq-item">--}}
            {{--                  <div class="faq-title">--}}
            {{--                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='How long will the money arrive in my account after the withdrawal process?' contenteditable="true">{{ __('How long will the money arrive in my account after the withdrawal process?') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('How long will the money arrive in my account after the withdrawal process?') }}--}}
            {{--                        @endif</h5>--}}
            {{--                    <span class="right-icon"></span>--}}
            {{--                  </div>--}}
            {{--                  <div class="faq-content">--}}
            {{--                    <p>--}}
            {{--                      @if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.' contenteditable="true">{{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}--}}
            {{--                        @endif--}}
            {{--                    </p>--}}
            {{--                  </div>--}}
            {{--                </div>--}}
            {{--                <div class="faq-item">--}}
            {{--                  <div class="faq-title">--}}
            {{--                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='What payment system can i use to withdraw?' contenteditable="true">{{ __('What payment system can i use to withdraw?') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('What payment system can i use to withdraw?') }}--}}
            {{--                        @endif</h5>--}}
            {{--                    <span class="right-icon"></span>--}}
            {{--                  </div>--}}
            {{--                  <div class="faq-content">--}}
            {{--                    <p>--}}
            {{--                      @if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.' contenteditable="true">{{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}--}}
            {{--                        @endif--}}
            {{--                    </p>--}}
            {{--                  </div>--}}
            {{--                </div>--}}
            {{--              </div>--}}
            {{--            </div>--}}
            <div class="tab-item active">
              <div class="faq-wrapper">
                @if($faqs !== null)
                  @foreach($faqs as $faq)
                  <div class="faq-item @if($loop->first) active open @endif">
                    <div class="faq-title">
                      <h5 class="title">{{ $faq->question }}</h5>
                      <span class="right-icon"></span>
                    </div>
                    <div class="faq-content">
                      <p>
                        {{ $faq->answer }}
                      </p>
                    </div>
                  </div>
                  @endforeach
                @endif
{{--                <div class="faq-item active open">--}}
{{--                  <div class="faq-title">--}}
{{--                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())--}}
{{--                        <editor_block data-name='What is the minimum percentage that an investor can earn on Hyipland?' contenteditable="true">{{ __('What is the minimum percentage that an investor can earn on Hyipland?') }}</editor_block>--}}
{{--                      @else--}}
{{--                        {{ __('What is the minimum percentage that an investor can earn on Hyipland?') }}--}}
{{--                      @endif</h5>--}}
{{--                    <span class="right-icon"></span>--}}
{{--                  </div>--}}
{{--                  <div class="faq-content">--}}
{{--                    <p>--}}
{{--                      @if(canEditLang() && checkRequestOnEdit())--}}
{{--                        <editor_block data-name='Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.' contenteditable="true">{{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}</editor_block>--}}
{{--                      @else--}}
{{--                        {{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}--}}
{{--                      @endif--}}
{{--                    </p>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--               --}}
{{--                <div class="faq-item">--}}
{{--                  <div class="faq-title">--}}
{{--                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())--}}
{{--                        <editor_block data-name='What are the minimum and maximum deposit amounts?' contenteditable="true">{{ __('What are the minimum and maximum deposit amounts?') }}</editor_block>--}}
{{--                      @else--}}
{{--                        {{ __('What are the minimum and maximum deposit amounts?') }}--}}
{{--                      @endif</h5>--}}
{{--                    <span class="right-icon"></span>--}}
{{--                  </div>--}}
{{--                  <div class="faq-content">--}}
{{--                    <p>--}}
{{--                      @if(canEditLang() && checkRequestOnEdit())--}}
{{--                        <editor_block data-name='Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.' contenteditable="true">{{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}</editor_block>--}}
{{--                      @else--}}
{{--                        {{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}--}}
{{--                      @endif--}}
{{--                    </p>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="faq-item">--}}
{{--                  <div class="faq-title">--}}
{{--                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())--}}
{{--                        <editor_block data-name='How long will the money arrive in my account after the withdrawal process?' contenteditable="true">{{ __('How long will the money arrive in my account after the withdrawal process?') }}</editor_block>--}}
{{--                      @else--}}
{{--                        {{ __('How long will the money arrive in my account after the withdrawal process?') }}--}}
{{--                      @endif</h5>--}}
{{--                    <span class="right-icon"></span>--}}
{{--                  </div>--}}
{{--                  <div class="faq-content">--}}
{{--                    <p>--}}
{{--                      @if(canEditLang() && checkRequestOnEdit())--}}
{{--                        <editor_block data-name='Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.' contenteditable="true">{{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}</editor_block>--}}
{{--                      @else--}}
{{--                        {{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}--}}
{{--                      @endif--}}
{{--                    </p>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--                <div class="faq-item">--}}
{{--                  <div class="faq-title">--}}
{{--                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())--}}
{{--                        <editor_block data-name='What payment system can i use to withdraw?' contenteditable="true">{{ __('What payment system can i use to withdraw?') }}</editor_block>--}}
{{--                      @else--}}
{{--                        {{ __('What payment system can i use to withdraw?') }}--}}
{{--                      @endif</h5>--}}
{{--                    <span class="right-icon"></span>--}}
{{--                  </div>--}}
{{--                  <div class="faq-content">--}}
{{--                    <p>--}}
{{--                      @if(canEditLang() && checkRequestOnEdit())--}}
{{--                        <editor_block data-name='Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.' contenteditable="true">{{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}</editor_block>--}}
{{--                      @else--}}
{{--                        {{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}--}}
{{--                      @endif--}}
{{--                    </p>--}}
{{--                  </div>--}}
{{--                </div>--}}
              </div>
            </div>
            {{--            <div class="tab-item">--}}
            {{--              <div class="faq-wrapper">--}}
            {{--                <div class="faq-item">--}}
            {{--                  <div class="faq-title">--}}
            {{--                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='What is the minimum percentage that an investor can earn on Hyipland?' contenteditable="true">{{ __('What is the minimum percentage that an investor can earn on Hyipland?') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('What is the minimum percentage that an investor can earn on Hyipland?') }}--}}
            {{--                        @endif</h5>--}}
            {{--                    <span class="right-icon"></span>--}}
            {{--                  </div>--}}
            {{--                  <div class="faq-content">--}}
            {{--                    <p>--}}
            {{--                      @if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.' contenteditable="true">{{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}--}}
            {{--                        @endif--}}
            {{--                    </p>--}}
            {{--                  </div>--}}
            {{--                </div>--}}
            {{--                <div class="faq-item active open">--}}
            {{--                  <div class="faq-title">--}}
            {{--                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='Can i invest using cryptocurrency?' contenteditable="true">{{ __('Can i invest using cryptocurrency?') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('Can i invest using cryptocurrency?') }}--}}
            {{--                        @endif</h5>--}}
            {{--                    <span class="right-icon"></span>--}}
            {{--                  </div>--}}
            {{--                  <div class="faq-content">--}}
            {{--                    <p>--}}
            {{--                      @if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.' contenteditable="true">{{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}--}}
            {{--                        @endif--}}
            {{--                    </p>--}}
            {{--                  </div>--}}
            {{--                </div>--}}
            {{--                <div class="faq-item">--}}
            {{--                  <div class="faq-title">--}}
            {{--                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='What are the minimum and maximum deposit amounts?' contenteditable="true">{{ __('What are the minimum and maximum deposit amounts?') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('What are the minimum and maximum deposit amounts?') }}--}}
            {{--                        @endif</h5>--}}
            {{--                    <span class="right-icon"></span>--}}
            {{--                  </div>--}}
            {{--                  <div class="faq-content">--}}
            {{--                    <p>--}}
            {{--                      @if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.' contenteditable="true">{{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}--}}
            {{--                        @endif--}}
            {{--                    </p>--}}
            {{--                  </div>--}}
            {{--                </div>--}}
            {{--                <div class="faq-item">--}}
            {{--                  <div class="faq-title">--}}
            {{--                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='How long will the money arrive in my account after the withdrawal process?' contenteditable="true">{{ __('How long will the money arrive in my account after the withdrawal process?') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('How long will the money arrive in my account after the withdrawal process?') }}--}}
            {{--                        @endif</h5>--}}
            {{--                    <span class="right-icon"></span>--}}
            {{--                  </div>--}}
            {{--                  <div class="faq-content">--}}
            {{--                    <p>--}}
            {{--                      @if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.' contenteditable="true">{{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}--}}
            {{--                        @endif--}}
            {{--                    </p>--}}
            {{--                  </div>--}}
            {{--                </div>--}}
            {{--                <div class="faq-item">--}}
            {{--                  <div class="faq-title">--}}
            {{--                    <h5 class="title">@if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='What payment system can i use to withdraw?' contenteditable="true">{{ __('What payment system can i use to withdraw?') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('What payment system can i use to withdraw?') }}--}}
            {{--                        @endif</h5>--}}
            {{--                    <span class="right-icon"></span>--}}
            {{--                  </div>--}}
            {{--                  <div class="faq-content">--}}
            {{--                    <p>--}}
            {{--                      @if(canEditLang() && checkRequestOnEdit())--}}
            {{--                        <editor_block data-name='Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.' contenteditable="true">{{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}</editor_block>--}}
            {{--                      @else--}}
            {{--                        {{ __('Ea commodi eius nisi fugiat eligendi neque repellendus vero, aliquam temporibus, dicta optio eveniet saepe. Beatae hic fugiat qui possimus doloribus? Ratione, molestiae magnam.') }}--}}
            {{--                        @endif--}}
            {{--                    </p>--}}
            {{--                  </div>--}}
            {{--                </div>--}}
            {{--              </div>--}}
            {{--            </div>--}}
          </div>
        </div>
      </div>
    </section>
    <!--=======Feature-Section Ends Here=======-->

    <!-- ==========Footer-Section Starts Here========== -->
  @include('layouts.app-footer')
  <!-- ==========Footer-Section Ends Here========== -->


  </div>

@endsection
