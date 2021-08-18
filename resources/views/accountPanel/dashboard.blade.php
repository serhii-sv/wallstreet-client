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
                    <div class="align-self-center text-center"><i data-feather="database"></i></div>
                    <div class="media-body">
                      <span class="m-0">Balance in {{ $item->currency->name }}</span>
                      <h4 class="mb-0 counter">{{ $item->balance ?? 0 }} {{ $item->currency->symbol }}</h4>
                      <i class="icon-bg" data-feather="database"></i>
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
                  <button class="btn btn-lg btn-primary btn-block send-money-to-user-btn" >Перевести</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      
      <div class="col-xl-8 xl-100 dashboard-sec box-col-12">
        <div class="card earning-card">
          <div class="card-body p-0">
            <div class="row m-0">
              <div class="col-xl-3 earning-content p-0">
                <div class="row m-0 chart-left">
                  <div class="col-xl-12 p-0 left_side_earning">
                    <h5>Dashboard</h5>
                    <p class="font-roboto">Overview of last month</p>
                  </div>
                  <div class="col-xl-12 p-0 left_side_earning">
                    <h5>$4055.56 </h5>
                    <p class="font-roboto">This Month Earning</p>
                  </div>
                  <div class="col-xl-12 p-0 left_side_earning">
                    <h5>$1004.11</h5>
                    <p class="font-roboto">This Month Profit</p>
                  </div>
                  <div class="col-xl-12 p-0 left_side_earning">
                    <h5>90%</h5>
                    <p class="font-roboto">This Month Sale</p>
                  </div>
                  <div class="col-xl-12 p-0 left-btn">
                    <a class="btn btn-gradient">Summary</a>
                  </div>
                </div>
              </div>
              <div class="col-xl-9 p-0">
                <div class="chart-right">
                  <div class="row m-0 p-tb">
                    <div class="col-xl-8 col-md-8 col-sm-8 col-12 p-0">
                      <div class="inner-top-left">
                        <ul class="d-flex list-unstyled">
                          <li>Daily</li>
                          <li class="active">Weekly</li>
                          <li>Monthly</li>
                          <li>Yearly</li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-4 col-12 p-0 justify-content-end">
                      <div class="inner-top-right">
                        <ul class="d-flex list-unstyled justify-content-end">
                          <li>Online</li>
                          <li>Store</li>
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
                      <div class="media-left"><i class="icofont icofont-crown"></i></div>
                      <div class="media-body">
                        <h6>Referral Earning</h6>
                        <p>$5,000.20</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-md-6 col-sm-6">
                    <div class="media p-0">
                      <div class="media-left bg-secondary"><i class="icofont icofont-heart-alt"></i></div>
                      <div class="media-body">
                        <h6>Cash Balance</h6>
                        <p>$2,657.21</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-md-12 pe-0">
                    <div class="media p-0">
                      <div class="media-left"><i class="icofont icofont-cur-dollar"></i></div>
                      <div class="media-body">
                        <h6>Sales forcasting</h6>
                        <p>$9,478.50 </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-9 xl-100 chart_data_left box-col-12">
        <div class="card">
          <div class="card-body p-0">
            <div class="row m-0 chart-main">
              <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                <div class="media align-items-center">
                  <div class="hospital-small-chart">
                    <div class="small-bar">
                      <div class="small-chart flot-chart-container"></div>
                    </div>
                  </div>
                  <div class="media-body">
                    <div class="right-chart-content">
                      <h4>1001</h4>
                      <span>Purchase </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                <div class="media align-items-center">
                  <div class="hospital-small-chart">
                    <div class="small-bar">
                      <div class="small-chart1 flot-chart-container"></div>
                    </div>
                  </div>
                  <div class="media-body">
                    <div class="right-chart-content">
                      <h4>1005</h4>
                      <span>Sales</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                <div class="media align-items-center">
                  <div class="hospital-small-chart">
                    <div class="small-bar">
                      <div class="small-chart2 flot-chart-container"></div>
                    </div>
                  </div>
                  <div class="media-body">
                    <div class="right-chart-content">
                      <h4>100</h4>
                      <span>Sales return</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-md-6 col-sm-6 p-0 box-col-6">
                <div class="media border-none align-items-center">
                  <div class="hospital-small-chart">
                    <div class="small-bar">
                      <div class="small-chart3 flot-chart-container"></div>
                    </div>
                  </div>
                  <div class="media-body">
                    <div class="right-chart-content">
                      <h4>101</h4>
                      <span>Purchase ret</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 xl-50 chart_data_right box-col-12">
        <div class="card">
          <div class="card-body">
            <div class="media align-items-center">
              <div class="media-body right-chart-content">
                <h4>$95,900
                  <span class="new-box">Hot</span>
                </h4>
                <span>Purchase Order Value</span>
              </div>
              <div class="knob-block text-center">
                <input class="knob1" data-width="10" data-height="70" data-thickness=".3" data-angleoffset="0" data-linecap="round" data-fgcolor="#7366ff" data-bgcolor="#eef5fb" value="60">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 xl-50 chart_data_right second d-none">
        <div class="card">
          <div class="card-body">
            <div class="media align-items-center">
              <div class="media-body right-chart-content">
                <h4>$95,000
                  <span class="new-box">New</span>
                </h4>
                <span>Product Order Value</span>
              </div>
              <div class="knob-block text-center">
                <input class="knob1" data-width="50" data-height="70" data-thickness=".3" data-fgcolor="#7366ff" data-linecap="round" data-angleoffset="0" value="60">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 xl-50 news box-col-6">
        <div class="card">
          <div class="card-header">
            <div class="header-top">
              <h5 class="m-0">News &amp; Update</h5>
              <div class="card-header-right-icon">
                <div class="dropdown">
                  <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">Today</button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Today</a>
                    <a class="dropdown-item" href="#">Tomorrow</a>
                    <a class="dropdown-item" href="#">Yesterday</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body p-0">
            <div class="news-update">
              <h6>36% off For pixel lights Couslations Types.</h6>
              <span>Lorem Ipsum is simply dummy...</span>
            </div>
            <div class="news-update">
              <h6>We are produce new product this</h6>
              <span> Lorem Ipsum is simply text of the printing... </span>
            </div>
            <div class="news-update">
              <h6>50% off For COVID Couslations Types.</h6>
              <span>Lorem Ipsum is simply dummy...</span>
            </div>
          </div>
          <div class="card-footer">
            <div class="bottom-btn">
              <a href="#">More...</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 xl-50 appointment-sec box-col-6">
        <div class="row">
          <div class="col-xl-12 appointment">
            <div class="card">
              <div class="card-header card-no-border">
                <div class="header-top">
                  <h5 class="m-0">appointment</h5>
                  <div class="card-header-right-icon">
                    <div class="dropdown">
                      <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">Today</button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Today</a>
                        <a class="dropdown-item" href="#">Tomorrow</a>
                        <a class="dropdown-item" href="#">Yesterday</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body pt-0">
                <div class="appointment-table table-responsive">
                  <table class="table table-bordernone">
                    <tbody>
                      <tr>
                        <td>
                          <img class="img-fluid img-40 rounded-circle mb-3" src="{{ asset('accountPanel/images/appointment/app-ent.jpg') }}" alt="Image description">
                          <div class="status-circle bg-primary"></div>
                        </td>
                        <td class="img-content-box">
                          <span class="d-block">Venter Loren</span>
                          <span class="font-roboto">Now</span>
                        </td>
                        <td>
                          <p class="m-0 font-primary">28 Sept</p>
                        </td>
                        <td class="text-end">
                          <div class="button btn btn-primary">Done<i class="fa fa-check-circle ms-2"></i></div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <img class="img-fluid img-40 rounded-circle" src="{{ asset('accountPanel/images/appointment/app-ent.jpg') }}" alt="Image description">
                          <div class="status-circle bg-primary"></div>
                        </td>
                        <td class="img-content-box">
                          <span class="d-block">John Loren</span>
                          <span class="font-roboto">11:00</span>
                        </td>
                        <td>
                          <p class="m-0 font-primary">22 Sept</p>
                        </td>
                        <td class="text-end">
                          <div class="button btn btn-danger">Pending<i class="fa fa-clock-o ms-2"></i></div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-12 alert-sec">
            <div class="card bg-img">
              <div class="card-header">
                <div class="header-top">
                  <h5 class="m-0">Alert </h5>
                  <div class="dot-right-icon"><i class="fa fa-ellipsis-h"></i></div>
                </div>
              </div>
              <div class="card-body">
                <div class="body-bottom">
                  <h6> 10% off For drama lights Couslations...</h6>
                  <span class="font-roboto">Lorem Ipsum is simply dummy...It is a long established fact that a reader will be distracted by  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 xl-50 notification box-col-6">
        <div class="card">
          <div class="card-header card-no-border">
            <div class="header-top">
              <h5 class="m-0">notification</h5>
              <div class="card-header-right-icon">
                <div class="dropdown">
                  <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">Today</button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Today</a>
                    <a class="dropdown-item" href="#">Tomorrow</a>
                    <a class="dropdown-item" href="#">Yesterday</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="media">
              <div class="media-body">
                <p>20-04-2020
                  <span>10:10</span>
                </p>
                <h6>Updated Product
                  <span class="dot-notification"></span>
                </h6>
                <span>Quisque a consequat ante sit amet magna...</span>
              </div>
            </div>
            <div class="media">
              <div class="media-body">
                <p>20-04-2020
                  <span class="ps-1">Today</span>
                  <span class="badge badge-secondary">New</span>
                </p>
                <h6>Tello just like your product
                  <span class="dot-notification"></span>
                </h6>
                <span>Quisque a consequat ante sit amet magna... </span>
              </div>
            </div>
            <div class="media">
              <div class="media-body">
                <div class="d-flex mb-3">
                  <div class="inner-img">
                    <img class="img-fluid" src="{{ asset('accountPanel/images/notification/1.jpg') }}" alt="Product-1">
                  </div>
                  <div class="inner-img">
                    <img class="img-fluid" src="{{ asset('accountPanel/images/notification/2.jpg') }}" alt="Product-2">
                  </div>
                </div>
                <span class="mt-3">Quisque a consequat ante sit amet magna...</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 xl-50 appointment box-col-6">
        <div class="card">
          <div class="card-header">
            <div class="header-top">
              <h5 class="m-0">Market Value</h5>
              <div class="card-header-right-icon">
                <div class="dropdown">
                  <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-expanded="false">Year</button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Year</a>
                    <a class="dropdown-item" href="#">Month</a>
                    <a class="dropdown-item" href="#">Day</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-Body">
            <div class="radar-chart">
              <div id="marketchart"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 xl-100 chat-sec box-col-6">
        <div class="card chat-default">
          <div class="card-header card-no-border">
            <div class="media media-dashboard">
              <div class="media-body">
                <h5 class="mb-0">Live Chat</h5>
              </div>
              <div class="icon-box"><i class="fa fa-ellipsis-h"></i></div>
            </div>
          </div>
          <div class="card-body chat-box">
            <div class="chat">
              <div class="media left-side-chat">
                <div class="media-body d-flex">
                  <div class="img-profile">
                    <img class="img-fluid" src="{{ asset('accountPanel/images/user.jpg') }}" alt="Profile"></div>
                  <div class="main-chat">
                    <div class="message-main">
                      <span class="mb-0">Hi deo, Please send me link.</span>
                    </div>
                    <div class="sub-message message-main">
                      <span class="mb-0">Right Now</span>
                    </div>
                  </div>
                </div>
                <p class="f-w-400">7:28 PM</p>
              </div>
              <div class="media right-side-chat">
                <p class="f-w-400">7:28 PM</p>
                <div class="media-body text-end">
                  <div class="message-main pull-right">
                    <span class="mb-0 text-start">How can do for you</span>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
              <div class="media left-side-chat">
                <div class="media-body d-flex">
                  <div class="img-profile">
                    <img class="img-fluid" src="{{ asset('accountPanel/images/user.jpg') }}" alt="Profile"></div>
                  <div class="main-chat">
                    <div class="sub-message message-main mt-0">
                      <span>It's argently</span>
                    </div>
                  </div>
                </div>
                <p class="f-w-400">7:28 PM</p>
              </div>
              <div class="media right-side-chat">
                <div class="media-body text-end">
                  <div class="message-main pull-right">
                    <span class="loader-span mb-0 text-start" id="wave"><span class="dot"></span><span class="dot"></span><span class="dot"></span></span>
                  </div>
                </div>
              </div>
              <div class="input-group">
                <input class="form-control" id="mail" type="text" placeholder="Type Your Message..." name="text">
                <div class="send-msg"><i data-feather="send"></i></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 col-lg-12 xl-50 calendar-sec box-col-6">
        <div class="card gradient-primary o-hidden">
          <div class="card-body">
            <div class="setting-dot">
              <div class="setting-bg-primary date-picker-setting position-set pull-right">
                <i class="fa fa-spin fa-cog"></i></div>
            </div>
            <div class="default-datepicker">
              <div class="datepicker-here" data-language="en"></div>
            </div>
            <span class="default-dots-stay overview-dots full-width-dots"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">                </span></span></span>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
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
@endpush
