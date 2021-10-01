@extends('layouts.accountPanel.app')
@section('title', __('Dashboard'))
@section('content')

    <div class="container-fluid">
        <div class="row second-chart-list third-news-update">

            @if(!empty($wallets))
                <div class="row">
                    @forelse($wallets as $item)
                        <div class="col-sm-6 col-xl-3 col-lg-6">
                            <div class="card o-hidden">
                                <div class="bg-primary b-r-4 card-body">
                                    <div class="media static-top-widget">
                                        <div class="align-self-center text-center">
                                            <i class="icofont " style="font-size: 28px;">{{ $item->currency->symbol }}</i>
                                        </div>
                                        <div class="media-body">
                                            <span class="m-0">Balance in {{ $item->currency->name }}</span>
                                            <h4 class="mb-0 counter">{{ $item->balance ?? 0 }} {{ $item->currency->symbol }}</h4>
                                            <i class="icon-bg" data-feather="credit-card"></i>
                                            <div class="mt-3">
                                                <a href="" class="btn btn-success">Пополнить</a>
                                                <a href="" class="btn btn-danger">Вывести</a>
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

            <div class="col-xl-3 risk-col xl-100 box-col-12">
                <div class="card total-users">
                    <div class="card-header card-no-border pb-3 pt-3">
                        <h5>Перевод</h5>
                    </div>
                    <div class="card-body pt-0">
                        <form action="{{ route('accountPanel.dashboard.send.money') }}" method="post" class="send-money-to-user-form">
                            @csrf
                            <div class="apex-chart-container goal-status text-center row">
                                <div class="rate-card col-xl-12">
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
            <div class="col-xl-9 xl-100 box-col-12">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header pt-4 pb-4">
                                <h4 class="mb-0">Последние 5 депозитов</h4>
                            </div>
                            <div class="card-body pt-3 pb-3">
                                <div class="best-seller-table responsive-tbl">
                                    <div class="item">
                                        <div class="table-responsive product-list">
                                            <table class="table table-bordernone">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Баланс</th>
                                                        <th>Название</th>
                                                        <th>Прошло дней</th>
                                                        <th>Начислено</th>
                                                        <th>Статус</th>
                                                        <th class="text-end">Дата открытия</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(isset($deposits) && !empty($deposits))
                                                        @foreach($deposits as $deposit)
                                                            <tr>
                                                                <th scope="row">{{ $loop->iteration  }}</th>
                                                                <td>
                                                                    <span class="">$ {{ number_format($deposit->balance, 2, '.', ',') ?? 0 }}</span>
                                                                </td>
                                                                <td>{{ $deposit->rate->name ?? '' }}</td>
                                                                <td>
                                                                    {{ Carbon\Carbon::now()->diffInDays($deposit->created_at) }}/{{ $deposit->duration }}
                                                                </td>
                                                                <th scope="col">
                                                                    <div class="span badge rounded-pill pill-badge-primary">$ {{ number_format($deposit->balance - $deposit->invested, 2, '.', ',') ?? 0 }}</div>
                                                                </th>
                                                                <th scope="col">
                                                                    @if($deposit->active)
                                                                        <span class="font-primary">В работе</span>
                                                                    @else
                                                                        <span class="font-danger">Закрыт</span>
                                                                    @endif
                                                                </th>
                                                                <td class="text-end">{{ $deposit->created_at->format('d-m-Y H:i') }}</td>
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

            <div class="col-xl-6 xl-100 dashboard-sec box-col-12">
                <div class="card earning-card">
                    <div class="card-body p-0">
                        <div class="row m-0">
                            <div class="col-xl-12 p-0">
                                <div class="chart-right">
                                    <div class="row m-0 p-tb">
                                        <div class="col-xl-8 col-md-8 col-sm-8 col-12 p-0">
                                            <div class="inner-top-left">
                                                <ul class="d-flex list-unstyled">
                                                    <li class="active">За последние 2 недели</li>
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
            <div class="col-xl-6 xl-100">
                <form method="post" action="{{ route('accountPanel.dashboard.store.user.video') }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h5>Видео с YouTube</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="icofont icofont-link"></i></span>
                                            <input class="form-control" name="video" value="{{ old('video') ?? '' }}" type="text" placeholder="Ссылка на видео" aria-label="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary m-r-15" type="submit">Отправить</button>
                        </div>
                    </div>
                </form>
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
            data: [@foreach($accruals_2week as $item) {{ number_format($item, 2, '.', '') }}@if(!$loop->last), @endif @endforeach]
          }, {
            name: 'Выведено, $',
            data: [@foreach($withdraws_2week as $item) {{ number_format($item, 2, '.', '') }}@if(!$loop->last), @endif @endforeach]
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
@endpush
