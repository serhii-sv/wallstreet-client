@extends('layouts.accountPanel.app')
@section('title', __('Dashboard'))
@section('content')
  
  <div class="container-fluid">
    <div class="edit-profile">
      <div class="row">
        <div class="col-xl-4">
          <div class="card">
            <div class="card-header pb-3 pt-3">
              <h4 class="card-title mb-0">My Profile</h4>
              <div class="card-options">
                <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse">
                  <i class="fe fe-chevron-up"></i>
                </a>
                <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
              </div>
            </div>
            <div class="card-body pt-3">
              
              <div class="row mb-2">
                <div class="profile-title">
                  <div class="media">
                    <div class="user-image">
                      <form action="{{ route('accountPanel.profile.update.photo') }}" enctype="multipart/form-data" method="post" class="text-center">
                        @csrf
                        <div class="avatar ">
                          <label class="position-relative" style="cursor: pointer;">
                            <input type="file" name="avatar" class="profile-avatar-input d-none">
                            <img class="avatar-image img-100 rounded-circle" style="height: 100px;" alt="" src="{{ auth()->user()->avatar ? route('accountPanel.profile.get.avatar', auth()->user()->id) : asset('accountPanel/images/user/16.png') }}" data-old="{{ route('accountPanel.profile.get.avatar', auth()->user()->id) }}">
                          </label>
                        </div>
                        <button class="btn btn-pill btn-success btn-air-success btn-xs">Загрузить</button>
                      </form>
                    </div>
                  </div>
                  <div class="media-body">
                    <p>{{ __('Investor') }}</p>
                    <h5 class="mb-1">{{ $user->name ?? '' }}</h5>
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label class="form-label">Email</label>
                <p><strong>{{ $user->email ?? 'Не указан' }}</strong></p>
              </div>
              <div class="mb-3">
                <label class="form-label">Телефон</label>
                <p><strong>{{ $user->phone ?? 'Не указан' }}</strong></p>
              </div>
              <div class="mb-3">
                <label class="form-label">Skype</label>
                <p><strong>{{ $user->skype ?? 'Не указан' }}</strong></p>
              </div>
              <div class="mb-3">
                <label class="form-label">Пол</label>
                <p><strong>{{ $user->sex ?? 'Не указан' }}</strong></p>
              </div>
              <div class="mb-3">
                <label class="form-label">Страна</label>
                <p><strong>{{ $user->country ?? 'Не указана' }}</strong></p>
              </div>
              <div class="mb-3">
                <label class="form-label">Город</label>
                <p><strong>{{ $user->city ?? 'Не указан' }}</strong></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8">
          <form class="card" method="post" action="{{ route('accountPanel.profile.update') }}">
            @csrf
            {{ method_field('PUT') }}
            <div class="card-header">
              <h4 class="card-title mb-0">Редактирование профиля</h4>
              <div class="card-options">
                <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse">
                  <i class="fe fe-chevron-up"></i></a>
                <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12 mb-3">
                  @include('partials.inform')
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Логин</label>
                    <input class="form-control" type="text" name="login" value="{{ $user->login ?? '' }}" placeholder="Username">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control" type="text" name="email" value="{{ $user->email ?? '' }}" placeholder="your-email@domain.com">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Имя</label>
                    <input class="form-control" type="text" name="name" value="{{ $user->name ?? '' }}" placeholder="">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Телефон</label>
                    <input class="form-control" type="text" name="phone" value="{{ $user->phone ?? '' }}">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Пол</label>
                    <select class="form-control" name="sex" type="text">
                      <option value="">Не выбран</option>
                      <option value="мужской" @if($user->sex == 'мужской') selected="selected" @endif>Мужской</option>
                      <option value="женский" @if($user->sex == 'женский') selected="selected" @endif>Женский</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Skype</label>
                    <input class="form-control" type="text" name="skype" value="{{ $user->skype ?? '' }}">
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer text-end">
              <button class="btn btn-primary" type="submit">Сохранить</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <style>
      .media {
          align-items: flex-start !important;
      }

      .user-image {
          position: relative;
      }
  </style>
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
    
      
  
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            $('.avatar-image').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        } else {
          $('.avatar-image').attr('src', $('.avatar-image').attr('data-old'));
        }
      }
  
      $(".profile-avatar-input").change(function() {
        readURL(this);
      });
      
    });
  </script>
@endpush