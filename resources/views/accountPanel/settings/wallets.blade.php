@extends('layouts.accountPanel.app')
@section('title', __('User wallets'))
@section('content')
  
  <div class="container-fluid">
    <div class="edit-profile">
      @if(!empty($wallets))
        <div class="row">
          <div class="col-sm-12 col-xl-12 ">
            <div class="card">
              <div class="card-header">
                <h5>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Payment system details' contenteditable="true">{{ __('Payment system details') }}</editor_block> @else {{ __('Payment system details') }} @endif</h5>
              </div>
              <div class="card-body">
                @include('partials.inform')
                <div class="row">
                  <div class="col-sm-3 tabs-responsive-side">
                    <div class="nav flex-column nav-pills border-tab nav-left" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                      @forelse($wallets as $wallet)
                        <a class="nav-link @if($loop->first) active @endif" id="v-pills-{{ $wallet->id }}-tab" data-bs-toggle="pill" href="#v-pills-{{ $wallet->id }}" role="tab" aria-controls="v-pills-{{ $wallet->id }}">{{ $wallet->currency->name }}</a>
                      @empty
                      @endforelse
                      {{--  <a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home">Home</a>
                        <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile">Profile</a>
                        <a class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages">Inbox</a>
                        <a class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings">Settings</a>--}}
                    </div>
                  </div>
                  <div class="col-sm-9">
                    <div class="tab-content" id="v-pills-tabContent">
                      @forelse($wallets as $wallet)
                        <div class="tab-pane fade @if($loop->first) active show @endif" id="v-pills-{{ $wallet->id }}" role="tabpanel" aria-labelledby="v-pills-{{ $wallet->id }}-tab">
                          @forelse($wallet->currency->paymentSystems()->get() as $payment)
                            <form action="{{ route('accountPanel.profile.wallet.details.update') }}" method="post" class="mb-3">
                              @csrf
                              <input type="hidden" name="payment_system_id" value="{{ $payment->id }}">
                              <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                              <input type="hidden" name="wallet_id" value="{{ $wallet->id }}">
                              <input type="hidden" name="currency_id" value="{{ $wallet->currency->id }}">
                              
                              <div class="row">
                                <div class="col">
                                  <div class="">
                                    <label class="form-label" for="{{ $payment->id }}">{{ $payment->name }}</label>
                                    <input class="form-control input-air-primary" id="{{ $payment->id }}" type="text" name="external" value="{{ $wallet->detail(auth()->user()->id, $payment->id)->first()->external ?? '' }}" placeholder="" data-bs-original-title="" title="">
                                  </div>
                                </div>
                                <div class="col align-self-end">
                                  <button class="btn btn-success">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Save' contenteditable="true">{{ __('Save') }}</editor_block> @else {{ __('Save') }} @endif</button>
                                </div>
                              </div>
                            </form>
                          @empty
                          @endforelse
                        </div>
                      
                      @empty
                      @endforelse
                      
                      {{--<div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                      </div>
                      <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                      </div>
                      <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>
                      </div>--}}
                    </div>
                  </div>
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