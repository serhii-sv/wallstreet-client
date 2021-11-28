@extends('layouts.accountPanel.app')
@section('title', 'Deposits page')
@section('content')

  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
      <div class="card">
        <div class="card-header">
          <h5>Всего депозитов: {{ $deposits_count ?? 0 }}</h5>
          <a href="{{ route('accountPanel.deposits.create') }}" class="mt-3 btn btn-success">Сделать депозит</a>
        </div>
        <div class="card-block row"  style="margin-top:50px;">
          <div class="col-12">
            @include('partials.inform')
          </div>
          <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="table-responsive">
              <table class="table">
                <thead class="bg-primary">
                  <tr>
                    <th scope="col">Тарифный план</th>
                    <th scope="col">Валюта</th>
                    <th scope="col">Сумма депозита</th>
                    <th scope="col">Начислено</th>
                    <th scope="col">Дата открытия</th>
                    <th>Реинвестирование</th>
                    <th>Пополнить</th>
                    <th>Апгрейд</th>
                  </tr>
                </thead>
                <tbody>
                  @if($deposits !== null)
                    @foreach($deposits as $deposit)
                      {{--@if($group->id == $deposit->rate->rate_group_id)--}}
                      <tr style="vertical-align: middle;">
                        <td>
                          {{ $deposit->rate->name }}
                        </td>
                        <td>{{ $deposit->currency->name }}</td>
                        <td>{{ number_format($deposit->balance, $deposit->currency->precision, '.', ',') ?? 0 }} {{ $deposit->currency->symbol }}</td>
                        <th scope="col">{{number_format($deposit->total_assessed(), $deposit->currency->precision, '.', ',') ?? 0 }} {{ $deposit->currency->symbol }}</th>
                        <td>{{ $deposit->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            @if($deposit->rate->reinvest)
                          <form action="{{ route('accountPanel.deposits.set.reinvest') }}" method="post">
                            @csrf
                            <input type="hidden" name="deposit_id" value="{{ $deposit->id }}">
                            <label class="col-md-12 col-form-label sm-left-text" for="u-range-{{ $deposit->id }}">Процент реинвестирования</label>
                            <div class="col-md-12 text-center">
                              <input id="u-range-{{ $deposit->id }}" type="hidden" class="irs-hidden-input deposit-range-slider @if(!$deposit->rate->reinvest) disable @endif" tabindex="-1" name="reinvest" readonly="" data-bs-original-title="" title="">
                            </div>
                            <div class="text-center">
                              <button class="btn btn-pill btn-success btn-air-success btn-sm mt-2 @if(!$deposit->rate->reinvest) disabled @endif">Применить</button>
                            </div>
                          </form>
                          @push('scripts')
                            <script>
                              $(document).ready(function () {
                                if ($("#u-range-{{ $deposit->id }}").hasClass('disable')) {
                                  $("#u-range-{{ $deposit->id }}").ionRangeSlider({
                                    min: 0,
                                    max: 100,
                                    from: {{ $deposit->reinvest }},
                                    disable: true,
                                    postfix: "%"
                                  })
                                } else {
                                  $("#u-range-{{ $deposit->id }}").ionRangeSlider({
                                    min: 0,
                                    max: 100,
                                    from: {{ $deposit->reinvest }},
                                    postfix: "%"
                                  })
                                }
                              });
                            </script>
                          @endpush
                                @endif
                        </td>
                        <td>
                            @if($deposit->rate->reinvest)
                          <form action="{{ route('accountPanel.deposits.add.balance') }}" method="post">
                            @csrf
                            <input type="hidden" name="deposit_id" value="{{ $deposit->id }}">
                            <input type="hidden" name="wallet_id" value="{{ $deposit->wallet->id }}">
                            <div class="text-center">
                              Баланс: {{ $deposit->wallet->balance }} {{ $deposit->currency->symbol }}
                            </div>
                            <div class="text-center">
                              <input class="form-control input-air-primary" id="" type="text" placeholder="" name="amount" data-bs-original-title="" title="">
                            </div>
                            <div class="text-center">
                              <button class="btn btn-pill btn-success btn-air-success btn-sm mt-2">Пополнить</button>
                            </div>
                          </form>
                        </td>
                        <td>
                          @if($deposit->canUpdate())
                            <div class="text-center">Средств достаточно для апгрейда</div>
                            <form action="{{ route('accountPanel.deposits.upgrade') }}" method="post">
                              @csrf
                              <input type="hidden" name="deposit_id" value="{{ $deposit->id }}">
                              <div class="text-center">
                                <button class="btn btn-pill btn-success btn-air-success btn-sm mt-2">Апгрейд</button>
                              </div>
                            </form>
                          @else
                          @endif
                            
                            @endif
                        </td>
                      </tr>
                      {{--@endif--}}
                    @endforeach
                  @else
                    <tr>
                      <td class="p-0" colspan="6">
                        <div class="alert alert-light inverse alert-dismissible fade show" role="alert">
                          <i class="icon-alert txt-dark"></i>
                          <p style="font-size: 16px;">Депозитов нет</p>
                        </div>
                      </td>
                    </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>


      <div>
        {{ $deposits->appends(request()->except('page'))->links() }}
      </div>

    </div>
  </div>
@endsection
@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/vendors/range-slider.css') }}">
@endpush
@push('scripts')
  <script src="{{ asset('accountPanel/js/range-slider/ion.rangeSlider.min.js') }}"></script>
  <script src="{{ asset('accountPanel/js/range-slider/rangeslider-script.js') }}"></script>
  <script>

  </script>
@endpush
