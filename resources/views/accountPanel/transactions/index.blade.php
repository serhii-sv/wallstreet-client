@extends('layouts.accountPanel.app')
@section('title', __('Все операции'))
@section('content')
  
  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
      <div class="col-xl-4 email-wrap bookmark-wrap">
        <div class="email-left-aside">
          <div class="card">
            <div class="card-body">
              <div class="email-app-sidebar left-bookmark">
                <ul class="nav main-menu" role="tablist">
                  <li class="nav-item">
                    <span class="main-title">Type</span>
                  </li>
                  @forelse($transaction_types as $transaction_type)
                    <li>
                      <a href="{{ route('accountPanel.transactions', $transaction_type->id) }}" class="@if($transaction_type->id == $type) active @endif" aria-controls="pills-created" aria-selected="false" data-bs-original-title="">
                        <span class="title">{{ __('locale.' . $transaction_type->name) ?? 'Не указано' }}</span>
                      </a>
                    </li>
                  @empty
                  @endforelse
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col col-xl-8 box-col-6">
        <div class="card">
          <div class="card-header">
            <h5>Всего операций: {{ $transactions_count ?? 0 }}</h5>
          </div>
          <div class="card-block row">
            <div class="col-sm-12 col-lg-12 col-xl-12">
              <div class="table-responsive">
                <table class="table">
                  <thead class="bg-primary">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Тип</th>
                      <th scope="col">Сумма</th>
                      <th scope="col">Платёжная система</th>
                      <th scope="col">Статус</th>
                      <th scope="col">Дата операции</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if(isset($transactions) && !empty($transactions))
                      @forelse($transactions as $operation)
                        <tr>
                          <th scope="row">{{ $operation->iteration  }}</th>
                          <td>{{ __('locale.' . $operation->type->name) ?? 'Не указано' }}</td>
                          <td>
                            <span class="">{{$operation->currency->symbol}} {{ number_format($operation->amount, $operation->currency->precision, '.', ',') ?? 0 }}</span>
                            <br>
                            <span class="badge rounded-pill pill-badge-info">$ {{ number_format($operation->main_currency_amount, 2, '.', ',') ?? 0 }}</span>
                          </td>
                          <td>
                            {{ $operation->paymentSystem->name ?? 'Не указано' }}
                            <br>
                            <span class="badge rounded-pill pill-badge-info">{{ $operation->external ?? '' }}</span>
                          </td>
                          <td>@switch($operation->approved)
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
                          <td>{{ $operation->created_at->format('d-m-Y H:i') }}</td>
                        </tr>
                      @empty
                        <tr>
                          <td class="p-0" colspan="6">
                            <div class="alert alert-light inverse alert-dismissible fade show" role="alert"><i class="icon-alert txt-dark"></i>
                              <p style="font-size: 16px;">Операций нет</p>
                            </div>
                          </td>
                        </tr>
                      @endforelse
                    @else
                      <tr>
                        <td class="p-0" colspan="6">
                          <div class="alert alert-light inverse alert-dismissible fade show" role="alert"><i class="icon-alert txt-dark"></i>
                            <p style="font-size: 16px;">Операций нет</p>
                          </div>
                        </td>
                      </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div>
        {{ $transactions->appends(request()->except('page'))->links() }}
      </div>
    
    </div>
  </div>
@endsection
@push('scripts')
  <script>
  
  </script>
@endpush
