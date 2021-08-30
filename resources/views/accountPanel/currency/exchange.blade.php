@extends('layouts.accountPanel.app')
@section('title', __('Обмен валют'))
@section('title.show', 'd-none')
@section('content')
  
  <div class="container-fluid">
    <div class="row second-chart-list third-news-update justify-content-center">
      <div class="card">
        <div class="card-block row">
          <div class="col-12">
  
          </div>
        </div>
      </div>
      
      <div class="col-xl-10 risk-col xl-100 box-col-12">
        <div class="card total-users">
          <div class="card-header card-no-border">
            <h5 class="text-center">Обмен валют</h5>
            <h6 class="font-primary text-center mb-0 mt-3">Комиссия 1$</h6>
            <div class="text-center mt-4">
              @include('partials.inform')
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="apex-chart-container goal-status text-center ">
              <form action="{{ route('accountPanel.currency.exchange') }}" method="post" class="row">
                @csrf
                <div class="rate-card col-xl-12">
                  <div class="goal-end-point">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="mb-2">
                          <div class="col-form-label">Выберите первый кошелёк</div>
                          <select class="exchange-first-wallet js-example-basic-single col-sm-12 select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="wallet_from">
                            <option value="" hidden selected disabled>Выбрать</option>
                            @forelse($wallets as $wallet)
                              <option value="{{ $wallet->id }}"
                                  data-id="{{ $wallet->id }}"
                                  data-prefix="{{ $wallet->currency->symbol }}"
                                  data-step="{{ $wallet->currency->precision }}"
                                  data-max="{{ $wallet->balance }}">
                                {{ $wallet->currency->name ?? '' }} - {{ $wallet->balance ?? '' }} {{ $wallet->currency->symbol ?? '' }}</option>
                            @empty
                              <option value="" disabled>Кошельки отсутствуют</option>
                            @endforelse
                          </select>
                        </div>
                      </div>
                      
                      <div class="col-lg">
                        <div class="mb-2">
                          <div class="col-form-label">Выберите второй кошелёк</div>
                          <select class="exchange-second-wallet js-example-basic-single col-sm-12 select2-hidden-accessible" tabindex="-1" aria-hidden="true" name="wallet_to">
                            <option value="" hidden selected disabled>Выбрать</option>
                            @forelse($wallets as $wallet)
                              <option value="{{ $wallet->id }}" data-id="{{ $wallet->id }}">{{ $wallet->currency->name ?? '' }} -
                                <strong>{{ $wallet->balance ?? '' }} {{ $wallet->currency->symbol ?? '' }}</option>
                            @empty
                              <option value="" disabled>Кошельки отсутствуют</option>
                            @endforelse
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                <ul class="col-xl-12">
                  <li>
                    <div class="form-group row">
                     {{-- <label class="col-md-12 control-label sm-left-text" for="u-range-02">Сколько хотите обменять?</label>--}}
                      <div class="col">
                        <label class="form-label">Сколько хотите обменять?</label>
                        <div class="input-group mb-3">
                          <span class="input-group-text currency-symbol">?</span>
                          <input class="form-control" type="text" name="amount" value="{{ old('amount') ?? '' }}" placeholder="0.1">
                        </div>
                      </div>
                      {{--<div class="col-md-12">
                        <input id="u-range-02" type="hidden" class="irs-hidden-input" tabindex="-1" readonly="" data-bs-original-title="" title="">
                      </div>--}}
                    </div>
                  </li>
                  <li>
                    <button class="btn-download btn btn-gradient f-w-500">Обменять</button>
                  </li>
                </ul>
              </form>
            </div>
          
          </div>
        </div>
      </div>
    
    </div>
  </div>
@endsection
{{--@push('styles')
  <link rel="stylesheet" href="{{ asset('accountPanel/css/vendors/range-slider.css') }}">
@endpush--}}
@push('scripts')
{{--  <script src="{{ asset('accountPanel/js/range-slider/ion.rangeSlider.min.js') }}"></script>
  <script>
    var range_slider_custom = {
      init: function () {
        $("#u-range-02").ionRangeSlider({
          min: 0,
          step: 0.00001,
          max: 0,
          prefix: '0',
          prettify_separator: '',
          from: 0
        })
      }
    };
    (function ($) {
      "use strict";
      range_slider_custom.init();
    })(jQuery);
  </script>--}}

  <script>
    $(document).ready(function () {
      var $deleted = '';
      $("body").on('change', '.exchange-first-wallet', function (e) {
        var $id = $(this).val();
        if ($deleted) {
          $(".exchange-second-wallet").append($deleted);
        }
      /*  var $step;
        var $prefix = $(this).find('option:selected').attr('data-prefix');
        var $precision = parseInt($(this).find('option:selected').attr('data-step'));
        if ($precision > 2){
          $step = 0.00001
        }else{
          $step = 1
        }
        var $max = $(this).find('option:selected').attr('data-max');
        $("#u-range-02").data("ionRangeSlider").update({
          prefix: $prefix + " ",
          step: $step,
          max: $max
        });
        */
        var $prefix = $(this).find('option:selected').attr('data-prefix');
        $(".currency-symbol").text($prefix);
        $deleted = $(".exchange-second-wallet option[data-id='" + $id + "']");
        $(".exchange-second-wallet option[data-id='" + $id + "']").remove();
        
      })
    });
  </script>
@endpush
