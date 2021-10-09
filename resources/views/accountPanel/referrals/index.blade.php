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
                <div class="avatar">
                  <img alt="" src="{{ $upliner->avatar ? route('accountPanel.profile.get.avatar', $upliner->id) : asset('accountPanel/images/user/user.png') }}">
                </div>
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
                          <h6><i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp;Переходов по реф. ссылке</h6>
                          <span>{{ $referral_link_clicks ?? 0 }}</span>
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
                  <h5>Поделитесь реферальной ссылкой в соц. сетях</h5>
                  <script src="https://yastatic.net/share2/share.js"></script>
                  <div class="ya-share2" data-url="{{ route('ref_link', auth()->user()->my_id) }}" data-curtain data-size="l" data-color-scheme="whiteblack" data-services="vkontakte,facebook,odnoklassniki,telegram,twitter,viber,whatsapp,moimir,skype,linkedin"></div>
                
                </div>
                <div class="follow">
                  <div class="row">
                    <div class="col-6 text-md-end">
                      <div class="follow-num counter">{{ $referral_link_registered }}</div>
                      <span>Зарегестрированных партнёров</span>
                    </div>
                    <div class="col-6 text-md-start border-right">
                      <div class="follow-num counter">{{ $referrals->count() }}</div>
                      <span>Активных партнёров</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      
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
                          Пользователь
                        </th>
                        <th>Телефон</th>
                        <th>Дата/Время регистрации</th>
                        <th>Логин аплайнера</th>
                        <th>Инвестировано</th>
                        <th>Начисления</th>
                        <th>Вознаграждение</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($referrals as $referral)
                        <tr>
                          <td>
                            <div class="d-inline-block align-middle">
                              <img class="img-40 m-r-15 rounded-circle align-top" src="{{ $referral->image ? route('accountPanel.profile.get.avatar', $referral->id) : asset('accountPanel/images/user/user.png') }}" alt="">
                              <div class="status-circle bg-primary"></div>
                              <div class="d-inline-block">
                                <span style="font-size: 18px;">{{ $referral->name }}</span>
                                <p class="font-roboto" style="font-size: 15px;">{{ $referral->login }}</p>
                              </div>
                            </div>
                          </td>
                          <td>{{ $referral->phone ?? 'Не указан' }}</td>
                          <td>{{ $referral->created_at->format('d.m.Y H:i:s') }}</td>
                          <td>
                            <span class="badge rounded-pill pill-badge-info" style="color: white;font-size: 16px;">{{ $referral->partner->login }}</span>
                          </td>
                          <td>
                            <span class="label">
                              {{ number_format($referral->invested(), 2, '.', ' ') ?? 0 }}$
                            </span>
                          </td>
                          <td class="">
                            {{ number_format($referral->deposits_accruals(), 2, '.', ' ') ?? 0 }}$
                          </td>
                          <td>
                            {{ number_format($referral->deposit_reward(), 2, '.', ' ') }}$
                          </td>
                        </tr>
                      @empty
                      @endforelse
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
  <script>
  
  </script>
@endpush
