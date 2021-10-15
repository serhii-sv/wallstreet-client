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
                <h5>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Withdrawal request' contenteditable="true">{{ __('Withdrawal request') }}</editor_block> @else {{ __('Withdrawal request') }} @endif</h5>
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
                      <p>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Wallet' contenteditable="true">{{ __('Wallet') }}</editor_block> @else {{ __('Wallet') }} @endif</p>
                    </div>
                    <div class="f1-step">
                      <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                      <p>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Payment system' contenteditable="true">{{ __('Payment system') }}</editor_block> @else {{ __('Payment system') }} @endif</p>
                    </div>
                  </div>
                  <fieldset style="display: block;">
                    <div class="mb-3">
                      <label class="form-label" for="exampleFormControlSelect9">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Wallet' contenteditable="true">{{ __('Wallet') }}</editor_block> @else {{ __('Wallet') }} @endif</label>
                      <select class="form-select digits" name="wallet_id" id="exampleFormControlSelect9">
                        @forelse($wallets as $item)
                          <option value="{{ $item->id }}">{{ $item->currency->name }} {{ $item->currency->symbol }}</option>
                        @empty
                          <option value="" disabled>Нет кошельков</option>
                        @endforelse
                      </select>
                    </div>
                    <div class="f1-buttons">
                      <button class="btn btn-primary btn-next" type="button" data-bs-original-title="" title="">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Next' contenteditable="true">{{ __('Next') }}</editor_block> @else {{ __('Next') }} @endif</button>
                    </div>
                  </fieldset>
                  <fieldset style="display: none;">
                    <div class="mb-3">
                      <label class="form-label" for="exampleFormControlSelect11">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Payment system' contenteditable="true">{{ __('Payment system') }}</editor_block> @else {{ __('Payment system') }} @endif</label>
                      <select class="form-select digits" name="payment_system_id" id="exampleFormControlSelect11">
                        @forelse($payment_systems as $item)
                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @empty
                          <option value="" disabled>Нет платёжных систем</option>
                        @endforelse
                      </select>
                    </div>
                    <div class="mb-3">
                      <label class="form-label" >@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Amount' contenteditable="true">{{ __('Amount') }}</editor_block> @else {{ __('Amount') }} @endif</label>
                      <input class="form-control" type="text" name="amount" placeholder="" data-bs-original-title="" title="">
                    </div>
                    <div class="f1-buttons">
                      <button class="btn btn-primary btn-previous" type="button" data-bs-original-title="" title="" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Previous' contenteditable="true">{{ __('Previous') }}</editor_block> @else {{ __('Previous') }} @endif</button>
                      <button class="btn btn-primary btn-submit" type="submit" data-bs-original-title="" title="" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Submit' contenteditable="true">{{ __('Submit') }}</editor_block> @else {{ __('Submit') }} @endif</button>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
          
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <h5>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='List of wallets' contenteditable="true">{{ __('List of wallets') }}</editor_block> @else {{ __('List of wallets') }} @endif</h5>
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
                          <h6 class="mb-2">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Choose a payment system' contenteditable="true">{{ __('Choose a payment system') }}</editor_block> @else {{ __('Choose a payment system') }} @endif</h6>
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
                          <h6 class="mb-2 mt-2">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Enter the amount' contenteditable="true">{{ __('Enter the amount') }}</editor_block> @else {{ __('Enter the amount') }} @endif</h6>
                          <div class="input-group">
                            <span class="input-group-text">{{ $item->currency->symbol ?? '' }}</span>
                            <input class="form-control" type="text" name="amount">
                          </div>
                          <div>
                            @if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Commission 1 $ ' contenteditable="true">{{ __('Commission 1 $ ') }}</editor_block> @else {{ __('Commission 1 $ ') }} @endif
                          </div>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='To withdraw' contenteditable="true">{{ __('To withdraw') }}</editor_block> @else {{ __('To withdraw') }} @endif</button>
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
@push('scripts')
  <script src="{{ asset('accountPanel/js/form-wizard/form-wizard-three.js') }}"></script>
  <script>
    $(document).ready(function () {
      $(".js-example-basic-single").select2();
    });
  </script>
@endpush
