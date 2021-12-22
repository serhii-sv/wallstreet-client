@extends('layouts.accountPanel.app')
@section('title')
Магазин
@endsection

@section('content')
  <div class="container-fluid" style="margin-top: 200px;">
    <h1 class="text-center">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='До старта NFT маркетплейса' contenteditable="true">{{ __('До старта NFT маркетплейса') }}</editor_block> @else {{ __('До старта NFT маркетплейса') }} @endif</h1>
    <div class="text-center mb-3" style="font-size: 32px;">
      @if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Осталось' contenteditable="true">{{ __('Осталось') }}</editor_block> @else {{ __('Осталось') }} @endif: <strong>{{ $diff_from_now_days }}</strong> @if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='дней' contenteditable="true">{{ __('дней') }}</editor_block> @else {{ __('дней') }} @endif
    </div>
    <div class="text-center" style="font-size: 42px;" data-timer="{{ date('M d, Y H:i:s', $timestamp) }}"><strong>{{ $diff_from_now_time }}</strong></div>

  </div>
@endsection

@section('script')
@endsection
