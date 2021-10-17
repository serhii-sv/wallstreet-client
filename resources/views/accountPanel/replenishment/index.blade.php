@extends('layouts.accountPanel.app')
@section('title', __('Replenishment'))
@section('content')
  
  <div class="container-fluid">
    <div class="row second-chart-list third-news-update">
      
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Application for replenishment' contenteditable="true">{{ __('Application for replenishment') }}</editor_block> @else {{ __('Application for replenishment') }} @endif</h5>
            </div>
            <div class="card-body">
              <form class="f1" method="post" action="{{ route('accountPanel.replenishment.new.request') }}">
                @csrf
                <div class="f1-steps">
                  <div class="f1-progress">
                    <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3" style="width: 16.66000000000001%;"></div>
                  </div>
                  <div class="f1-step active">
                    <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                    <p>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Payment system' contenteditable="true">{{ __('Payment system') }}</editor_block> @else {{ __('Payment system') }} @endif</p>
                  </div>
                  <div class="f1-step">
                    <div class="f1-step-icon"><i class="fa fa-key"></i></div>
                    <p>@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Currency' contenteditable="true">{{ __('Currency') }}</editor_block> @else {{ __('Currency') }} @endif</p>
                  </div>
                </div>
                <fieldset style="display: block;">
                  <div class="mb-3">
                    <label class="form-label" for="exampleFormControlSelect9">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Payment system' contenteditable="true">{{ __('Payment system') }}</editor_block> @else {{ __('Payment system') }} @endif</label>
                    <select class="form-select digits" name="payment_system" id="exampleFormControlSelect9">
                      @forelse($payment_systems as $item)
                        <option value="{{ $item->id }}" >{{ $item->name }}</option>
                      @empty
                        <option value="" disabled>Нет платёжных систем</option>
                      @endforelse
                    </select>
                  </div>
                  <div class="f1-buttons">
                    <button class="btn btn-primary btn-next" type="button" data-bs-original-title="" title="">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Next' contenteditable="true">{{ __('Next') }}</editor_block> @else {{ __('Next') }} @endif</button>
                  </div>
                </fieldset>
                <fieldset style="display: none;">
                  <div class="mb-3">
                    <label class="form-label" for="exampleFormControlSelect10">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Currency' contenteditable="true">{{ __('Currency') }}</editor_block> @else {{ __('Currency') }} @endif</label>
                    <select class="form-select digits" name="currency" id="exampleFormControlSelect10">
                      @forelse($currencies as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                      @empty
                        <option value="" disabled>Нет валют</option>
                      @endforelse
                    </select>
                  </div>
                  
                  <div class="f1-buttons">
                    <button class="btn btn-primary btn-previous" type="button" data-bs-original-title="" title="">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Previous' contenteditable="true">{{ __('Previous') }}</editor_block> @else {{ __('Previous') }} @endif</button>
                    <button class="btn btn-primary btn-submit" type="submit" data-bs-original-title="" title="">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Submit' contenteditable="true">{{ __('Submit') }}</editor_block> @else {{ __('Submit') }} @endif</button>
                  </div>
                </fieldset>
              </form>
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
