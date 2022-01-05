<div class="page-header">
  <div class="header-wrapper row m-0">
    <form class="form-inline search-full col" action="#" method="get">
      <div class="form-group w-100">
        <div class="Typeahead Typeahead--twitterUsers">
          <div class="u-posRelative">
            <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Cuba .." name="q" title="" autofocus>
            <div class="spinner-border Typeahead-spinner" role="status">
              <span class="sr-only">Loading...</span>
            </div>
            <i class="close-search" data-feather="x"></i>
          </div>
          <div class="Typeahead-menu"></div>
        </div>
      </div>
    </form>
    <div class="header-logo-wrapper col-auto p-0">
      <div class="logo-wrapper">
        <a href="/">
          <img class="img-fluid" src="{{ asset('accountPanel/images/logo/sprint_bank.png') }}" alt="">
        </a>
      </div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
      </div>
    </div>
    <style>
        .currency-rates {
            display: block;
            max-width: 100%;
            white-space: nowrap;
            overflow: hidden;

        }

        .currency-rates .wrapper {
            /*-webkit-animation: scroll 10s infinite linear;*/
            /*-moz-animation: scroll 10s infinite linear;*/
            animation: scroll 60s infinite linear;
        }

        .currency-rates span {
            margin: 0 15px;
            display: inline-block;
        }

        /*@-webkit-keyframes scroll {*/
        /*    0% {*/
        /*        -webkit-transform: translate(100%, 0);*/
        /*        transform: translate(100%, 0);*/
        /*    }*/
        /*    100% {*/
        /*        -webkit-transform: translate(-100%, 0);*/
        /*        transform: translate(-100%, 0)*/
        /*    }*/
        /*}*/

        /*@-moz-keyframes scroll {*/
        /*    0% {*/
        /*        -moz-transform: translate(100%, 0);*/
        /*        transform: translate(100%, 0);*/
        /*    }*/
        /*    100% {*/
        /*        -webkit-transform: translate(-100%, 0);*/
        /*        transform: translate(-100%, 0)*/
        /*    }*/
        /*}*/

        @keyframes scroll {
            0% {
                transform: translate(100%, 0);
            }
            100% {
                transform: translate(-400%, 0)
            }
        }

    </style>

    <div class="left-header col-9 horizontal-wrapper ps-0 ">
      {{--     <div class="currency-rates">
               <div class="wrapper">
                   @forelse($currency_rates as $key => $rates)
                       <span>{{ $key }} - {{ $rates }}</span>
                   @empty
                   @endforelse
               </div>
           </div>--}}
      <strong style="font-size: 18px;">
          @if(canEditLang() && checkRequestOnEdit())
              <editor_block data-name='1 Sprint Token (SRT) =' contenteditable="true">{{ __('1 Sprint Token (SRT) =') }}</editor_block>
          @else
              {{ __('1 Sprint Token (SRT) =') }} {{ number_format(\App\Models\ExchangeRateLog::where('rate_id', 15)->orderBy('created_at', 'desc')->first()->new_rate ?? 1, 2, '.', '') }}$
          @endif
      </strong>
    </div>

    <div class="nav-right col-3 pull-right right-header p-0">
      <ul class="nav-menus">
        <li class="language-nav">
          <div class="translate_wrapper">
            <div class="current_lang">
              <div class="lang">
                <i class="flag-icon flag-icon-@if(session()->get('language') == 'en')us @else{{ session()->get('language') }}@endif"></i>
                {{-- <span class="lang-txt">{{ strtoupper(session()->get('language')) }}</span>--}}
              </div>
            </div>
            <div class="more_lang">
              @foreach($languages as $lang)
                <a href="{{ route('set.lang', $lang->code) }}" class="lang @if(session()->has('lang') && session()->get('language') == $lang->code)selected @endif">
                  <i class="flag-icon flag-icon-@if($lang->code == 'en')us @else{{ $lang->code }}@endif"></i>
                  <span class="lang-txt">{{ $lang->name }}<span> ({{strtoupper($lang->code)}})</span></span>
                </a>
              @endforeach
              {{--<a href="{{ route('set.lang', 'en') }}" class="lang selected" data-value="en"><i class="flag-icon flag-icon-us"></i>
                <span class="lang-txt">English<span> (US)</span></span>
              </a>
              <div class="lang" data-value="de"><i class="flag-icon flag-icon-de"></i>
                <span class="lang-txt">Deutsch</span>
              </div>
              <div class="lang" data-value="es"><i class="flag-icon flag-icon-es"></i>
                <span class="lang-txt">Español</span>
              </div>
              <div class="lang" data-value="fr"><i class="flag-icon flag-icon-fr"></i>
                <span class="lang-txt">Français</span>
              </div>
              <div class="lang" data-value="pt"><i class="flag-icon flag-icon-pt"></i>
                <span class="lang-txt">Português<span> (BR)</span></span>
              </div>
              <div class="lang" data-value="cn"><i class="flag-icon flag-icon-cn"></i>
                <span class="lang-txt">简体中文</span>
              </div>
              <div class="lang" data-value="ae"><i class="flag-icon flag-icon-ae"></i>
                <span class="lang-txt">لعربية <span> (ae)</span></span>
              </div>--}}
            </div>
          </div>
        </li>

        <style>
            .page-wrapper .page-header .header-wrapper .nav-right .notification-dropdown li:last-child {
                text-align: left !important;
            }

            .page-wrapper .page-header .header-wrapper .nav-right .notification-dropdown li:last-child p {
                margin-bottom: 0 !important;
            }
        </style>
        <li>
          <a class="waves-effect waves-block waves-light toggle-fullscreen" href="#">
            <i data-feather="maximize" class=""></i>
            <i data-feather="minimize" class="d-none"></i>
          </a>
        </li>
        <li class="onhover-dropdown">
          <div class="notification-box"><i data-feather="bell"> </i>@if($counts['notifications']>0)
              <span class="badge rounded-pill badge-secondary">{{ $counts['notifications'] ?? 0 }}</span>@endif
          </div>
          <ul class="notification-dropdown onhover-show-div" style="max-height: 400px; overflow: hidden auto;">
            <li><i data-feather="bell"></i>
              <h6 class="f-18 mb-0">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Уведомления' contenteditable="true">{{ __('Уведомления') }}</editor_block> @else {{ __('Уведомления') }} @endif</h6>
            </li>

            @forelse($navbar_notifications as $item)
                <?php
                if ($item->notification == null) {
                    continue;
                }
                ?>
              <li class="notification" data-id="{{ $item->id }}" data-count="{{ $counts['notifications'] ?? 0 }}">
                <p><i class="fa fa-circle-o me-3 font-success"> </i>{{ $item->notification->text ?? '' }}
                  <span class="pull-right">@if($item->notification->created_at){{ $item->notification->created_at->diffForHumans() }}@endif</span>
                </p>
              </li>
            @empty
              <li class="notification">
                <p><i class="fa fa-circle-o me-3 font-success"> </i>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='No notifications!' contenteditable="true">{{ __('No notifications!') }}</editor_block> @else {{ __('No notifications!') }} @endif
                  <span class="pull-right"></span>
                </p>
              </li>
            @endforelse
          </ul>
        </li>

        <li>
          <div class="mode"><i class="fa fa-moon-o"></i></div>
        </li>

        <li class="profile-nav onhover-dropdown p-0 me-0">
          <div class="media profile-media">
            <img class="b-r-10" src="{{ $user->avatar ? route('accountPanel.profile.get.avatar', auth()->user()->id) : asset('accountPanel/images/user/user.png') }}" alt="" width="36" height="36">
            <div class="media-body">
              <span>{{$user->login}}</span>
              <p class="mb-0 font-roboto d-flex">
                  @if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='{{ $user->roles()->first()->name ?? "Customer" }}' contenteditable="true">{{ __($user->roles()->first()->name ?? "Customer") }}</editor_block>
                  @else
                      {{ __($user->roles()->first()->name ?? "Customer") }}
                  @endif
                <i class="middle fa fa-angle-down" style="margin-left: 3px"></i></p>
            </div>
          </div>
          <ul class="profile-dropdown onhover-show-div">
            <li>
              <a href="{{ route('accountPanel.settings.profile') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif><i data-feather="user"></i>
                <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Account' contenteditable="true">{{ __('Account') }}</editor_block> @else {{ __('Account') }} @endif</span>
              </a>
            </li>

            <li>
              <a href="{{ route('accountPanel.settings.security') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif><i data-feather="settings"></i>
                <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Settings' contenteditable="true">{{ __('Settings') }}</editor_block> @else {{ __('Settings') }} @endif</span>
              </a>
            </li>

              <li>
                  <a href="{{ route('accountPanel.user-products.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif><i data-feather="shopping-bag"></i>
                      <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Покупки' contenteditable="true">{{ __('Покупки') }}</editor_block> @else {{ __('Покупки') }} @endif</span>
                  </a>
              </li>

            @if(canEditLang() && checkRequestOnEdit())
              <li>
                <a href="{{ url()->current() }}">
                  <i data-feather="edit-3"></i>
                  <span>{{ __('Default mode') }}</span>
                </a>
              </li>
            @elseif(canEditLang())
              <li>
                <a href="{{ url()->current() . '?edit=true' }}" >
                  <i data-feather="edit-3"></i>
                  <span>{{ __('Edit text') }}</span>
                </a>
              </li>
            @endif
            <li>
              <a href="{{route('logout')}}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif><i data-feather="log-in"> </i>
                <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Log out' contenteditable="true">{{ __('Log out') }}</editor_block> @else {{ __('Log out') }} @endif</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
