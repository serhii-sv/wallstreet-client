@extends('layouts.accountPanel.app')
@section('title', __('Все рефералы'))
@section('content')
  
  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
      @include('partials.inform')
      <div class="user-profile">
        <div class="row">
          <div id="chart-container"></div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('styles')
  <link href="{{ asset('css/orgChart.css') }}" rel="stylesheet">
  <style type="text/css">
      #chart-container {
          height: 620px;
      }
      .orgchart {
          background: transparent;
      }
  </style>
@endpush
@push('scripts')
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/jquery.orgchart.min.js') }}"></script>
  <script src="{{ asset('js/jquery.orgchart.min.js.map') }}"></script>
  
  <script>
    $(function() {
      var datascource = {!! json_encode($children) !!};
      var oc = $('#chart-container').orgchart({
    
        'data': datascource,
        'nodeContent': 'title',
        // 'ajaxURL': ajaxURLs,
        //   'toggleSiblingsResp': true,
        //'depth': 2,
      });
    });
  </script>
@endpush
