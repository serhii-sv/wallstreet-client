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
        <a href="/"><img class="img-fluid" src="{{ asset('accountPanel/images/logo/logo.png') }}" alt=""></a>
      </div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
    </div>
    <style>
      .currency-rates{
          display: block;
          max-width: 100%;
          white-space: nowrap;
          overflow: hidden;
      
      }
      .currency-rates .wrapper{
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
    
    <div class="left-header col-9 horizontal-wrapper ps-0">
      <div class="currency-rates">
        <div class="wrapper">
        @forelse($currency_rates as $key => $rates)
          <span>{{ $key }} - {{ $rates }}</span>
        @empty
        @endforelse
        </div>
      </div>
    </div>

    <div class="nav-right col-3 pull-right right-header p-0">
      <ul class="nav-menus">
        <li class="language-nav">
          <div class="translate_wrapper">
            <div class="current_lang">
              <div class="lang"><i class="flag-icon flag-icon-@if(session()->get('lang') == 'en')us @else{{ session()->get('lang') }}@endif"></i>
                <span class="lang-txt">{{ strtoupper(session()->get('lang')) }}</span>
              </div>
            </div>
            <div class="more_lang">
              @foreach($languages as $lang)
                <a href="{{ route('set.lang', $lang->code) }}" class="lang @if(session()->has('lang') && session()->get('lang') == $lang->code)selected @endif">
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
        <li class="onhover-dropdown">
          <div class="notification-box"><i data-feather="bell"> </i>@if($counts['notifications']>0)
              <span class="badge rounded-pill badge-secondary">{{ $counts['notifications'] ?? 0 }}</span>@endif</div>
          <ul class="notification-dropdown onhover-show-div" style="max-height: 400px; overflow: hidden auto;">
            <li><i data-feather="bell"></i>
              <h6 class="f-18 mb-0">Уведомления</h6>
            </li>
            
            @forelse($navbar_notifications as $item)
              <li class="notification" data-id="{{ $item->id }}" data-count="{{ $counts['notifications'] ?? 0 }}">
                <p><i class="fa fa-circle-o me-3 font-success"> </i>{{ $item->notification->text }}
                  <span class="pull-right">@if($item->notification->created_at){{ $item->notification->created_at->diffForHumans() }}@endif</span>
                </p>
              </li>
            @empty
              <li class="notification">
                <p><i class="fa fa-circle-o me-3 font-success"> </i>Уведомлений нет!
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
            <img class="b-r-10" src="{{ asset('accountPanel/images/dashboard/profile.jpg') }}" alt="">
            <div class="media-body">
              <span>{{$user->name}}</span>
              <p class="mb-0 font-roboto">{{$user->roles()->first()->name ?? "Customer"}}
                <i class="middle fa fa-angle-down"></i></p>
            </div>
          </div>
          <ul class="profile-dropdown onhover-show-div">
            <li>
              <a href="{{ route('accountPanel.profile') }}"><i data-feather="user"></i>
                <span>Account </span>
              </a>
            </li>
            <li>
              <a href="{{ route('accountPanel.support-tasks.index') }}"><i data-feather="file-text"></i>
                <span>Taskboard</span>
              </a>
            </li>
            <li>
              <a href="{{ route('accountPanel.settings.security') }}"><i data-feather="settings"></i>
                <span>Settings</span>
              </a>
            </li>
            <li>
              <a href="{{route('logout')}}"><i data-feather="log-in"> </i>
                <span>Log out</span>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>
