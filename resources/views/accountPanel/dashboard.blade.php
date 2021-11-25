@extends('layouts.accountPanel.app')
@section('title')
Account
@endsection
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
    <div class="row" style="margin-top:50px;">
      <div class="col-xl-12 xl-100 dashboard-sec box-col-12" style="margin-top:50px;">
        <div class="card earning-card">
          <div class="card-body p-0">
            <div class="row m-0">
              <div class="col-xl-12 p-0">
                <div class="chart-right">
                  <div class="row m-0 p-tb">
                    <div class="col-xl-8 col-md-8 col-sm-8 col-12 p-0">
                      <div class="inner-top-left">
                        <ul class="d-flex list-unstyled">
                          <li class="active">
                            @if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='by last 7 days' contenteditable="true">{{ __('by last 7 days') }}</editor_block>
                            @else {{ __('by last 7 days') }}@endif
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-xl-4 col-md-4 col-sm-4 col-12 p-0 justify-content-end">
                      <div class="inner-top-right">
                        <ul class="d-flex list-unstyled justify-content-end">
                          <li>@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='Assessed' contenteditable="true">{{ __('Assessed') }}</editor_block>
                            @else {{ __('Assessed') }}@endif</li>
                          <li>@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='Withdrawn' contenteditable="true">{{ __('Withdrawn') }}</editor_block>
                            @else {{ __('Withdrawn') }}@endif</li>
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
                        <h6>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Earnings per second' contenteditable="true">{{ __('Earnings per second') }}</editor_block>
                          @else {{ __('Earnings per second') }}@endif</h6>
                        <p>$ {{ number_format($total_revenue / 24 / 60 / 60, 5, '.',',') ?? 0 }}@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='/sec' contenteditable="true">{{ __('/sec') }}</editor_block>
                          @else {{ __('/sec') }}@endif</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-md-6 col-sm-6">
                    <div class="media p-0">
                      <div class="media-left bg-secondary">
                        <i class="icofont icofont-cur-dollar"></i></div>
                      <div class="media-body">
                        <h6>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Earnings per hour' contenteditable="true">{{ __('Earnings per hour') }}</editor_block>
                          @else {{ __('Earnings per hour') }}@endif</h6>
                        <p>$ {{ number_format(($total_revenue / 24), 4, '.',',') ?? 0 }}@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='/hour' contenteditable="true">{{ __('/hour') }}</editor_block>
                          @else {{ __('/hour') }}@endif</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-4 col-md-12 pe-0">
                    <div class="media p-0">
                      <div class="media-left bg-success">
                        <i class="icofont icofont-cur-dollar"></i></div>
                      <div class="media-body">
                        <h6>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Daily earnings' contenteditable="true">{{ __('Daily earnings') }}</editor_block>
                          @else {{ __('Daily earnings') }}@endif</h6>
                        <p>$ {{ number_format(($total_revenue), 2, '.',',') ?? 0 }}@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='/day' contenteditable="true">{{ __('/day') }}</editor_block>
                          @else {{ __('/day') }}@endif</p>
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
              <div class="col-sm-6 col-xl-4 col-lg-4 col-xxl-3">
                <div class="card o-hidden">
                  <div class="bg-primary b-r-4 card-body" style="padding: 30px 15px;">
                    <div class="media static-top-widget">
                      {{-- <div class="align-self-center text-center">
                         <i class="icofont " style="font-size: 28px;">{{ $item->currency->symbol }}</i>
                       </div>--}}
                      <div class="media-body ml-0 " style="padding-left: 5px;">

                          <span class="m-0">@if(canEditLang() && checkRequestOnEdit())
                                  <editor_block data-name='Balance in' contenteditable="true">{{ __('Balance in') }}</editor_block>
                              @else {{ __('Balance in') }}@endif {{ $item->currency->name }}
                        </span>
                          <h4 class="mb-0 counter">{{ $item->balance ?? 0 }} {{ $item->currency->symbol }}</h4>

                          <span style="display:block; margin-top:25px;" class="m-0">@if(canEditLang() && checkRequestOnEdit())
                                  <editor_block data-name='Total user enter' contenteditable="true">{{ __('Total user enter') }}</editor_block>
                              @else {{ __('Total user enter') }}@endif {{ $item->totalEnter() ?? 0 }} {{ $item->currency->symbol }}
                        </span>

                          <span style="display:block; margin-top:5px;" class="m-0">@if(canEditLang() && checkRequestOnEdit())
                                  <editor_block data-name='Total user withdraw' contenteditable="true">{{ __('Total user withdraw') }}</editor_block>
                              @else {{ __('Total user withdraw') }}@endif {{ $item->totalWithdraw() ?? 0 }} {{ $item->currency->symbol }}
                        </span>

                        <i class="icon-bg" data-feather="credit-card"></i>
                        <div class="mt-3 wallet-button-wrapper ">
                          <a href="{{ route('accountPanel.replenishment') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif class="btn btn-success">@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='Replenish1' contenteditable="true">{{ __('Replenish1') }}</editor_block>
                            @else {{ __('Replenish1') }}@endif</a>
                          <a href="{{ route('accountPanel.withdrawal') }}" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif class="btn btn-danger">@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='To withdraw2' contenteditable="true">{{ __('To withdraw2') }}</editor_block>
                            @else {{ __('To withdraw2') }}@endif</a>
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
                <h4 class="mb-0">@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Last 5 transactions' contenteditable="true">{{ __('Last 5 transactions') }}</editor_block>
                  @else {{ __('Last 5 transactions') }}@endif</h4>
              </div>
              <div class="card-body pt-3 pb-3">
                <div class="table-responsive">
                  <div class="item">
                    <div class="table-responsive product-list">
                      <table class="table table-bordernone">
                        <thead>
                          <tr>
                            <th>@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Type of transaction' contenteditable="true">{{ __('Type of transaction') }}</editor_block>
                              @else {{ __('Type of transaction') }}@endif</th>
                            <th>@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Amount' contenteditable="true">{{ __('Amount') }}</editor_block>
                              @else {{ __('Amount') }}@endif</th>
                            <th>@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Payment system' contenteditable="true">{{ __('Payment system') }}</editor_block>
                              @else {{ __('Payment system') }}@endif</th>
                            <th>@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Status operation' contenteditable="true">{{ __('Status operation') }}</editor_block>
                              @else {{ __('Status operation') }}@endif</th>
                            <th class="">@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Date of operation' contenteditable="true">{{ __('Date of operation') }}</editor_block>
                              @else {{ __('Date of operation') }}@endif</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(isset($transactions) && !empty($transactions))
                            @foreach($transactions as $transaction)
                              <tr style="vertical-align: middle;">
                                <td>
                                  @if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='{{ 'locale.' . $transaction->type->name }}' contenteditable="true">{{ __('locale.' . $transaction->type->name) }}</editor_block> @else {{ __('locale.' . $transaction->type->name) }}@endif
                                  {{-- {{ __('locale.' . $transaction->type->name) ?? 'Не указано' }}--}}</td>
                                <td>
                                  <span class="">{{$transaction->currency->symbol}} {{ number_format($transaction->amount, $transaction->currency->precision, '.', ',') ?? 0 }}</span>
                                  @if(!preg_match('/USD/', $transaction->currency->code))
                                  <br>
                                  <span class="badge rounded-pill pill-badge-info">$ {{ number_format($transaction->main_currency_amount, 2, '.', ',') ?? 0 }}</span>
                                  @endif
                                </td>
                                <td>
                                    {{ $transaction->paymentSystem->name ?? $transaction->currency->code }}
                                </td>
                                <td>@switch($transaction->approved)
                                    @case(1)
                                    <span class="btn-success p-2 ps-4 pe-4" style="display: inline-block; min-width: 200px;text-align: center">@if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='Confirmed' contenteditable="true">{{ __('Confirmed') }}</editor_block>
                                      @else {{ __('Confirmed') }}@endif</span>
                                    @break
                                    @case(2)
                                    <span class="btn-danger p-2 ps-4 pe-4" style="display: inline-block; min-width: 200px;text-align: center">@if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='Rejected' contenteditable="true">{{ __('Rejected') }}</editor_block>
                                      @else {{ __('Rejected') }}@endif</span>
                                    @break
                                    @default
                                    <span class="btn-light p-2 ps-4 pe-4" style="display: inline-block; min-width: 200px;text-align: center">@if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='Not confirmed' contenteditable="true">{{ __('Not confirmed') }}</editor_block>
                                      @else {{ __('Not confirmed') }}@endif</span>
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
              <h5 class="m-0">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Popularity by country' contenteditable="true">{{ __('Popularity by country') }}</editor_block>
                @else {{ __('Popularity by country') }}@endif</h5>
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
            <h5>@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Videos' contenteditable="true">{{ __('Videos') }}</editor_block>
              @else {{ __('Videos') }}@endif</h5>
          </div>
          <div class="card-body pt-3 pb-3">
            <div class="row pb-4">
              <div class="col-12">
                <ul class="nav nav-dark" id="pills-darktab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif id="pills-darkhome-tab" data-bs-toggle="pill" href="#pills-darkhome" role="tab" aria-controls="pills-darkhome" aria-selected="true" data-bs-original-title="" title="">
                      <i class="icofont icofont-ui-note"></i>
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Feed' contenteditable="true">{{ __('Feed') }}</editor_block>
                      @else {{ __('Feed') }}@endif
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif id="pills-darkprofile-tab" data-bs-toggle="pill" href="#pills-darkprofile" role="tab" aria-controls="pills-darkprofile" aria-selected="false" data-bs-original-title="" title="">
                      <i class="icofont icofont-upload-alt"></i>
                      @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Upload' contenteditable="true">{{ __('Upload') }}</editor_block>
                      @else {{ __('Upload') }}@endif
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
                                <img src="{{  $users_video->user->avatar ? route('accountPanel.profile.get.avatar',$users_video->user->id) : asset('accountPanel/images/user/user.png')  }}" alt="" width="40" height="40" style="-webkit-border-radius: 50%;-moz-border-radius: 50%;border-radius: 50%;">
                                {{ $users_video->user->login ?? '' }}</div>
                              {!! htmlspecialchars_decode($users_video->link) !!}
                            </li>
                          @empty
                            <li class="mb-3" style="background: #fafafa; padding: 15px">
                              @if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Nothing added' contenteditable="true">{{ __('Nothing added') }}</editor_block>
                              @else {{ __('Nothing added ') }}@endif
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
                        <button class="btn btn-primary m-r-15" type="submit" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Send' contenteditable="true">{{ __('Send') }}</editor_block>
                          @else {{ __('Send') }}@endif</button>
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
            <h5>@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Transfer' contenteditable="true">{{ __('Transfer') }}</editor_block> @else {{ __('Transfer') }} @endif
            </h5>
          </div>
          <div class="card-body pt-0">
            <form action="{{ route('accountPanel.dashboard.send.money') }}" method="post" class="send-money-to-user-form">
              @csrf
              <div class="apex-chart-container goal-status text-center">
                <div class="rate-card">
                  <h6 class="mb-2 mt-2 f-w-400">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='User' contenteditable="true">{{ __('User') }}</editor_block> @else {{ __('User') }} @endif
                  </h6>
                  <div class="input-group mb-3">
                    <input class="form-control" type="text" name="user" value="{{ old('user') ?? '' }}">
                  </div>
                  <h6 class="mb-2 mt-2 f-w-400">@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Enter the amount' contenteditable="true">{{ __('Enter the amount') }}</editor_block> @else {{ __('Enter the amount') }} @endif
                  </h6>
                  <div class="input-group mb-3">
                    <input class="form-control" type="text" name="amount" value="{{ old('amount') ?? '' }}">
                  </div>
                  <div class="input-group mb-3">
                    <select class="form-select form-control-inverse-fill " name="wallet_id">
                      <option value="" disabled selected hidden>
                        Выберите баланс аккаунта
                      </option>
                      @forelse($wallets as $wallet)
                        <option value="{{ $wallet->id }}" @if(old('wallet_id') == $wallet->id) selected="selected" @endif>{{ $wallet->currency->name }} - {{ $wallet->balance }}{{ $wallet->currency->symbol }}</option>
                      @empty
                      @endforelse
                    </select>
                  </div>
                  <div class="form-check checkbox mb-3">
                    <input class="form-check-input" id="checkbox3" type="checkbox">
                    <label class="form-check-label" for="checkbox3">
                        @if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Do insurance 1' contenteditable="true">{{ __('Do insurance 1') }}</editor_block>
                        @else
                            {{ __('Do insurance 1') }}
                        @endif
                    </label>
                  </div>
                  <button class="btn btn-lg btn-primary btn-block send-money-to-user-btn" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                      <editor_block data-name='Do transfer' contenteditable="true">{{ __('Do transfer') }}</editor_block> @else {{ __('Do transfer') }} @endif
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-6 risk-col ">
        <div class="card height-equal" style="min-height: 331px;">
          <div class="card-header">
            <h5>@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Your referral link' contenteditable="true">{{ __('Your referral link') }}</editor_block> @else {{ __('Your referral link') }} @endif
            </h5>
          </div>
          <div class="card-body">
            <h4><i data-feather="link"></i> {{ route('ref_link', auth()->user()->my_id) }}</h4>
          </div>
          <div class="card-footer">
            <button class="btn btn-primary btn-lg" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @else onclick="copyToClipboard()" @endif>@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Copy' contenteditable="true">{{ __('Copy') }}</editor_block> @else {{ __('Copy') }} @endif
            </button>
          </div>
        </div>
      </div>
      <div class="offer-box" style="padding-top: 40px; padding-bottom: 40px;">
        <div class="row">
          <div class="col offer-slider" style="">
            <div class="carousel-item active">
              <div class="selling-slide row">
                <div class="col-xl-4 col-md-6">
                  <div class="d-flex">
                    <div class="left-content">
                      <p>@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Much More Selling product' contenteditable="true">{{ __('Much More Selling product') }}</editor_block> @else {{ __('Much More Selling product') }} @endif</p>
                      <h4 class="f-w-600">@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Best Selling Product' contenteditable="true">{{ __('Best Selling Product') }}</editor_block> @else {{ __('Best Selling Product') }} @endif</h4>
                      <span class="badge badge-white rounded-pill">@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='78% offer' contenteditable="true">{{ __('78% offer') }}</editor_block> @else {{ __('78% offer') }} @endif</span>
                      <span class="badge badge-dotted rounded-pill ms-2">@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Coupon Code : 12345' contenteditable="true">{{ __('Coupon Code : 12345') }}</editor_block> @else {{ __('Coupon Code : 12345') }} @endif</span>
                    </div>
                  </div>
                </div>
                <div class="col-xl-4 col-md-12">
                  <div class="center-img text-center">
                    <img class="img-fluid" src="{{ asset('images/dashboard-2/sprint bank card-02.png') }}" style="max-width: 410px" alt="..."></div>
                </div>
                <div class="col-xl-4 col-md-6">
                  <div class="d-flex">
                    <div class="right-content">
                      <p>@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Money back Guarrantee' contenteditable="true">{{ __('Money back Guarrantee') }}</editor_block> @else {{ __('Money back Guarrantee') }} @endif</p>
                      <h4 class="f-w-600">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Women Straight Kurta' contenteditable="true">{{ __('Women Straight Kurta') }}</editor_block> @else {{ __('Women Straight Kurta') }} @endif</h4>
                      <span class="badge badge-white rounded-pill">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='$100.00' contenteditable="true">{{ __('$100.00') }}</editor_block> @else {{ __('$100.00') }} @endif</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{--@if($banners !== null)
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
      @endif--}}
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
                          @if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Best seller' contenteditable="true">{{ __('Best seller') }}</editor_block> @else {{ __('Best seller') }} @endif
                        </th>
                        <th>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Date' contenteditable="true">{{ __('Date') }}</editor_block> @else {{ __('Date') }} @endif
                        </th>
                        <th>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Product' contenteditable="true">{{ __('Product') }}</editor_block> @else {{ __('Product') }} @endif
                        </th>
                        <th>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Country' contenteditable="true">{{ __('Country') }}</editor_block> @else {{ __('Country') }} @endif
                        </th>
                        <th>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Total' contenteditable="true">{{ __('Total') }}</editor_block> @else {{ __('Total') }} @endif
                        </th>
                        <th class="text-end">@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Status' contenteditable="true">{{ __('Status') }}</editor_block> @else {{ __('Status') }} @endif
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                    @for($i=1; $i<=4; $i++)
                      <tr>
                        <td>
                          <div class="d-inline-block align-middle">
                              <?php
                              $avatarCodes = [
                                  '1.jpg',
                                  '2.png',
                                  '2021-11-06 14.25.51.jpg',
                                  '5.jpg',
                              ];
                              ?>
                            <img class="img-40 m-r-15 rounded-circle align-top" src="{{ asset('accountPanel/images/user/'.($avatarCodes[$i-1])) }}" alt="">
                            <div class="status-circle bg-primary"></div>
                            <div class="d-inline-block">
                              <span>
                                  @if(canEditLang() && checkRequestOnEdit())
                                      <editor_block data-name='Username {{ $i }}' contenteditable="true">
                                          {{ __('Username '.$i) }}
                                      </editor_block>
                                  @else
                                      {{ __('Username '.$i) }}
                                  @endif
                              </span>
                              <p class="font-roboto">
                                  @if(canEditLang() && checkRequestOnEdit())
                                      <editor_block data-name='Year {{ $i }}' contenteditable="true">
                                          {{ __('Year '.$i) }}
                                      </editor_block>
                                  @else
                                      {{ __('Year '.$i) }}
                                  @endif
                              </p>
                            </div>
                          </div>
                        </td>
                        <td>
                            @if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Date {{ $i }}' contenteditable="true">
                                    {{ __('Date '.$i) }}
                                </editor_block>
                            @else
                                {{ __('Date '.$i) }}
                            @endif
                        </td>
                        <td>
                            @if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Cap {{ $i }}' contenteditable="true">
                                    {{ __('Cap '.$i) }}
                                </editor_block>
                            @else
                                {{ __('Cap '.$i) }}
                            @endif
                        </td>
                          <?php
                          $countryCodes = [
                              'gb',
                              'us',
                              'za',
                              'at',
                              'br',
                          ];
                          ?>
                        <td><i class="flag-icon flag-icon-{{ $countryCodes[$i-1] }}"></i></td>
                        <td>
                          <span class="label">
                                  @if(canEditLang() && checkRequestOnEdit())
                                  <editor_block data-name='Amount {{ $i }}' contenteditable="true">
                                          {{ __('Amount '.$i) }}
                                      </editor_block>
                              @else
                                  {{ __('Amount '.$i) }}
                              @endif
                          </span>
                        </td>
                        <td class="text-end"><i class="fa fa-check-circle"></i>
                            @if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Status {{ $i }}' contenteditable="true">
                                    {{ __('Status '.$i) }}
                                </editor_block>
                            @else
                                {{ __('Status '.$i) }}
                            @endif
                        </td>
                      </tr>
                    @endfor
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

  <script>
    $(document).ready(function () {
      $(".form-control-inverse-fill").select2();
    });


    $(".send-money-to-user-btn").on('click', function (e) {
      e.preventDefault();
      swal({
        title: "Вы подтверждаете?",
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
            show: true
          },
        },
        dataLabels: {
          enabled: true
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          type: 'period',
          low: 0,
          offsetX: 0,
          offsetY: 0,
          show: true,
          categories: [@foreach($period_graph as $period) "{{ $period['start']->format('d.m.Y') }}", @endforeach],
          labels: {
            low: 0,
            offsetX: 0,
            show: false,
          },
          axisBorder: {
            low: 0,
            offsetX: 0,
            show: true,
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
            show: true,
          },
          axisBorder: {
            low: 0,
            offsetX: 0,
            show: true,
          },
        },
        grid: {
          show: true,
          padding: {
            left: 0,
            right: 0,
            bottom: -15,
            top: -40
          }
        },
        colors: ['#51bb25', CubaAdminConfig.secondary], // CubaAdminConfig.primary
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
            message: 'Ссылка скопирована!'
          },
          {
            type: 'success',
            allow_dismiss: false,
            newest_on_top: false,
            mouse_over: false,
            showProgressbar: false,
            spacing: 10,
            timer: 2000,
            placement: {
              from: 'top',
              align: 'center'
            },
            offset: {
              x: 30,
              y: 30
            },
            delay: 1000,
            z_index: 10000,
            animate: {
              enter: 'animated bounce',
              exit: 'animated bounce'
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
            data: [800, 454, 900, 500, 734, 623, 600],
          }],
          stroke: {
            width: 3,
            curve: 'smooth',
          },
          /*labels: [@foreach($countries_stat as $item)"{{ $item->name }}" @if(!$loop->last), @endif @endforeach],*/
          labels: ['Сша', 'Китай', 'Россия', 'Сингапур', 'Германия', 'Австралия', 'Казахстан'],
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
