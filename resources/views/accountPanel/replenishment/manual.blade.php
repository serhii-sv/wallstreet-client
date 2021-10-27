@extends('layouts.accountPanel.app')
@section('title')
  @if(canEditLang() && checkRequestOnEdit())
    <editor_block data-name='Replenishment details page' contenteditable="true">{{ __('Replenishment details page') }}</editor_block>
  @else
    {{ __('Replenishment details page') }}
  @endif
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
            <div class="card-body">
              <p>
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Replenishment text 1' contenteditable="true">{{ __('Replenishment text 1') }}</editor_block> @else {{ __('Replenishment text 1') }} @endif
              </p>
              <h6>
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Replenishment head 1' contenteditable="true">{{ __('Replenishment head 1') }}</editor_block> @else {{ __('Replenishment head 1') }} @endif
              </h6>
              <p>
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Replenishment text 2' contenteditable="true">{{ __('Replenishment text 2') }}</editor_block> @else {{ __('Replenishment text 2') }} @endif
              </p>
              <p>
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Replenishment text 3' contenteditable="true">{{ __('Replenishment text 3') }}</editor_block> @else {{ __('Replenishment text 3') }} @endif
              </p>
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
