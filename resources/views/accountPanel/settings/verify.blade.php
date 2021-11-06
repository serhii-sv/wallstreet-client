@extends('layouts.accountPanel.app')
@section('title')
Verify documents
@endsection
@section('content')

  <div class="container-fluid">
    <div class="edit-profile">
      @if(!$user->documents_verified)
        <div class="row" style="margin-top:50px;">
          <div class="col-xl-12">
            <form class="card" method="post" action="{{ route('accountPanel.profile.upload-documents') }}" enctype="multipart/form-data">
              @include('partials.inform')
              @csrf
              <div class="row p-5">
                <div class="col-sm-6">
                  <div class="card">
                    <div class="card-header">
                      <h5>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Passport photo' contenteditable="true">{{ __('Passport photo') }}</editor_block> @else {{ __('Passport photo') }} @endif</h5>
                    </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-center">
                        <div class="btn btn-outline-primary ms-2" id="uploadPassportImage">
                          <i data-feather="upload"></i>
                          @if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Upload' contenteditable="true">{{ __('Upload') }}</editor_block> @else {{ __('Upload') }} @endif
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
                      <h5>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Selfie' contenteditable="true">{{ __('Selfie') }}</editor_block> @else {{ __('Selfie') }} @endif</h5>
                    </div>
                    <div class="card-body">
                      <div class="d-flex justify-content-center">
                        <div class="btn btn-outline-primary ms-2" id="uploadSelfie">
                          <i data-feather="upload"></i>
                          @if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Upload' contenteditable="true">{{ __('Upload') }}</editor_block> @else {{ __('Upload') }} @endif
                        </div>
                      </div>
                      <input type="file" class="hidden" name="selfie" id="selfie" accept="image/jpeg','image/gif','image/png','image/bmp','image/svg+xml">
                      <img class="preview mt-3 {{ is_null($user->lastVerificationRequest()) ? 'hidden' : '' }}" id="selfiePreview" src="{{ !is_null($user->lastVerificationRequest()) ? Storage::disk('do_spaces')->url($user->lastVerificationRequest()->selfie_image) : '' }}">
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-end">
                @if($user->verifiedDocuments()->where('accepted', false)->count())
                  @if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Application pending' contenteditable="true">{{ __('Application pending') }}</editor_block> @else {{ __('Application pending') }} @endif
                @else
                  <button class="btn btn-primary" type="submit" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif
                  >@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Save' contenteditable="true">{{ __('Save') }}</editor_block> @else {{ __('Save') }} @endif</button>
                @endif
              </div>
            </form>
          </div>
        </div>
      @else
        <div class="row">
          <div class="col">
            <div class="card bg-img">
              <div class="card-header">
                <div class="header-top">
                  <h5 class="m-0">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Documents confirmed' contenteditable="true">{{ __('Documents confirmed') }}</editor_block> @else {{ __('Documents confirmed') }} @endif</h5>
                </div>
              </div>
              <div class="card-body">
                <div class="body-bottom">
                  <h6>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Documents confirmed text 1' contenteditable="true">{{ __('Documents confirmed text 1') }}</editor_block> @else {{ __('Documents confirmed text 1') }} @endif</h6>
                  <span class="font-roboto">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Documents confirmed text 2' contenteditable="true">{{ __('Documents confirmed text 2') }}</editor_block> @else {{ __('Documents confirmed text 2') }} @endif</span>
                </div>
              </div>
            </div>
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
