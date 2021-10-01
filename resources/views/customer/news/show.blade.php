@extends('layouts.app')
@section('title', __('News'))
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
    @include('layouts.app-preloader')
    <!--========== Preloader ==========-->

        <!--=======Header-Section Starts Here=======-->
    @include('layouts.app-header')
    <!--=======Header-Section Ends Here=======-->


        <!--=======Proit-Section Starts Here=======-->
        <section class="profit-section padding-top mb-5" id="profit">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-xl-12">
                        <div class="section-header">
                            <h2 class="title">
                                {{ $news->getTitle(session()->get('lang')) }}
                            </h2>
                        </div>
                        <div class="news-image text-center img-fluid mb-5">
                            @if($news->image)
                                <img src="{{ \Illuminate\Support\Facades\Storage::disk('do_spaces')->url($news->image) }}" alt="">
                            @endif
                        </div>
                        <div class="news-content">
                            {!!   $news->getContent(session()->get('lang')) !!}
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!--=======Proit-Section Ends Here=======-->

        <style>

        </style>

        <!-- ==========Footer-Section Starts Here========== -->
    @include('layouts.app-footer')
    <!-- ==========Footer-Section Ends Here========== -->
    </div>
@endsection
