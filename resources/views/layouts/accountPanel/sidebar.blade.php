<div class="sidebar-wrapper">
  <div>
    <div class="logo-wrapper">
      <a href="{{ route('customer.main') }}" target="_blank">
        <img class="img-fluid for-light" src="{{ asset('accountPanel/images/logo/sprint_bank.png') }}" width="120" alt="">
        <img class="img-fluid for-dark" src="{{ asset('accountPanel/images/logo/sprint_bank.png') }}" width="120" alt="">
      </a>
      <div class="back-btn"><i class="fa fa-angle-left"></i></div>
      <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
    </div>
    <div class="logo-icon-wrapper">
      <a href="{{ route('customer.main') }}" target="_blank"><img class="img-fluid" src="{{ asset('accountPanel/images/logo/logo-icon.png') }}" alt="">
      </a>
    </div>
    <nav class="sidebar-main">
      <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
      <div id="sidebar-menu">
        <ul class="sidebar-links" id="simple-bar">
          <li class="back-btn">
            <a href="{{ route('customer.main') }}" target="_blank" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
              <img class="img-fluid" src="{{ asset('accountPanel/images/logo/logo-icon.png') }}" alt=""></a>
            <div class="mobile-back text-end">
              <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Back' contenteditable="true">{{ __('Back') }}</editor_block> @else {{ __('Back') }} @endif</span>
              <i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
          </li>
          <li class="sidebar-main-title">
            <a href="{{ route('customer.main') }}" class="d-block" target="_blank" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
              <h6 class="lan-1">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='General' contenteditable="true">{{ __('General') }}</editor_block> @else {{ __('General') }} @endif</h6>
              <p class="lan-2">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Dashboards,widgets & layout.' contenteditable="true">{{ __('Dashboards,widgets & layout.') }}</editor_block> @else {{ __('Dashboards,widgets & layout.') }} @endif</p>
            </a>
          </li>
          <li class="sidebar-list">
            {{--<label class="badge badge-success">2</label>--}}
            <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.dashboard') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
              <i data-feather="home"></i>
              <span class="lan-3">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Dashboard' contenteditable="true">{{ __('Dashboard') }}</editor_block> @else {{ __('Dashboard') }} @endif</span>
            </a>
          </li>
          <li class="sidebar-list">
            {{--<label class="badge badge-success">2</label>--}}
            <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.replenishment') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
              <i data-feather="dollar-sign"></i>
              <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Replenishment' contenteditable="true">{{ __('Replenishment') }}</editor_block> @else {{ __('Replenishment') }} @endif</span>
            </a>
          </li>
          <li class="sidebar-list">
            {{--<label class="badge badge-success">2</label>--}}
            <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.deposits.create') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
              <i data-feather="briefcase"></i>
              <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Create deposit' contenteditable="true">{{ __('Create deposit') }}</editor_block> @else {{ __('Create deposit') }} @endif</span>
            </a>
          </li>
          <li class="sidebar-list">
            {{--<label class="badge badge-success">2</label>--}}
            <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.withdrawal') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
              <i data-feather="dollar-sign"></i>
              <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Withdraw' contenteditable="true">{{ __('Withdraw') }}</editor_block> @else {{ __('Withdraw') }} @endif</span>
            </a>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="#" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
              <i data-feather="list"></i>
              <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Transactions' contenteditable="true">{{ __('Transactions') }}</editor_block> @else {{ __('Transactions') }} @endif</span>
            </a>
            <ul class="sidebar-submenu">
              <li class="">
                <a class="" href="{{ route('accountPanel.transactions') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i data-feather="list"></i>
                  <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='All transactions' contenteditable="true">{{ __('All transactions') }}</editor_block> @else {{ __('All transactions') }} @endif</span>
                </a>
              </li>
              <li class="">
                <a class="" href="{{ route('accountPanel.calendar') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i data-feather="calendar"></i>
                  <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Calendar' contenteditable="true">{{ __('Calendar') }}</editor_block> @else {{ __('Calendar') }} @endif</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="sidebar-list">
            {{--<label class="badge badge-success">2</label>--}}
          {{--  <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.referrals') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
              <i data-feather="users"></i>
              <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Referrals' contenteditable="true">{{ __('Referrals') }}</editor_block> @else {{ __('Referrals') }} @endif</span>
            </a>--}}

            <a class="sidebar-link sidebar-title" href="#">
              <i data-feather="users"></i>
              <span class="lan-6" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Referrals' contenteditable="true">{{ __('Referrals') }}</editor_block> @else {{ __('Referrals') }} @endif</span>
            </a>
            <ul class="sidebar-submenu">
              <li class="">
                {{--<label class="badge badge-success">2</label>--}}
                <a class="" href="{{ route('accountPanel.referrals.progress') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i data-feather="user"></i>
                  <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Progress' contenteditable="true">{{ __('Progress') }}</editor_block> @else {{ __('Progress') }} @endif</span>
                </a>
              </li>
              <li class="">
                {{--<label class="badge badge-success">2</label>--}}
                <a class="" href="{{ route('accountPanel.referrals.banners') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i data-feather="user"></i>
                  <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Banners' contenteditable="true">{{ __('Banners') }}</editor_block> @else {{ __('Banners') }} @endif</span>
                </a>
              </li>
              <li class="">
                {{--<label class="badge badge-success">2</label>--}}
                <a class="" href="{{ route('accountPanel.referrals.tree') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i data-feather="user"></i>
                  <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Referral tree' contenteditable="true">{{ __('Referral tree') }}</editor_block> @else {{ __('Referral tree') }} @endif</span>
                </a>
              </li>
            </ul>


          </li>
          <li class="sidebar-list">
            {{--<label class="badge badge-success">2</label>--}}
            <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.currency.exchange') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
              <i data-feather="trending-down"></i>
              <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Currency exchange' contenteditable="true">{{ __('Currency exchange') }}</editor_block> @else {{ __('Currency exchange') }} @endif</span>
            </a>
          </li>


            <li class="sidebar-list">
                {{--<label class="badge badge-success">2</label>--}}
                <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.ico') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                    <i data-feather="trending-down"></i>
                    <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='ICO' contenteditable="true">{{ __('ICO') }}</editor_block> @else {{ __('ICO') }} @endif @if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='(Soon)' contenteditable="true">{{ __('(Soon)') }}</editor_block> @else {{ __('(Soon)') }} @endif</span>
                </a>
            </li>

{{--            <li class="sidebar-list">--}}
{{--                --}}{{--<label class="badge badge-success">2</label>--}}
{{--                <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.shop') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>--}}
{{--                    <i data-feather="trending-down"></i>--}}
{{--                    <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Shop link' contenteditable="true">{{ __('Shop link') }}</editor_block> @else {{ __('Shop link') }} @endif @if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='(Soon)' contenteditable="true">{{ __('(Soon)') }}</editor_block> @else {{ __('(Soon)') }} @endif</span>--}}
{{--                </a>--}}
{{--            </li>--}}

            <li class="sidebar-list">
                {{--<label class="badge badge-success">2</label>--}}
                <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.products.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                    <i data-feather="shopping-bag"></i>
                    <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Магазин' contenteditable="true">{{ __('Магазин') }}</editor_block> @else {{ __('Магазин') }} @endif</span>
                </a>
            </li>

            <li class="sidebar-list">
                {{--<label class="badge badge-success">2</label>--}}
                <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.nft-marketplace') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                    <i data-feather="trending-up"></i>
                    <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='NFT маркетплейс' contenteditable="true">{{ __('NFT маркетплейс') }}</editor_block> @else {{ __('NFT маркетплейс') }} @endif @if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='(скоро)' contenteditable="true">{{ __('(скоро)') }}</editor_block> @else {{ __('(скоро)') }} @endif</span>
                </a>
            </li>

          <li class="sidebar-list">
            {{--<label class="badge badge-success">2</label>--}}
            <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.chat') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
              <i data-feather="message-circle"></i>
              <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Chat' contenteditable="true">{{ __('Chat') }}</editor_block> @else {{ __('Chat') }} @endif</span>
              <span class="round-badge-primary badge ">{{ $total_unread_messages > 0 ? "+" . $total_unread_messages : 0 }}</span>
            </a>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="#"><i data-feather="settings"></i>
              <span class="lan-6" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Settings' contenteditable="true">{{ __('Settings') }}</editor_block> @else {{ __('Settings') }} @endif</span>
            </a>
            <ul class="sidebar-submenu">
              <li class="">
                {{--<label class="badge badge-success">2</label>--}}
                <a class="" href="{{ route('accountPanel.settings.profile') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i data-feather="user"></i>
                  <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Profile' contenteditable="true">{{ __('Profile') }}</editor_block> @else {{ __('Profile') }} @endif</span>
                </a>
              </li>
              <li class="">
                {{--<label class="badge badge-success">2</label>--}}
                <a class="" href="{{ route('accountPanel.settings.wallets') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i data-feather="user"></i>
                  <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Wallets' contenteditable="true">{{ __('Wallets') }}</editor_block> @else {{ __('Wallets') }} @endif</span>
                </a>
              </li>
              <li class="">
                {{--<label class="badge badge-success">2</label>--}}
                <a class="" href="{{ route('accountPanel.settings.verify') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i data-feather="user"></i>
                  <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Verify' contenteditable="true">{{ __('Verify') }}</editor_block> @else {{ __('Verify') }} @endif</span>
                </a>
              </li>
              <li class="">
                {{--<label class="badge badge-success">2</label>--}}
                <a class="" href="{{ route('accountPanel.support-tasks.index') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i data-feather="info"></i>
                  <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Support tasks' contenteditable="true">{{ __('Support tasks') }}</editor_block> @else {{ __('Support tasks') }} @endif</span>
                </a>
              </li>
              <li>
                <a href="{{ route('accountPanel.settings.security') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                    <i data-feather="user"></i>
                    <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Security' contenteditable="true">{{ __('Security') }}</editor_block> @else {{ __('Security') }} @endif</span>
                </a>
              </li>
            </ul>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="{{ route('logout') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
              <i data-feather="log-out"></i>
              <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Logout' contenteditable="true">{{ __('Logout') }}</editor_block> @else {{ __('Logout') }} @endif</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
  </div>
</div>
