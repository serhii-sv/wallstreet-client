<footer class="footer">
  <div class="container">
    <section class="top">
      <div class="container">
        @include('layouts.navigation')
      </div>
    </section>
    <div class="main-line container">
      <a class="main-line__logo" href="{{ route('customer.main') }}"><img src="{{ asset('accountPanel/images/logo/sprint_bank_fin-02.png') }}" width="80" alt=""></a>
      <p class="main-line__slogan">Energy of Cryptocurrency
      </p>
      <!-- <div class="main-line__call"><a class="main-line__phone" href="tel:+121232233456">+12 123 223-34-56 </a>
          <a class="main-line__link" href="#call" data-fancybox="" data-modal="true">Обратный звонок</a>
      </div> -->
      @if(Auth::user())
        <div class="main-line__buttons">
          <a class="btn btn--white main-line__btn" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif href="/profile">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Profile' contenteditable="true">{{ __('Profile') }}</editor_block>
            @else
              {{ __('Profile') }}
            @endif {{auth()->user()->name}}</a>

            <a class="btn btn--accent2 main-line__btn" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @else onclick="event.preventDefault(); document.getElementById('logout-form').submit();" @endif href="#">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Log out' contenteditable="true">{{ __('Log out') }}</editor_block>
              @else
                {{ __('Log out') }}
              @endif</a>
        </div>
      @else
        <div class="main-line__buttons">
          <a class="btn btn--white main-line__btn" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif href="#">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Log in' contenteditable="true">{{ __('Log in') }}</editor_block>
            @else
              {{ __('Log in') }}
            @endif</a>
          <a class="btn btn--accent2 main-line__btn" href="#"
              @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif
          >
            @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Registration' contenteditable="true">{{ __('Registration') }}</editor_block>
            @else
              {{ __('Registration') }}
            @endif
          </a>
        </div>
      @endif
    </div>
  </div>
</footer>
