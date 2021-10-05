@extends('layouts.accountPanel.app')
@section('title', __('Обмен валют'))
@section('title.show', 'd-none')
@section('content')
  
  <div class="container-fluid">
    <div class="row second-chart-list third-news-update justify-content-center">
      <div class="card">
        <div class="card-block row">
          <div class="col-12">
            <div class="donut-chart-widget">
              <div class="card">
                <div class="card-header">
                  <h5>Курс Sprint Token'а</h5>
                  <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                      <li><i class="fa fa-spin fa-cog"></i></li>
                      <li><i class="view-html fa fa-code"></i></li>
                      <li><i class="icofont icofont-maximize full-card"></i></li>
                      <li><i class="icofont icofont-minus minimize-card"></i></li>
                      <li><i class="icofont icofont-refresh reload-card"></i></li>
                      <li><i class="icofont icofont-error close-card"></i></li>
                    </ul>
                  </div>
                </div>
                <div class="card-body">
                  <div id="chart-widget13"></div>
                </div>
              </div>
            </div>
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
  <script src="{{ asset('accountPanel/js/chart/apex-chart/apex-chart.js') }}"></script>
  <script src="{{ asset('accountPanel/js/chart/apex-chart/stock-prices.js') }}"></script>
  <script src="{{ asset('accountPanel/js/chart/apex-chart/chart-custom.js') }}"></script>
  @if($exchange_rate_log)
    
    <script>
      $(document).ready(function () {
        // browser-candlestick chart
        var optionscandlestickchart = {
          chart: {
            toolbar: {
              show: false
            },
            height: 500,
            type: 'candlestick',
          },
          plotOptions: {
            candlestick: {
              colors: {
                upward: CubaAdminConfig.primary,
                downward: CubaAdminConfig.secondary
              }
            }
          },
          fill: {
            opacity: 0.9,
            colors: ['#7366ff'],
          },
          tooltip:{
            enabled: true,
            x: {
              show: true,
              format: 'HH:mm:ss',
              formatter: undefined,
            },
          },
          series: [{
            data: [@foreach($exchange_rate_log as $item){
              x: new Date({{ $item->date }}000),
              y: [{{ $item->old_rate }}, {{ $item->old_rate > $item->new_rate ? $item->old_rate : $item->new_rate }}, {{ $item->old_rate < $item->new_rate ? $item->old_rate : $item->new_rate }}, {{ $item->new_rate }}]
            },
              @endforeach
              /*{
                x: new Date(1538780400000),
                y: [6, 6, 1, 1]
              },
              {
                x: new Date(1538782200000),
                y: [1, 7, 1, 7]
              },
              {
                x: new Date(1538783400000),
                y: [7, 4, 7, 4]
              },
              {
                x: new Date(1538784200000),
                y: [4, 9, 4, 9]
              },*/
            ]
          }],
          title: {
            text: 'last 40',
            align: 'left'
          },
          xaxis: {
            type: 'datetime',
            labels: {
              show: true,
              datetimeFormatter: {
                year: 'yyyy',
                month: "MMM 'yy",
                day: 'dd MMM',
                hour: 'HH:mm',
              },
            }
          },
          yaxis: {
            tooltip: {
              enabled: true
            }
          }
        }
        
        var chartcandlestickchart = new ApexCharts(
            document.querySelector("#chart-widget13"),
            optionscandlestickchart
        );
        chartcandlestickchart.render();
      });
    </script>
  @endif
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
