<nav class="navigation">
    <ul class="navigation__list">
        <li id="homePageMenuItem" class="navigation__item"><a class="navigation__link" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif href="{{ route('customer.main') }}">
            @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Home' contenteditable="true">{{ __('Home') }}</editor_block>
            @else
              {{ __('Home') }}
            @endif</a>
        </li>
        <li id="aboutUsPageMenuItem" class="navigation__item"><a class="navigation__link" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif href="{{ route('customer.aboutus') }}">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='About us' contenteditable="true">{{ __('About us') }}</editor_block>
            @else
              {{ __('About us') }}
            @endif</a>
        </li>
        <li id="investorsPageMenuItem" class="navigation__item"><a class="navigation__link" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif href="{{ route('customer.investors') }}">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='For investors' contenteditable="true">{{ __('For investors') }}</editor_block>
            @else
              {{ __('For investors') }}
            @endif</a>
        </li>
        <li id="partnersPageMenuItem" class="navigation__item"><a class="navigation__link" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif href="{{ route('customer.partners') }}">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='For partners' contenteditable="true">{{ __('For partners') }}</editor_block>
            @else
              {{ __('For partners') }}
            @endif</a>
        </li>
        <li id="contactPageMenuItem" class="navigation__item"><a class="navigation__link" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif href="{{ route('customer.contact') }}">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Contacts' contenteditable="true">{{ __('Contacts') }}</editor_block>
            @else
              {{ __('Contacts') }}
            @endif</a>
        </li>
        <li id="faqPageMenuItem" class="navigation__item"><a class="navigation__link" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif href="{{ route('customer.faq') }}">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='FAQ' contenteditable="true">{{ __('FAQ') }}</editor_block>
            @else
              {{ __('FAQ') }}
            @endif</a>
        </li>
        <!-- <li id="payoutPageMenuItem" class="navigation__item"><a class="navigation__link" href="{{ route('customer.payout') }}">{{ __('Выплаты') }}</a>
        </li> -->
    </ul>
</nav>
