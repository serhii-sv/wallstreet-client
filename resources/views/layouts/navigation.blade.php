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
                    {{ __('About') }}
            @endif</a>
        </li>
        <li id="partnersPageMenuItem" class="navigation__item"><a class="navigation__link" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif href="{{ route('customer.partners') }}">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='For partners' contenteditable="true">{{ __('For partners') }}</editor_block>
            @else
              {{ __('Affiliate') }}
            @endif</a>
        </li>
        <li id="faqPageMenuItem" class="navigation__item"><a class="navigation__link" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif href="{{ route('customer.faq') }}">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='FAQ' contenteditable="true">{{ __('FAQ') }}</editor_block>
                @else
                    {{ __('Faqs') }}
                @endif</a>
        </li>
        <li id="newsPageMenuItem" class="navigation__item"><a class="navigation__link" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif href="{{ route('customer.news') }}">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='news' contenteditable="true">{{ __('news') }}</editor_block>
                @else
                    {{ __('news') }}
                @endif</a>
        </li>
        <li id="contactPageMenuItem" class="navigation__item"><a class="navigation__link" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif href="{{ route('customer.contact') }}">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Contacts' contenteditable="true">{{ __('Contacts') }}</editor_block>
            @else
                    {{ __('Contact') }}
            @endif</a>
        </li>
    </ul>
</nav>
