@extends('layouts.accountPanel.app')
@section('title', __('Edit profile'))
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
                <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                      class="fe fe-x"></i></a>
              </div>
            </div>
            <div class="card-body pt-3">
              
              <div class="row mb-2">
                <div class="profile-title">
                  <div class="media">
                    <div class="user-image">
                      <form action="{{ route('accountPanel.profile.update.photo') }}"
                          enctype="multipart/form-data" method="post" class="text-center">
                        @csrf
                        <div class="avatar ">
                          <label class="position-relative" style="cursor: pointer;">
                            <input type="file" name="avatar"
                                class="profile-avatar-input d-none">
                            @if(auth()->user()->avatar)
                              <img class="avatar-image img-100 rounded-circle"
                                  style="height: 100px;" alt=""
                                  src="{{ route('accountPanel.profile.get.avatar', auth()->user()->id) }}"
                                  data-old="{{ route('accountPanel.profile.get.avatar', auth()->user()->id) }}">
                            @else
                              <img class="avatar-image img-100 rounded-circle"
                                  style="height: 100px;" alt=""
                                  src="{{ asset('accountPanel/images/user/user.png') }}"
                                  data-old="{{ asset('accountPanel/images/user/user.png') }}">
                            @endif
                          </label>
                        </div>
                        <button class="btn btn-pill btn-success btn-air-success btn-xs">
                          Загрузить
                        </button>
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
                <a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i
                      class="fe fe-x"></i></a>
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
                    <input class="form-control" type="text" name="login"
                        value="{{ $user->login ?? '' }}" placeholder="Username">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input class="form-control" type="text" name="email"
                        value="{{ $user->email ?? '' }}" placeholder="your-email@domain.com">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Имя</label>
                    <input class="form-control" type="text" name="name"
                        value="{{ $user->name ?? '' }}" placeholder="">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Телефон</label>
                    <input class="form-control" type="text" name="phone"
                        value="{{ $user->phone ?? '' }}">
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Пол</label>
                    <select class="form-control" name="sex" type="text">
                      <option value="">Не выбран</option>
                      <option value="мужской"
                          @if($user->sex == 'мужской') selected="selected" @endif>Мужской
                      </option>
                      <option value="женский"
                          @if($user->sex == 'женский') selected="selected" @endif>Женский
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Skype</label>
                    <input class="form-control" type="text" name="skype"
                        value="{{ $user->skype ?? '' }}">
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
      @if(!$user->documents_verified)
        <div class="row">
          <div class="col-xl-12">
            <form class="card" method="post" action="{{ route('accountPanel.profile.upload-documents') }}" enctype="multipart/form-data">
              @csrf
              <div class="row p-5">
                <div class="col-sm-6">
                  <div class="card">
                    <div class="card-header">
                      <h5>Фото паспорта</h5>
                    </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-center">
                        <div class="btn btn-outline-primary ms-2" id="uploadPassportImage">
                          <i data-feather="upload"></i>
                          Upload
                        </div>
                      </div>
                      <input type="file" class="hidden" name="passportImage" id="passportImage" accept="image/jpeg','image/gif','image/png','image/bmp','image/svg+xml">
                      <img class="preview mt-3 {{ is_null($user->lastVerificationRequest()) ? 'hidden' : '' }}" id="passportImagePreview" src="{{ !is_null($user->lastVerificationRequest()) ? Storage::disk('do_spaces')->url($user->lastVerificationRequest()->passport_image) : '' }}">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="card">
                    <div class="card-header">
                      <h5>Селфи</h5>
                    </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-center">
                        <div class="btn btn-outline-primary ms-2" id="uploadSelfie">
                          <i data-feather="upload"></i>
                          Upload
                        </div>
                      </div>
                      <input type="file" class="hidden" name="selfie" id="selfie" accept="image/jpeg','image/gif','image/png','image/bmp','image/svg+xml">
                      <img class="preview mt-3 {{ is_null($user->lastVerificationRequest()) ? 'hidden' : '' }}" id="selfiePreview" src="{{ !is_null($user->lastVerificationRequest()) ? Storage::disk('do_spaces')->url($user->lastVerificationRequest()->selfie_image) : '' }}">
                    </div>
                  </div>
                </div>
                <div class="col-sm-12 col-md-12">
                  <div class="">
                    <label class="form-label">Полное Имя</label>
                    <input class="form-control" type="text" name="full_name" value="{{ !is_null($user->lastVerificationRequest()) ? $user->lastVerificationRequest()->full_name : '' }}">
                  </div>
                </div>
              </div>
              <div class="card-footer text-end">
                @if($user->verifiedDocuments()->where('accepted', false)->count())
                  Заявка находится на рассмотрении
                @else
                  <button class="btn btn-primary" type="submit">Сохранить</button>
                @endif
              </div>
            </form>
          </div>
        </div>
      @endif
    </div>
  </div>
  <style>
      .media {
          align-items: flex-start !important;
      }

      .user-image {
          position: relative;
      }

      .hidden {
          display: none;
      }

      .preview {
          width: 100%;
          height: auto;
      }
  </style>
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('.avatar-image').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        } else {
          $('.avatar-image').attr('src', $('.avatar-image').attr('data-old'));
        }
      }
      
      $(".profile-avatar-input").change(function () {
        readURL(this);
      });
      
      $('#uploadPassportImage').click(function () {
        document.getElementById('passportImage').click()
      })
      
      $('#selfie').change(function () {
        let input = this;
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#selfiePreview').attr('src', e.target.result).removeClass('hidden');
          }
          reader.readAsDataURL(input.files[0]);
        }
      })
      
      $('#uploadSelfie').click(function () {
        document.getElementById('selfie').click()
      })
      
      $('#passportImage').change(function () {
        let input = this;
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#passportImagePreview').attr('src', e.target.result).removeClass('hidden');
          }
          reader.readAsDataURL(input.files[0]);
        }
      })
    });
  </script>
@endpush
