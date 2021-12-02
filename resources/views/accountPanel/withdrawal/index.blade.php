@extends('layouts.accountPanel.app')
@section('title')
Withdrawals
@endsection
@section('content')

    <style>
        .shake {
            animation: shake 0.82s cubic-bezier(.36, .07, .19, .97) both infinite;
            transform: translate3d(0, 0, 0);
            backface-visibility: hidden;
            perspective: 1000px;
        }

        @keyframes shake {
            10%,
            90% {
                transform: translate3d(-1px, 0, 0);
            }
            20%,
            80% {
                transform: translate3d(2px, 0, 0);
            }
            30%,
            50%,
            70% {
                transform: translate3d(-4px, 0, 0);
            }
            40%,
            60% {
                transform: translate3d(4px, 0, 0);
            }
        }
    </style>

  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">

      @if(!empty($wallets))
        <div class="row" style="margin-top: 50px;">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5 style="text-align: center;text-transform: none;">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='List of wallets' contenteditable="true">{{ __('List of wallets') }}</editor_block> @else {{ __('List of wallets') }} @endif
                </h5>
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
                          <h6 class="mb-2 shake" style="color:green;">@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='Choose wallet' contenteditable="true">{{ __('Choose wallet') }}</editor_block> @else {{ __('Choose wallet') }} @endif
                          </h6>
                          <select class="js-example-basic-single col-sm-12" name="wallet_id">
                              <?php
                              /** @var \App\Models\Currency $currency */
                              $currency = $item->currency;
                              $walletName = $currency->name;
                              ?>
                            @if($item->external !== null)
                                <?php
                                  if ($currency->code == 'USD') {
                                      $walletName = 'PerfectMoney';
                                  } elseif ($currency->code == 'UAH') {
                                      $walletName = 'UAH VISA/MASTERCARD';
                                  } elseif ($currency->code == 'RUB') {
                                      $walletName = 'RUB VISA/MASTERCARD';
                                  } elseif ($currency->code == 'KZT') {
                                      $walletName = 'KZT VISA/MASTERCARD';
                                  } elseif ($currency->code == 'EUR') {
                                      $walletName = 'EUR VISA/MASTERCARD';
                                  }
                                ?>
                              <option value="{{ $item->id }}">{{ $walletName }} {{ strtoupper($item->external) }}</option>
                            @else
                                  @if($currency->code != 'USD' && $currency->code != 'RUB')
                              <option value="" disabled>Введите реквизиты для вывода в настройках</option>
                                  @endif
                            @endif
                            @if($currency->code == 'USD')
                                <option value="payeer:{{ $item->id }}">Payeer {{ strtoupper($item->external_payeer) }}</option>
                            @endif
                            @if($currency->code == 'RUB')
                                <option value="qiwi:{{ $item->id }}">Qiwi {{ strtoupper($item->external_qiwi) }}</option>
                            @endif
                          </select>
                          <h6 class="mb-2 mt-2" style="color:green;">@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='Enter the amount' contenteditable="true">{{ __('Enter the amount') }}</editor_block> @else {{ __('Enter the amount') }} @endif
                          </h6>
                          <div class="input-group">
                            <span class="input-group-text">{{ $item->currency->symbol ?? '' }}</span>
                            <input class="form-control" type="text" name="amount">
                          </div>
                          <div style="margin-top:30px;">
                            @if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='Withdraw commission 0%' contenteditable="true">{{ __('Withdraw commission 0%') }}</editor_block> @else {{ __('Withdraw commission 0%') }} @endif
                          </div>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='To withdraw' contenteditable="true">{{ __('To withdraw') }}</editor_block> @else {{ __('To withdraw') }} @endif
                        </button>
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
@push('styles')
  <style>
      .item-list-wrapper {
          display: flex;
          flex-wrap: wrap;
      }

      .payment-system-radio {
          position: absolute;
          left: -9999px;
          top: -9999px;
          opacity: 0;
          pointer-events: none;
      }

      .payment-system-radio:checked ~ .payment-system-item {
          border: 3px solid #0082ff;
          -webkit-box-shadow: 0 7px 15px 0 rgba(0, 0, 0, 0.1);
          -moz-box-shadow: 0 7px 15px 0 rgba(0, 0, 0, 0.1);
          box-shadow: 0 7px 15px 0 rgba(0, 0, 0, 0.1);
      }

      .payment-system-item {
          padding: 15px;
          -webkit-transition: .1s ease;
          -moz-transition: .1s ease;
          -ms-transition: .1s ease;
          -o-transition: .1s ease;
          transition: .1s ease;
          width: 200px;
          height: 220px;
          margin: 15px;
          cursor: pointer;
          border: 3px solid #e4e4e4;
          -webkit-border-radius: 5px;
          -moz-border-radius: 5px;
          border-radius: 5px;
      }

      .payment-system-item span {
          text-align: center;
      }

      .payment-system-item img {
          width: 100%;
      }
  </style>
@endpush
@push('scripts')
  <script src="{{ asset('accountPanel/js/form-wizard/form-wizard-three.js') }}"></script>
  <script>
    $(document).ready(function () {
      $(".js-example-basic-single").select2();
    });
  </script>
@endpush
