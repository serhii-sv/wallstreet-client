@extends('layouts.app')
@section('title', __('Contacts'))
@section('content')
  <div class="main--body section-bg">
    <!--========== Preloader ==========-->
 {{-- @include('layouts.app-preloader')--}}
  <!--========== Preloader ==========-->


    <!--=======Header-Section Starts Here=======-->
  @include('layouts.app-header')
  <!--=======Header-Section Ends Here=======-->


    <!--=======Banner-Section Starts Here=======-->
    <section class="bg_img hero-section-2 left-bottom-lg-max" data-background="{{ asset('theme/images/about/hero-bg5.png') }}">
      <div class="container">
        <div class="hero-content text-white">
          <h1 class="title">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Contact' contenteditable="true">{{ __('Contact') }}</editor_block>
            @else
              {{ __('Contact') }}
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
                <editor_block data-name='Contact' contenteditable="true">{{ __('Contact') }}</editor_block>
              @else
                {{ __('Contact') }}
              @endif
            </li>
          </ul>
        </div>
      </div>
    </section>
    <!--=======Banner-Section Ends Here=======-->


    <!--=======Contact-Section Starts Here=======-->
    <section class="contact-section padding-bottom padding-top">
      <div class="container">
        <div class="contact-wrapper padding-top">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-xl-4 offset-xl-1">
              <div class="contact-header">
                <h2 class="title">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Get in touch' contenteditable="true">{{ __('Get in touch') }}</editor_block>
                  @else
                    {{ __('Get in touch') }}
                    @endif</h2>
                <p>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Ready to make life easier?' contenteditable="true">{{ __('Ready to make life easier?') }}</editor_block>
                  @else
                    {{ __('Ready to make life easier?') }}
                    @endif</p>
              </div>
              <div class="contact-content">
                <h3 class="title">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Have questions?' contenteditable="true">{{ __('Have questions?') }}</editor_block>
                  @else
                    {{ __('Have questions?') }}
                    @endif</h3>
                <p>
                  @if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Have questions about payments or price plans? We have answers!' contenteditable="true">{{ __('Have questions about payments or price plans? We have answers!') }}</editor_block>
                  @else
                    {{ __('Have questions about payments or price plans? We have answers!') }}
                    @endif
                </p>
                <a href="{{ route('customer.faq') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Read F.A.Q' contenteditable="true">{{ __('Read F.A.Q') }}</editor_block>
                  @else
                    {{ __('Read F.A.Q') }}
                    @endif <i class="flaticon-right-arrow"></i></a>
              </div>
            </div>
            <div class="col-lg-5 offset-xl-1">
              <form class="contact-form" id="contact_form_submit">
                <div class="form-group">
                  <label for="name">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='First name' contenteditable="true">{{ __('First name') }}</editor_block>
                    @else
                      {{ __('First name') }}
                      @endif</label>
                  <input type="text" id="name" placeholder="Иван" name="name">
                </div>
                <div class="form-group">
                  <label for="surename">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Last name' contenteditable="true">{{ __('Last name') }}</editor_block>
                    @else
                      {{ __('Last name') }}
                      @endif</label>
                  <input type="text" id="surname" placeholder="Иванов" name="surname">
                </div>
                <div class="form-group">
                  <label for="email">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Email address' contenteditable="true">{{ __('Email address') }}</editor_block>
                    @else
                      {{ __('Email') }}
                      @endif</label>
                  <input type="text" id="email" placeholder="ivanov@gmail.com" name="email">
                </div>
                <div class="form-group">
                  <label for="message">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='How can we help' contenteditable="true">{{ __('How can we help') }}</editor_block>
                    @else
                      {{ __('How can we help') }}
                      @endif</label>
                  <textarea name="message" id="message" placeholder="Здравствуйте, у меня такой вопрос ...."></textarea>
                </div>
                <div class="form-group">
                  <input type="submit" value="Отправить сообщение">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--=======Contact-Section Ends Here=======-->


    <!-- ==========Footer-Section Starts Here========== -->
  @include('layouts.app-footer')
  <!-- ==========Footer-Section Ends Here========== -->


  </div>
@endsection
