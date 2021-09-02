@extends('layouts.accountPanel.app')
@section('title', __('календарь'))
@section('content')
  
  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
      <div class="card">
        <div class="card-header">
          <h5>Календарь операций</h5>
        </div>
        <div class="card-block row">
          <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="d-flex event-calendar">
              <div id="lnb">
                <div class="lnb-calendars" id="lnb-calendars">
                  <div>
                    <div class="lnb-calendars-item">
                      <label>
                        <input class="tui-full-calendar-checkbox-square" type="checkbox" value="all" checked="" data-bs-original-title="" title="">
                        <span></span>
                        <strong>View all</strong>
                      </label>
                    </div>
                  </div>
                  <div class="lnb-calendars-d1" id="calendarList">
                    <div class="lnb-calendars-item">
                      <label style=""><input type="checkbox" class="tui-full-calendar-checkbox-round" value="1" checked="" data-bs-original-title="" title="">
                        <span style="border-color: rgb(158, 95, 255); background-color: rgb(158, 95, 255);"></span>
                        <span>My Calendar</span>
                      </label></div>
                    <div class="lnb-calendars-item">
                      <label style=""><input type="checkbox" class="tui-full-calendar-checkbox-round" value="2" checked="" data-bs-original-title="" title="">
                        <span style="border-color: rgb(0, 169, 255); background-color: rgb(0, 169, 255);"></span>
                        <span>Company</span>
                      </label></div>
                  </div>
                </div>
              </div>
              <div id="right">
                <div id="menu">
                  <div class="dropdown d-inline">
                    <button class="btn btn-default btn-sm dropdown-toggle" id="dropdownMenu-calendarType" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-bs-original-title="" title=""><i class="calendar-icon ic_view_week" id="calendarTypeIcon" style="margin-right: 4px;"></i><span id="calendarTypeName">Weekly</span><i class="calendar-icon tui-full-calendar-dropdown-arrow"></i></button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu-calendarType">
                      <li role="presentation"><a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily" data-bs-original-title="" title=""><i class="calendar-icon ic_view_day"></i>Daily</a></li>
                      <li role="presentation"><a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly" data-bs-original-title="" title=""><i class="calendar-icon ic_view_week"></i>Weekly</a></li>
                      <li role="presentation"><a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly" data-bs-original-title="" title=""><i class="calendar-icon ic_view_month"></i>Month</a></li>
                      <li class="dropdown-divider" role="presentation"></li>
                      <li role="presentation"><a role="menuitem" data-action="toggle-workweek" data-bs-original-title="" title=""></a>
                        <input class="tui-full-calendar-checkbox-square" type="checkbox" value="toggle-workweek" checked="" data-bs-original-title="" title=""><span class="checkbox-title"></span>Show weekends
                      </li>
                      <li role="presentation"><a role="menuitem" data-action="toggle-start-day-1" data-bs-original-title="" title=""></a>
                        <input class="tui-full-calendar-checkbox-square" type="checkbox" value="toggle-start-day-1" data-bs-original-title="" title=""><span class="checkbox-title"></span>Start Week on Monday
                      </li>
                      <li role="presentation"><a role="menuitem" data-action="toggle-narrow-weekend" data-bs-original-title="" title=""></a>
                        <input class="tui-full-calendar-checkbox-square" type="checkbox" value="toggle-narrow-weekend" data-bs-original-title="" title=""><span class="checkbox-title"></span>Narrower than weekdays
                      </li>
                    </ul>
                  </div><span id="menu-navi">
                          <button class="btn btn-default btn-sm move-today" type="button" data-action="move-today" data-bs-original-title="" title="">Today</button>
                          <button class="btn btn-default btn-sm move-day" type="button" data-action="move-prev" data-bs-original-title="" title=""><i class="calendar-icon ic-arrow-line-left" data-action="move-prev"></i></button>
                          <button class="btn btn-default btn-sm move-day" type="button" data-action="move-next" data-bs-original-title="" title=""><i class="calendar-icon ic-arrow-line-right" data-action="move-next"></i></button></span><span class="render-range" id="renderRange">2021.08.29 ~  09.04</span>
                </div>
                <div id="calendar"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    </div>
  </div>
@endsection
@push('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/vendors/calendar.css') }}">
@endpush
@push('scripts')
  <script src="{{ asset('accountPanel/js/calendar/tui-code-snippet.min.js') }}"></script>
 {{-- <script src="{{ asset('accountPanel/js/calendar/tui-time-picker.min.js') }}"></script>
  <script src="{{ asset('accountPanel/js/calendar/tui-date-picker.min.js') }}"></script>--}}
  <script src="{{ asset('accountPanel/js/calendar/moment.min.js') }}"></script>
  <script src="{{ asset('accountPanel/js/calendar/chance.min.js') }}"></script>
  <script src="{{ asset('accountPanel/js/calendar/tui-calendar.js') }}"></script>
  <script src="{{ asset('accountPanel/js/calendar/calendars.js') }}"></script>
  <script src="{{ asset('accountPanel/js/calendar/schedules.js') }}"></script>
  <script src="{{ asset('accountPanel/js/calendar/app.js') }}"></script>
@endpush
