{{--@extends('layouts.customer')--}}
{{--@section('content')--}}
{{--    @include('partials.loader')--}}
    <main role="main">
        <section class="intro">
            <div class="container">
                <div class="intro__content mt--85 text-center w-100">
                    <h1 class="intro__title">
                        Поздравляем с успешной регистрацией
                    </h1>
                    <p class="text-center">Ваш email: {{ $user->email }}</p>
                    <br>
                    <p class="text-center">Ваш пароль: {{ $user->unhashed_password }}</p>
                    <br>
                    <a href="{{ config('app.url') }}">{{ config('app.url') }}</a>
                </div>
            </div>
        </section>
    </main>
{{--@endsection--}}
