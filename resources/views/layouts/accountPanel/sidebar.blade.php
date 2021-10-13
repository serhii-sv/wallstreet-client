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
            <a href="{{ route('customer.main') }}" target="_blank">
              <img class="img-fluid" src="{{ asset('accountPanel/images/logo/logo-icon.png') }}" alt=""></a>
            <div class="mobile-back text-end">
              <span>Back</span>
              <i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
          </li>
          <li class="sidebar-main-title">
            <a href="{{ route('customer.main') }}" class="d-block" target="_blank">
              <h6 class="lan-1">General</h6>
              <p class="lan-2">Dashboards,widgets & layout.</p>
            </a>
          </li>
          <li class="sidebar-list">
            {{--<label class="badge badge-success">2</label>--}}
            <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.dashboard') }}">
              <i data-feather="home"></i>
              <span class="lan-3">{{ __('Dashboard') }}</span>
            </a>
          </li>
          <li class="sidebar-list">
            {{--<label class="badge badge-success">2</label>--}}
            <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.deposits.create') }}">
              <i data-feather="briefcase"></i>
              <span>{{ __('Create deposit') }}</span>
            </a>
          </li>
          <li class="sidebar-list">
            {{--<label class="badge badge-success">2</label>--}}
            <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.deposits.index') }}">
              <i data-feather="briefcase"></i>
              <span>{{ __('Deposits') }}</span>
            </a>
          </li>
  
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="#">
              <i data-feather="list"></i>
              <span>{{ __('Transactions') }}</span>
            </a>
            <ul class="sidebar-submenu">
              <li class="">
                <a class="" href="{{ route('accountPanel.transactions') }}">
                  <i data-feather="list"></i>
                  <span>{{ __('All transactions') }}</span>
                </a>
              </li>
              <li class="">
                <a class="" href="{{ route('accountPanel.calendar') }}">
                  <i data-feather="calendar"></i>
                  <span>{{ __('Calendar') }}</span>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="sidebar-list">
            {{--<label class="badge badge-success">2</label>--}}
            <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.replenishment') }}">
              <i data-feather="dollar-sign"></i>
              <span>{{ __('Replenishment') }}</span>
            </a>
          </li>
          <li class="sidebar-list">
            {{--<label class="badge badge-success">2</label>--}}
            <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.withdrawal') }}">
              <i data-feather="dollar-sign"></i>
              <span>{{ __('Withdraw') }}</span>
            </a>
          </li>
          <li class="sidebar-list">
            {{--<label class="badge badge-success">2</label>--}}
            <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.currency.exchange') }}">
              <i data-feather="trending-down"></i>
              <span>{{ __('Currency exchange') }}</span>
            </a>
          </li>
          <li class="sidebar-list">
            {{--<label class="badge badge-success">2</label>--}}
            <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.referrals') }}">
              <i data-feather="users"></i>
              <span>{{ __('Refferals') }}</span>
            </a>
          </li>
          <li class="sidebar-list">
            {{--<label class="badge badge-success">2</label>--}}
            <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.chat') }}">
              <i data-feather="message-circle"></i>
              <span>{{ __('Chat') }}</span>
              <span class="round-badge-primary badge ">{{ $total_unread_messages > 0 ? "+" . $total_unread_messages : 0 }}</span>
            </a>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="#"><i data-feather="settings"></i>
              <span class="lan-6">Настройки</span>
            </a>
            <ul class="sidebar-submenu">
              <li class="">
                {{--<label class="badge badge-success">2</label>--}}
                <a class="" href="{{ route('accountPanel.profile') }}">
                  <i data-feather="user"></i>
                  <span>{{ __('Profile') }}</span>
                </a>
              </li>
              <li class="">
                {{--<label class="badge badge-success">2</label>--}}
                <a class="" href="{{ route('accountPanel.support-tasks.index') }}">
                  <i data-feather="info"></i>
                  <span>{{ __('Support tasks') }}</span>
                </a>
              </li>
              <li>
                <a href="{{ route('accountPanel.settings.security') }}">{{ __('Security') }}</a>
              </li>
            </ul>
          </li>
          <li class="sidebar-list">
            <a class="sidebar-link sidebar-title" href="{{ route('logout') }}">
              <i data-feather="log-out"></i>
              <span>{{ __('Logout') }}</span>
            </a>
          </li>
        </ul>
      </div>
      <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
  </div>
</div>
