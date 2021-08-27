@extends('layouts.accountPanel.app')
@section('title', __('Сделать депозит'))
@section('content')
  
  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
      
      @if(!empty($rates))
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
       
              <div class="card-body row pricing-content">
                <div class="mb-3">
                  @include('partials.inform')
                </div>
                @forelse($rates as $item)
                  <div class="col-xl-3 col-sm-6 xl-50 box-col-6">
                    <form action="{{ route('accountPanel.deposits.store') }}" class="create-deposit-form" method="post">
                      <input type="hidden" name="rate_id" value="{{ $item->id }}">
                      @csrf
                      <div class="card text-center pricing-simple">
                        <div class="card-body">
                          <h3>{{ $item->name }}</h3>
                          <h5>В день {{ $item->daily }}%</h5>
                          <h6>Длительность: {{ $item->duration }}</h6>
                          <h4 class="mb-2">Можно внести </h4>
                          <p style="font-size: 15px;">от <strong>{{ number_format($item->min, 2,'.',',') }}$</strong> до <strong>{{ number_format($item->max, 2,'.',' ') }}$</strong></p>
                          {{--                          <h6 class="mb-2">Выберите платёжную систему</h6>--}}
                          {{--                          <select class="js-example-basic-single col-sm-12" name="payment_system">--}}
                          {{--                            @forelse($payment_systems as $payment_system)--}}
                          {{--                              <option value="{{ $payment_system->id }}">{{ $payment_system->name }}</option>--}}
                          {{--                            @empty--}}
                          {{--                            @endforelse--}}
                          {{--                          </select>--}}
                          <div class="input-group">
                            <select class="form-select form-control-inverse-fill" name="wallet_id">
                              <option value="" disabled selected hidden>Выберите валюту</option>
                              @forelse($wallets as $wallet)
                              <option value="{{ $wallet->id }}" @if(old('wallet_id') == $wallet->id) selected="selected" @endif>{{ $wallet->currency->name }} - {{ $wallet->balance }}{{ $wallet->currency->symbol }}</option>
                              @empty
                              @endforelse
                            </select>
                          </div>
                          <h6 class="mb-2 mt-2">Введите сумму</h6>
                          <div class="input-group">
                            <input class="form-control" type="text" name="amount" value="{{ old('amount') ?? '' }}">
                          </div>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block create-deposit-btn" >Внести</button>
                      </div>
                    </form>
                  </div>
                @empty
                @endforelse
              </div>
            </div>
          </div>
        
        </div>
      @endif
    
    </div>
  </div>
@endsection
@push('scripts')
  <script src="{{ asset('accountPanel/js/sweet-alert/sweetalert.min.js') }}"></script>
  <script>
    $(document).ready(function (){
      $(".form-control-inverse-fill").select2();
    
      $(".create-deposit-btn").on('click', function (e) {
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
            $(this).parent().parent().submit();
            swal("Подождите немного!", {
              icon: "success",
            });
          }
        });
      });
    });
  </script>
@endpush
