@extends('layouts.accountPanel.app')
@section('title')
  @if(canEditLang() && checkRequestOnEdit())
    <editor_block data-name='Verify phone page' contenteditable="true">{{ __('Verify phone page') }}</editor_block>
  @else
    {{ __('Verify phone page') }}
  @endif
@endsection
@section('content')
  
  <div class="container-fluid">
    <div class="edit-profile">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body pb-4 pt-4">
              <h4 class="card-title mb-4">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Verify phone' contenteditable="true">{{ __('Verify phone') }}</editor_block> @else {{ __('Verify phone') }} @endif
              </h4>
              <form action="{{ route('accountPanel.settings.update.phone') }}" method="post">
                @csrf
                <div class="mt-3 mb-3">@include('partials.inform')</div>
                <div class="mb-3">
                  <label class="form-label">Номер телефона:</label>
                  <input class="form-control input-air-primary" name="phone" value="{{ $user->phone ?? '' }}">
                </div>
                <button class="btn btn-primary">Сохранить</button>
              </form>
              <div class="mt-4">
                @if($user->phone_verified)
                  <div class="d-flex align-items-center mb-3">
                    Статус:
                    <i data-feather="check" class="" style="margin: 0 5px; color: #1eb000"></i>
                    Верифицирован
                  </div>
                @else
                  <div class="d-flex align-items-center mb-3">
                    Статус:
                    <i data-feather="x" style="margin: 0 5px;color: #c40033"></i>
                    Не верифицирован
                  </div>
                  <a href="{{ route('accountPanel.settings.send.verify.code') }}" class="btn btn-success @if(!$user->phone) disabled @endif">Верифицировать</a>
                  <div class="text-danger mt-2">@if(!$user->phone) Нужно указать телефон! @endif</div>
                @endif
              </div>
              @if($user->phone_verified)
              <div class="mt-4">
                <form action="{{ route('accountPanel.settings.auth.with.phone') }}" method="post">
                  @csrf
                  <div class="mb-3">Вход</div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="radio1" type="radio" name="auth_with_phone" value="0" @if($user->auth_with_phone == false) checked @endif>
                    <label class="form-check-label" for="radio1">Без кода на телефон</label>
                  </div>
                  <div class="form-check radio radio-primary">
                    <input class="form-check-input" id="radio2" type="radio" name="auth_with_phone" value="1" @if($user->auth_with_phone == true) checked @endif>
                    <label class="form-check-label" for="radio2">С кодом на телефон</label>
                  </div>
                  <button class="btn btn-success">Сохранить</button>
                </form>
              </div>
              @endif
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
