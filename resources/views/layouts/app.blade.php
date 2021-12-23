<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('theme/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/owl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/css/main.css') }}">
      <link rel="stylesheet" href="{{ asset('accountPanel/css/vendors/feather-icon.css') }}">
      <link rel="stylesheet" href="{{ asset('accountPanel/css/font-awesome.css') }}">
      <link rel="stylesheet" href="{{ asset('accountPanel/css/spinner.css') }}">

    @yield('styles')
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <script src="//code-eu1.jivosite.com/widget/WTWc6WTrkx" async></script>
      <style>
          ::-webkit-scrollbar {
              width: 16px;
          }
          ::-webkit-scrollbar-track {
              background: 0 0;
              padding: 0 6px;
          }
          ::-webkit-scrollbar-thumb {
              background: url(/accountPanel/images/scroll.png) center no-repeat;
              background-size: contain;
          }
      </style>
  </head>

  <body>
  <div class="spinner-wrapper">
      <div class="spinning-loader">
          <i></i>
          <i></i>
          <i></i>
          <i></i>
          <i></i>
          <i></i>
          <i></i>
      </div>
  </div>
    @include('layouts.admin_edit_lang')
    <div class="m-wrapper position-relative">
      @yield('content')
    </div>

    <script src="{{ asset('theme/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('theme/js/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('theme/js/plugins.js') }}"></script>
    <script src="{{ asset('theme/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('theme/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('theme/js/wow.min.js') }}"></script>
    <script src="{{ asset('theme/js/odometer.min.js') }}"></script>
    <script src="{{ asset('theme/js/viewport.jquery.js') }}"></script>
    <script src="{{ asset('theme/js/nice-select.js') }}"></script>
    <script src="{{ asset('theme/js/owl.min.js') }}"></script>
    <script src="{{ asset('accountPanel/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('accountPanel/js/icons/feather-icon/feather-icon.js') }}"></script>
    <script src="{{ asset('theme/js/paroller.js') }}"></script>
    <script src="{{ asset('theme/js/main.js') }}"></script>
    <script src="{{ asset('accountPanel/js/jquery.mask.min.js') }}"></script>
  @if(\App\Models\Setting::getValue('enable_snow', '', true) == 'true')
    @include('partials.show')
  @endif
  <script>
      window.addEventListener("load", function() {
          $('.spinner-wrapper').remove()
      });
      $(function () {
          setTimeout(function () {
              $('.spinner-wrapper').remove()
          }, 4000)
      })
  </script>
    @if(auth()->check() && (!(auth()->user()->country) || !(auth()->user()->city) || !(auth()->user()->ip)))
      <script src="//geoip-js.com/js/apis/geoip2/v2.1/geoip2.js" type="text/javascript"></script>
      <script>
        $(document).ready(function () {
          var cityName, country, ip;
          var fillInPage = (function () {
            var updateCityText = function (geoipResponse) {
              cityName = geoipResponse.city.names.ru || 'your city';
              country = geoipResponse.country.names.ru || 'your country';
              ip = geoipResponse.traits.ip_address || 'ip';
              $.ajax({
                type: 'post',
                async: true,
                url: '{{ route('ajax.set.user.location') }}',
                data: 'country=' + country + '&city=' + cityName + '&ip=' + ip,
                headers: {
                  'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                  data = $.parseJSON(data);
                  console.log(data);
                }
              });
            };

            var onSuccess = function (geoipResponse) {
              updateCityText(geoipResponse);
            };

            var onError = function (error) {
              console.log(error);
            };

            return function () {
              if (typeof geoip2 !== 'undefined') {
                geoip2.city(onSuccess, onError);
              } else {
                console.log('a browser that blocks GeoIP2 requests');
              }
            };
          }());
          fillInPage();
        });
      </script>
    @endif
    @if(canEditLang() && checkRequestOnEdit())
      <script>
        $(document).ready(function () {
          class Request {
            constructor() {
              this.protocol = '';
              this.domain = '';
              this.params = {};

            }

            postJsonRequestAjax(url, method, data, callbackSuccess, callbackFail, callbackBefore, callbackAfter) {
              callbackSuccess = callbackSuccess || function () {
              };
              callbackFail = callbackFail || function () {
              };
              callbackBefore = callbackBefore || function () {
              };
              callbackAfter = callbackAfter || function () {
              };
              method = method || 'POST';
              data = data || {};
              url = url || '';

              callbackBefore({}, data);

              $.ajax({
                type: method,
                url: url,
                data: data,
                headers: {
                  'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                  if (data.error) {
                    callbackFail({}, data);
                    callbackAfter({}, data);
                    return;
                  }
                  callbackSuccess(data.data, data);
                  callbackAfter({}, data);
                },
                error: function (data) {
                  callbackFail({}, data);
                  callbackAfter({}, data);
                }
              });
            }

            queryAjax(url, data, success, fail, before, after) {
              data = data || {};
              this.postJsonRequestAjax(
                  url,
                  'POST',
                  this.objectMerge(data, this.params),
                  success,
                  fail,
                  before,
                  after
              );
            }

            objectMerge(a, b) {
              return Object.assign(a, b);
            }

            messageSuccess(mes, data) {
              return {
                error: false,
                message: mes,
                data: data || {}
              };
            }

            messageError(mes, data) {
              return {
                error: true,
                message: mes,
                data: data || {}
              };
            }
          }

          $('editor_block')
          .prop('contentEditable', true)
          .focusin(function () {
            let $this = $(this);
          })
          .focusout(function (e) {
            let $this = $(this);

            (new Request()).queryAjax('{{ route('ajax.change.lang') }}', {
                  name: $this.attr('data-name'),
                  text: $this.text()
                }, function (data, dataRaw) {
                  console.log('Сохранено!');
                  console.log($this.text());
                }, function () {

                },
                function () {
                  console.log('Сохранение');
                }
            );
          });

        });
      </script>
    @endif
    @stack('js')
  </body>

</html>
