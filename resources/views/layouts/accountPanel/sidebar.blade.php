<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper">
            <a href="index.html">
                <img class="img-fluid for-light" src="{{ asset('accountPanel/images/logo/logo.png') }}" alt="">
                <img class="img-fluid for-dark" src="{{ asset('accountPanel/images/logo/logo_dark.png') }}" alt="">
            </a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
        </div>
        <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="{{ asset('accountPanel/images/logo/logo-icon.png') }}" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="index.html"><img class="img-fluid" src="{{ asset('accountPanel/images/logo/logo-icon.png') }}" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    {{--<li class="sidebar-main-title">
                        <div>
                            <h6 class="lan-1">General</h6>
                            <p class="lan-2">Dashboards,widgets & layout.</p>
                        </div>
                    </li>--}}
                    <li class="sidebar-list">
                        {{--<label class="badge badge-success">2</label>--}}
                        <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.dashboard') }}">
                            <i data-feather="home"></i><span class="lan-3">Dashboard</span>
                        </a>
                    </li>
                  <li class="sidebar-list">
                    {{--<label class="badge badge-success">2</label>--}}
                    <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.transactions') }}">
                      <i data-feather="home"></i><span>Все операции</span>
                    </a>
                  </li>
                    <li class="sidebar-list">
                        {{--<label class="badge badge-success">2</label>--}}
                        <a class="sidebar-link sidebar-title" href="{{ route('accountPanel.withdrawal') }}">
                            <i data-feather="home"></i><span>Вывод</span>
                        </a>
                    </li>
                  
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="#"><i data-feather="settings"></i><span class="lan-6">Настройки</span></a>
                        <ul class="sidebar-submenu">
                            <li><a href="{{ route('accountPanel.settings.security') }}">Безопасность</a></li>
                            <li><a href="chart-widget.html">Другое</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title" href="{{ route('logout') }}">
                            <i data-feather="log-out"></i><span>Logout</span>
                        </a>
                    </li>

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
