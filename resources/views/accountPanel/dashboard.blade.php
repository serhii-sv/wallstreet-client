@extends('layouts.accountPanel.app')
@section('title', __('Dashboard'))
@push('styles')
  <style>
      .dashboard-video-list {
          max-height: 350px;
          overflow: hidden auto;
      }

      .dashboard-video-list iframe {
          max-width: 100%;
      }
  </style>
@endpush
@section('content')
  
  <div class="container-fluid">
    <div class="row">
      <div class="col-xl-12 xl-100 dashboard-sec box-col-12">
        <div class="card earning-card">
          <div class="card-body p-0">
            <div class="row m-0">
              <div class="col-xl-12 p-0">
                <div class="chart-right">
                  <div class="row m-0 p-tb">
                    <div class="col-xl-8 col-md-8 col-sm-8 col-12 p-0">
                      <div class="inner-top-left">
                        <ul class="d-flex list-unstyled">
                          <li class="active">За последние 7 дней</li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-4 col-12 p-0 justify-content-end">
                      <div class="inner-top-right">
                        <ul class="d-flex list-unstyled justify-content-end">
                          <li>Начислено</li>
                          <li>Выведено</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xl-12">
                      <div class="card-body p-0">
                        <div class="current-sale-container">
                          <div id="chart-currently"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row border-top m-0">
                  <div class="col-xl-4 ps-0 col-md-6 col-sm-6">
                    <div class="media p-0">
                      <div class="media-left bg-primary">
                        <i class="icofont icofont-cur-dollar"></i></div>
                      <div class="media-body">
                        <h6>Заработок в сек</h6>
                        <p>$ {{ number_format($total_revenue/604800, 5, '.',',') ?? 0 }}/сек</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-md-6 col-sm-6">
                    <div class="media p-0">
                      <div class="media-left bg-secondary">
                        <i class="icofont icofont-cur-dollar"></i></div>
                      <div class="media-body">
                        <h6>Заработок в час</h6>
                        <p>$ {{ number_format(($total_revenue/604800) * 3600, 4, '.',',') ?? 0 }}/час</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-md-12 pe-0">
                    <div class="media p-0">
                      <div class="media-left bg-success">
                        <i class="icofont icofont-cur-dollar"></i></div>
                      <div class="media-body">
                        <h6>Заработок в сутки</h6>
                        <p>$ {{ number_format(($total_revenue/604800) * 86400, 2, '.',',') ?? 0 }}/день</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row second-chart-list third-news-update">
      <div class="col-12">
        @if(!empty($wallets))
          <div class="row">
            @forelse($wallets as $item)
              <div class="col-sm-6 col-xl-3 col-lg-6">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body" style="padding: 30px 15px;">
                    <div class="media static-top-widget">
                     {{-- <div class="align-self-center text-center">
                        <i class="icofont " style="font-size: 28px;">{{ $item->currency->symbol }}</i>
                      </div>--}}
                      <div class="media-body ml-0">
                        <span class="m-0">Balance in {{ $item->currency->name }}</span>
                        <h4 class="mb-0 counter">{{ $item->balance ?? 0 }} {{ $item->currency->symbol }}</h4>
                        <i class="icon-bg" data-feather="credit-card"></i>
                        <div class="mt-3">
                          <a href="" class="btn btn-success">Пополнить</a>
                          <a href="{{ route('accountPanel.withdrawal') }}" class="btn btn-danger">Вывести</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @empty
            @endforelse
          </div>
        @endif
      </div>
     
      <div class="col-xl-12 xl-100 box-col-12">
        <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-header pt-4 pb-4">
                <h4 class="mb-0">Последние 5 операций</h4>
              </div>
              <div class="card-body pt-3 pb-3">
                <div class="table-responsive">
                  <div class="item">
                    <div class="table-responsive product-list">
                      <table class="table table-bordernone">
                        <thead>
                          <tr>
                            <th>Тип операции</th>
                            <th>Сумма</th>
                            <th>Платёжная система</th>
                            <th>Статус</th>
                            <th class="text-end">Дата операции</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(isset($transactions) && !empty($transactions))
                            @foreach($transactions as $transaction)
                              <tr style="vertical-align: middle;">
                                <th scope="row">{{ $loop->iteration  }}</th>
                                <td>{{ __('locale.' . $transaction->type->name) ?? 'Не указано' }}</td>
                                <td>
                                  <span class="">{{$transaction->currency->symbol}} {{ number_format($transaction->amount, $transaction->currency->precision, '.', ',') ?? 0 }}</span>
                                  <br>
                                  <span class="badge rounded-pill pill-badge-info">$ {{ number_format($transaction->main_currency_amount, 2, '.', ',') ?? 0 }}</span>
                                </td>
                                <td>{{ $transaction->paymentSystem->name ?? 'Не указано' }}</td>
                                <td>@switch($transaction->approved)
                                    @case(1)
                                    <span class="btn-success p-2 ps-4 pe-4" style="display: inline-block; min-width: 200px;text-align: center">Подтверждён</span>
                                    @break
                                    @case(2)
                                    <span class="btn-danger p-2 ps-4 pe-4" style="display: inline-block; min-width: 200px;text-align: center">Отклонён</span>
                                    @break
                                    @default
                                    <span class="btn-light p-2 ps-4 pe-4" style="display: inline-block; min-width: 200px;text-align: center">Не подтверждён</span>
                                    @break
                                  @endswitch</td>
                                <td>{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
                              </tr>
                            @endforeach
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-lg-6 appointment">
        <div class="card">
          <div class="card-header">
            <div class="header-top">
              <h5 class="m-0">Популярность по странам</h5>
            </div>
          </div>
          <div class="card-Body">
            <div class="radar-chart">
              <div id="marketchart"></div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header pb-3">
            <h5>Видеоролики</h5>
          </div>
          <div class="card-body pt-3 pb-3">
            <div class="row pb-4">
              <div class="col-12">
                <ul class="nav nav-dark" id="pills-darktab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="pills-darkhome-tab" data-bs-toggle="pill" href="#pills-darkhome" role="tab" aria-controls="pills-darkhome" aria-selected="true" data-bs-original-title="" title="">
                      <i class="icofont icofont-ui-note"></i>
                      Лента
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="pills-darkprofile-tab" data-bs-toggle="pill" href="#pills-darkprofile" role="tab" aria-controls="pills-darkprofile" aria-selected="false" data-bs-original-title="" title="">
                      <i class="icofont icofont-upload-alt"></i>
                      Загрузить
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="mb-3">
                  <div class="tab-content" id="pills-darktabContent">
                    <div class="tab-pane fade active show" id="pills-darkhome" role="tabpanel" aria-labelledby="pills-darkhome-tab">
                      <ul class="dashboard-video-list">
                        @if($users_videos !== null)
                          @forelse($users_videos as $users_video)
                            <li class="mb-3" style="background: #fafafa; padding: 15px">
                              <div class="mb-3">
                                <img src="{{  $users_video->user->avatar ? route('accountPanel.profile.get.avatar',$users_video->user->id) : asset('accountPanel/images/user/user.png')  }}" alt="">
                                {{ $users_video->user->login ?? '' }}</div>
                              {!! htmlspecialchars_decode($users_video->link) !!}
                            </li>
                          @empty
                            <li class="mb-3" style="background: #fafafa; padding: 15px">
                              Ничего не добавлено
                            </li>
                          @endforelse
                        @endif
                      </ul>
                    </div>
                    <div class="tab-pane fade" id="pills-darkprofile" role="tabpanel" aria-labelledby="pills-darkprofile-tab">
                      <form method="post" action="{{ route('accountPanel.dashboard.store.user.video') }}">
                        @csrf
                        <div class="input-group mb-4">
                          
                          <span class="input-group-text"><i class="icofont icofont-link"></i></span>
                          <input class="form-control" name="video" value="{{ old('video') ?? '' }}" type="text" placeholder="Ссылка на видео" aria-label="">
                        </div>
                        <button class="btn btn-primary m-r-15" type="submit">Отправить</button>
                      </form>
                    </div>
                  
                  </div>
                
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-lg-6 risk-col ">
        <div class="card total-users">
          <div class="card-header card-no-border pb-3 pt-3">
            <h5>Перевод</h5>
          </div>
          <div class="card-body pt-0">
            <form action="{{ route('accountPanel.dashboard.send.money') }}" method="post" class="send-money-to-user-form">
              @csrf
              <div class="apex-chart-container goal-status text-center">
                <div class="rate-card">
                  <h6 class="mb-2 mt-2 f-w-400">Пользователь</h6>
                  <div class="input-group mb-3">
                    <input class="form-control" type="text" name="user" value="{{ old('user') ?? '' }}">
                  </div>
                  <h6 class="mb-2 mt-2 f-w-400">Введите сумму</h6>
                  <div class="input-group mb-3">
                    <input class="form-control" type="text" name="amount" value="{{ old('amount') ?? '' }}">
                  </div>
                  <div class="input-group mb-3">
                    <select class="form-select form-control-inverse-fill " name="wallet_id">
                      <option value="" disabled selected hidden>Выберите кошелёк</option>
                      @forelse($wallets as $wallet)
                        <option value="{{ $wallet->id }}" @if(old('wallet_id') == $wallet->id) selected="selected" @endif>{{ $wallet->currency->name }} - {{ $wallet->balance }}{{ $wallet->currency->symbol }}</option>
                      @empty
                      @endforelse
                    </select>
                  </div>
                  <button class="btn btn-lg btn-primary btn-block send-money-to-user-btn">Перевести</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      
      <div class="col-lg-6 risk-col ">
        <div class="card height-equal" style="min-height: 331px;">
          <div class="card-header">
            <h5>Ваша реферальная ссылка</h5>
          </div>
          <div class="card-body">
            <h4><i data-feather="link"></i> {{ route('ref_link', auth()->user()->my_id) }}</h4>
          </div>
          <div class="card-footer">
            <button class="btn btn-primary btn-lg" onclick="copyToClipboard()">Скопировать</button>
          </div>
        </div>
      </div>
      @if($banners !== null)
        <div class="row mb-4">
          <div class="col">
            <div class="offer-slider">
              <div class="carousel slide" id="carouselExampleCaptions" data-bs-ride="carousel">
                <div class="carousel-inner">
                  @forelse($banners as $banner)
                    <div class="carousel-item @if($loop->first) active @endif">
                      <div class="selling-slide row">
                        <div class="col-xl-12 col-md-12">
                          <div class="center-img d-flex justify-content-center">
                            <img src="{{ \Illuminate\Support\Facades\Storage::disk('do_spaces')->url($banner->image) }}" class="img-fluid">
                          </div>
                        </div>
                      </div>
                    </div>
                  @empty
                  @endforelse
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      @endif
      <div class="col-xl-12">
        <div class="card">
          <div class="card-body">
            <div class="best-seller-table responsive-tbl">
              <div class="item">
                <div class="table-responsive product-list">
                  <table class="table table-bordernone">
                    <thead>
                      <tr>
                        <th class="f-22">
                          Best Seller
                        </th>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Country</th>
                        <th>Total</th>
                        <th class="text-end">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <div class="d-inline-block align-middle">
                            <img class="img-40 m-r-15 rounded-circle align-top" src="{{ asset('accountPanel/images/user/8.jpg') }}" alt="">
                            <div class="status-circle bg-primary"></div>
                            <div class="d-inline-block">
                              <span>John keter</span>
                              <p class="font-roboto">2019</p>
                            </div>
                          </div>
                        </td>
                        <td>06 August</td>
                        <td>CAP</td>
                        <td><i class="flag-icon flag-icon-gb"></i></td>
                        <td>
                          <span class="label">$5,08,652</span>
                        </td>
                        <td class="text-end"><i class="fa fa-check-circle"></i>Done</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-inline-block align-middle">
                            <img class="img-40 m-r-15 rounded-circle align-top" src="{{ asset('accountPanel/images/user/4.jpg') }}" alt="">
                            <div class="status-circle bg-primary"></div>
                            <div class="d-inline-block">
                              <span>Herry Venter</span>
                              <p class="font-roboto">2020</p>
                            </div>
                          </div>
                        </td>
                        <td>21 March</td>
                        <td>Branded Shoes</td>
                        <td><i class="flag-icon flag-icon-us"></i></td>
                        <td>
                          <span class="label">$59,105</span>
                        </td>
                        <td class="text-end"><i class="fa fa-check-circle"></i>Pending</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-inline-block align-middle">
                            <img class="img-40 m-r-15 rounded-circle align-top" src="{{ asset('accountPanel/images/user/5.jpg') }}" alt="">
                            <div class="status-circle bg-primary"></div>
                            <div class="d-inline-block">
                              <span>loain deo</span>
                              <p class="font-roboto">2020</p>
                            </div>
                          </div>
                        </td>
                        <td>09 March</td>
                        <td>Headphone</td>
                        <td><i class="flag-icon flag-icon-za"></i></td>
                        <td>
                          <span class="label">$10,155</span>
                        </td>
                        <td class="text-end"><i class="fa fa-check-circle"></i>Success</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-inline-block align-middle">
                            <img class="img-40 m-r-15 rounded-circle align-top" src="{{ asset('accountPanel/images/user/4.jpg') }}" alt="">
                            <div class="status-circle bg-primary"></div>
                            <div class="d-inline-block">
                              <span>Horen Hors</span>
                              <p class="font-roboto">2020</p>
                            </div>
                          </div>
                        </td>
                        <td>14 February</td>
                        <td>Cell Phone</td>
                        <td><i class="flag-icon flag-icon-at"></i></td>
                        <td>
                          <span class="label">$90,568</span>
                        </td>
                        <td class="text-end"><i class="fa fa-check-circle"></i>In process</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="d-inline-block align-middle">
                            <img class="img-40 m-r-15 rounded-circle align-top" src="{{ asset('accountPanel/images/user/2.png') }}" alt="">
                            <div class="status-circle bg-primary"></div>
                            <div class="d-inline-block">
                              <span>fenter Jessy</span>
                              <p class="font-roboto">2021</p>
                            </div>
                          </div>
                        </td>
                        <td>12 January</td>
                        <td>Earings</td>
                        <td><i class="flag-icon flag-icon-br"></i></td>
                        <td>
                          <span class="label">$10,652</span>
                        </td>
                        <td class="text-end"><i class="fa fa-check-circle"></i>Pending</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
@endsection

@push('scripts')

  <script src="{{ asset('accountPanel/js/dashboard/default.js') }}"></script>
  <script src="{{ asset('accountPanel/js/sweet-alert/sweetalert.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      $(".form-control-inverse-fill").select2();
    });
    
    
    $(".send-money-to-user-btn").on('click', function (e) {
      e.preventDefault();
      swal({
        title: "Вы уверены?",
        text: "С вашего баланса будут списаны денежные средства!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          //create-deposit-form
          $(".send-money-to-user-form").submit();
          swal("Подождите немного!", {
            icon: "success",
          });
        }
      });
    });
  </script>
  <script>
    $(document).ready(function () {
      var options = {
        series: [{
          name: 'Начислено, $',
          data: [@foreach($accruals_week as $item) {{ number_format($item, 2, '.', '') }}@if(!$loop->last), @endif @endforeach]
        }, {
          name: 'Выведено, $',
          data: [@foreach($withdraws_week as $item) {{ number_format($item, 2, '.', '') }}@if(!$loop->last), @endif @endforeach]
        }],
        chart: {
          height: 240,
          type: 'area',
          toolbar: {
            show: false
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          type: 'period',
          low: 0,
          offsetX: 0,
          offsetY: 0,
          show: false,
          categories: [@foreach($period_graph as $period) "{{ $period['start']->format('d.m.Y') }}", @endforeach],
          labels: {
            low: 0,
            offsetX: 0,
            show: false,
          },
          axisBorder: {
            low: 0,
            offsetX: 0,
            show: false,
          },
        },
        markers: {
          strokeWidth: 3,
          colors: "#ffffff",
          strokeColors: [CubaAdminConfig.primary, CubaAdminConfig.secondary],
          hover: {
            size: 6,
          }
        },
        yaxis: {
          low: 0,
          offsetX: 0,
          offsetY: 0,
          show: false,
          labels: {
            low: 0,
            offsetX: 0,
            show: false,
          },
          axisBorder: {
            low: 0,
            offsetX: 0,
            show: false,
          },
        },
        grid: {
          show: false,
          padding: {
            left: 0,
            right: 0,
            bottom: -15,
            top: -40
          }
        },
        colors: [CubaAdminConfig.primary, CubaAdminConfig.secondary],
        fill: {
          type: 'gradient',
          gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.7,
            opacityTo: 0.5,
            stops: [0, 80, 100]
          }
        },
        legend: {
          show: false,
        },
        tooltip: {
          x: {
            format: 'MM'
          },
        },
      };
      
      var chart = new ApexCharts(document.querySelector("#chart-currently"), options);
      chart.render();
    });
  </script>
  <script>
    function copyToClipboard() {
      var inputc = document.body.appendChild(document.createElement("input"));
      inputc.value = '{{ route('ref_link', auth()->user()->my_id) }}';
      inputc.focus();
      inputc.select();
      document.execCommand('copy');
      inputc.parentNode.removeChild(inputc);
      $.notify({
            message:'Ссылка скопирована!'
          },
          {
            type:'success',
            allow_dismiss:false,
            newest_on_top:false ,
            mouse_over:false,
            showProgressbar:false,
            spacing:10,
            timer:2000,
            placement:{
              from:'top',
              align:'center'
            },
            offset:{
              x:30,
              y:30
            },
            delay:1000 ,
            z_index:10000,
            animate:{
              enter:'animated bounce',
              exit:'animated bounce'
            }
          });
    }
  </script>
  @if($countries_stat !== null)
    <script>
      $(document).ready(function () {
        var options1 = {
          chart: {
            height: 380,
            type: 'radar',
            toolbar: {
              show: false
            },
          },
          series: [{
            name: 'Users',
            /*data: [@foreach($countries_stat as $item){{ intval($item->count) }} @if(!$loop->last), @endif @endforeach],*/
            data: [800, 454,900, 500,734,623,600],
          }],
          stroke: {
            width: 3,
            curve: 'smooth',
          },
          /*labels: [@foreach($countries_stat as $item)"{{ $item->name }}" @if(!$loop->last), @endif @endforeach],*/
          labels: ['Сша', 'Китай', 'Россия', 'Сингапур', 'Германия', 'Австралия','Казахстан'],
          plotOptions: {
            radar: {
              size: 140,
              polygons: {
                fill: {
                  colors: ['#fcf8ff', '#f7eeff']
                },
                
              }
            },
            
          },
          colors: [CubaAdminConfig.primary],
          
          markers: {
            size: 6,
            colors: ['#fff'],
            strokeColor: CubaAdminConfig.primary,
            strokeWidth: 3,
          },
          tooltip: {
            enabled: false,
            marker: {
              show: false,
            },
            y: {
              formatter: function (val) {
                return ''
              }
            }
          },
          yaxis: {
            show: false,
            tickAmount: 7,
            labels: {
              show: false,
              formatter: function (val, i) {
                if (i % 2 === 0) {
                  return val
                } else {
                  return ''
                }
              }
            }
          }
        }
        
        var chart1 = new ApexCharts(
            document.querySelector("#marketchart"),
            options1
        );
        
        chart1.render();
        
      });
    </script>
  @endif
@endpush
