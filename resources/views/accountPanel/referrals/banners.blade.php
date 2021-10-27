@extends('layouts.accountPanel.app')
@section('title')
  @if(canEditLang() && checkRequestOnEdit())
    <editor_block data-name='All banners page' contenteditable="true">{{ __('All banners page') }}</editor_block>
  @else
    {{ __('All banners page') }}
  @endif
@endsection
@section('content')
  
  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
      @include('partials.inform')
      
      
      <div class="col-xl-12">
        <div class="card">
          <div class="card-body">
            @forelse($banners as $banner)
              <div class="mb-3">
              @if($banner->image)
                <img style="max-width: 100%" src="{{ route('get.banner', $banner->id) }}" @if($banner->getWidth()) width="{{ $banner->getWidth() }}" @endif @if( $banner->getHeight()) height="{{  $banner->getHeight() }}" @endif >
              @endif
              </div>
            @empty
            @endforelse
          </div>
        </div>
      </div>
    
    </div>
  </div>
@endsection
@push('scripts')
  <script>
  
  </script>
@endpush
