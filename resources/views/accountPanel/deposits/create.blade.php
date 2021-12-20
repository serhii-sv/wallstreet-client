@extends('layouts.accountPanel.app')
@section('title')
Create deposit
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

      @if(!empty($rates))
        <div class="row" style="margin-top:50px;">
          <div class="card height-equal">
            <div class="card-header pb-3 d-flex justify-content-center">
              <ul class="nav nav-dark mb-3" id="pills-darktab" role="tablist">
                @forelse($deposit_groups as $group)
                  <li class="nav-item">
                    <a class="nav-link @if($loop->first) active @endif" id="pills-{{ $group->id }}-tab" data-bs-toggle="pill" href="#pills-{{ $group->id }}" role="tab" aria-controls="pills-{{ $group->id }}" aria-selected="false" data-bs-original-title="" title="">

                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='group {{ $group->id }}' contenteditable="true">{{ __('group '.$group->id) }}</editor_block>
                      @else
                            {{ __('group '.$group->id) }}
                      @endif
                    </a>
                  </li>
                @empty
                @endforelse
              </ul>
            </div>
            <div class="card-body pt-3">
              <div class="mb-3">
                @include('partials.inform')
              </div>

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
                                  <h3>  @if(canEditLang() && checkRequestOnEdit())
                                      <editor_block data-name='{{ $item->name }}' contenteditable="true">{{ __($item->name) }}</editor_block>
                                    @else
                                      {{ $item->name }}
                                    @endif
                                  </h3>

                                    <div class="transaction-header">
                                        <span class="title">
                                @if(canEditLang() && checkRequestOnEdit())
                                                <div style="text-align:left;">
                                <editor_block data-name='Daily earnings {{ $item->id }}' contenteditable="true">{!! __('Daily earnings '.$item->id) !!}</editor_block>
                                </div>
                                            @else
                                                <div style="text-align:left;">
                                                <span style="text-align:left;" class="date">{!! html_entity_decode(__('Daily earnings '.$item->id)) !!}</span>
                                                </div>
                                            @endif

                                            @if(canEditLang() && checkRequestOnEdit())
                                                <div style="text-align:left;">
                                <editor_block data-name='Duration {{ $item->id }}' contenteditable="true">{!! __('Duration '.$item->id) !!}</editor_block>
                                </div>
                                            @else
                                                <div style="text-align:left;">
                                        <span  style="text-align:left;" class="date">{!! html_entity_decode(__('Duration '.$item->id)) !!}</span>
                                        </div>
                                            @endif

                                                        </span>
                                        @if(canEditLang() && checkRequestOnEdit())
                                            <div style="text-align:left;">
                                                <editor_block data-name='Daily rate {{ $item->id }}' contenteditable="true">{!! __('Daily rate '.$item->id) !!}</editor_block>
                                            </div>
                                        @else
                                            <div style="text-align:left;">
                                                <span  style="text-align:left;" class="date">{!! html_entity_decode(__('Daily rate '.$item->id)) !!}</span>
                                            </div>
                                        @endif

                                        @if(canEditLang() && checkRequestOnEdit())
                                            <div style="text-align:left;">
                                                <editor_block data-name='Add str {{ $item->id }}' contenteditable="true">{!! __('Add str '.$item->id) !!}</editor_block>
                                            </div>
                                        @else
                                            <div style="text-align:left;">
                                                <span  style="text-align:left;" class="date">{!! html_entity_decode(__('Add str '.$item->id)) !!}</span>
                                            </div>
                                        @endif

                                        @if(canEditLang() && checkRequestOnEdit())
                                            <div style="text-align:left;">
                                                <editor_block data-name='Add str 2 {{ $item->id }}' contenteditable="true">{!! __('Add str 2 '.$item->id) !!}</editor_block>
                                            </div>
                                        @else
                                            <div style="text-align:left;">
                                                <span  style="text-align:left;" class="date">{!! html_entity_decode(__('Add str 2 '.$item->id)) !!}</span>
                                            </div>
                                        @endif

                                        @if(canEditLang() && checkRequestOnEdit())
                                            <div style="text-align:left;">
                                                <editor_block data-name='Add str 3 {{ $item->id }}' contenteditable="true">{!! __('Add str 3 '.$item->id) !!}</editor_block>
                                            </div>
                                        @else
                                            <div style="text-align:left;">
                                                <span  style="text-align:left;" class="date">{!! html_entity_decode(__('Add str 3 '.$item->id)) !!}</span>
                                            </div>
                                        @endif

                                        @if(canEditLang() && checkRequestOnEdit())
                                            @if($item->overall)
                                                <editor_block style="text-align:left;" data-name='return deposit: true {{ $item->id }}' contenteditable="true">{!! __('return deposit: true '.$item->id) !!}</editor_block>
                                            @else
                                                <div style="text-align:left;">
                                                    <editor_block data-name='return deposit: false {{ $item->id }}' contenteditable="true">{!! __('return deposit: false '.$item->id) !!}</editor_block>
                                                </div>
                                            @endif
                                        @else
                                            <div style="text-align:left;">
                                                @if($item->overall)
                                                    <span style="text-align:left;" class="date">{!! html_entity_decode(__('return deposit: true '.$item->id)) !!}</span>
                                                @else
                                                    <span style="text-align:left;" class="date">{!! html_entity_decode(__('return deposit: false '.$item->id)) !!}</span>
                                                @endif
                                            </div>
                                        @endif

                                        @if(canEditLang() && checkRequestOnEdit())
                                            <div style="text-align:left;">
                                                <editor_block data-name='Add str 4 {{ $item->id }}' contenteditable="true">{!! __('Add str 4 '.$item->id) !!}</editor_block>
                                            </div>
                                        @else
                                            <div style="text-align:left;">
                                                <span  style="text-align:left;" class="date">{!! html_entity_decode(__('Add str 4 '.$item->id)) !!}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <p>&nbsp;</p>
                                  <div style="text-align: center;">
                                      <h6 class="mb-2" style="color:green; text-align:center;">@if(canEditLang() && checkRequestOnEdit())
                                              <editor_block data-name='Choose wallet 2' contenteditable="true">{{ __('Choose wallet 2') }}</editor_block> @else {{ __('Choose wallet 2') }} @endif
                                      </h6>

                                    <select class="form-select form-control-inverse-fill wallet-select" name="wallet_id" data-rate="{{ $item->id }}">
                                      @forelse($wallets as $wallet)
                                        <option value="{{ $wallet->id }}" data-currency="{{ $wallet->currency_id }}"
                                            @if(old('wallet_id') == $wallet->id) selected="selected" @endif>
                                          {{ $wallet->currency->name }} - {{ $wallet->balance }}{{ $wallet->currency->symbol }}
                                        </option>
                                      @empty
                                      @endforelse
                                    </select>
                                  </div>
                                    <p>&nbsp;</p>
                                    <div style="text-align:center;" class="transaction-footer">
                                                  <span class="amount" style="text-align:center;color:green;">
                                                      @if(canEditLang() && checkRequestOnEdit())
                                                          <editor_block data-name='Can deposit {{ $item->id }}' contenteditable="true">{{ __('Can deposit '.$item->id) }}</editor_block>
                                                      @else
                                                          {{ __('Can deposit '.$item->id) }}
                                                      @endif
                                                  </span>
                                        <div class="rate-min-max-block" data-rate="{{ $item->id }}">
                                            <h5 class="sub-title">
                                                @if(canEditLang() && checkRequestOnEdit())
                                                    <editor_block data-name='Min {{ $item->id }}' contenteditable="true">{{ __('Min '.$item->id) }}</editor_block>
                                                @else
                                                    {{ __('Min '.$item->id) }} {{ number_format($item->min, 2, '.', '') }}$
                                                @endif
                                            </h5>
                                            <h5 class="sub-title">
                                                @if(canEditLang() && checkRequestOnEdit())
                                                    <editor_block data-name='Max {{ $item->id }}' contenteditable="true">{{ __('Max '.$item->id) }}</editor_block>
                                                @else
                                                    {{ __('Max '.$item->id) }} {{ number_format($item->max, 2, '.', '') }}$
                                                @endif
                                            </h5>
                                        </div>
                                    </div>
                                    <p></p>
                                  <h6 class="mb-2 mt-2" style="color:green;">
                                      @if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='Enter the amount {{ $item->id }}' contenteditable="true">{{ __('Enter the amount '.$item->id) }}</editor_block>
                                      @else
                                          {{ __('Enter the amount '.$item->id) }}
                                      @endif
                                  </h6>
                                  <div class="input-group">
                                    <input class="form-control" type="text" name="amount" value="{{ old('amount') ?? '' }}">
                                  </div>
                                </div>
                                <button class="btn btn-lg btn-primary btn-block create-deposit-btn" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif >
                                      @if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='Invest' contenteditable="true">{{ __('Invest') }}</editor_block>
                                      @else
                                        {{ __('Invest') }}
                                      @endif
                                </button>
                              </div>
                            </form>
                          </div>
                        @endif
                      @empty
                      @endforelse
                    </div>
                  </div>
                @empty
                @endforelse
              </div>
              <div class="row second-chart-list third-news-update">
                <div class="col">
                  <div class="card">
                    <div class="card-block row">
                      <div class="col-sm-12 col-lg-12 col-xl-12" style="text-align: center; margin:30px 0 50px 0;">
                          <h3>
                              @if(canEditLang() && checkRequestOnEdit())
                                  <editor_block data-name='{{ 'title 123123' }}' contenteditable="true">{{ __('title 123123') }}</editor_block>
                              @else
                                  {{ __('title 123123') }}
                              @endif
                          </h3>
                      </div>
                      <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="table-responsive">
                          <table class="table">
                            <thead class="bg-primary">
                              <tr>
                                <th scope="col">@if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Tariff plan' contenteditable="true">{{ __('Tariff plan') }}</editor_block> @else {{ __('Tariff plan') }} @endif
                                </th>
                                <th scope="col">@if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Currency' contenteditable="true">{{ __('Currency') }}</editor_block> @else {{ __('Currency') }} @endif
                                </th>
                                <th scope="col">@if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Current balance' contenteditable="true">{{ __('Current balance') }}</editor_block> @else {{ __('Current balance') }} @endif
                                </th>
                                <th scope="col">@if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Assessed' contenteditable="true">{{ __('Assessed') }}</editor_block> @else {{ __('Assessed') }} @endif
                                </th>
                                <th scope="col">@if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Opening date' contenteditable="true">{{ __('Opening date') }}</editor_block> @else {{ __('Opening date') }} @endif
                                </th>
                                <th>@if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Reinvestment' contenteditable="true">{{ __('Reinvestment') }}</editor_block> @else {{ __('Reinvestment') }} @endif
                                </th>
                                <th>@if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Replenish' contenteditable="true">{{ __('Replenish') }}</editor_block> @else {{ __('Replenish') }} @endif
                                </th>
                                <th>@if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Upgrade' contenteditable="true">{{ __('Upgrade') }}</editor_block> @else {{ __('Upgrade') }} @endif
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                              @if($deposits !== null)
                                @foreach($deposits as $deposit)
                                  {{--@if($group->id == $deposit->rate->rate_group_id)--}}
                                  <tr style="vertical-align: middle;">
                                    <td>
                                      @if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='{{ $deposit->rate->name }}' contenteditable="true">{{ __($deposit->rate->name) }}</editor_block>
                                      @else
                                        {{ __($deposit->rate->name) }}
                                      @endif
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
                                        <label class="col-md-12 col-form-label sm-left-text" for="u-range-{{ $deposit->id }}">@if(canEditLang() && checkRequestOnEdit())
                                            <editor_block data-name='Reinvestment percentage' contenteditable="true">{{ __('Reinvestment percentage') }}</editor_block> @else {{ __('Reinvestment percentage') }} @endif
                                        </label>
                                        <div class="col-md-12 text-center">
                                          <input id="u-range-{{ $deposit->id }}" type="hidden" class="irs-hidden-input deposit-range-slider @if(!$deposit->rate->reinvest) disable @endif" tabindex="-1" name="reinvest" readonly="" data-bs-original-title="" title="">
                                        </div>
                                        <div class="text-center">
                                          <button class="btn btn-pill btn-success btn-air-success btn-sm mt-2 @if(!$deposit->rate->reinvest) disabled @endif" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                                              <editor_block data-name='Apply' contenteditable="true">{{ __('Apply') }}</editor_block> @else {{ __('Apply') }} @endif
                                          </button>
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
                                        @else
                                            <strong>недоступно</strong>
                                            @endif
                                    </td>
                                    <td>
                                        @if($deposit->rate->reinvest)
                                      <form action="{{ route('accountPanel.deposits.add.balance') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="deposit_id" value="{{ $deposit->id }}">
                                        <input type="hidden" name="wallet_id" value="{{ $deposit->wallet->id }}">
                                        <div class="text-center">
                                          @if(canEditLang() && checkRequestOnEdit())
                                            <editor_block data-name='Balance' contenteditable="true">{{ __('Balance') }}</editor_block> @else {{ __('Balance') }} @endif: {{ $deposit->wallet->balance }} {{ $deposit->currency->symbol }}
                                        </div>
                                        <div class="text-center">
                                          <input class="form-control input-air-primary" type="text" placeholder="" name="amount" data-bs-original-title="" title="">
                                        </div>
                                        <div class="text-center">
                                          <button class="btn btn-pill btn-success btn-air-success btn-sm mt-2" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                                              <editor_block data-name='To reinvest' contenteditable="true">{{ __('To reinvest') }}</editor_block> @else {{ __('To reinvest') }} @endif
                                          </button>
                                        </div>
                                      </form>
                                        @else
                                            <strong>недоступно</strong>
                                            @endif
                                    </td>
                                    <td>
                                      @if($deposit->canUpdate())
                                        <div class="text-center">@if(canEditLang() && checkRequestOnEdit())
                                            <editor_block data-name='Enough funds for the upgrade' contenteditable="true">{{ __('Enough funds for the upgrade') }}</editor_block> @else {{ __('Enough funds for the upgrade') }} @endif
                                        </div>
                                        <form action="{{ route('accountPanel.deposits.upgrade') }}" method="post">
                                          @csrf
                                          <input type="hidden" name="deposit_id" value="{{ $deposit->id }}">
                                          <div class="text-center">
                                            <button class="btn btn-pill btn-success btn-air-success btn-sm mt-2" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                                                <editor_block data-name='Upgrade' contenteditable="true">{{ __('Upgrade') }}</editor_block> @else {{ __('Upgrade') }} @endif
                                            </button>
                                          </div>
                                        </form>
                                      @else
                                            <strong>недоступно</strong>
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
                                      <p style="font-size: 16px;">@if(canEditLang() && checkRequestOnEdit())
                                          <editor_block data-name='No deposits' contenteditable="true">{{ __('No deposits') }}</editor_block> @else {{ __('No deposits') }} @endif
                                      </p>
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
              <div>
                {{ $deposits->links() }}
              </div>
            </div>
          </div>

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
          title: "Вы подтверждаете?",
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
  <script>
    $(document).ready(function () {
      $(".wallet-select").on('change', function () {
        var $rate_id = $(this).attr('data-rate');
        var $currency_id = $(this).find('option:selected').attr('data-currency');
        var $url = "{{ route('ajax.get.rate.min.max') }}";
        /*<strong>{{--{{ number_format($item->min, 2,'.',',') }}--}}$</strong> до
        <strong>{{--{{ number_format($item->max, 2,'.',' ') }}--}}$</strong>*/
        $(".rate-min-max-block[data-rate='" + $rate_id + "']").html('<div class="loader-box" style="height: 24px">' +
            '<div class="loader-15"></div>' +
            '</div>');
        $.ajax({
          url: $url,
          method: 'post',
          data: 'rate_id=' + $rate_id + '&currency_id=' + $currency_id,
          headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
          },
          success: function success(data) {
            var $data = $.parseJSON(data);

            $(".rate-min-max-block[data-rate='" + $rate_id + "']").html($data['rate_min_max']);

          }
        });

      });
    });
  </script>
@endpush
