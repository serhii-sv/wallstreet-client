@extends('layouts.accountPanel.app')
@section('title')
Products
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('accountPanel/css/vendors/datatables.css')}}">
@endpush
@section('content')

    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            @if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Мои покупки' contenteditable="true">{{ __('Мои покупки') }}</editor_block>
                            @else
                                {{ __('Мои покупки') }}
                            @endif
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @forelse($products as $product)
                            <div class="col-xl-4 col-md-6">
                                <div class="prooduct-details-box">
                                    <div class="media">
                                        <img class="align-self-center img-fluid img-60" src="{{ $product->image ? \Illuminate\Support\Facades\Storage::disk('do_spaces')->url($product->image) : asset('images/product-default.png') }}" alt="#">
                                        <div class="media-body ms-3">
                                            <div class="product-name">
                                                <h6><a href="#">{!! $product->title !!}</a></h6>
                                            </div>
                                            <div class="price d-flex">
                                                <div class="text-muted me-2">Price</div>
                                                : {{ $product->price }}$
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty

                            @endforelse
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="{{asset('accountPanel/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('accountPanel/js/datatable/datatables/datatable.custom.js')}}"></script>
@endpush
