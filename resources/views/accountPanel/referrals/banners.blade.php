@extends('layouts.accountPanel.app')
@section('title', __('Все баннеры'))
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
                @dump( route('get.banner', $banner->id))
                <img src="{{ route('get.banner', $banner->id) }}" width="{{ $banner->getWidth() ?? 0 }}" height="{{ $banner->getHeight() ?? 0 }}">
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
