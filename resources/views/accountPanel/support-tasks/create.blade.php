@extends('layouts.accountPanel.app')
@section('title')
Create task
@endsection
@section('content')

    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-xl-12" style="margin-top:50px;">
                    <form class="form theme-form" method="post" action="{{ route('accountPanel.support-tasks.store') }}">
                        <div class="card p-30">
                            <div class="card-content">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Task Title' contenteditable="true">{{ __('Task Title') }}</editor_block> @else {{ __('Task Title') }} @endif</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="title" placeholder="{{ __('Task Title') }}" value="{{ old('title') }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row mb-0">
                                        <label class="col-sm-3 col-form-label">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Task Description' contenteditable="true">{{ __('Task Description') }}</editor_block> @else {{ __('Task Description') }} @endif</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="description" rows="5" cols="5" placeholder="{{ __('Task Description') }}">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="padding: 30px 10px 0 0 !important;">
                                <div class="col-sm-3 offset-sm-9">
                                    <button class="btn btn-primary" type="submit">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Save' contenteditable="true">{{ __('Save') }}</editor_block> @else {{ __('Save') }} @endif</button>
                                    <a class="btn btn-light" href="{{ route('accountPanel.support-tasks.index') }}">@if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Cancel' contenteditable="true">{{ __('Cancel') }}</editor_block> @else {{ __('Cancel') }} @endif</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush
