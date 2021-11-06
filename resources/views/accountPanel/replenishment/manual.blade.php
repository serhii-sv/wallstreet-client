@extends('layouts.accountPanel.app')
@section('title')
Topup balance details
@endsection
@section('content')

  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">

      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Replenishment details' contenteditable="true">{{ __('Replenishment details') }}</editor_block> @else {{ __('Replenishment details') }} @endif {{ $paymentSystem !== null ? $paymentSystem->name : '' }}</h5>
            </div>
            <div class="card-body" style="text-align: center; font-size:21px;">
              <p>
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Replenishment text 1' contenteditable="true">{{ __('Replenishment text 1') }}</editor_block> @else {{ __('Replenishment text 1') }} @endif
              </p>
              <h6>
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Replenishment head 1' contenteditable="true">{{ __('Replenishment head 1') }}</editor_block> @else {{ __('Replenishment head 1') }} @endif
              </h6>

                <div class="f1-buttons" style="text-align: center;margin-top:50px;">
                    <button class="btn btn-primary btn-previous" type="button" onClick="location.assign('https://t.me/sprintbank')"  style="padding:15px 50px 15px 50px; font-size:21px;">@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Previous 2' contenteditable="true">{{ __('Previous 2') }}</editor_block> @else {{ __('Previous 2') }} @endif
                    </button>
                    <button class="btn btn-primary btn-submit shake" id="next" onClick="location.assign('https://jivo.chat/xQE8U0bisX')" type="submit" data-bs-original-title="" title=""  style="margin-left:30px;padding:15px 50px 15px 50px; font-size:21px;">@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='vnesti 2' contenteditable="true">{{ __('vnesti 2') }}</editor_block> @else {{ __('vnesti 2') }} @endif
                    </button>
                </div>
            </div>
          </div>
        </div>

      </div>


    </div>
  </div>
@endsection
@push('scripts')
  <script src="{{ asset('accountPanel/js/form-wizard/form-wizard-three.js') }}"></script>
  <script>
    $(document).ready(function () {

    });
  </script>
@endpush
