@extends('layouts.accountPanel.app')
@section('title')
Verify phone
@endsection
@section('content')

  <div class="container-fluid">
    <div class="edit-profile">
      <div class="row">
        <div class="col-xl-12" style="margin-top:50px;">
          <div class="card">
            <div class="card-body pb-4 pt-4">
              <h4 class="card-title mb-4">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Verify phone' contenteditable="true">{{ __('Verify phone') }}</editor_block> @else {{ __('Verify phone') }} @endif
              </h4>
              <div class="mt-3 mb-3">@include('partials.inform')</div>
              <form action="{{ route('accountPanel.settings.verify.phone') }}" method="post">
                @csrf
                <div class="mb-3">
                  <label class="form-label">Введите код отправленый вам на телефон:</label>
                  <input class="form-control input-air-primary" name="code" value="">
                </div>
                <div class="mb-3">
                  @if($last_sms)
                    <span>Отправить код повторно можно будет через {{ 300 - Carbon\Carbon::parse($last_sms->created_at)->diffInSeconds(Carbon\Carbon::now()) }} секунд</span>
                  @else
                    <a href="{{ route('accountPanel.settings.send.verify.code') }}">Отправить код повторно</a>
                  @endif
                </div>
                <button class="btn btn-primary">Отправить</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
  </div>
  <style>
  </style>
@endsection

@push('scripts')
  <script>

  </script>
@endpush
