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
                    <p style="text-align: center !important;">Your email has been confirmed. Wait ...</p>
                    <a class="btn intro__btn" href="{{ route('customer.main') }}?resend">Re-send mail</a>

                    @if(isset($message) && !empty($message))
                        <p style="font-weight: bold;">{{ $message }}</p>
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

    <script>
        setTimeout(function(){
            location.assign('{{ route('profile.profile') }}');
        }, 2000)
    </script>
@endpush
