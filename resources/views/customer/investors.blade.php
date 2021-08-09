@extends('layouts.customer')
@section('title', __('For investors'))
@section('content')
  <main role="main" style="background: white">
    <div class="page">
      <svg class="before-svg" viewBox="0 0 1950 65.242325" height="65.242325" width="1950">
        <path d="M 975,65.242324 H 0 V 35.889669 6.53701 L 21.25,5.88359 42.5,5.23016 88.000004,4.21053 133.5,3.19089 184,2.14419 234.5,1.09749 430.5,0.54874 626.5,0 l 85,1.14503 85,1.14503 46.5,0.96431 46.5,0.96431 41,1.0362 41,1.0362 49.5,1.48571 49.5,1.48571 42,1.50324 42,1.50325 48.5,1.99247 48.5,1.99247 43,2.013562 43,2.013565 38.5,2.004288 38.5,2.004288 43.5,2.486247 43.5,2.486246 47.5,3.01284 47.5,3.01284 36,2.496047 36,2.496046 13,0.97181 13,0.97181 40,3.03931 40,3.039311 48,3.987707 48,3.987708 38.4368,3.482384 38.4368,3.482385 h 1.3132 1.3132 v 1 1 z"></path>
      </svg>
      @include('partials.breadcrumbs')
      <div class="container">
        <h2 class="page-title"> @if(canEditLang() && checkRequestOnEdit())
            <editor_block data-name="Take the path" contenteditable="true">{{ __('Take the path') }}</editor_block>
          @else
            {{ __('Take the path') }}
          @endif
          <span> @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name="of earning" contenteditable="true">{{ __('of earning') }}</editor_block>
            @else
              {{ __('of earning') }}
            @endif</span>
        </h2>
        <section class="plan">
          <div class="plan-item">
            <div class="plan-item__left">
              <p class="plan-item__name">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name="from 0.77% per day" contenteditable="true">{{ __('from 0.77% per day') }}</editor_block>
                @else
                  {{ __('from 0.77% per day') }}
                @endif
              </p>
              <a class="btn btn--accent2" href="#" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name="Invest now" contenteditable="true">{{ __('Invest now') }}</editor_block>
                @else
                  {{ __('Invest now') }}
                @endif</a>
            </div>
            <div class="plan-item__content">
              <p><strong>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name="Increase your capital with a team of professional traders." contenteditable="true">{{ __('Increase your capital with a team of professional traders.') }}</editor_block>
                  @else
                    {{ __('Increase your capital with a team of professional traders.') }}
                  @endif</strong></p>
              <ul class="information-icons">
                <li class="information-icons__item">
                  <div class="information-icons__icon"><img src="/img/icons/icon-calendar.svg" alt="">
                  </div>
                  <div class="information-icons__content">
                    <p class="information-icons__title">
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name="Period" contenteditable="true">{{ __('Period') }}</editor_block>
                      @else
                        {{ __('Period') }}
                      @endif
                    </p>
                    <p class="information-icons__name">
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name="100 days" contenteditable="true">{{ __('100 days') }}</editor_block>
                      @else
                        {{ __('100 days') }}
                      @endif
                    </p>
                  </div>
                </li>
                <li class="information-icons__item">
                  <div class="information-icons__icon"><img src="/img/icons/icon-cash.svg" alt="">
                  </div>
                  <div class="information-icons__content">
                    <p class="information-icons__title">
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name="Profit" contenteditable="true">{{ __('Profit') }}</editor_block>
                      @else
                        {{ __('Profit') }}
                      @endif
                    </p>
                    <p class="information-icons__name">
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name="from 77%" contenteditable="true">{{ __('from 77%') }}</editor_block>
                      @else
                        {{ __('from 77%') }}
                      @endif
                    </p>
                  </div>
                </li>
                <li class="information-icons__item">
                  <div class="information-icons__icon"><img src="/img/icons/icon-monets.svg" alt="">
                  </div>
                  <div class="information-icons__content">
                    <p class="information-icons__title">
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name="Minimum" contenteditable="true">{{ __('Minimum') }}</editor_block>
                      @else
                        {{ __('Minimum') }}
                      @endif
                    </p>
                    <p class="information-icons__name">USD 10$
                    </p>
                  </div>
                </li>
                <!-- <li class="information-icons__item">
                    <div class="information-icons__icon"><img src="/img/icons/icon-money.svg" alt="">
                    </div>
                    <div class="information-icons__content">
                        <p class="information-icons__title">Total earn
                        </p>
                        <p class="information-icons__name">$432
                        </p>
                    </div>
                </li> -->
              </ul>
              <p>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Three ready-to-use investment proposals and the configurator of investment packages were developed for achieving these goals. Thanks to it every investor can create such an investment package, which is more appropriate for him.' contenteditable="true">{{ __('Three ready-to-use investment proposals and the configurator of investment packages were developed for achieving these goals. Thanks to it every investor can create such an investment package, which is more appropriate for him.') }}</editor_block>
                @else
                  {{ __('Three ready-to-use investment proposals and the configurator of investment packages were developed for achieving these goals. Thanks to it every investor can create such an investment package, which is more appropriate for him.') }}
                @endif</p>
            </div>
          </div>
        </section>
        <section class="calculate calculate--smallPadding">
          <div class="container">
            <div class="calculate-block">
              <div class="calculate-block__top">
                <svg id="svg7819" viewBox="0 0 1153 68">
                  <path id="path7829" style="fill:#ffffff" d="M 576.5,69.27947 H 0 v -4.88605 -4.88605 l 4.003163,-5.99478 4.003162,-5.99478 5.454519,-4.20814 5.45452,-4.20813 L 46.207682,35.16108 73.5,31.22062 l 38,-4.51337 38,-4.51337 32,-2.91771 32,-2.91772 24,-2.02385 24,-2.02384 41,-2.48712 41,-2.48711 30,-1.50162 30,-1.50162 L 430,3.32771 456.5,2.32212 519,1.16106 581.5,0 l 73,0.63135 73,0.63135 36.5,1.00502 36.5,1.00502 33.5,1.5363 33.5,1.53631 50,2.99393 50,2.99392 18.00003,1.50443 17.99997,1.50444 33.5,2.98832 33.5,2.98832 31,3.55713 31,3.55712 3.7916,2.46497 3.7916,2.46496 3.8969,4.01551 3.8969,4.01552 2.5615,4.37084 2.5615,4.37085 v 9.57193 9.57193 z"></path>
                </svg>
                <div class="calculate-block__top-content">
                  <div class="calculate-block__bonus">
                    <p style="margin-left:30px;margin-top:-15px;"><strong>+0.51%</strong> @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='to daily earnings' contenteditable="true">{{ __('to daily earnings') }}</editor_block>
                      @else
                        {{ __('to daily earnings') }}
                      @endif
                    </p>
                  </div>
                  <div class="calculate-block__content">
                    <h3 class="calculate-block__title">
                      <span>{{ __('Calculate your profit') }} </span>{{ __('and get up to 38.4% of income per month') }}
                    </h3>
                    <p>{{ __('Three ready-to-use investment proposals and the configurator of investment packages were developed for achieving these goals. Thanks to it every investor can create such an investment package, which is more appropriate for him.') }}</p>
                  
                  </div>
                  <div class="calculate-block__right">
                    <div class="calc">
                      <div class="calc__top">
                        <div class="calc__row">
                          <label class="label">
                            @if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='Choose a period' contenteditable="true">{{ __('Choose a period') }}</editor_block>
                            @else
                              {{ __('Choose a period') }}
                            @endif
                            <span> @if(canEditLang() && checkRequestOnEdit())
                                (<editor_block data-name='days' contenteditable="true">{{ __('days') }}</editor_block>)
                              @else
                                ({{ __('days') }})
                              @endif</span>
                          </label>
                          <div class="js-slider">
                          </div>
                          <input type="hidden" class="calculatorDuration" value="180" />
                        </div>
                        <div class="calc__row">
                          <label class="label">@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='Choose a budget' contenteditable="true">{{ __('Choose a budget') }}</editor_block>
                            @else
                              {{ __('Choose a budget') }}
                            @endif
                          </label>
                          <div class="calc__input-row"><input value="0.15" type="text" id="calculatorAmount" />
                            <select id="calculatorCurrency">
                              <option>BTC</option>
                              <option>ETH</option>
                              <option>USD</option>
                            </select>
                            {{--<p class="subtext" class="calculatorBonus">+ <span class="calculatorBonusCurrency">BTC</span> 0.01 <span>бонус!</span>--}}
                            {{--</p>--}}
                          </div>
                        </div>
                        <div class="calc__row">
                          <!-- <label class="label">Выберите план
                          </label>
                          <select class="select">
                              <option>Plan name here</option>
                              <option>Plan name here</option>
                              <option>Plan name here</option>
                          </select> -->
                        </div>
                      </div>
                      <div class="calc__bottom">
                        <ul class="calc-results">
                          <li class="calc-results__item">
                            <p class="calc-results__title">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Profit' contenteditable="true">{{ __('Profit') }}</editor_block>
                              @else
                                {{ __('Profit') }}
                              @endif
                            </p>
                          </li>
                          <li class="calc-results__item">
                            <p class="calc-results__count day" style="font-size:16px;">7.50
                            </p>
                            <p class="calc-results__currency">BTC
                            </p>
                            <p class="calc-results__description day">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='per day' contenteditable="true">{{ __('per day') }}</editor_block>
                              @else
                                {{ __('per day') }}
                              @endif
                            </p>
                          </li>
                          <li class="calc-results__item">
                            <p class="calc-results__count alltime" style="font-size:16px;">675.00
                            </p>
                            <p class="calc-results__currency">BTC
                            </p>
                            <p class="calc-results__description alltime">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='for the entire period' contenteditable="true">{{ __('for the entire period') }}</editor_block>
                              @else
                                {{ __('for the entire period') }}
                              @endif
                            </p>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="calculate-block__bottom">
                <div class="calculate-block__bottom-content">
                  <div class="calculate-block__bottom-text">
                    <p>
                      <strong>@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='If your deposit amount reaches over $1000, you will receive a bonus in the amount of 0.51%.' contenteditable="true">{{ __('If your deposit amount reaches over $1000, you will receive a bonus in the amount of 0.51%.') }}</editor_block>
                        @else
                          {{ __('If your deposit amount reaches over $1000, you will receive a bonus in the amount of 0.51%.') }}
                        @endif
                        <br>@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='1.28% - your new interest rate!' contenteditable="true">{{ __('1.28% - your new interest rate!') }}</editor_block>
                        @else
                          {{ __('1.28% - your new interest rate!') }}
                        @endif</strong></p>
                  </div>
                </div>
                <svg viewBox="0 0 1151 50">
                  <path d="M940.9125 49.836L748.5 49.672l-47.5-.7468-47.5-.7467-50-1.1203-50-1.1203-33-.9432-33-.9432-37.5-1.052-37.5-1.052-38-1.496-38-1.4959-52.5-2.451-52.5-2.4512-12.5-.5853-12.5-.5853-25-1.4713-25-1.4712-46-2.9513-46-2.9513L42 22.4069l-22.5-1.6308-4.6972-2.9584-4.6972-2.9584-3.4962-3.87L3.113 7.1196 1.5566 4.1094 0 1.0994V0h1151v32.6744l-3.9637 5.5353-3.9637 5.5352-4.8739 3.1276L1133.3249 50z" fill="#5d639d"></path>
                </svg>
              </div>
            </div>
          </div>
        </section>
      </div>
      <section class="faq">
        <div class="container">
          <div class="faq__top">
            <h3 class="faq__subtitle">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Got questions?' contenteditable="true">{{ __('Got questions?') }}</editor_block>
              @else
                {{ __('Got questions?') }}
              @endif
            </h3>
            <h3 class="faq__title">
              <span>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='FAQ' contenteditable="true">{{ __('FAQ') }}</editor_block>
                @else
                  {{ __('FAQ') }}
                @endif</span>
            </h3>
          </div>
          <div class="faq__content">
            <div class="faq-block accordion">
              <h3 class="faq-block__title">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='What is Luminex?' contenteditable="true">{{ __('What is Luminex?') }}</editor_block>
                @else
                  {{ __("What is Luminex?") }}
                @endif
              </h3>
              <div class="faq-block__content">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='This is an innovative company that opens opportunities to attract the funds of investors with various financial capabilities.' contenteditable="true">{{ __('This is an innovative company that opens opportunities to attract the funds of investors with various financial capabilities.') }}</editor_block>
                @else
                  {{ __("This is an innovative company that opens opportunities to attract the funds of investors with various financial capabilities.") }}
                @endif
              </div>
              <h3 class="faq-block__title">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='What is Luminex Technology?' contenteditable="true">{{ __('What is Luminex Technology?') }}</editor_block>
                @else
                  {{ __("What is Luminex Technology?") }}
                @endif
              </h3>
              <div class="faq-block__content">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Luminex Technology is the technology developed by the specialists of our company that allows us to quickly and efficiently use the funds of a large number of investors at once to profit on their total amount.' contenteditable="true">{{ __('Luminex Technology is the technology developed by the specialists of our company that allows us to quickly and efficiently use the funds of a large number of investors at once to profit on their total amount.') }}</editor_block>
                @else
                  {{ __("Luminex Technology is the technology developed by the specialists of our company that allows us to quickly and efficiently use the funds of a large number of investors at once to profit on their total amount.") }}
                @endif
              </div>
              <h3 class="faq-block__title">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Is Luminex an officially registered company?' contenteditable="true">{{ __('Is Luminex an officially registered company?') }}</editor_block>
                @else
                  {{ __("Is Luminex an officially registered company?") }}
                @endif
              </h3>
              <div class="faq-block__content">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name="Our company is officially registered, and works legally. All documents are presented on the company's website. By starting your work with this service, you enter into an agreement with us." contenteditable="true">{{ __("Our company is officially registered, and works legally. All documents are presented on the company's website. By starting your work with this service, you enter into an agreement with us.") }}</editor_block>
                @else
                  {{ __("Our company is officially registered, and works legally. All documents are presented on the company's website. By starting your work with this service, you enter into an agreement with us.") }}
                @endif
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
  
  <script>document.getElementById("investorsPageMenuItem").className = "navigation__item navigation__item--active";</script>

@endsection
