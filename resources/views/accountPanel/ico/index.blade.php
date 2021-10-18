@extends('layouts.accountPanel.app')

@section('css')

@endsection

@section('style')
@endsection

@section('title', __('Ico'))

@section('content')
  <div class="container-fluid">
    <h1 class="text-center">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Coming soon' contenteditable="true">{{ __('Coming soon') }}</editor_block> @else {{ __('Coming soon') }} @endif</h1>
    <div class="text-center mb-3" style="font-size: 32px;">
      @if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Left' contenteditable="true">{{ __('Left') }}</editor_block> @else {{ __('Left') }} @endif: <strong>{{ $diff_from_now_days }}</strong> @if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Days' contenteditable="true">{{ __('Days') }}</editor_block> @else {{ __('Days') }} @endif
    </div>
    <div class="text-center" style="font-size: 42px;" data-timer="{{ date('M d, Y H:i:s', $timestamp) }}"><strong>{{ $diff_from_now_time }}</strong></div>

  </div>
@endsection

@section('script')
@endsection
