<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('accountPanel/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('accountPanel/images/favicon.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title')</title>
    <script src="//code-eu1.jivosite.com/widget/WTWc6WTrkx" async></script>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/font-awesome.css') }}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/vendors/icofont.css') }}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/vendors/chartist.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/vendors/date-picker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/vendors/select2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/vendors/sweetalert2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/vendors/sweetalert2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/spinner.css') }}">
    <style>
        .unread {
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
        }

        * {
            text-transform: none !important;
        }
    </style>
    <style>
        .pagination {
            /* Pagination button styling */
        }

        .pagination {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .pagination li {
            height: auto;
            margin: 0 2px;
        }

        .pagination a, .pagination span {
            display: block;
            margin-top: 0.25rem;
            padding: 0.25em 0.65em;
            border: 1px solid transparent;
        }

        .pagination li.active span,
        .pagination a:hover {
            color: white !important;
            border: 1px solid #3f51b5;
            border-radius: 4px;
            background: #3f51b5;
            box-shadow: 0 0 8px 0 #3f51b5;
        }

        .tap-top {
            z-index: 555 !important;
            left:50px !important;
        }

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
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/style.css') }}">

    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/css/responsive.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('accountPanel/css/color-1.css') }}" media="screen">
    @stack('styles')

  </head>
  <body class="{{--{{ (($themeSettings['theme-dark'] ?? null) == 'true') ? 'dark-only' : '' }}--}}">

  {{--<div class="loader-wrapper">
    <div class="loader-index">
      <span></span>
    </div>
    <svg>
      <defs></defs>
      <filter id="goo">
        <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
        <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"></fecolormatrix>
      </filter>
    </svg>
  </div>--}}
  <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>

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
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
    @include('layouts.accountPanel.header')
    <!-- Page Header Ends-->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
      @include('layouts.accountPanel.sidebar')
      <!-- Page Sidebar Ends-->
        <div class="page-body">

{{--          <div class="container-fluid">--}}
{{--            <div class="page-title @yield('title.show')">--}}
{{--              <div class="row">--}}
{{--                <div class="col-6">--}}
{{--                  <h3 class="">@yield('title')</h3>--}}
{{--                </div>--}}
{{--                @include('layouts.accountPanel.breadcrumbs')--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}

          <!-- Container-fluid starts-->
        @yield('content')
        <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        @include('layouts.accountPanel.footer')

      </div>

    </div>
    <!-- latest jquery-->
    <script src="{{ asset('accountPanel/js/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('accountPanel/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('accountPanel/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('accountPanel/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('accountPanel/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('accountPanel/js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('accountPanel/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('accountPanel/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('accountPanel/js/chart/chartist/chartist.js') }}"></script>
    <script src="{{ asset('accountPanel/js/chart/chartist/chartist-plugin-tooltip.js') }}"></script>
    <script src="{{ asset('accountPanel/js/chart/knob/knob.min.js') }}"></script>
    <script src="{{ asset('accountPanel/js/chart/knob/knob-chart.js') }}"></script>
    <script src="{{ asset('accountPanel/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('accountPanel/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('accountPanel/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('accountPanel/js/notify/index.js') }}"></script>
    <script src="{{ asset('accountPanel/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('accountPanel/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('accountPanel/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
    <script src="{{ asset('accountPanel/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('accountPanel/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('accountPanel/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('accountPanel/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('accountPanel/js/typeahead-search/typeahead-custom.js') }}"></script>
    <script src="{{ asset('accountPanel/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('accountPanel/js/select2/select2-custom.js') }}"></script>
    <script src="{{ asset('accountPanel/js/sweet-alert/sweetalert.min.js') }}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('accountPanel/js/script.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('accountPanel/js/theme-customizer/customizer.js') }}"></script>
    <!-- login js-->
    <!-- Plugin used-->

    <script src="//geoip-js.com/js/apis/geoip2/v2.1/geoip2.js" type="text/javascript"></script>
    <script src="{{ asset('accountPanel/js/jquery.mask.min.js') }}"></script>

  @if(\App\Models\Setting::getValue('enable_snow', '', true) == 'true')
      @include('partials.show')
  @endif

  <script type="text/javascript">
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      window.addEventListener("load", function(event) {
          $('.spinner-wrapper').remove()
      });
      $(function () {
          setTimeout(function () {
              $('.spinner-wrapper').remove()
          }, 4000)
      })

      $(document).ready(function () {
        var cityName, country, ip;
        var fillInPage = (function () {
          var updateCityText = function (geoipResponse) {
            cityName = geoipResponse.city.names.ru || 'Неизвестный';
            country = geoipResponse.country.names.ru || 'Неизвестная';
            ip = geoipResponse.traits.ip_address || 'ip';
            $.ajax({
              type: 'post',
              async: true,
              url: '{{ route('ajax.set.user.geoip.table') }}',
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
    <script>
      $(document).ready(function () {
        @if(session()->has('short_error_array'))
        @foreach(session()->get('short_error_array') as $fieldErrors)
        @foreach($fieldErrors as $error)
        $.notify({
              title: 'Ошибка',
              message: '{{ $error }}'
            },
            {
              type: 'danger',
              allow_dismiss: false,
              newest_on_top: false,
              mouse_over: false,
              showProgressbar: false,
              spacing: 10,
              timer: 4000,
              placement: {
                from: 'top',
                align: 'right'
              },
              offset: {
                x: 30,
                y: 30
              },
              delay: 1000,
              z_index: 10000,
              animate: {
                enter: 'animated pulse',
                exit: 'animated pulse'
              }
            });
        @endforeach
        @endforeach
        @endif
        @if(session()->has('short_error'))
        swal({
          title: "Ошибка",
          text: "{{ session()->get('short_error') }}",
          icon: "error"
        });
      {{--  $.notify({
              title: 'Ошибка',
              message: '{{ session()->get('short_error') }}'
            },
            {
              type: 'danger',
              allow_dismiss: false,
              newest_on_top: false,
              mouse_over: false,
              showProgressbar: false,
              spacing: 10,
              timer: 4000,
              placement: {
                from: 'top',
                align: 'right'
              },
              offset: {
                x: 30,
                y: 30
              },
              delay: 1000,
              z_index: 10000,
              animate: {
                enter: 'animated pulse',
                exit: 'animated pulse'
              }
            });--}}
        @endif
        @if(session()->has('short_success'))
        swal({
          title: "Успешно",
          text: "{{ session()->get('short_success') }}",
          icon: "success"
        });
        /*$.notify({
              title: 'Успех!',
              message: ''
            },
            {
              type: 'success',
              allow_dismiss: false,
              newest_on_top: false,
              mouse_over: false,
              showProgressbar: false,
              spacing: 10,
              timer: 4000,
              placement: {
                from: 'top',
                align: 'right'
              },
              offset: {
                x: 30,
                y: 30
              },
              delay: 1000,
              z_index: 10000,
              animate: {
                enter: 'animated pulse',
                exit: 'animated pulse'
              }
            });*/
        @endif
      });
    </script>
    @stack('scripts')
    <script>
      $(document).ready(function () {
        $(".notification-dropdown li.notification").on('click', function (e) {
          e.preventDefault();
          var $notification_count;
          var $count = parseInt($(".notification-box").find('.badge').text());

          if ($count > 0) {
            var $id = parseInt($(this).attr('data-id'));
            $.ajax({
              url: "/ajax/notification/status/read",
              method: 'post',
              data: 'id=' + $id,
              headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
              },
              success: function success(data) {
                var $data = $.parseJSON(data);

                if ($data['status'] == 'good') {
                  $(".notification-dropdown li.notification[data-id='" + $id + "']").remove();
                  $notification_count = $data['notification_count'];
                  $(".notification-box").find('.badge').text($notification_count);

                  if ($notification_count == 0) {
                    $(".notification-box").find('.badge').remove();
                    $(".notification-dropdown").append('<li class="notification"><p><i class="fa fa-circle-o me-3 font-success"> </i>Уведомлений нет! <span class="pull-right"></span></p></li>');
                  }
                }
              }
            });
          } else {
            $(".notification-button").find('.notification-badge').remove();
            $("#notifications-dropdown").find('h6 span.badge').remove();
          }
        });
      })
    </script>
    <script>
      $(document).ready(function () {
        $(".mode").on("click", function () {
          var $themeDark = false;

          if (!$('.mode i').hasClass("fa-lightbulb-o")) {
            $themeDark = true;
          } else {
            $themeDark = false;
          }
          //  $('.mode i').hasClass()

          // var color = $(this).attr("data-attr");
          //  localStorage.setItem('body', 'dark-only');

          $.ajax({
            url: '/theme-settings',
            method: 'post',
            data: {
              '_token': $('meta[name="csrf-token"]').attr('content'),
              'theme-dark': $themeDark,
            },
            success: (response) => {
              if (response.success) {
                if ($themeDark) {
                  $('.mode i').removeClass("fa-moon-o").addClass("fa-lightbulb-o");
                  $('body').addClass("dark-only");
                } else {
                  $('body').removeClass("dark-only");
                  $('.mode i').addClass("fa-moon-o").removeClass("fa-lightbulb-o");
                }
              }
              $.notify({
                    title: response.success ? 'Успешно!' : 'Ошибка!',
                    message: response.message,
                  },
                  {
                    type: response.success ? 'success' : 'danger',
                    allow_dismiss: false,
                    newest_on_top: false,
                    mouse_over: false,
                    showProgressbar: false,
                    spacing: 10,
                    timer: 2000,
                    placement: {
                      from: 'top',
                      align: 'right'
                    },
                    offset: {
                      x: 30,
                      y: 30
                    },
                    delay: 1000,
                    z_index: 10000,
                    animate: {
                      enter: 'animated pulse',
                      exit: 'animated pulse'
                    }
                  });
            }
          })

        });
      });
    </script>
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
  </body>
</html>
