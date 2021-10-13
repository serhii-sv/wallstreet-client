@extends('layouts.accountPanel.app')
@section('title', __('Replenishment'))
@section('content')
  
  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
      
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Детали пополнения</h5>
            </div>
            <div class="card-body">
              Текст про ручное пополнение
            </div>
          </div>
        </div>
      
      </div>
    
    
    </div>
  </div>
@endsection
@push('scripts')
  <script src="{{ asset('accountPanel/js/form-wizard/form-wizard-three.js') }}"></script>
  <script>
    $(document).ready(function () {
    
    });
  </script>
@endpush
