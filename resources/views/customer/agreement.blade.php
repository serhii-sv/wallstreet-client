@extends('layouts.app')
@section('title', __('User agreement'))
@section('content')
    <main role="main" style="background: white">
        <div class="page">
            <svg class="before-svg" viewBox="0 0 1950 65.242325" height="65.242325" width="1950">
                <path d="M 975,65.242324 H 0 V 35.889669 6.53701 L 21.25,5.88359 42.5,5.23016 88.000004,4.21053 133.5,3.19089 184,2.14419 234.5,1.09749 430.5,0.54874 626.5,0 l 85,1.14503 85,1.14503 46.5,0.96431 46.5,0.96431 41,1.0362 41,1.0362 49.5,1.48571 49.5,1.48571 42,1.50324 42,1.50325 48.5,1.99247 48.5,1.99247 43,2.013562 43,2.013565 38.5,2.004288 38.5,2.004288 43.5,2.486247 43.5,2.486246 47.5,3.01284 47.5,3.01284 36,2.496047 36,2.496046 13,0.97181 13,0.97181 40,3.03931 40,3.039311 48,3.987707 48,3.987708 38.4368,3.482384 38.4368,3.482385 h 1.3132 1.3132 v 1 1 z"></path>
            </svg>
            @include('partials.breadcrumbs')
            <div class="container">
                <h2 class="page-title page-title--line">
                    @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Agreement title' contenteditable="true">{{ __('Agreement title') }}</editor_block>
                    @else
                        {{ __('Agreement title') }}
                    @endif
                </h2>
                <div class="text">
                    <p>
                        @if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Agreement text' contenteditable="true">{{ __('Agreement text') }}</editor_block>
                        @else
                            {{ __('Agreement text') }}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </main>
@endsection
