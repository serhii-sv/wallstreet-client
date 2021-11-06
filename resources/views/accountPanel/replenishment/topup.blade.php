@extends('layouts.accountPanel.app')
@section('title')
Balance page
@endsection
@section('content')
<section class="lk-section">
    <div class="form-lk">
        <div class="form-lk__col">
            <form method="POST" action="{{ route('accountPanel.topup') }}">
                {{ csrf_field() }}
                <p style="font-weight: bold;">@include('partials.inform')</p>

                <div class="input-row white-shadow-select">
                    <label for="currency" class="input-row__name">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Currency' contenteditable="true">{{ __('Currency') }}</editor_block>
                      @else
                        {{ __('Currency') }}
                      @endif
                    </label>
                    <select class="select" id="currency_id" name="currency" autofocus>
                    @foreach($paymentSystems as $paymentSystem)
                        @foreach($paymentSystem['currencies'] as $currency)
                            <option value="{{ $paymentSystem['id'].':'.$currency['id'] }}">{{ $paymentSystem['name'] }} {{ $currency['name'] }}</option>
                        @endforeach
                    @endforeach
                    </select>
                </div>
                <div class="input-row">
                    <label for="amount" class="input-row__name">@if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Amount' contenteditable="true">{{ __('Amount') }}</editor_block>
                      @else
                        {{ __('Amount') }}
                      @endif
                    </label><input id="amount" name="amount" type="number" step="any" class="input-row__input input input--white-shadow" required/>
                    @if($enter_commission > 0)
                        <span class="help-block">@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='System commission' contenteditable="true">{{ __('System commission') }}</editor_block>
                          @else
                            {{ __('System commission') }}
                          @endif {{ $enter_commission }} %</span>
                    @endif
                </div>
                <div class="form-lk__bottom"><button class="btn btn--accent2">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Process' contenteditable="true">{{ __('Process') }}</editor_block>
                    @else
                      {{ __('Process') }}
                    @endif</button>
                </div>
            </form>
        </div>
        <div class="form-lk__col">
          <img src="/img/profit.png" alt="">
        </div>
    </div>
</section>

<script>document.getElementById("balanceProfilePageMenuItem").className = "navigation-icons__link navigation-icons__link--active";</script>

@push('script')
@endpush

@endsection
