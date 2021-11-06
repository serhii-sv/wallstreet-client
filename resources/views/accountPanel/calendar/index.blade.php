@extends('layouts.accountPanel.app')
@section('title')
Calendar page
@endsection
@section('content')

  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
      <div class="card" style="margin-top:50px;">
        <div class="card-header">
          <h5>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Calendar page' contenteditable="true">{{ __('Calendar page') }}</editor_block> @else {{ __('Calendar page') }} @endif</h5>
        </div>
        <div class="card-block row">
          <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="d-flex event-calendar">
              <div id="lnb">
                <div class="lnb-calendars" id="lnb-calendars">
                  {{--       <div>
                           <div class="lnb-calendars-item">
                             <label>
                               <input class="tui-full-calendar-checkbox-square" type="checkbox" value="all" checked="" data-bs-original-title="" title="">
                               <span></span>
                               <strong>Показать все</strong>
                             </label>
                           </div>
                         </div>--}}
                  <div class="lnb-calendars-d1" id="calendarList">
                    <div class="lnb-calendars-item">
                      <label style=""><input type="checkbox" class="tui-full-calendar-checkbox-round" value="1" checked="" data-bs-original-title="" title="">
                        <span style="border-color: rgb(158, 95, 255); background-color: rgb(158, 95, 255);"></span>
                        <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Accruals' contenteditable="true">{{ __('Accruals') }}</editor_block> @else {{ __('Accruals') }} @endif</span>
                      </label>
                    </div>
                    <div class="lnb-calendars-item">
                      <label style=""><input type="checkbox" class="tui-full-calendar-checkbox-round" value="2" checked="" data-bs-original-title="" title="">
                        <span style="border-color: rgb(0, 169, 255); background-color: rgb(0, 169, 255);"></span>
                        <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Conclusions' contenteditable="true">{{ __('Conclusions') }}</editor_block> @else {{ __('Conclusions') }} @endif</span>
                      </label>
                    </div>
                    <div class="lnb-calendars-item">
                      <label style=""><input type="checkbox" class="tui-full-calendar-checkbox-round" value="3" checked="" data-bs-original-title="" title="">
                        <span style="border-color: rgb(0, 169, 255); background-color: rgb(0, 169, 255);"></span>
                        <span>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Referral' contenteditable="true">{{ __('Referral') }}</editor_block> @else {{ __('Referral') }} @endif</span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div id="right">
                {{--<div id="menu">
                  <div class="dropdown d-inline">
                    <button class="btn btn-default btn-sm dropdown-toggle" id="dropdownMenu-calendarType" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true" data-bs-original-title="" title="">
                      <i class="calendar-icon ic_view_week" id="calendarTypeIcon" style="margin-right: 4px;"></i>
                      <span id="calendarTypeName">Weekly</span>
                      <i class="calendar-icon tui-full-calendar-dropdown-arrow"></i></button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu-calendarType">
                      <li role="presentation">
                        <a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily" data-bs-original-title="" title="">
                          <i class="calendar-icon ic_view_day"></i>Daily
                        </a>
                      </li>
                      --}}{{--                      <li role="presentation"><a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly" data-bs-original-title="" title=""><i class="calendar-icon ic_view_week"></i>Weekly</a></li>--}}{{--
                      <li role="presentation">
                        <a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly" data-bs-original-title="" title="">
                          <i class="calendar-icon ic_view_month"></i>Month
                        </a>
                      </li>
                    </ul>
                  </div>
                  <span id="menu-navi">
                          <button class="btn btn-default btn-sm move-today" type="button" data-action="move-today" data-bs-original-title="" title="">Today</button>
                          <button class="btn btn-default btn-sm move-day" type="button" data-action="move-prev" data-bs-original-title="" title=""><i class="calendar-icon ic-arrow-line-left" data-action="move-prev"></i></button>
                          <button class="btn btn-default btn-sm move-day" type="button" data-action="move-next" data-bs-original-title="" title=""><i class="calendar-icon ic-arrow-line-right" data-action="move-next"></i></button></span>
                  <span class="render-range" id="renderRange">2021.08.29 ~  09.04</span>
                </div>--}}
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
  <script>
    console.log(window.cal);
    var title = "Test";
    var isAllDay = true;
    var start = new Date();
    var end = new Date();
    var calendarList = document.getElementById('calendarList');
    var html = [];
    CalendarList.forEach(function (calendar) {
      @if($partners)
      @foreach($partners as $day => $items)
      @foreach($items as $item)
        if (calendar.id == 1) {
          window.cal.createSchedules([{
            id: String(chance.guid()),
            calendarId: calendar.id,
            title: "Реферальные {{ $item->main_currency_amount }}$",
            body: "Вам начислено {{ $item->amount . $item->currency->symbol }} ({{ $item->main_currency_amount }}$) за реферальные",
            isAllDay: isAllDay,
            start: "{{ $day }}",
            end: "{{ $day }}",
            category: isAllDay ? 'allday' : 'time',
            dueDateClass: '',
            color: calendar.color,
            bgColor: calendar.bgColor,
            dragBgColor: calendar.bgColor,
            borderColor: calendar.borderColor,
          }]);
        }
      @endforeach
      @endforeach
      @endif
      @if($bonuses)
      @foreach($bonuses as $day => $items)
      @foreach($items as $item)
      if (calendar.id == 1) {
        window.cal.createSchedules([{
          id: String(chance.guid()),
          calendarId: calendar.id,
          title: "Бонус {{ $item->main_currency_amount }}$",
          body: "Вам начислен бонус, в размере {{ $item->amount . $item->currency->symbol }} ({{ $item->main_currency_amount }}$) ",
          isAllDay: isAllDay,
          start: "{{ $day }}",
          end: "{{ $day }}",
          category: isAllDay ? 'allday' : 'time',
          dueDateClass: '',
          color: calendar.color,
          bgColor: calendar.bgColor,
          dragBgColor: calendar.bgColor,
          borderColor: calendar.borderColor,
        }]);
      }
      @endforeach
      @endforeach
      @endif
      @if($dividends)
      @foreach($dividends as $day => $items)
      @foreach($items as $item)
      if (calendar.id == 1) {
        window.cal.createSchedules([{
          id: String(chance.guid()),
          calendarId: calendar.id,
          title: "Дивиденды {{ $item->main_currency_amount }}$",
          body: "Вам начислено {{ $item->amount . $item->currency->symbol }} ({{ $item->main_currency_amount }}$) за депозит {{ $item->rate->name ?? '' }}",
          isAllDay: isAllDay,
          start: "{{ $day }}",
          end: "{{ $day }}",
          category: isAllDay ? 'allday' : 'time',
          dueDateClass: '',
          color: calendar.color,
          bgColor: calendar.bgColor,
          dragBgColor: calendar.bgColor,
          borderColor: calendar.borderColor,
        }]);
      }
      @endforeach
      @endforeach
      @endif
      @if($transfers)
      @foreach($transfers as $day => $items)
      @foreach($items as $item)
      if (calendar.id == 1) {
          window.cal.createSchedules([{
            id: String(chance.guid()),
            calendarId: calendar.id,
            title: "Перевод средств {{ $item->main_currency_amount }}$",
            body: "Вам перевели {{ $item->amount . $item->currency->symbol }} ({{ $item->main_currency_amount }}$)",
            isAllDay: isAllDay,
            start: "{{ $day }}",
            end: "{{ $day }}",
            category: isAllDay ? 'allday' : 'time',
            dueDateClass: '',
            color: calendar.color,
            bgColor: calendar.bgColor,
            dragBgColor: calendar.bgColor,
            borderColor: calendar.borderColor,
          }]);
        }
        @endforeach
      @endforeach
      @endif

      @foreach($withdraws as $day => $items)
      @foreach($items as $item)
      if (calendar.id == 2) {
        window.cal.createSchedules([{
          id: String(chance.guid()),
          calendarId: calendar.id,
          title: "Вывод средств {{ $item->main_currency_amount }}$",
          body: "Вы вывели {{ $item->amount . $item->currency->symbol }} ({{ $item->main_currency_amount }}$)",
          isAllDay: isAllDay,
          start: "{{ $day }}",
          end: "{{ $day }}",
          category: isAllDay ? 'allday' : 'time',
          dueDateClass: '',
          color: calendar.color,
          bgColor: calendar.bgColor,
          dragBgColor: calendar.bgColor,
          borderColor: calendar.borderColor,
        }]);
      }
      @endforeach
      @endforeach

          calendarList.innerHTML
          = html.join('\n');
      html.push('<div class="lnb-calendars-item"><label>' +
          '<input type="checkbox" class="tui-full-calendar-checkbox-round" value="' + calendar.id + '" checked>' +
          '<span style="border-color: ' + calendar.borderColor + '; background-color: ' + calendar.borderColor + ';"></span>' +
          '<span>' + calendar.name + '</span>' +
          '</label></div>'
      );
    });
    calendarList.innerHTML = html.join('\n');

  </script>
@endpush
