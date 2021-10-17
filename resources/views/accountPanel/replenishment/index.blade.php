@extends('layouts.accountPanel.app')
@section('title', __('Replenishment'))
@section('content')
  
  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
      
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5 class="mb-4">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Application for replenishment' contenteditable="true">{{ __('Application for replenishment') }}</editor_block> @else {{ __('Application for replenishment') }} @endif
              </h5>
              @include('partials.inform')
            </div>
            <div class="card-body">
              <form class="f1" method="post" action="{{ route('accountPanel.replenishment.new.request') }}">
                @csrf
                <div class="f1-steps">
                  <div class="f1-progress">
                    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66000000000001%;"></div>
                  </div>
                  <div class="f1-step active">
                    <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                    <p>
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Payment system' contenteditable="true">{{ __('Payment system') }}</editor_block>
                      @else {{ __('Payment system') }} @endif
                    </p>
                  </div>
                  <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                    <p>
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Currency' contenteditable="true">{{ __('Currency') }}</editor_block>
                      @else {{ __('Currency') }} @endif
                    </p>
                  </div>
                </div>
                <fieldset style="display: block;">
                  
                  <div class="mb-3 item-list-wrapper">
                    @forelse($payment_systems as $item)
                      
                      <label class="d-flex flex-column align-items-center justify-content-center">
                        <input class="payment-system-radio" type="radio" name="payment_system" value="{{ $item->id }}">
                        <div class=" payment-system-item d-flex flex-column align-items-center justify-content-center">
                          <img src="{{ asset('accountPanel/images/logos/' .  $item->image ) }}" alt="{{ $item->image_alt }}" title="{{ $item->image_title }}">
                          <span>{{ $item->name }}</span>
                        </div>
                      </label>
                    
                    @empty
                    @endforelse
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
                  <div class="f1-buttons">
                    <button class="btn btn-primary btn-next" type="button" data-bs-original-title="" title="">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Next' contenteditable="true">{{ __('Next') }}</editor_block> @else {{ __('Next') }} @endif
                    </button>
                  </div>
                </fieldset>
                <fieldset style="display: none;">
                  <div class="mb-3 d-flex flex-wrap">
                    @forelse($currencies as $item)
                      <label class="d-flex flex-column align-items-center justify-content-center">
                        <input class="payment-system-radio" type="radio" name="currency" value="{{ $item->id }}">
                        <div class=" payment-system-item d-flex flex-column align-items-center justify-content-center">
                          <img src="{{ asset('accountPanel/images/logos/' .  $item->image ) }}" alt="{{ $item->image_alt }}" title="{{ $item->image_title }}">
                          <span>{{ $item->name }}</span>
                        </div>
                      </label>
                    @empty
                    @endforelse
                  </div>
                  
                  <div class="f1-buttons">
                    <button class="btn btn-primary btn-previous" type="button" data-bs-original-title="" title="">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Previous' contenteditable="true">{{ __('Previous') }}</editor_block> @else {{ __('Previous') }} @endif
                    </button>
                    <button class="btn btn-primary btn-submit" type="submit" data-bs-original-title="" title="">@if(canEditLang() && checkRequestOnEdit())
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
      .item-list-wrapper{
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
      
    });
  </script>
@endpush
