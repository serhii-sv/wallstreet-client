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
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='News list' contenteditable="true">{{ __('News list') }}</editor_block>
                @else
                  {{ __('News list') }}
                @endif
              </h2>
              <p>
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='News list sub title' contenteditable="true">{{ __('News list sub title') }}</editor_block>
                @else
                  {{ __('News list sub title') }}
                @endif
              </p>
            </div>
            <style>
                .news-main-wrapper {
                    display: flex;
                    margin: 0 -15px 15px;
                }

                .news-video-block {
                    margin: 15px;
                    width: calc((100% / 3) * 2 - 15px);
                }

                .news-video-block iframe {
                    width: 100%;
                    min-height: 300px;
                }
            </style>
            <div class="news-main-wrapper mb-2">
              <div class="news-video-block">
                <iframe src="https://www.youtube.com/embed/ARD90AFqnDE" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
              @if($last_news)
                <a href="{{ route('customer.news', $last_news->id) }}" class="news-block">
                  <div class="image ">
                    @if($last_news->image)
                      <img src="{{ \Illuminate\Support\Facades\Storage::disk('do_spaces')->url($last_news->image) }}" alt="">
                    @endif
                  </div>
                  <div class="short-content">
                    <div class="title">
                      {!! $last_news->getTitle(session()->get('language'))  !!}
                    </div>
                    <div class="desc">
                      {!!  Str::limit($last_news->getShortContent(session()->get('language')), 100, '..' )  !!}
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                      <div class="likes d-flex align-items-center">
                        <i data-feather="thumbs-up" class="mr-2"></i>
                        {{ $last_news->likes ?? 0}}
                      </div>
                      <div class="views d-flex align-items-center">
                        <i data-feather="eye" class="mr-2"></i>
                        {{ $last_news->views ?? 0}}
                      </div>
                    </div>
                  </div>
                </a>
              @endif
            </div>

          </div>

          <div class="news-list w-100 d-flex flex-wrap mb-4">
            @if($news)
              @forelse($news as $item)
                <a href="{{ route('customer.news', $item->id) }}" class="news-block">
                  <div class="image ">
                    @if($item->image)
                      <img src="{{ \Illuminate\Support\Facades\Storage::disk('do_spaces')->url($item->image) }}" alt="">
                    @endif
                  </div>
                  <div class="short-content">
                    <div class="title">
                      {!! $item->getTitle(session()->get('language'))  !!}
                    </div>
                    <div class="desc">
                      {!!  Str::limit($item->getShortContent(session()->get('language')), 100, '..' )  !!}
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                      <div class="likes d-flex align-items-center">
                        <i data-feather="thumbs-up" class="mr-2"></i>
                        {{ $item->likes ?? 0}}
                      </div>
                      <div class="views d-flex align-items-center">
                        <i data-feather="eye" class="mr-2"></i>
                        {{ $item->views ?? 0}}
                      </div>
                    </div>
                  </div>
                </a>
              @empty
              @endforelse
            @endif
          </div>
          <div class="d-flex justify-content-center">
            {{ $news->links() }}
          </div>
        </div>
      </div>
  </div>
  </section>
  <!--=======Proit-Section Ends Here=======-->


  <!-- ==========Footer-Section Starts Here========== -->
  @include('layouts.app-footer')
  <!-- ==========Footer-Section Ends Here========== -->
  </div>
@endsection
