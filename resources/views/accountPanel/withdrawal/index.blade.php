@extends('layouts.accountPanel.app')
@section('title', __('Dashboard'))
@section('content')
  
  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
      
      @if(!empty($wallets))
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5>Simple Pricing Card</h5>
              </div>
              <div class="card-body row pricing-content">
                <div class="mb-3">
                  @include('partials.inform')
                </div>
                @forelse($wallets as $item)
                  <div class="col-xl-3 col-sm-6 xl-50 box-col-6">
                    <form action="{{ route('accountPanel.withdrawal.add') }}" method="post">
                      <input type="hidden" name="wallet_id" value="{{ $item->id }}">
                      @csrf
                      <div class="card text-center pricing-simple">
                        <div class="card-body">
                          <h3>{{ $item->currency->name }}</h3>
                          <h1>{{ $item->balance ?? 0 }}{{ $item->currency->symbol }}</h1>
                          <h6 class="mb-2">Платёжная система</h6>
                          <p>{{ $item->paymentSystem->name }}</p>
{{--                          <h6 class="mb-2">Выберите платёжную систему</h6>--}}
{{--                          <select class="js-example-basic-single col-sm-12" name="payment_system">--}}
{{--                            @forelse($payment_systems as $payment_system)--}}
{{--                              <option value="{{ $payment_system->id }}">{{ $payment_system->name }}</option>--}}
{{--                            @empty--}}
{{--                            @endforelse--}}
{{--                          </select>--}}
                          <h6 class="mb-2 mt-2">Введите сумму</h6>
                          <div class="input-group">
                            <span class="input-group-text">{{ $item->currency->symbol }}</span>
                            <input class="form-control" type="text" name="amount">
                          </div>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block">Вывести</button>
                      </div>
                    </form>
                  </div>
                @empty
                @endforelse
              </div>
            </div>
          </div>
        
        </div>
      @endif
    
    </div>
  </div>
@endsection
@push('scripts')
  <script>
    $(document).ready(function (){
      $(".js-example-basic-single").select2();
    });
  </script>
@endpush
