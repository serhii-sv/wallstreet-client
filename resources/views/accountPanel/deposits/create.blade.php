@extends('layouts.accountPanel.app')
@section('title')
  @if(canEditLang() && checkRequestOnEdit())
    <editor_block data-name='Create deposit page' contenteditable="true">{{ __('Create deposit page') }}</editor_block>
  @else
    {{ __('Create deposit page') }}
  @endif
@endsection
@section('content')

  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">

      @if(!empty($rates))
        <div class="row">
          <div class="card height-equal">
            <div class="card-header pb-3 d-flex justify-content-center">
              <ul class="nav nav-dark mb-3" id="pills-darktab" role="tablist">
                @forelse($deposit_groups as $group)
                  <li class="nav-item">
                    <a class="nav-link @if($loop->first) active @endif" id="pills-{{ $group->id }}-tab" data-bs-toggle="pill" href="#pills-{{ $group->id }}" role="tab" aria-controls="pills-{{ $group->id }}" aria-selected="false" data-bs-original-title="" title="" >

                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='{{ $group->name }}' contenteditable="true">{{ __($group->name) }}</editor_block>
                      @else
                        {{ $group->name }}
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
                                    @endif</h3>
                                  <h5>@if(canEditLang() && checkRequestOnEdit())
                                      <editor_block data-name='Acc daily earnings {{ $item->id }}' contenteditable="true">{{ __('Acc daily earnings '.$item->id) }}</editor_block> @else {{ __('Acc daily earnings '.$item->id) }} @endif: {{ $item->daily }}%
                                  </h5>
                                  <h6>@if(canEditLang() && checkRequestOnEdit())
                                      <editor_block data-name='Acc duration {{ $item->id }}' contenteditable="true">{{ __('Acc duration '.$item->id) }}</editor_block> @else {{ __('Acc duration '.$item->id) }} @endif: {{ $item->duration }} дней
                                  </h6>
                                  <h6>@if(canEditLang() && checkRequestOnEdit())
                                      <editor_block data-name='Acc reinvest {{ $item->id }}' contenteditable="true">{{ __('Acc reinvest '.$item->id) }}</editor_block> @else {{ __('Reinvesting '.$item->id) }} @endif: {{ $item->reinvest ? 'есть' : 'нет' }}
                                  </h6>
                                  {{-- <h6>Реинвестирование</h6>
                                   <div class="form-group row">
                                     <label class="col-md-12 col-form-label sm-left-text" for="u-range-{{ $item->id }}">Процент реинвестирования</label>
                                     <div class="col-md-12">
                                       <input id="u-range-{{ $item->id }}" type="hidden" class="irs-hidden-input range-slider @if(!$item->reinvest) disable @endif" tabindex="-1" name="reinvest" readonly="" data-bs-original-title="" title="">
                                     </div>
                                   </div>--}}
                                  <h5>
                                    <span class="span badge rounded-pill pill-badge-primary" style="white-space: normal;">
                                      @if($item->overall)
                                        @if(canEditLang() && checkRequestOnEdit())
                                          <editor_block data-name='Refund of the deposit at the end {{ $item->id }}' contenteditable="true">{{ __('Refund of the deposit at the end '.$item->id) }}</editor_block> @else {{ __('Refund of the deposit at the end '.$item->id) }} @endif: {{ $item->overall }}%
                                      @else
                                        @if(canEditLang() && checkRequestOnEdit())
                                          <editor_block data-name='The deposit is not refundable {{ $item->id }}' contenteditable="true">{{ __('The deposit is not refundable '.$item->id) }}</editor_block> @else {{ __('The deposit is not refundable '.$item->id) }} @endif
                                      @endif
                                    </span>
                                  </h5>
                                  <h4 class="mb-2">@if(canEditLang() && checkRequestOnEdit())
                                      <editor_block data-name='Can deposit {{ $item->id }}' contenteditable="true">{{ __('Can deposit '.$item->id) }}</editor_block> @else {{ __('Can deposit '.$item->id) }} @endif
                                  </h4>
                                  <p class="rate-min-max-block" data-rate="{{ $item->id }}" style="font-size: 15px;">
                                    <strong>{{ number_format($item->min, 2,'.',',') }}$</strong> -
                                    <strong>{{ number_format($item->max, 2,'.',' ') }}$</strong>
                                  </p>
                                  <div class="input-group">
                                    <select class="form-select form-control-inverse-fill wallet-select" name="wallet_id" data-rate="{{ $item->id }}">
                                      <option value="" disabled selected hidden>Выберите кошелёк</option>
                                      @forelse($wallets as $wallet)
                                        <option value="{{ $wallet->id }}" data-currency="{{ $wallet->currency_id }}"
                                            @if(old('wallet_id') == $wallet->id) selected="selected" @endif>
                                          {{ $wallet->currency->name }} - {{ $wallet->balance }}{{ $wallet->currency->symbol }}
                                        </option>
                                      @empty
                                      @endforelse
                                    </select>
                                  </div>
                                  <h6 class="mb-2 mt-2">@if(canEditLang() && checkRequestOnEdit())
                                      <editor_block data-name='Enter the amount ' contenteditable="true">{{ __('Enter the amount ') }}</editor_block> @else {{ __('Enter the amount ') }} @endif
                                  </h6>
                                  <div class="input-group">
                                    <input class="form-control" type="text" name="amount" value="{{ old('amount') ?? '' }}">
                                  </div>
                                </div>
                                <button class="btn btn-lg btn-primary btn-block create-deposit-btn" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Invest' contenteditable="true">{{ __('Invest') }}</editor_block> @else {{ __('Invest') }} @endif
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
                      <div class="col-sm-12 col-lg-12 col-xl-12">
                        <div class="table-responsive">
                          <table class="table">
                            <thead class="bg-primary">
                              <tr>
                                <th scope="col">@if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='#' contenteditable="true">{{ __('#') }}</editor_block> @else {{ __('#') }} @endif
                                </th>
                                <th scope="col">@if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Tariff plan' contenteditable="true">{{ __('Tariff plan') }}</editor_block> @else {{ __('Tariff plan') }} @endif
                                </th>
                                <th scope="col">@if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Currency' contenteditable="true">{{ __('Currency') }}</editor_block> @else {{ __('Currency') }} @endif
                                </th>
                                <th scope="col">@if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Amount of investment' contenteditable="true">{{ __('Amount of investment') }}</editor_block> @else {{ __('Amount of investment') }} @endif
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
                                    <th scope="row">{{ $deposit->int_id  }}</th>
                                    <td>
                                      @if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='{{ $deposit->rate->name }}' contenteditable="true">{{ __($deposit->rate->name) }}</editor_block>
                                      @else
                                        {{ __($deposit->rate->name) }}
                                      @endif
                                    </td>
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
                                    </td>
                                    <td>
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
                                        <div class="text-center">@if(canEditLang() && checkRequestOnEdit())
                                            <editor_block data-name='Unavailable' contenteditable="true">{{ __('Unavailable') }}</editor_block> @else {{ __('Unavailable') }} @endif
                                        </div>
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
