@extends('layouts.accountPanel.app')
@section('title', __('Все операции'))
@section('content')
  
  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
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
                        <th scope="row">{{ $loop->iteration  }}</th>
                        <td>{{ __('locale.' . $operation->type->name) ?? 'Не указано' }}</td>
                        <td>
                          <span class="">$ {{ number_format($operation->main_currency_amount, 2, '.', ',') ?? 0 }}</span>
                        </td>
                        <td>{{ $operation->paymentSystem->name ?? 'Не указано' }}</td>
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
