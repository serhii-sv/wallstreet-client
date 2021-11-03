@extends('layouts.app')
@section('title', __('Agreement title'))
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
                            <editor_block data-name='Agreement title 2' contenteditable="true">{{ __('Agreement title 2') }}</editor_block>
                        @else
                            {{ __('Agreement title 2') }}
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
                                <editor_block data-name='Agreement link' contenteditable="true">{{ __('Agreement link') }}</editor_block>
                            @else
                                {{ __('Agreement link') }}
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
                <h2 class="page-title page-title--line">
                    @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Agreement title' contenteditable="true">{{ __('Agreement title') }}</editor_block>
                    @else
                        {{ __('Agreement title') }}
                    @endif
                </h2>
                <div class="text" style="margin-top:50px;">
                    <p>
                        @if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Agreement text' contenteditable="true">{{ __('Agreement text') }}</editor_block>
                        @else
                            {{ __('Agreement text') }}
                        @endif
                    </p>
                </div>
            </div>
        </section>
        <!--=======Feature-Section Ends Here=======-->

        <!-- ==========Footer-Section Starts Here========== -->
    @include('layouts.app-footer')
    <!-- ==========Footer-Section Ends Here========== -->


    </div>

@endsection
