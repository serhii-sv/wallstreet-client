@extends('layouts.customer')
@section('title', __('Home'))
@section('content')
    @include('partials.loader')
    <main role="main">
        <section class="intro">
            <div class="container">
                <div class="intro__content" style="text-align: center; width:100%; margin-top:100px;">
                    <h1 class="intro__title">
                        E-Mail verification
                    </h1>
                    <p style="text-align: center !important;">To access your account. Please, verify your account.</p>
                    <a class="btn intro__btn" href="{{ route('customer.main') }}/resend">Re-send mail</a>

                    @if(isset($message) && !empty($message))
                        <p style="font-weight: bold; margin-top:30px; color:rgb(0,100,100);">{{ $message }}</p>
                    @endif
                </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    @if(isset($errors) && !empty($errors->first()))
        <script>
            alert("{{ $errors->first() }}");
        </script>
    @endif
@endpush
