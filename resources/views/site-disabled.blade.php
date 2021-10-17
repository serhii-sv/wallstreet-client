@extends('layouts.errors.master')
@section('title', 'Технические работы')

@section('content')
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- error-503 start-->
        <div class="error-wrapper">
            <div class="container"><img class="img-100" src="{{asset('theme/images/sad.png')}}" alt="">
                <div class="error-heading">
                    <h2 class="headline font-secondary" style="font-size: 150px">Технические работы</h2>
                </div>
                <div class="col-md-8 offset-md-2">
                    <p class="sub-content">
                        В данный момент времени на сайте ведутся технические работы и сайт будет недоступен некоторое время.
                        Приносим свои извинения. Это не займет много времени
                    </p>
                </div>
            </div>
        </div>
        <!-- error-503 end-->
    </div>
@endsection
