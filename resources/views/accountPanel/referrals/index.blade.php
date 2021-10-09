@extends('layouts.accountPanel.app')
@section('title', __('Все рефералы'))
@section('content')
  
  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
      @include('partials.inform')
      <div class="user-profile">
        <div class="row">
          <!-- user profile first-style start-->
          <div class="col-sm-12">
            <div class="card hovercard text-center">
              <div class="cardheader" style="background: url('{{ asset('accountPanel/images/other-images/profile-style-img3.png') }}') no-repeat; background-size: cover;max-height: 300px;"></div>
              <div class="user-image">
                <div class="avatar"><img alt="" src="{{ $upliner->avatar ? route('accountPanel.profile.get.avatar', $upliner->id) : asset('accountPanel/images/user/user.png') }}"></div>
                <div class="icon-wrapper"><i class="icofont icofont-pencil-alt-5"></i></div>
              </div>
              <div class="info">
                <div class="row">
                  <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="ttl-info text-start">
                          <h6><i class="fa fa-link"></i>&nbsp;&nbsp;&nbsp;Ваша реферальная ссылка</h6>
                          <span>{{ route('ref_link', $user->my_id) }}</span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="ttl-info text-start">
                          <h6><i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp;...</h6>
                          <span>...</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                    <div class="user-designation">
                      <div class="title">
                        <a target="_blank" href="" data-bs-original-title="" title="">{{ $upliner->name }}</a>
                      </div>
                      <div class="desc">Логин: {{ $upliner->login }}</div>
                      <div class="desc">Ваш аплайнер</div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="ttl-info text-start">
                          <h6><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;Сумма инвестиций партнёров</h6>
                          <span>{{ number_format($total_referral_invested, 2,'.', ' ') }}$</span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="ttl-info text-start">
                          <h6><i class="fa fa-location-arrow"></i>&nbsp;&nbsp;&nbsp;Сумма прибыли</h6>
                          <span>{{ number_format($total_referral_revenue, 2,'.', ' ') }}$</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="social-media">
                  <ul class="list-inline">
                    <li class="list-inline-item">
                      <a href="#" data-bs-original-title="" title=""><i class="fa fa-facebook"></i></a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#" data-bs-original-title="" title=""><i class="fa fa-google-plus"></i></a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#" data-bs-original-title="" title=""><i class="fa fa-twitter"></i></a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#" data-bs-original-title="" title=""><i class="fa fa-instagram"></i></a>
                    </li>
                    <li class="list-inline-item">
                      <a href="#" data-bs-original-title="" title=""><i class="fa fa-rss"></i></a>
                    </li>
                  </ul>
                </div>
                <div class="follow">
                  <div class="row">
                    <div class="col-6 text-md-end border-right">
                      <div class="follow-num counter">25869</div>
                      <span>Зарегестрированных партнёров</span>
                    </div>
                    <div class="col-6 text-md-start">
                      <div class="follow-num counter">659887</div>
                      <span>Активных партнёров</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      {{--<div class="row">
        <div class="col-12">
          @include('partials.inform')
        </div>
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
              <div class="best-seller-table responsive-tbl mb-3">
                <div class="item">
                  <div class="table-responsive product-list">
                    <table class="table table-bordernone">
                      <thead>
                        <tr>
                          <th class="f-22">Логин</th>
                          <th >Сумма инвестиций, $</th>
                          <th scope="col">Дата регистрации</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(isset($referrals) && !empty($referrals))
                          @foreach($referrals as $referral)
                            <tr>
                              <td class="f-16">{{ $referral->login ?? '' }}</td>
                            
                              <td >
                                <div class="span badge rounded-pill pill-badge-primary f-14 ">
                                  ${{ number_format($referral->transactions->where('type_id', $transaction_type_invest->id)->sum('main_currency_amount'), 2, '.',' ') }}
                                </div>
                               </td>
                              <td >{{ $referral->created_at ?? '' }}</td>
                            </tr>
                          @endforeach
                        @else
                          <tr>
                            <td class="p-0" colspan="6">
                              <div class="alert alert-light inverse alert-dismissible fade show" role="alert"><i class="icon-alert txt-dark"></i>
                                <p style="font-size: 16px;">Депозитов нет</p>
                              </div>
                            </td>
                          </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div>
                {{ $referrals->appends(request()->except('page'))->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>--}}
    </div>
  </div>
@endsection
@push('scripts')
  <script>
  
  </script>
@endpush
