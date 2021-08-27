@extends('layouts.accountPanel.app')
@section('title', __('Все рефералы'))
@section('content')
  
  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">

        <div class="row">
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
        </div>
      </div>
      
      

    
  </div>
@endsection
@push('scripts')
  <script>
  
  </script>
@endpush
