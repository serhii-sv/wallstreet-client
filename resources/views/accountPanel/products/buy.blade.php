@extends('layouts.accountPanel.app')
@section('title')
Products
@endsection
@push('styles')
    <style>
        .order-box .sub-total li .count {
            width: unset !important;
        }
    </style>
@endpush
@section('content')

    <div class="container-fluid checkout">
        <div class="card">
            <div class="card-header">
                <h5>
                    @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Детали покупки' contenteditable="true">{{ __('Детали покупки') }}</editor_block>
                    @else
                        {{ __('Детали покупки') }}
                    @endif
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-8 col-sm-12">
                        <div class="checkout-details">
                            <form action="{{ route('accountPanel.products.pay', $product) }}" method="post">
                                @csrf
                                <div class="order-box">
                                    <div class="title-box">
                                        <div class="checkbox-title">
                                            <h4>
                                                @if(canEditLang() && checkRequestOnEdit())
                                                    <editor_block data-name='Продукт' contenteditable="true">{{ __('Продукт') }}</editor_block>
                                                @else
                                                    {{ __('Продукт') }}
                                                @endif
                                            </h4>
                                            <span>
                                             @if(canEditLang() && checkRequestOnEdit())
                                                    <editor_block data-name='Сумма' contenteditable="true">{{ __('Сумма') }}</editor_block>
                                                @else
                                                    {{ __('Сумма') }}
                                                @endif
                                        </span>
                                        </div>
                                    </div>
                                    <ul class="qty">
                                        <li>{!! $product->title !!} <span>${{ $product->price }}</span></li>
                                    </ul>
                                    <ul class="sub-total total">
                                        <li>
                                            @if(canEditLang() && checkRequestOnEdit())
                                                <editor_block data-name='Валюта' contenteditable="true">{{ __('Валюта') }}</editor_block>
                                            @else
                                                {{ __('Валюта') }}
                                            @endif
                                            <span class="count">
                                                <select name="currency_id" class="form-select digits">
                                                    <option selected disabled value="">Выберите валюту для оплаты</option>
                                                    @foreach(\App\Models\Currency::all() as $currency)
                                                        <option value="{{ $currency->id }}">{{ $currency->name }}</option>
                                                    @endforeach
                                                </select>
                                            </span>
                                        </li>
                                    </ul>
                                    @include('partials.inform')
                                    <div class="order-place">
                                        <button class="btn btn-primary">
                                            Place Order
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
