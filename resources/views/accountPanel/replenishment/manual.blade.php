@extends('layouts.accountPanel.app')
@section('title')
Topup balance details
@endsection
@section('content')

  <div class="container-fluid">
    <div class="row second-chart-list third-news-update" style="margin-top:50px;">

      <div class="row" style="margin-top: 50px;">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5 style="text-transform:none;">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Replenishment details' contenteditable="true">{{ __('Replenishment details') }}</editor_block> @else {{ __('Replenishment details') }} @endif {{ $paymentSystem !== null ? $paymentSystem->name : '' }}</h5>
            </div>

@if(session('language') == 'ru')
<div style="width:80%; margin-left:10%;">
  <iframe style="margin:0px 0 20px 0; width:100%;" height="450" src="https://www.youtube.com/embed/7yjpnmEebj4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
@endif

            <div class="card-body" style="text-align: left; margin-left:10%;">
                <p style="font-size:21px !important;">
                    @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Replenishment text 1' contenteditable="true">{{ __('Replenishment text 1') }}</editor_block> @else {{ __('Replenishment text 1') }} @endif
                </p>

                <p style="font-size:21px !important;">
                    @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Replenishment text 2' contenteditable="true">{{ __('Replenishment text 2') }}</editor_block> @else {{ __('Replenishment text 2') }} @endif
                </p>

                <p style="font-size:21px !important;">
                    @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Replenishment text 3' contenteditable="true">{{ __('Replenishment text 3') }}</editor_block> @else {{ __('Replenishment text 3') }} @endif
                </p>

                <p style="font-size:21px !important;">
                    @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Replenishment text 4' contenteditable="true">{{ __('Replenishment text 4') }}</editor_block> @else {{ __('Replenishment text 4') }} @endif
                </p>

                <p style="font-size:21px !important;">
                    @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Replenishment text 5' contenteditable="true">{{ __('Replenishment text 5') }}</editor_block> @else {{ __('Replenishment text 5') }} @endif
                </p>

                <p style="font-size:21px !important;">
                    @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Replenishment text 6' contenteditable="true">{{ __('Replenishment text 6') }}</editor_block> @else {{ __('Replenishment text 6') }} @endif
                </p>
            </div>

              <div class="f1-buttons" style="text-align: center;margin-top:50px;margin-bottom: 50px;">
                  <button class="btn btn-primary btn-previous" type="button" onClick="location.assign('https://t.me/sprintbank')"  style="padding:15px 50px 15px 50px; font-size:21px;">@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='Previous 2' contenteditable="true">{{ __('Previous 2') }}</editor_block> @else {{ __('Previous 2') }} @endif
                  </button>
                  @if($paymentSystem->code == 'visa_mastercard' || $paymentSystem->code == 'sberbank' || $paymentSystem->code == 'alfabank' || $paymentSystem->code == 'tinkoff' || $paymentSystem->code == 'vtb' || $paymentSystem->code == 'qiwi' || $paymentSystem->code == 'yoomoney')
                  <button class="btn btn-primary btn-submit" id="pay" onClick="location.assign('{{ route('accountPanel.replenishment') }}?freekassa=true')" type="button" data-bs-original-title="" title=""  style="margin-left:30px;padding:15px 50px 15px 50px; font-size:21px;">@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='vnesti auto' contenteditable="true">{{ __('vnesti auto') }}</editor_block> @else {{ __('vnesti auto') }} @endif
                  </button>
                  <br><br>
                  @endif
                  <button class="btn btn-primary btn-submit shake" id="next" onClick="location.assign('https://jivo.chat/xQE8U0bisX')" type="submit" data-bs-original-title="" title=""  style="margin-left:30px;padding:15px 50px 15px 50px; font-size:21px;">@if(canEditLang() && checkRequestOnEdit())
                          <editor_block data-name='vnesti 2' contenteditable="true">{{ __('vnesti 2') }}</editor_block> @else {{ __('vnesti 2') }} @endif
                  </button>
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
