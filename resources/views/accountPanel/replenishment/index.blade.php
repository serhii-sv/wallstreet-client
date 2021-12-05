@extends('layouts.accountPanel.app')
@section('title')
Topup balance
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
    <div class="row second-chart-list third-news-update" style="margin-top:50px;">

      <div class="row" style="margin-top: 50px;">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5 class="mb-4">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Replenishment page 2' contenteditable="true">{{ __('Replenishment page 2') }}</editor_block> @else {{ __('Replenishment page 2') }} @endif <span id="payName"></span>
              </h5>
              @include('partials.inform')
            </div>
            <div class="card-body">
              <form class="f1" method="post" action="{{ route('accountPanel.replenishment') }}">
                @csrf
                <div class="f1-steps">
                  <div class="f1-progress">
                    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66000000000001%;"></div>
                  </div>
                  <div class="f1-step {{ isset($_GET['freekassa']) ? '' : 'active' }}">
                    <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                    <p>
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Method of replenishment' contenteditable="true">{{ __('Method of replenishment') }}</editor_block>
                      @else {{ __('Method of replenishment') }} @endif
                    </p>
                  </div>
                  <div class="f1-step {{ isset($_GET['freekassa']) ? 'active' : '' }}">
                    <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                    <p>
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Amount top' contenteditable="true">{{ __('Amount top') }}</editor_block>
                      @else {{ __('Amount top') }} @endif
                    </p>
                  </div>
                </div>
                @if(!isset($_GET['freekassa']))
                <fieldset>

                  <div class="mb-3 item-list-wrapper">
                    @forelse($payment_systems as $item)
                      <?php
                      if ($item->code == 'sprint') {
                        continue;
                      }
                      ?>
                      @if($item->code == 'coinpayments')
                        @foreach($item->currencies()->get() as $currency)
                          <label class="d-flex flex-column align-items-center justify-content-center replenishment-method-item" href="next">
                            <input class="payment-system-radio" type="radio" name="payment_system" value="{{ $item->id }}" data-manual="false" data-name="{{ $currency->name }}">
                            <div class=" payment-system-item d-flex flex-column align-items-center justify-content-center">
                              <img src="{{ asset('accountPanel/images/logos/' .  $currency->image ) }}" alt="{{ $currency->image_alt }}" title="{{ $currency->image_title }}">
                              <span>{{ $currency->name }}</span>
                            </div>
                            <input class="payment-system-radio" type="radio" name="currency" value="{{ $currency->id }}">
                          </label>
                        @endforeach
                      @else
                      <label class="d-flex flex-column align-items-center justify-content-center replenishment-method-item" href="next">
                        <input class="payment-system-radio" type="radio" name="payment_system" value="{{ $item->id }}" data-name="{{ $item->code }}" data-manual="true">
                        <div class=" payment-system-item d-flex flex-column align-items-center justify-content-center">
                          <img src="{{ asset('accountPanel/images/logos/' .  $item->image ) }}" alt="{{ $item->image_alt }}" title="{{ $item->image_title }}">
                          <span>{{ $item->name }}</span>
                        </div>
                      </label>
                      @endif

                    @empty
                    @endforelse

                    <label class="d-flex flex-column align-items-center justify-content-center replenishment-method-item">
                      <div class=" payment-system-item d-flex flex-column align-items-center justify-content-center">
                        <span>Вашей платежной системы нет в списке? Напишите нам в Службу Поддержки и мы постараемся принять перевод.</span>
                      </div>
                    </label>
                  </div>

                  {{--<div class="mb-3">
                    <label class="form-label" for="exampleFormControlSelect9">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Payment system' contenteditable="true">{{ __('Payment system') }}</editor_block> @else {{ __('Payment system') }} @endif</label>
                    <select class="form-select digits" name="payment_system" id="exampleFormControlSelect9">
                      @forelse($payment_systems as $item)
                        <option value="{{ $item->id }}" >{{ $item->name }}</option>
                      @empty
                        <option value="" disabled>Нет платёжных систем</option>
                      @endforelse
                    </select>
                  </div>--}}
                  <div class="f1-buttons" style="text-align: center;">
                    <button class="btn btn-primary btn-next shake" id="next" type="button" style="padding:15px 50px 15px 50px; font-size:21px;">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Next' contenteditable="true">{{ __('Next') }}</editor_block> @else {{ __('Next') }} @endif
                    </button>
                  </div>
                </fieldset>
                @else
                <input class="payment-system-radio" type="radio" name="payment_system" value="{{ \App\Models\PaymentSystem::where('code', 'visa_mastercard')->first()->id ?? '' }}" checked>
                @endif

                <fieldset style="display: {{ isset($_GET['freekassa']) ? 'block' : 'none' }};">
                  {{--   <div class="mb-3 d-flex flex-wrap currencies-wrapper">
                       @forelse($currencies as $item)
                         <label class="d-flex flex-column align-items-center justify-content-center currency-wrapper-item">
                           <input class="payment-system-radio" type="radio" name="currency" value="{{ $item->id }}" required>
                           <div class=" payment-system-item d-flex flex-column align-items-center justify-content-center">
                             <img src="{{ asset('accountPanel/images/logos/' .  $item->image ) }}" alt="{{ $item->image_alt }}" title="{{ $item->image_title }}">
                             <span>{{ $item->name }}</span>
                           </div>
                         </label>
                       @empty
                       @endforelse
                     </div>--}}
                  <div class="text-center mb-3" style="margin-top:50px;">
                    <div style="margin-bottom:50px;">
                        <label class="" style="font-size: 20px;">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Amount bot' contenteditable="true">{{ __('Amount bot') }}</editor_block> @else {{ __('Amount bot') }} @endif</label>
                    </div>
                    <input class="form-control input-air-primary text-center" type="text" name="amount" style="font-size: 20px; padding: 10px;max-width: 320px;margin:auto;">
                  </div>

                  <div class="f1-buttons" style="text-align: center;margin-top:50px;">
                    @if(!isset($_GET['freekassa']))
                    <button class="btn btn-primary btn-previous" type="button" data-bs-original-title="" title=""  style="padding:15px 50px 15px 50px; font-size:21px;">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Previous' contenteditable="true">{{ __('Previous') }}</editor_block> @else {{ __('Previous') }} @endif
                    </button>
                    @endif
                    <button class="btn btn-primary btn-submit shake" id="next" type="submit" data-bs-original-title="" title=""  style="margin-left:30px;padding:15px 50px 15px 50px; font-size:21px;">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='vnesti' contenteditable="true">{{ __('vnesti') }}</editor_block> @else {{ __('vnesti') }} @endif
                    </button>
                  </div>
                </fieldset>
              </form>

            </div>
          </div>
        </div>

      </div>


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
      $(".replenishment-method-item").on('click', function () {
        $("input[name='currency']").each(function (i,el) {
          $(el).prop('checked', false).removeAttr('checked');
        });
        $(this).find("input[name='currency']").prop('checked', true).attr('checked', 'checked');

        $([document.documentElement, document.body]).animate({
          scrollTop: $(".f1-buttons").offset().top
        },0);
      });
      $(".btn-previous").on('click', function (e) {
          var paySystem = $("input[name='payment_system']:checked").attr('data-name');
          $('#payName').html("");
      });
      $(".btn-next").on('click', function (e) {

          var paySystem = $("input[name='payment_system']:checked").attr('data-name');
          $('#payName').html(paySystem);



        var manual = $("input[name='payment_system']:checked").attr('data-manual');
        if (manual == 'true'){
          var $id = $("input[name='payment_system']:checked").val();
          $(".item-list-wrapper").empty().html('<div class="loader-box" style="height: 24px; margin: 50px auto 30px">' +
              '<div class="loader-3"></div>' +
              '</div>');
          $(".f1-buttons").hide();
          var $url = "{{ route('accountPanel.replenishment.manual') }}/" + $id ;
          location.href = $url;
        }

      });
    });
  </script>
@endpush
