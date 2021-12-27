@extends('layouts.accountPanel.app')
@section('title')
Products
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('accountPanel/css/vendors/owlcarousel.css')}}">
@endpush
@section('content')

    <div class="container-fluid pt-5">
        <div>
            <div class="row product-page-main p-0">
                <div class="col-xl-4 xl-50 box-col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="product-slider owl-carousel owl-theme" id="sync1">
                                <div class="item">
                                    <img src="{{ $product->image ? \Illuminate\Support\Facades\Storage::disk('do_spaces')->url($product->image) : asset('images/product-default.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 xl-50 box-col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="product-page-details">
                                <h3>{!! $product->title !!}</h3>
                            </div>
                            <div class="product-price">${{ $product->price }}
{{--                                <del>$350.00 </del>--}}
                            </div>
{{--                            <ul class="product-color">--}}
{{--                                <li class="bg-primary"></li>--}}
{{--                                <li class="bg-secondary"></li>--}}
{{--                                <li class="bg-success"></li>--}}
{{--                                <li class="bg-info"></li>--}}
{{--                                <li class="bg-warning"></li>--}}
{{--                            </ul>--}}
                            <hr
                                {!! $product->description !!}
                            <hr>
                            <div class="m-t-15">
                                <a href="{{ route('accountPanel.products.buy', $product->slug) }}" class="btn btn-success m-r-10" type="button" title=""> <i class="fa fa-shopping-cart me-1"></i>Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{asset('accountPanel/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('accountPanel/js/owlcarousel/owl.carousel.js')}}"></script>
    <script src="{{asset('accountPanel/js/ecommerce.js')}}"></script>
@endpush
