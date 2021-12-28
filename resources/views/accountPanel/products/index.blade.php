@extends('layouts.accountPanel.app')
@section('title')
Products
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('accountPanel/css/vendors/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('accountPanel/css/vendors/owlcarousel.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('accountPanel/css/vendors/rating.css')}}">
@endpush
@section('content')

    <div class="container-fluid product-wrapper pt-4">
        <div class="product-grid">
            <div class="d-flex justify-content-end">
                <a href="{{ route('accountPanel.user-products.index') }}" class="btn btn-pill btn-light mb-3 float-right">
                    @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Мои покупки' contenteditable="true">{{ __('Мои покупки') }}</editor_block>
                    @else
                        {{ __('Мои покупки') }}
                    @endif
                </a>
            </div>
                <div class="feature-products">
                    <form action="{{ route('accountPanel.products.index') }}" method="get">
                        <div class="row">
                            <div class="col-md-6 products-total">

                            </div>
                            <div class="col-md-6 text-end">
                        <span class="f-w-600 m-r-5">
                            @if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Показаны продукты'
                                              contenteditable="true">{{ __('Показаны продукты') }}</editor_block>
                            @else
                                {{ __('Показаны продукты') }}
                            @endif
                            {{ $products->firstItem() }} - {{ $products->lastItem() }}
                            @if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='из' contenteditable="true">{{ __('из') }}</editor_block>
                            @else
                                {{ __('из') }}
                            @endif
                            {{  $products->total() }}
                        </span>
                                <div class="select2-drpdwn-product select-options d-inline-block">
                                    <select class="form-control btn-square" name="sort" id="filter">
                                        <option selected disabled value="opt1">Фильтр</option>
                                        <option
                                            {{ request()->sort == 'price_lowest_first' ? 'selected' : '' }} value="price_lowest_first">
                                            От дешевых к дорогим
                                        </option>
                                        <option
                                            {{ request()->sort == 'price_highest_first' ? 'selected' : '' }} value="price_highest_first">
                                            От дорогих к дешевым
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="product-sidebar mt-1">
                                <div class="filter-section">
                                    <div class="col-md-6 products-total">
                                        <div class="square-product-setting d-inline-block">
                                            <a class="icon-grid grid-layout-view" href="#" data-original-title="" title="">
                                                <i data-feather="grid"></i>
                                            </a>
                                        </div>
                                        <div class="square-product-setting d-inline-block">
                                            <a class="icon-grid m-0 list-layout-view" href="#" data-original-title="" title="">
                                                <i data-feather="list"></i>
                                            </a>
                                        </div>
                                        <span class="d-none-productlist filter-toggle">
                            Filters
                            <span class="ms-2">
                                <i class="toggle-data" data-feather="chevron-down"></i>
                            </span>
                        </span>
                                        <div class="grid-options d-inline-block">
                                            <ul>
                                                <li>
                                                    <a class="product-2-layout-view" href="#" data-original-title="" title="">
                                                        <span class="line-grid line-grid-1 bg-primary"></span>
                                                        <span class="line-grid line-grid-2 bg-primary"></span>
                                                    </a>
                                                </li>
                                                <li><a class="product-3-layout-view" href="#" data-original-title=""
                                                       title=""><span class="line-grid line-grid-3 bg-primary"></span><span
                                                            class="line-grid line-grid-4 bg-primary"></span><span
                                                            class="line-grid line-grid-5 bg-primary"></span></a></li>
                                                <li><a class="product-4-layout-view" href="#" data-original-title=""
                                                       title=""><span class="line-grid line-grid-6 bg-primary"></span><span
                                                            class="line-grid line-grid-7 bg-primary"></span><span
                                                            class="line-grid line-grid-8 bg-primary"></span><span
                                                            class="line-grid line-grid-9 bg-primary"></span></a></li>
                                                <li><a class="product-6-layout-view" href="#" data-original-title=""
                                                       title=""><span class="line-grid line-grid-10 bg-primary"></span><span
                                                            class="line-grid line-grid-11 bg-primary"></span><span
                                                            class="line-grid line-grid-12 bg-primary"></span><span
                                                            class="line-grid line-grid-13 bg-primary"></span><span
                                                            class="line-grid line-grid-14 bg-primary"></span><span
                                                            class="line-grid line-grid-15 bg-primary"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-sm-12">
                            <form action="{{ route('accountPanel.products.index') }}" method="get">
                                <div class="form-group m-0">
                                    <input class="form-control" type="search" placeholder="Поиск.." name="title" value="{{ request()->title }}">
                                    <i class="fa fa-search"></i>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <div class="product-wrapper-grid">
                <div class="row">
                    @forelse($products as $product)
                    <div class="col-xl-3 col-sm-6 xl-4">
                        <div class="card">
                            <div class="product-box">
                                <div class="product-img">
                                    <img class="img-fluid" src="{{ $product->image ? \Illuminate\Support\Facades\Storage::disk('do_spaces')->url($product->image) : asset('images/product-default.png') }}" alt="">
                                    <div class="product-hover">
                                        <ul>
                                            <li>
                                                <a href="{{ route('accountPanel.products.buy', $product->slug) }}" class="btn" type="button"><i class="icon-shopping-cart"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-details">
{{--                                    <div class="rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></div>--}}
                                    <a href="{{ route('accountPanel.products.show', $product->slug) }}">
                                        <h4>{!! $product->title !!}</h4>
                                    </a>
                                    <p>{!! $product->short_description !!}</p>
                                    <div class="product-price">${{ $product->price }}
{{--                                        <del>$350.00    </del>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="d-flex justify-content-center align-items-center">
                             <span>
                                 @if(canEditLang() && checkRequestOnEdit())
                                     <editor_block data-name='Продуктов нет' contenteditable="true">{{ __('Продуктов нет') }}</editor_block>
                                 @else
                                     {{ __('Продуктов нет') }}
                                 @endif
                            </span>
                        </div>
                    @endforelse
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{asset('accountPanel/js/range-slider/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('accountPanel/js/range-slider/rangeslider-script.js')}}"></script>
    <script src="{{asset('accountPanel/js/owlcarousel/owl.carousel.js')}}"></script>
    <script src="{{asset('accountPanel/js/product-tab.js')}}"></script>

    <script>
        $(function () {
            $('#filter, .fa.fa-search').change(function () {
                $(this).closest('form').submit();
            })
            $('.fa.fa-search').click(function () {
                $(this).closest('form').submit();
            })
        })
    </script>
@endpush
