@extends('layouts.customer')
@section('title', __('Payout'))
@section('content')
    <main role="main" style="background: white">
        <div class="page">
            <svg class="before-svg" viewBox="0 0 1950 65.242325" height="65.242325" width="1950">
                <path d="M 975,65.242324 H 0 V 35.889669 6.53701 L 21.25,5.88359 42.5,5.23016 88.000004,4.21053 133.5,3.19089 184,2.14419 234.5,1.09749 430.5,0.54874 626.5,0 l 85,1.14503 85,1.14503 46.5,0.96431 46.5,0.96431 41,1.0362 41,1.0362 49.5,1.48571 49.5,1.48571 42,1.50324 42,1.50325 48.5,1.99247 48.5,1.99247 43,2.013562 43,2.013565 38.5,2.004288 38.5,2.004288 43.5,2.486247 43.5,2.486246 47.5,3.01284 47.5,3.01284 36,2.496047 36,2.496046 13,0.97181 13,0.97181 40,3.03931 40,3.039311 48,3.987707 48,3.987708 38.4368,3.482384 38.4368,3.482385 h 1.3132 1.3132 v 1 1 z"></path>
            </svg>
            @include('partials.breadcrumbs')
            <div class="container">
                <h2 class="page-title page-title--line">ПОЛУЧИТЕ Ваши <span>Деньги</span>
                </h2>
                <div class="text">
                    <p><strong>Вы можете произвести частичное или полное снятие средств со своего баланса. Эти операции могут проводиться в любое время.</strong></p>
                    <p>This is the case with the cryptocurrencies trading. Luminex MISSION is to provide an accessible, transparent and secure tool for automated trading in high-volatile cryptocurrency markets, to improve each participant's the welfare without the need for deep immersion in the cryptocurrencies, blockchain and neural networks fields. Machines have replaced people in many life spheres. This is the case with the cryptocurrencies trading. Luminex MISSION is to provide an accessible, transparent and secure tool for automated trading in high-volatile cryptocurrency markets, to improve each participant's the welfare without the need for deep immersion in the cryptocurrencies, blockchain and neural networks fields.  Machines have replaced people in many life spheres. </p>
                </div>
            </div>
            <section class="partners">
                <div class="container">
                    <ul class="partners__list">
                        <li class="partners__item"><a class="partners__link" href="#" target="_blank"><img src="/img/partners/bitcoin.png" alt=""></a>
                        </li>
                        {{--<li class="partners__item"><a class="partners__link" href="#" target="_blank"><img src="/img/partners/bitcoin-cash.png" alt=""></a></li>--}}
                        <li class="partners__item"><a class="partners__link" href="#" target="_blank"><img src="/img/partners/ethereum.png" alt=""></a>
                        </li>
                        <li class="partners__item"><a class="partners__link" href="#" target="_blank" style="margin-top:15px"><img src="/img/partners/perfect-money.png" alt=""></a>
                        </li>
                        <li class="partners__item"><a class="partners__link" href="#" target="_blank"><img src="/img/partners/payeer.png" alt=""></a>
                        </li>
                        {{--<li class="partners__item"><a class="partners__link" href="#" target="_blank" style="margin-top:-13px"><img src="/img/partners/advcash.png" alt=""></a></li>--}}
                    </ul>
                </div>
            </section>
            <div class="container">
                <div class="text">
                    <p>This is the case with the cryptocurrencies trading. Luminex MISSION is to provide an accessible, transparent and secure tool for automated trading in high-volatile cryptocurrency markets, to improve each participant's the welfare without the need for deep immersion in the cryptocurrencies, blockchain and neural networks fields. </p>
                    <p>This is the case with the cryptocurrencies trading. Luminex MISSION is to provide an accessible, transparent and secure tool for automated trading in high-volatile cryptocurrency markets, to improve each participant's the welfare without the need for deep immersion in the cryptocurrencies, blockchain and neural networks fields. Machines have replaced people in many life spheres. This is the case with the cryptocurrencies trading. Luminex MISSION is to provide an accessible, transparent and secure tool for automated trading in high-volatile cryptocurrency markets, to improve each participant's the welfare without the need for deep immersion in the cryptocurrencies, blockchain and neural networks fields.  Machines have replaced people in many life spheres. </p><img class="image-right" src="/img/payout.png" alt="">
                    <p>This is the case with the cryptocurrencies trading. Luminex MISSION is to provide an accessible, transparent and secure tool for automated trading in high-volatile cryptocurrency markets, to improve each participant's the welfare without the need for deep immersion in the cryptocurrencies, blockchain and neural networks fields.  This is the case with the cryptocurrencies trading. Luminex MISSION is to provide an accessible, transparent and secure tool for automated trading in high-volatile cryptocurrency markets, to improve each participant's the welfare without the need for deep immersion in the cryptocurrencies, blockchain and neural networks fields. Machines have replaced people in many life spheres. This is the case with the cryptocurrencies trading. Luminex MISSION is to provide an accessible, transparent and secure tool for automated trading in high-volatile cryptocurrency markets, to improve each participant's the welfare without the need for deep immersion in the cryptocurrencies, blockchain and neural networks fields.  Machines have replaced people in many life spheres. </p>
                    <p>This is the case with the cryptocurrencies trading. Luminex MISSION is to provide an accessible, transparent and secure tool for automated trading in high-volatile cryptocurrency markets, to improve each participant's the welfare without the need for deep immersion in the cryptocurrencies, blockchain and neural networks fields. </p>
                </div>
            </div>
        </div>
    </main>

<script>document.getElementById("payoutPageMenuItem").className = "navigation__item navigation__item--active";</script>

@endsection
