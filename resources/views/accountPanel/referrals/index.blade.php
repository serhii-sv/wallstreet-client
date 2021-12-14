@extends('layouts.accountPanel.app')
@section('title')
Referrals page
@endsection
@section('content')

  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
      @include('partials.inform')



      <div class="col-xl-12">
        <div class="card">
          <div class="card-body">
            <div class="best-seller-table responsive-tbl">
              <div class="item">
                <div class="table-responsive product-list">



                </div>
              </div>
            </div>
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
