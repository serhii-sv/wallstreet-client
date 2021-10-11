@extends('layouts.accountPanel.app')
@section('title', __('Сделать депозит'))

@section('content')
  
  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
      
      @if(!empty($rates))
        <div class="row">
          <div class="card height-equal">
            <div class="card-header pb-3">
              <h5>{{ __('Create deposit') }}</h5>
            </div>
            <div class="card-body pt-3">
              <div class="mb-3">
                @include('partials.inform')
              </div>
              <ul class="nav nav-dark mb-3" id="pills-darktab" role="tablist">
                @forelse($deposit_groups as $group)
                  <li class="nav-item">
                    <a class="nav-link @if($loop->first) active @endif" id="pills-{{ $group->id }}-tab" data-bs-toggle="pill" href="#pills-{{ $group->id }}" role="tab" aria-controls="pills-{{ $group->id }}" aria-selected="false" data-bs-original-title="" title="">
                      {{ $group->name }}
                    </a>
                  </li>
                @empty
                @endforelse
              </ul>
              <div class="tab-content" id="pills-darktabContent">
                @forelse($deposit_groups as $group)
                  <div class="tab-pane fade @if($loop->first) active show @endif" id="pills-{{ $group->id }}" role="tabpanel" aria-labelledby="pills-{{ $group->id }}-tab">
                    <div class="row">
                      @forelse($rates as $item)
                        @if($item->rate_group_id == $group->id)
                          <div class="col-xl-3 col-sm-6 xl-50 box-col-6">
                            <form action="{{ route('accountPanel.deposits.store') }}" class="create-deposit-form" method="post">
                              <input type="hidden" name="rate_id" value="{{ $item->id }}">
                              @csrf
                              <div class="card text-center pricing-simple">
                                <div class="card-body">
                                  <h3>{{ $item->name }}</h3>
                                  <h5>В день {{ $item->daily }}%</h5>
                                  <h6>Длительность: {{ $item->duration }} дней</h6>
                                  
                                  <h6>Реинвестирование</h6>
                                  <div class="form-group row">
                                    <label class="col-md-12 col-form-label sm-left-text" for="u-range-{{ $item->id }}">Процент реинвестирования</label>
                                    <div class="col-md-12">
                                      <input id="u-range-{{ $item->id }}" type="hidden" class="irs-hidden-input range-slider @if(!$item->reinvest) disable @endif" tabindex="-1" name="reinvest" readonly="" data-bs-original-title="" title="">
                                    </div>
                                  </div>
                                  <h6>
                                    <span class="span badge rounded-pill pill-badge-primary">
                                      {{ $item->overall ? 'Возврат депозита: ' . $item->overall . '% в конце срока' : 'Депозит не возвращается' }}
                                    </span>
                                  </h6>
                                  <h4 class="mb-2">Можно внести </h4>
                                  <p style="font-size: 15px;">от
                                    <strong>{{ number_format($item->min, 2,'.',',') }}$</strong> до
                                    <strong>{{ number_format($item->max, 2,'.',' ') }}$</strong></p>
                                  {{--                          <h6 class="mb-2">Выберите платёжную систему</h6>--}}
                                  {{--                          <select class="js-example-basic-single col-sm-12" name="payment_system">--}}
                                  {{--                            @forelse($payment_systems as $payment_system)--}}
                                  {{--                              <option value="{{ $payment_system->id }}">{{ $payment_system->name }}</option>--}}
                                  {{--                            @empty--}}
                                  {{--                            @endforelse--}}
                                  {{--                          </select>--}}
                                  <div class="input-group">
                                    <select class="form-select form-control-inverse-fill" name="wallet_id">
                                      <option value="" disabled selected hidden>Выберите кошелёк</option>
                                      @forelse($wallets as $wallet)
                                        <option value="{{ $wallet->id }}" @if(old('wallet_id') == $wallet->id) selected="selected" @endif>{{ $wallet->currency->name }} - {{ $wallet->balance }}{{ $wallet->currency->symbol }}</option>
                                      @empty
                                      @endforelse
                                    </select>
                                  </div>
                                  <h6 class="mb-2 mt-2">Введите сумму ($)</h6>
                                  <div class="input-group">
                                    <input class="form-control" type="text" name="amount" value="{{ old('amount') ?? '' }}">
                                  </div>
                                </div>
                                <button class="btn btn-lg btn-primary btn-block create-deposit-btn">Инвестировать</button>
                              </div>
                            </form>
                          </div>
                        @endif
                      @empty
                      @endforelse
                    </div>
                    
                    <div class="row second-chart-list third-news-update">
                      <div class="col">
                        <div class="card">
                          <div class="card-block row">
                            <div class="col-sm-12 col-lg-12 col-xl-12">
                              <div class="table-responsive">
                                <table class="table">
                                  <thead class="bg-primary">
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Тарифный план</th>
                                      <th scope="col">Валюта</th>
                                      <th scope="col">Сумма инвестиций</th>
                                      <th scope="col">Текущий баланс</th>
                                      <th scope="col">Начислено</th>
                                      <th scope="col">Дата открытия</th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @if($deposits !== null)
                                      @php($i = 0)
                                      @foreach($deposits as $deposit)
                                        @if($group->id == $deposit->rate->rate_group_id)
                                          @php($i++)
                                          <tr style="vertical-align: middle;">
                                            <th scope="row">{{ $i  }}</th>
                                            <td>{{ $deposit->rate->name }}</td>
                                            <td>{{ $deposit->currency->name }}</td>
                                            <td>
                                              <span class="">{{ number_format($deposit->invested, $deposit->currency->precision, '.', ',') ?? 0 }} {{ $deposit->currency->symbol }}</span>
                                            </td>
                                            <td>{{ number_format($deposit->balance, $deposit->currency->precision, '.', ',') ?? 0 }} {{ $deposit->currency->symbol }}</td>
                                            <th scope="col">{{number_format($deposit->total_assessed(), $deposit->currency->precision, '.', ',') ?? 0 }} {{ $deposit->currency->symbol }}</th>
                                            <td>{{ $deposit->created_at->format('d-m-Y H:i') }}</td>
                                            <td>
                                              <form action="{{ route('accountPanel.deposits.set.reinvest') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="deposit_id" value="{{ $deposit->id }}">
                                                <label class="col-md-12 col-form-label sm-left-text" for="u-range-{{ $item->id }}">Процент реинвестирования</label>
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
                                            </td>
                                            <td>
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
                                              <form action="">
                                                @csrf
                                                <input type="hidden" name="deposit_id" value="{{ $deposit->id }}">
                                                <div class="text-center">
                                                  <button class="btn btn-pill btn-success btn-air-success btn-sm mt-2">Апгрейд</button>
                                                </div>
                                              </form>
                                            </td>
                                          </tr>
                                        @endif
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
                      </div>
                    </div>
                  
                  </div>
                @empty
                @endforelse
              </div>
            </div>
          </div>
          
          
          {{--<div class="col-sm-12">
            <div class="card">
              
              <div class="card-body row pricing-content">
                
                @forelse($rates as $item)
                  <div class="col-xl-3 col-sm-6 xl-50 box-col-6">
                    <form action="{{ route('accountPanel.deposits.store') }}" class="create-deposit-form" method="post">
                      <input type="hidden" name="rate_id" value="{{ $item->id }}">
                      @csrf
                      <div class="card text-center pricing-simple">
                        <div class="card-body">
                          <h3>{{ $item->name }}</h3>
                          <h5>В день {{ $item->daily }}%</h5>
                          <h6>{{ $item->refund_deposit ? 'Возврат в конце сроква' : 'Депозит не возвращается' }}</h6>
                          <h6>Длительность: {{ $item->duration }} дней</h6>
                          <h4 class="mb-2">Можно внести </h4>
                          <p style="font-size: 15px;">от <strong>{{ number_format($item->min, 2,'.',',') }}$</strong> до
                            <strong>{{ number_format($item->max, 2,'.',' ') }}$</strong></p>
                          --}}{{--                          <h6 class="mb-2">Выберите платёжную систему</h6>--}}{{--
                          --}}{{--                          <select class="js-example-basic-single col-sm-12" name="payment_system">--}}{{--
                          --}}{{--                            @forelse($payment_systems as $payment_system)--}}{{--
                          --}}{{--                              <option value="{{ $payment_system->id }}">{{ $payment_system->name }}</option>--}}{{--
                          --}}{{--                            @empty--}}{{--
                          --}}{{--                            @endforelse--}}{{--
                          --}}{{--                          </select>--}}{{--
                          <div class="input-group">
                            <select class="form-select form-control-inverse-fill" name="wallet_id">
                              <option value="" disabled selected hidden>Выберите валюту</option>
                              @forelse($wallets as $wallet)
                                <option value="{{ $wallet->id }}" @if(old('wallet_id') == $wallet->id) selected="selected" @endif>{{ $wallet->currency->name }} - {{ $wallet->balance }}{{ $wallet->currency->symbol }}</option>
                              @empty
                              @endforelse
                            </select>
                          </div>
                          <h6 class="mb-2 mt-2">Введите сумму ($)</h6>
                          <div class="input-group">
                            <input class="form-control" type="text" name="amount" value="{{ old('amount') ?? '' }}">
                          </div>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block create-deposit-btn">Инвестировать</button>
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
@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/vendors/range-slider.css') }}">
@endpush
@push('scripts')
  <script src="{{ asset('accountPanel/js/range-slider/ion.rangeSlider.min.js') }}"></script>
  <script src="{{ asset('accountPanel/js/range-slider/rangeslider-script.js') }}"></script>
  <script src="{{ asset('accountPanel/js/sweet-alert/sweetalert.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      $(".form-control-inverse-fill").select2();
      
      $(".create-deposit-btn").on('click', function (e) {
        e.preventDefault();
        swal({
          title: "Вы уверены?",
          text: "С вашего баланса будут списаны денежные средства!",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            //create-deposit-form
            $(this).parent().parent().submit();
            swal("Подождите немного!", {
              icon: "success",
            });
          }
        });
      });
      
      
    });
  </script>
  <script>
    $(document).ready(function () {
      $(".range-slider").each(function (i, el) {
        if ($(el).hasClass('disable')) {
          $(el).ionRangeSlider({
            min: 0,
            max: 100,
            from: 0,
            disable: true,
            postfix: "%"
          })
        } else {
          $(el).ionRangeSlider({
            min: 0,
            max: 100,
            from: 0,
            postfix: "%"
          })
        }
      })
    });
  </script>
@endpush
