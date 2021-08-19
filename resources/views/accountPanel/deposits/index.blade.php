@extends('layouts.accountPanel.app')
@section('title', __('Все депозиты'))
@section('content')
  
  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
      <div class="card">
        <div class="card-header">
          <h5>Всего депозитов: {{ $deposits_count ?? 0 }}</h5>
          <a href="{{ route('accountPanel.deposits.create') }}" class="mt-3 btn btn-success">Сделать депозит</a>
        </div>
        <div class="card-block row">
          <div class="col-12">
            @include('partials.inform')
          </div>
          <div class="col-sm-12 col-lg-12 col-xl-12">
            <div class="table-responsive">
              <table class="table">
                <thead class="bg-primary">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Сумма инвестиций</th>
                    <th scope="col">Текущий баланс</th>
                    <th scope="col">Осталось начислить</th>
                    <th scope="col">Следующее начисление</th>
                    <th scope="col">Дата открытия</th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($deposits) && !empty($deposits))
                    @foreach($deposits as $deposit)
                      <tr>
                        <th scope="row">{{ $loop->iteration  }}</th>
                        <td>
                          <span class="">$ {{ number_format($deposit->invested, 2, '.', ',') ?? 0 }}</span>
                        </td>
                        <td>$ {{ number_format($deposit->invested, 2, '.', ',') ?? 0 }}</td>
                        <th scope="col">?</th>
                        <th scope="col">?</th>
                        <td>{{ $deposit->created_at->format('d-m-Y H:i') }}</td>
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
      </div>
      
      
      <div>
        {{ $deposits->appends(request()->except('page'))->links() }}
      </div>
    
    </div>
  </div>
@endsection
@push('scripts')
  <script>
  
  </script>
@endpush
