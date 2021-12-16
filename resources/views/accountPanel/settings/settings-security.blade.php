@extends('layouts.accountPanel.app')
@section('title')
Security settings
@endsection
@section('content')
    <div class="container-fluid" style="margin-top:50px;">
        <div class="edit-profile">
            <div class="row">
                <div class="col-xl-12" style="margin-top:50px;">
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
                                    <input class="form-control input-air-primary" id="phone" name="phone" value="{{ $user->phone ?? '' }}">
                                </div>
                                <button class="btn btn-primary">Сохранить</button>
                            </form>
                            @if($verification_enable == 'on')
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
                            @else
                                <div class="mt-3">Верификация отключена</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

  <div class="container-fluid">
    <div class="edit-profile">
      <div class="row" style="margin-top:50px;">
        <div class="col-xl-4">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title mb-0">Общие</h4>
              <div class="card-options">
                <a class="card-options-collapse" href="#"
                    data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a
                    class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                      class="fe fe-x"></i></a>
              </div>
            </div>
            <div class="card-body">
              {{--<div class="mb-3">
                  <div class="row">
                      <label class="form-label">E-mail</label>
                      <div class="col-md-8">
                          <input class="form-control" placeholder="http://Uplor .com">
                      </div>
                      <div class="col-md-4">
                          <button class="form-control btn btn-square btn-light active txt-dark"
                                  type="button" title=""
                                  data-bs-original-title="btn btn-square btn-light active"
                                  data-original-title="btn btn-square btn-success active">Выслать
                              подтверждение
                          </button>
                      </div>
                  </div>
              </div>--}}
              <div class="form-check checkbox checkbox-success mb-0">
                <input class="form-check-input" type="checkbox" name="ffa_field"
                    data-bs-original-title="" title="" id="ffa_field" @if($fa_field) checked="checked" @endif>
                <label class="form-check-label" for="ffa_field">исползовать двух-факторную
                  аутентификацию</label>
              </div>
              <div class="form-footer">
                <button class="btn btn-primary btn-block" id="ffa_save">Применить изменения</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card">
            <div class="card-header pb-2">
              <h4 class="card-title mb-0">Пароль</h4>
              <div class="card-options">
                <a class="card-options-collapse" href="#"
                    data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                <a
                    class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                      class="fe fe-x"></i></a>
              </div>
            </div>
            <div class="card-body pt-2">
              <div class="mb-3">
                <label class="form-label">Введите старый пароль</label>
                <input class="form-control" id="password_old_field" type="password" name="password_old">
              </div>
              <div class="mb-3">
                <label class="form-label">Введите новый пароль</label>
                <input class="form-control" id="password_field" type="password" name="password">
              </div>
              <div class="form-footer">
                <button class="btn btn-primary btn-block" id="password_save">Сменить пароль</button>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <!-- Cod Box Copy begin -->
            <div class="card">
              <div class="card-header card-no-border">
                <h5>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Login history' contenteditable="true">{{ __('Login history') }}</editor_block> @else {{ __('Login history') }} @endif</h5>
              </div>
              <div class="card-body new-update pt-0">
                <div class="activity-timeline">
                  @forelse($auth_log as $item)
                    <div class="media">
                      <div class="activity-line"></div>
                      <div class="activity-dot-secondary"></div>
                      <div class="media-body">
                        <span class="badge rounded-pill pill-badge-info">ip: {{ $item->ip }}</span>
                        <p class="font-roboto">{{ $item->created_at->format('H:i:s d.F.Y') }}</p>
                      </div>
                    </div>
                  @empty
                  @endforelse
                  {{--   <div class="media">
                       <div class="activity-dot-primary"></div>
                       <div class="media-body">
                         <span>You liked James products</span>
                         <p class="font-roboto">Aenean sit amet magna vel magna fringilla ferme.</p>
                       </div>
                     </div>--}}
                </div>
              </div>
            </div>
            <!-- Cod Box Copy end -->
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script>
    $(document).ready(() => {
        $('#phone').mask('+000000000000');
      $("#password_save").click((e) => {
        e.preventDefault();

        $.ajax({
          url: "{{route('accountPanel.settings.setPassword')}}",
          type: 'post',
          data: [
            '#password_old_field',
            '#password_field'
          ]
          .map((val) => $(val).attr('name') + "=" + $(val).val())
          .reduce((accum, next) => accum + "&" + next),
          success: (response) => {
            var $data = $.parseJSON(response);
            if ($data['status'] == 'good') {
              $.notify('<i class="fa fa-bell-o"></i><strong>Данные обновлены!</strong> ' + $data['msg'], {
                type: 'theme',
                allow_dismiss: true,
                delay: 3000,
                showProgressbar: true,
                timer: 300,
                animate: {
                  enter: 'animated fadeInDown',
                  exit: 'animated fadeOutUp'
                }
              });

              $('#password_field').val('');
              $('#password_old_field').val('');
            } else {
              $.notify('<i class="fa fa-bell-o"></i><strong>Ошибка!</strong> ' + $data['msg'], {
                type: 'theme',
                allow_dismiss: true,
                delay: 3000,
                showProgressbar: true,
                timer: 300,
                animate: {
                  enter: 'animated fadeInDown',
                  exit: 'animated fadeOutUp'
                }
              });
            }
          },
        })
      });

      $("#ffa_save").click((e) => {
        e.preventDefault();

        $.ajax({
          url: "{{route('accountPanel.settings.set2FA')}}",
          type: 'post',
          data: 'ffa_field=' + $('#ffa_field').is(':checked'),
          success: (response) => {
            console.log(response);

            if (response.result === 'redirect')
              window.location.replace(response.to);

            $.notify('<i class="fa fa-bell-o"></i><strong>Данные обновлены</strong> 2FA был изменен', {
              type: 'theme',
              allow_dismiss: true,
              delay: 2000,
              showProgressbar: true,
              timer: 300,
              animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
              }
            });
          }
        })
      })
    });
  </script>
@endpush
