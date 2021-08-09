<footer class="footer-section">
  <div class="newslater-section padding-bottom">
    <div class="container">
      <div class="newslater-area">
        <div class="newslater-content padding-bottom padding-top">
          <span class="cate">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='SUBSCRIBE TO hyipland' contenteditable="true">{{ __('SUBSCRIBE TO hyipland') }}</editor_block>
            @else
              {{ __('SUBSCRIBE TO hyipland') }}
            @endif</span>
          <h3 class="title">@if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='To Get Exclusive Benefits' contenteditable="true">{{ __('To Get Exclusive Benefits') }}</editor_block>
            @else
              {{ __('To Get Exclusive Benefits') }}
            @endif
          </h3>
          <form class="newslater-form">
            <input type="text" placeholder="Enter Your Email Here" required>
            <button type="submit" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='subscribe' contenteditable="true">{{ __('subscribe') }}</editor_block>
              @else
                {{ __('subscribe') }}
              @endif
            </button>
          </form>
        </div>
        <div class="newslater-thumb">
          <img src="{{ asset('theme/images/footer/footer.png') }}" alt="footer">
          <div class="coin-1">
            <img src="{{ asset('theme/images/footer/Coin_01.png') }}" alt="footer">
          </div>
          <div class="coin-2">
            <img src="{{ asset('theme/images/footer/Coin_02.png') }}" alt="footer">
          </div>
          <div class="coin-3">
            <img src="{{ asset('theme/images/footer/Coin_03.png') }}" alt="footer">
          </div>
          <div class="coin-4">
            <img src="{{ asset('theme/images/footer/Coin_04.png') }}" alt="footer">
          </div>
          <div class="coin-5">
            <img src="{{ asset('theme/images/footer/Coin_05.png') }}" alt="footer">
          </div>
          <div class="coin-6">
            <img src="{{ asset('theme/images/footer/Coin_06.png') }}" alt="footer">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="footer-top">
      <div class="logo">
        <a href="">
          <img src="{{ asset('theme/images/logo/footer-logo.png') }}" alt="logo">
        </a>
      </div>
      <ul class="links">
        <li>
          <a href="{{ route('customer.aboutus') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>  @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='About' contenteditable="true">{{ __('About') }}</editor_block>
            @else
              {{ __('About') }}
            @endif</a>
        </li>
        <li>
          <a href="{{ route('customer.partners') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>  @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Affiliates' contenteditable="true">{{ __('Affiliates') }}</editor_block>
            @else
              {{ __('Affiliates') }}
            @endif</a>
        </li>

        <li>
          <a href="{{ route('customer.faq') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>  @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='FAQ' contenteditable="true">{{ __('FAQ') }}</editor_block>
            @else
              {{ __('FAQ') }}
            @endif</a>
        </li>
        <li>
          <a href="{{ route('customer.agreement') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>  @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Privacy Policy' contenteditable="true">{{ __('Privacy Policy') }}</editor_block>
            @else
              {{ __('Privacy Policy') }}
            @endif</a>
        </li>
        <li>
          <a href="{{ route('customer.contact') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>  @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='Contact' contenteditable="true">{{ __('Contact') }}</editor_block>
            @else
              {{ __('Contact') }}
            @endif</a>
        </li>
      </ul>
    </div>
    <div class="footer-bottom">
      <div class="footer-bottom-area">
        <div class="left">
          <p>&copy; 2020
            <a href="{{ route('customer.main') }}">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Hyipland' contenteditable="true">{{ __('Hyipland') }}</editor_block>
              @else
                {{ __('Hyipland') }}
                @endif </a>
            | @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='All right reserved' contenteditable="true">{{ __('All right reserved') }}</editor_block>
            @else
              {{ __('All right reserved') }}
            @endif
          </p>
        </div>
        <ul class="social-icons">
          <li>
            <a href="#0">
              <i class="fab fa-facebook-f"></i>
            </a>
          </li>
          <li>
            <a href="#0" class="active">
              <i class="fab fa-twitter"></i>
            </a>
          </li>
          <li>
            <a href="#0">
              <i class="fab fa-pinterest-p"></i>
            </a>
          </li>
          <li>
            <a href="#0">
              <i class="fab fa-instagram"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>
