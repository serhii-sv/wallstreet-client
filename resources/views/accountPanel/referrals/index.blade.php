@extends('layouts.accountPanel.app')
@section('title')
Referrals page
@endsection
@section('content')

  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
      @include('partials.inform')
      <div class="user-profile">
        <div class="row">
          <!-- user profile first-style start-->
          <div class="col-sm-12">
            <div class="card hovercard text-center">
              <div class="cardheader" style="background: url('{{ asset('accountPanel/images/other-images/sprint bank banner_-01.jpg') }}') no-repeat; background-size: cover;max-height: 300px;"></div>
              <div class="user-image">
                <div class="avatar">
                  @if(!$upliner)
                    <img alt="" src="{{ $user->avatar ? route('accountPanel.profile.get.avatar', $user->id) : asset('accountPanel/images/user/user.png') }}">
                  @else
                    <img alt="" src="{{ $upliner->avatar ? route('accountPanel.profile.get.avatar', $upliner->id) : asset('accountPanel/images/user/user.png') }}">
                  @endif
                </div>
              </div>
              <div class="info">
                <div class="row">
                  <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="ttl-info text-start">
                          <h6><i class="fa fa-calendar"></i>&nbsp;&nbsp;&nbsp;@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='Referral link transitions' contenteditable="true">{{ __('Referral link transitions') }}</editor_block> @else {{ __('Referral link transitions') }} @endif
                          </h6>
                          <span>{{ $referral_link_clicks ?? 0 }}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                    <div class="user-designation">
                      <div class="title">
                        <a target="_blank" href="" data-bs-original-title="" title="">@if(!$upliner) {{ $user->name }} @else {{ $upliner->name }} @endif </a>
                      </div>
                      <div class="desc">@if(!$upliner) @if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Your login' contenteditable="true">{{ __('Your login') }}</editor_block> @else {{ __('Your login') }} @endif: {{ $user->login }} @else {{ $upliner->login }} @endif
                      </div>
                      <div class="desc">@if($upliner) @if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Your upliner' contenteditable="true">{{ __('Your upliner') }}</editor_block> @else {{ __('Your upliner') }} @endif @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="ttl-info text-start">
                          <h6><i class="fa fa-phone"></i>&nbsp;&nbsp;&nbsp;@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name="Partners' investment amount" contenteditable="true">{{ __("Partners' investment amount") }}</editor_block> @else {{ __("Partners' investment amount") }} @endif
                          </h6>
                          <span>{{ number_format($total_referral_invested, 2,'.', ' ') }}$</span>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="ttl-info text-start">
                          <h6>
                            <i class="fa fa-location-arrow"></i>&nbsp;&nbsp;&nbsp;@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='Profit amount' contenteditable="true">{{ __('Profit amount') }}</editor_block> @else {{ __('Profit amount') }} @endif
                          </h6>
                          <span>{{ number_format($personal_turnover, 2,'.', ' ') }}$</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="social-media">
                      <h5>@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Share your referral link on social media' contenteditable="true">{{ __('Share your referral link on social media') }}</editor_block> @else {{ __('Share your referral link on social media') }} @endif
                      </h5>
                      <script src="https://yastatic.net/share2/share.js"></script>
                      <div class="ya-share2" data-url="{{ route('ref_link', auth()->user()->my_id) }}" data-curtain data-size="l" data-color-scheme="whiteblack" data-services="vkontakte,facebook,odnoklassniki,telegram,twitter,viber,whatsapp,moimir,skype,linkedin"></div>

                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="follow">
                      <div class="row">
                        <div class="col-lg-4">
                          <div class="ttl-info text-start">
                            <h6><i class="fa fa-link"></i>&nbsp;&nbsp;&nbsp;@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Your referral link' contenteditable="true">{{ __('Your referral link') }}</editor_block> @else {{ __('Your referral link') }} @endif
                            </h6>
                            <span>{{ route('ref_link', $user->my_id) }}</span>
                          </div>
                        </div>
                        <div class="col-lg-4 text-md-end">
                          <div class="follow-num counter">{{ $referral_link_registered }}</div>
                          <span>@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='Registered partners' contenteditable="true">{{ __('Registered partners') }}</editor_block> @else {{ __('Registered partners') }} @endif</span>
                        </div>
                        <div class="col-lg-4 text-md-start border-right">
                          <div class="follow-num counter">{{ $all_referrals->count() }}</div>
                          <span>@if(canEditLang() && checkRequestOnEdit())
                              <editor_block data-name='Active partners' contenteditable="true">{{ __('Active partners') }}</editor_block> @else {{ __('Active partners') }} @endif</span>
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
                            <editor_block data-name='User acc' contenteditable="true">{{ __('User acc') }}</editor_block> @else {{ __('User acc') }} @endif
                        </th>
                        <th>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Telephone acc' contenteditable="true">{{ __('Telephone acc') }}</editor_block> @else {{ __('Telephone acc') }} @endif
                        </th>
                        <th>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Date/Time of registration acc' contenteditable="true">{{ __('Date/Time of registration acc') }}</editor_block> @else {{ __('Date/Time of registration acc') }} @endif
                        </th>
                        <th>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Upliner login acc' contenteditable="true">{{ __('Upliner login acc') }}</editor_block> @else {{ __('Upliner login acc') }} @endif
                        </th>
                        <th>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Invested acc' contenteditable="true">{{ __('Invested acc') }}</editor_block> @else {{ __('Invested acc') }} @endif
                        </th>
                        <th>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Accruals acc' contenteditable="true">{{ __('Accruals acc') }}</editor_block> @else {{ __('Accruals acc') }} @endif
                        </th>
                        <th>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Reward acc' contenteditable="true">{{ __('Reward acc') }}</editor_block> @else {{ __('Reward acc') }} @endif
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    die(print_r(auth()->user()->getAllReferralsForAccount(),true));
                    ?>
                    @foreach(auth()->user()->getAllReferralsForAccount() as $level => $referrals)
                        <?php
                        if (!count($referrals)) {
                            break;
                        }
                        ?>

                        <tr>
                            <td colspan="7" style="font-weight:bold; text-align: center;">
                                <h3>{{ $level }} линия</h3>
                            </td>
                        </tr>

                      @forelse($referrals as $referral)
                        <tr>
                          <td>
                            <div class="d-inline-block align-middle">
                              <img class="img-40 m-r-15 rounded-circle align-top" src="{{ $referral->avatar ? route('accountPanel.profile.get.avatar', $referral->id) : asset('accountPanel/images/user/user.png') }}" alt="">
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
                    @endforeach
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
