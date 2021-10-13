@extends('layouts.accountPanel.app')
@section('title', __('Withdrawal'))
@section('content')
  
  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
      
      @if(!empty($wallets))
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5>Заявка на пополнение</h5>
              </div>
              <div class="card-body">
                <form class="f1" action="{{ route('accountPanel.withdrawal.add') }}" method="post">
                  @csrf
                  @include('partials.inform')
                  <div class="f1-steps">
                    <div class="f1-progress">
                      <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66000000000001%;"></div>
                    </div>
                    <div class="f1-step active">
                      <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                      <p>Wallet</p>
                    </div>
                    <div class="f1-step">
                      <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                      <p>Payment System</p>
                    </div>
                  </div>
                  <fieldset style="display: block;">
                    <div class="mb-3">
                      <label class="form-label" for="exampleFormControlSelect9">Wallet</label>
                      <select class="form-select digits" name="wallet_id" id="exampleFormControlSelect9">
                        @forelse($wallets as $item)
                          <option value="{{ $item->id }}">{{ $item->currency->name }} {{ $item->currency->symbol }}</option>
                        @empty
                          <option value="" disabled>Нет кошельков</option>
                        @endforelse
                      </select>
                    </div>
                    <div class="f1-buttons">
                      <button class="btn btn-primary btn-next" type="button" data-bs-original-title="" title="">Next</button>
                    </div>
                  </fieldset>
                  <fieldset style="display: none;">
                    <div class="mb-3">
                      <label class="form-label" for="exampleFormControlSelect11">Payment System</label>
                      <select class="form-select digits" name="payment_system_id" id="exampleFormControlSelect11">
                        @forelse($payment_systems as $item)
                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @empty
                          <option value="" disabled>Нет платёжных систем</option>
                        @endforelse
                      </select>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" >Amount</label>
                      <input class="form-control" type="text" name="amount" placeholder="" data-bs-original-title="" title="">
                    </div>
                    <div class="f1-buttons">
                      <button class="btn btn-primary btn-previous" type="button" data-bs-original-title="" title="">Previous</button>
                      <button class="btn btn-primary btn-submit" type="submit" data-bs-original-title="" title="">Submit</button>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
          
         {{-- <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5>List of wallets </h5>
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
                          <h6 class="mb-2">Выберите платёжную систему</h6>
                          <select class="js-example-basic-single col-sm-12" name="wallet_detail">
                            @php($i = 0)
                            @forelse($item->currency->paymentSystems()->get() as $payment_system)
                              @if($item->detail(auth()->user()->id, $payment_system->id)->first() !== null)
                                @php($i++)
                                <option value="{{ $item->detail(auth()->user()->id, $payment_system->id)->first()->id }}">{{ $payment_system->name }}</option>
                              @else
                              @endif
                              @if($loop->last && $i == 0)
                                  <option value="" disabled>Введите реквизиты для вывода</option>
                                @endif
                            @empty
                              <option value="" disabled>Нет платёжной системы</option>
                            @endforelse
                          </select>
                          --}}{{--<p>{{ $item->paymentSystem->name }}</p>--}}{{--
                          --}}{{--                          <h6 class="mb-2">Выберите платёжную систему</h6>--}}{{--
                          --}}{{--                          <select class="js-example-basic-single col-sm-12" name="payment_system">--}}{{--
                          --}}{{--                            @forelse($payment_systems as $payment_system)--}}{{--
                          --}}{{--                              <option value="{{ $payment_system->id }}">{{ $payment_system->name }}</option>--}}{{--
                          --}}{{--                            @empty--}}{{--
                          --}}{{--                            @endforelse--}}{{--
                          --}}{{--                          </select>--}}{{--
                          <h6 class="mb-2 mt-2">Введите сумму</h6>
                          <div class="input-group">
                            <span class="input-group-text">{{ $item->currency->symbol ?? '' }}</span>
                            <input class="form-control" type="text" name="amount">
                          </div>
                          <div>
                            Комиссия 1$
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
          </div>--}}
        
        </div>
      @endif
    
    </div>
  </div>
@endsection
@push('scripts')
  <script src="{{ asset('accountPanel/js/form-wizard/form-wizard-three.js') }}"></script>
  <script>
    $(document).ready(function () {
      $(".js-example-basic-single").select2();
    });
  </script>
@endpush
