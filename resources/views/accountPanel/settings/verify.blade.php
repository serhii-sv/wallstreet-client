@extends('layouts.accountPanel.app')
@section('title')
    Verify documents
@endsection
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('accountPanel/verification/css/style.css') }}">
@endpush
@section('content')

    <div class="container-fluid">
        <div class="edit-profile">
            @if(!$user->documents_verified && ($user->verifiedDocuments()->orderBy('created_at', 'desc')->first()->rejected ?? true) == true && !$user->verifiedDocuments->where('accepted', false)->count())
                <div class="row">
                    <div class="col-xl-12" style="margin-top:50px;">
                        @if(($user->verifiedDocuments()->orderBy('created_at', 'desc')->first()->rejected ?? false) == true)
                            <div class="alert alert-danger" role="alert" style="font-size: 20px;">
                                @if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Ваша предыдущая заявка была отменена. Вам нужно создать еще одну' contenteditable="true">{{ __('Ваша предыдущая заявка была отменена. Вам нужно создать еще одну') }}</editor_block>
                                @else
                                    {{ __('Ваша предыдущая заявка была отменена. Вам нужно создать еще одну') }}
                                @endif
                            </div>
                        @endif
                        <form class="card" method="post" action="{{ route('accountPanel.profile.upload-documents') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row p-5">
                                <div class="kyc-form-wrapper">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8 col-xl-7 text-center">
                                            <h2 class="page-title">
                                                @if(canEditLang() && checkRequestOnEdit())
                                                    <editor_block data-name='Начните верификацию личности.' contenteditable="true">{{ __('Начните верификацию личности.') }}</editor_block>
                                                @else
                                                    {{ __('Начните верификацию личности.') }}
                                                @endif
                                            </h2>
                                            <p class="large">
                                                @if(canEditLang() && checkRequestOnEdit())
                                                    <editor_block data-name='Пройдите верификацию для расширения своих возможностей на нашей платформе!' contenteditable="true">{{ __('Пройдите верификацию для расширения своих возможностей на нашей платформе!') }}</editor_block>
                                                @else
                                                    {{ __('Пройдите верификацию для расширения своих возможностей на нашей платформе!') }}
                                                @endif</p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center" style="margin-top: 50px;">
                                        <div class="col-lg-10 col-xl-12">
                                            <div class="kyc-form-steps card mx-lg-4">
                                                <div class="personal-details-wrapper">
                                                    <div id="step1" class="form-step form-step1">
                                                        <div class="form-step-head card-innr">
                                                            <div class="step-head">
                                                                <div class="step-number">01</div>
                                                                <div class="step-head-text">
                                                                    <h4>
                                                                        @if(canEditLang() && checkRequestOnEdit())
                                                                            <editor_block data-name='Персональные данные' contenteditable="true">{{ __('Персональные данные') }}</editor_block>
                                                                        @else
                                                                            {{ __('Персональные данные') }}
                                                                        @endif
                                                                    </h4>
                                                                    <p>
                                                                        @if(canEditLang() && checkRequestOnEdit())
                                                                            <editor_block data-name='Простая персональная информация для вашей идентификации.' contenteditable="true">{{ __('Простая персональная информация для вашей идентификации.') }}</editor_block>
                                                                        @else
                                                                            {{ __('Простая персональная информация для вашей идентификации.') }}
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-step-fields card-innr">
                                                            <div class="note note-plane note-light-alt note-md pdb-1x">
                                                                <em class="fa fa-info-circle"></em>
                                                                <p>
                                                                    @if(canEditLang() && checkRequestOnEdit())
                                                                        <editor_block data-name='Вводите данные верно. Вы не сможете их изменить после заполнения формы.' contenteditable="true">{{ __('Вводите данные верно. Вы не сможете их изменить после заполнения формы.') }}</editor_block>
                                                                    @else
                                                                        {{ __('Вводите данные верно. Вы не сможете их изменить после заполнения формы.') }}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="input-item input-with-label">
                                                                        <label class="input-item-label">
                                                                            @if(canEditLang() && checkRequestOnEdit())
                                                                                <editor_block data-name='Имя' contenteditable="true">{{ __('Имя') }}</editor_block>
                                                                            @else
                                                                                {{ __('Имя') }}
                                                                            @endif
                                                                        </label>
                                                                        <input type="text" name="first_name" class="input-bordered {{ $errors->has('first_name') ? 'has-error' : ''}}" value="{{ old('first_name') }}">
                                                                        @if($errors->has('first_name'))
                                                                            <div class="error">{{ $errors->first('first_name') }}</div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="input-item input-with-label">
                                                                        <label class="input-item-label">
                                                                            @if(canEditLang() && checkRequestOnEdit())
                                                                                <editor_block data-name='Фамилия' contenteditable="true">{{ __('Фамилия') }}</editor_block>
                                                                            @else
                                                                                {{ __('Фамилия') }}
                                                                            @endif
                                                                        </label>
                                                                        <input type="text" name="last_name" class="input-bordered {{ $errors->has('last_name') ? 'has-error' : ''}}" value="{{ old('last_name') }}">
                                                                        @if($errors->has('last_name'))
                                                                            <div class="error">{{ $errors->first('last_name') }}</div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="input-item input-with-label">
                                                                        <label class="input-item-label">
                                                                            @if(canEditLang() && checkRequestOnEdit())
                                                                                <editor_block data-name='Дата рождения' contenteditable="true">{{ __('Дата рождения') }}</editor_block>
                                                                            @else
                                                                                {{ __('Дата рождения') }}
                                                                            @endif
                                                                        </label>
                                                                        <input type="date" name="date_of_birth" class="input-bordered date-picker {{ $errors->has('date_of_birth') ? 'has-error' : ''}}" value="{{ old('date_of_birth') }}">
                                                                        @if($errors->has('date_of_birth'))
                                                                            <div class="error">{{ $errors->first('date_of_birth') }}</div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <h4 class="text-secondary mgt-0-5x">
                                                                @if(canEditLang() && checkRequestOnEdit())
                                                                    <editor_block data-name='Ваш адрес' contenteditable="true">{{ __('Ваш адрес') }}</editor_block>
                                                                @else
                                                                    {{ __('Ваш адрес') }}
                                                                @endif
                                                            </h4>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="input-item input-with-label">
                                                                        <label class="input-item-label">
                                                                            @if(canEditLang() && checkRequestOnEdit())
                                                                                <editor_block data-name='Страна' contenteditable="true">{{ __('Страна') }}</editor_block>
                                                                            @else
                                                                                {{ __('Страна') }}
                                                                            @endif
                                                                        </label>
                                                                        <input type="text" name="country" class="input-bordered {{ $errors->has('country') ? 'has-error' : ''}}" value="{{ old('country') }}">
                                                                        @if($errors->has('country'))
                                                                            <div class="error">{{ $errors->first('country') }}</div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="input-item input-with-label">
                                                                        <label class="input-item-label">
                                                                            @if(canEditLang() && checkRequestOnEdit())
                                                                                <editor_block data-name='Город' contenteditable="true">{{ __('Город') }}</editor_block>
                                                                            @else
                                                                                {{ __('Город') }}
                                                                            @endif
                                                                        </label>
                                                                        <input type="text" name="city" class="input-bordered {{ $errors->has('city') ? 'has-error' : ''}}" value="{{ old('city') }}">
                                                                        @if($errors->has('city'))
                                                                            <div class="error">{{ $errors->first('city') }}</div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="input-item input-with-label">
                                                                        <label class="input-item-label">
                                                                            @if(canEditLang() && checkRequestOnEdit())
                                                                                <editor_block data-name='Штат (область)' contenteditable="true">{{ __('Штат (область)') }}</editor_block>
                                                                            @else
                                                                                {{ __('Штат (область)') }}
                                                                            @endif
                                                                        </label>
                                                                        <input type="text" name="state" class="input-bordered {{ $errors->has('state') ? 'has-error' : ''}}" value="{{ old('state') }}">
                                                                        @if($errors->has('state'))
                                                                            <div class="error">{{ $errors->first('state') }}</div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="input-item input-with-label">
                                                                        <label for="nationality" class="input-item-label">
                                                                            @if(canEditLang() && checkRequestOnEdit())
                                                                                <editor_block data-name='Национальность' contenteditable="true">{{ __('Национальность') }}</editor_block>
                                                                            @else
                                                                                {{ __('Национальность') }}
                                                                            @endif
                                                                        </label>
                                                                        <input type="text" name="nationality" class="input-bordered {{ $errors->has('nationality') ? 'has-error' : ''}}" value="{{ old('nationality') }}">
                                                                        @if($errors->has('nationality'))
                                                                            <div class="error">{{ $errors->first('nationality') }}</div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="input-item input-with-label">
                                                                        <label class="input-item-label">
                                                                            @if(canEditLang() && checkRequestOnEdit())
                                                                                <editor_block data-name='Почтовый индекс' contenteditable="true">{{ __('Почтовый индекс') }}</editor_block>
                                                                            @else
                                                                                {{ __('Почтовый индекс') }}
                                                                            @endif
                                                                        </label>
                                                                        <input type="text" name="zip_code" class="input-bordered {{ $errors->has('zip_code') ? 'has-error' : ''}}" value="{{ old('zip_code') }}">
                                                                        @if($errors->has('zip_code'))
                                                                            <div class="error">{{ $errors->first('zip_code') }}</div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="input-item input-with-label">
                                                                        <label class="input-item-label">
                                                                            @if(canEditLang() && checkRequestOnEdit())
                                                                                <editor_block data-name='Фактический адрес' contenteditable="true">{{ __('Фактический адрес') }}</editor_block>
                                                                            @else
                                                                                {{ __('Фактический адрес') }}
                                                                            @endif
                                                                        </label>
                                                                        <input type="text" name="address" class="input-bordered {{ $errors->has('address') ? 'has-error' : ''}}" value="{{ old('address') }}">
                                                                        @if($errors->has('address'))
                                                                            <div class="error">{{ $errors->first('address') }}</div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-step form-step2 name-verification-wrapper">
                                                    <div class="form-step-head card-innr">
                                                        <div class="step-head">
                                                            <div class="step-number">02</div>
                                                            <div class="step-head-text">
                                                                <h4>
                                                                    @if(canEditLang() && checkRequestOnEdit())
                                                                        <editor_block data-name='Загрузка документов' contenteditable="true">{{ __('Загрузка документов') }}</editor_block>
                                                                    @else
                                                                        {{ __('Загрузка документов') }}
                                                                    @endif
                                                                </h4>
                                                                <p>
                                                                    @if(canEditLang() && checkRequestOnEdit())
                                                                        <editor_block data-name='Для верификации личности загрузите один из ваших документов ниже.' contenteditable="true">{{ __('Для верификации личности загрузите один из ваших документов ниже.') }}</editor_block>
                                                                    @else
                                                                        {{ __('Для верификации личности загрузите один из ваших документов ниже.') }}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-step-fields card-innr">
                                                        <div class="mb-1"></div>
                                                        <div class="note note-plane note-light-alt note-md pdb-0-5x">
                                                            <em class="fa fa-info-circle"></em>
                                                            <p>
                                                                @if(canEditLang() && checkRequestOnEdit())
                                                                    <editor_block data-name='Для прохождения верификации выберите один из документов.' contenteditable="true">{{ __('Для прохождения верификации выберите один из документов.') }}</editor_block>
                                                                @else
                                                                    {{ __('Для прохождения верификации выберите один из документов.') }}
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="gaps-2x"></div>
                                                        <input type="hidden" name="document_type" value="{{ old('document_type') ?? 'passport' }}">
                                                        <ul role="tablist"
                                                            class="nav nav-tabs nav-tabs-bordered row flex-wrap guttar-20px">
                                                            <li class="nav-item flex-grow-0">
                                                                <a data-toggle="tab" href="#passport" class="nav-link d-flex align-items-center {{ old('document_type') == 'passport' || old('document_type') == null ? 'active show' : '' }}">
                                                                    <div class="nav-tabs-icon">
                                                                        <img src="{{ asset('accountPanel/verification/images/icon-passport.png') }}" alt="icon">
                                                                        <img src="{{ asset('accountPanel/verification/images/icon-passport-color.png') }}" alt="icon">
                                                                    </div>
                                                                    <span>
                                                                        @if(canEditLang() && checkRequestOnEdit())
                                                                            <editor_block data-name='Паспорт' contenteditable="true">{{ __('Паспорт') }}</editor_block>
                                                                        @else
                                                                            {{ __('Паспорт') }}
                                                                        @endif
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item flex-grow-0">
                                                                <a data-toggle="tab" href="#national-card" class="nav-link d-flex align-items-center {{ old('document_type') == 'national-card' ? 'active show' : '' }}">
                                                                    <div class="nav-tabs-icon">
                                                                        <img src="{{ asset('accountPanel/verification/images/icon-national-id.png') }}" alt="icon">
                                                                        <img src="{{ asset('accountPanel/verification/images/icon-national-id-color.png') }}" alt="icon">
                                                                    </div>
                                                                    <span>
                                                                        @if(canEditLang() && checkRequestOnEdit())
                                                                            <editor_block data-name='ID карта' contenteditable="true">{{ __('ID карта') }}</editor_block>
                                                                        @else
                                                                            {{ __('ID карта') }}
                                                                        @endif
                                                                    </span>
                                                                </a>
                                                            </li>
                                                            <li class="nav-item flex-grow-0">
                                                                <a data-toggle="tab" href="#driver-licence" class="nav-link d-flex align-items-center {{ old('document_type') == 'driver-licence' ? 'active show' : '' }}">
                                                                    <div class="nav-tabs-icon">
                                                                        <img src="{{ asset('accountPanel/verification/images/icon-licence.png') }}" alt="icon">
                                                                        <img src="{{ asset('accountPanel/verification/images/icon-licence-color.png') }}" alt="icon">
                                                                    </div>
                                                                    <span>
                                                                        @if(canEditLang() && checkRequestOnEdit())
                                                                            <editor_block data-name='Водительское удостоверение' contenteditable="true">{{ __('Водительское удостоверение') }}</editor_block>
                                                                        @else
                                                                            {{ __('Водительское удостоверение') }}
                                                                        @endif
                                                                    </span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <div id="myTabContent" class="tab-content">
                                                            <div id="passport" class="tab-pane fade {{ old('document_type') == 'passport' || old('document_type') == null ? 'active show' : '' }}">
                                                                <h5 class="text-secondary font-bold">
                                                                    @if(canEditLang() && checkRequestOnEdit())
                                                                        <editor_block data-name='Чтобы избежать отмены верификации следуйте простым правилам:' contenteditable="true">{{ __('Чтобы избежать отмены верификации следуйте простым правилам:') }}</editor_block>
                                                                    @else
                                                                        {{ __('Чтобы избежать отмены верификации следуйте простым правилам:') }}
                                                                    @endif
                                                                </h5>
                                                                <ul class="list-check">
                                                                    <li>
                                                                        @if(canEditLang() && checkRequestOnEdit())
                                                                            <editor_block data-name='Выбранный документ не должен быть просрочен.' contenteditable="true">{{ __('Выбранный документ не должен быть просрочен.') }}</editor_block>
                                                                        @else
                                                                            {{ __('Выбранный документ не должен быть просрочен.') }}
                                                                        @endif
                                                                    </li>
                                                                    <li>
                                                                        @if(canEditLang() && checkRequestOnEdit())
                                                                            <editor_block data-name='Документ должен быть в хорошем состоянии и легко читаемым.' contenteditable="true">{{ __('Документ должен быть в хорошем состоянии и легко читаемым.') }}</editor_block>
                                                                        @else
                                                                            {{ __('Документ должен быть в хорошем состоянии и легко читаемым.') }}
                                                                        @endif
                                                                    </li>
                                                                    <li>
                                                                        @if(canEditLang() && checkRequestOnEdit())
                                                                            <editor_block data-name='Убедитесь что на документе нет бликов света, затрудняющих чтение информации.' contenteditable="true">{{ __('Убедитесь что на документе нет бликов света, затрудняющих чтение информации.') }}</editor_block>
                                                                        @else
                                                                            {{ __('Убедитесь что на документе нет бликов света, затрудняющих чтение информации.') }}
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                                <div class="gaps-2x"></div>
                                                                <h5 class="font-mid">
                                                                    @if(canEditLang() && checkRequestOnEdit())
                                                                        <editor_block data-name='Загрузите копию паспорта в поле ниже.' contenteditable="true">{{ __('Загрузите копию паспорта в поле ниже.') }}</editor_block>
                                                                    @else
                                                                        {{ __('Загрузите копию паспорта в поле ниже.') }}
                                                                    @endif
                                                                </h5>
                                                                <div class="row align-items-center">
                                                                    <div class="col-sm-8">
                                                                        <div class="upload-box">
                                                                            <div data-value="name" class="upload-zone dropzone dz-clickable">
                                                                                <div class="dz-message">
                                                                                    <div>
                                                                                        <button type="button" class="btn btn-primary" id="uploadPassportImage">
                                                                                            @if(canEditLang() && checkRequestOnEdit())
                                                                                                <editor_block data-name='Выбрать' contenteditable="true">{{ __('Выбрать') }}</editor_block>
                                                                                            @else
                                                                                                {{ __('Выбрать') }}
                                                                                            @endif
                                                                                        </button>
                                                                                    </div>
                                                                                    <div>
                                                                                        <input type="file" class="hidden" name="passport_image" id="passportImage" accept="image/jpeg','image/gif','image/png','image/bmp','image/svg+xml">
                                                                                        <img class="preview mt-3" id="passportImagePreview">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @if($errors->has('passport_image'))
                                                                                <div class="error">{{ $errors->first('passport_image') }}</div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4 d-none d-sm-block">
                                                                        <div class="mx-md-4">
                                                                            <img src="{{ asset('accountPanel/verification/images/vector-passport.png') }}" alt="vector">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="national-card" class="tab-pane fade {{ old('document_type') == 'national-card' ? 'active show' : '' }}">
                                                                <h5 class="text-secondary font-bold">
                                                                    @if(canEditLang() && checkRequestOnEdit())
                                                                        <editor_block data-name='Чтобы избежать отмены верификации следуйте простым правилам:' contenteditable="true">{{ __('Чтобы избежать отмены верификации следуйте простым правилам:') }}</editor_block>
                                                                    @else
                                                                        {{ __('Чтобы избежать отмены верификации следуйте простым правилам:') }}
                                                                    @endif
                                                                </h5>
                                                                <ul class="list-check">
                                                                    <li>
                                                                        @if(canEditLang() && checkRequestOnEdit())
                                                                            <editor_block data-name='Выбранный документ не должен быть просрочен.' contenteditable="true">{{ __('Выбранный документ не должен быть просрочен.') }}</editor_block>
                                                                        @else
                                                                            {{ __('Выбранный документ не должен быть просрочен.') }}
                                                                        @endif
                                                                    </li>
                                                                    <li>
                                                                        @if(canEditLang() && checkRequestOnEdit())
                                                                            <editor_block data-name='Документ должен быть в хорошем состоянии и легко читаемым.' contenteditable="true">{{ __('Документ должен быть в хорошем состоянии и легко читаемым.') }}</editor_block>
                                                                        @else
                                                                            {{ __('Документ должен быть в хорошем состоянии и легко читаемым.') }}
                                                                        @endif
                                                                    </li>
                                                                    <li>
                                                                        @if(canEditLang() && checkRequestOnEdit())
                                                                            <editor_block data-name='Убедитесь что на документе нет бликов света, затрудняющих чтение информации.' contenteditable="true">{{ __('Убедитесь что на документе нет бликов света, затрудняющих чтение информации.') }}</editor_block>
                                                                        @else
                                                                            {{ __('Убедитесь что на документе нет бликов света, затрудняющих чтение информации.') }}
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                                <div class="gaps-2x"></div>
                                                                <h5 class="font-mid">
                                                                    @if(canEditLang() && checkRequestOnEdit())
                                                                        <editor_block data-name='Загрузите переднюю сторону ID карты' contenteditable="true">{{ __('Загрузите переднюю сторону ID карты') }}</editor_block>
                                                                    @else
                                                                        {{ __('Загрузите переднюю сторону ID карты') }}
                                                                    @endif
                                                                </h5>
                                                                <div class="row align-items-center">
                                                                    <div class="col-sm-8">
                                                                        <div class="upload-box">
                                                                            <div class="upload-zone dropzone dz-clickable">
                                                                                <div class="dz-message">
                                                                                    <div>
                                                                                        <button type="button" class="btn btn-primary" id="uploadIdCardFrontImage">
                                                                                            @if(canEditLang() && checkRequestOnEdit())
                                                                                                <editor_block data-name='Выбрать' contenteditable="true">{{ __('Выбрать') }}</editor_block>
                                                                                            @else
                                                                                                {{ __('Выбрать') }}
                                                                                            @endif
                                                                                        </button>
                                                                                    </div>
                                                                                    <div>
                                                                                        <input type="file" class="hidden" name="id_card_front_image" id="id_card_front_image" accept="image/jpeg','image/gif','image/png','image/bmp','image/svg+xml">
                                                                                        <img class="preview mt-3" id="idCardFrontImagePreview">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @if($errors->has('id_card_front_image'))
                                                                            <div class="error">{{ $errors->first('id_card_front_image') }}</div>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-sm-4 d-none d-sm-block">
                                                                        <div class="mx-md-4">
                                                                            <img src="{{ asset('accountPanel/verification/images/vector-id-front.png') }}" alt="vector">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="gaps-3x"></div>
                                                                <h5 class="font-mid">
                                                                    @if(canEditLang() && checkRequestOnEdit())
                                                                        <editor_block data-name='Загрузите заднюю сторону ID карты' contenteditable="true">{{ __('Загрузите заднюю сторону ID карты') }}</editor_block>
                                                                    @else
                                                                        {{ __('Загрузите заднюю сторону ID карты') }}
                                                                    @endif
                                                                </h5>
                                                                <div class="row align-items-center">
                                                                    <div class="col-sm-8">
                                                                        <div class="upload-box">
                                                                            <div class="upload-zone dropzone dz-clickable">
                                                                                <div class="dz-message">
                                                                                    <div>
                                                                                        <button type="button" class="btn btn-primary" id="uploadIdCardBackImage">
                                                                                            @if(canEditLang() && checkRequestOnEdit())
                                                                                                <editor_block data-name='Выбрать' contenteditable="true">{{ __('Выбрать') }}</editor_block>
                                                                                            @else
                                                                                                {{ __('Выбрать') }}
                                                                                            @endif
                                                                                        </button>
                                                                                    </div>
                                                                                    <div>
                                                                                        <input type="file" class="hidden" name="id_card_back_image" id="id_card_back_image" accept="image/jpeg','image/gif','image/png','image/bmp','image/svg+xml">
                                                                                        <img class="preview mt-3" id="idCardBackImagePreview">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @if($errors->has('id_card_back_image'))
                                                                                <div class="error">{{ $errors->first('id_card_back_image') }}</div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4 d-none d-sm-block">
                                                                        <div class="mx-md-4">
                                                                            <img src="{{ asset('accountPanel/verification/images/vector-id-back.png') }}" alt="vector">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="driver-licence" class="tab-pane fade {{ old('document_type') == 'driver-licence' ? 'active show' : '' }}">
                                                                <h5 class="text-secondary font-bold">
                                                                    @if(canEditLang() && checkRequestOnEdit())
                                                                        <editor_block data-name='Чтобы избежать отмены верификации следуйте простым правилам:' contenteditable="true">{{ __('Чтобы избежать отмены верификации следуйте простым правилам:') }}</editor_block>
                                                                    @else
                                                                        {{ __('Чтобы избежать отмены верификации следуйте простым правилам:') }}
                                                                    @endif
                                                                </h5>
                                                                <ul class="list-check">
                                                                    <li>
                                                                        @if(canEditLang() && checkRequestOnEdit())
                                                                            <editor_block data-name='Выбранный документ не должен быть просрочен.' contenteditable="true">{{ __('Выбранный документ не должен быть просрочен.') }}</editor_block>
                                                                        @else
                                                                            {{ __('Выбранный документ не должен быть просрочен.') }}
                                                                        @endif
                                                                    </li>
                                                                    <li>
                                                                        @if(canEditLang() && checkRequestOnEdit())
                                                                            <editor_block data-name='Документ должен быть в хорошем состоянии и легко читаемым.' contenteditable="true">{{ __('Документ должен быть в хорошем состоянии и легко читаемым.') }}</editor_block>
                                                                        @else
                                                                            {{ __('Документ должен быть в хорошем состоянии и легко читаемым.') }}
                                                                        @endif
                                                                    </li>
                                                                    <li>
                                                                        @if(canEditLang() && checkRequestOnEdit())
                                                                            <editor_block data-name='Убедитесь что на документе нет бликов света, затрудняющих чтение информации.' contenteditable="true">{{ __('Убедитесь что на документе нет бликов света, затрудняющих чтение информации.') }}</editor_block>
                                                                        @else
                                                                            {{ __('Убедитесь что на документе нет бликов света, затрудняющих чтение информации.') }}
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                                <div class="gaps-2x"></div>
                                                                <h5 class="font-mid">
                                                                    @if(canEditLang() && checkRequestOnEdit())
                                                                        <editor_block data-name='Загрузите копию вашего водительского удостоверения' contenteditable="true">{{ __('Загрузите копию вашего водительского удостоверения') }}</editor_block>
                                                                    @else
                                                                        {{ __('Загрузите копию вашего водительского удостоверения') }}
                                                                    @endif
                                                                </h5>
                                                                <div class="row align-items-center">
                                                                    <div class="col-sm-8">
                                                                        <div class="upload-box">
                                                                            <div class="upload-zone dropzone dz-clickable">
                                                                                <div class="dz-message">
                                                                                    <div>
                                                                                        <button type="button" class="btn btn-primary" id="uploadDriverLicenseImage">
                                                                                            @if(canEditLang() && checkRequestOnEdit())
                                                                                                <editor_block data-name='Выбрать' contenteditable="true">{{ __('Выбрать') }}</editor_block>
                                                                                            @else
                                                                                                {{ __('Выбрать') }}
                                                                                            @endif
                                                                                        </button>
                                                                                    </div>
                                                                                    <div>
                                                                                        <input type="file" class="hidden" name="driver_license_image" id="driver_license_image" accept="image/jpeg','image/gif','image/png','image/bmp','image/svg+xml">
                                                                                        <img class="preview mt-3" id="driverLicenseImagePreview">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @if($errors->has('driver_license_image'))
                                                                                <div class="error">{{ $errors->first('driver_license_image') }}</div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4 d-none d-sm-block">
                                                                        <div class="mx-md-4">
                                                                            <img src="{{ asset('accountPanel/verification/images/vector-licence.png') }}" alt="vector">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-step form-step3 name-verification-wrapper">
                                                    <div class="form-step-head card-innr">
                                                        <div class="step-head">
                                                            <div class="step-number">03</div>
                                                            <div class="step-head-text">
                                                                <h4>
                                                                    @if(canEditLang() && checkRequestOnEdit())
                                                                        <editor_block data-name='Верификация адреса' contenteditable="true">{{ __('Верификация адреса') }}</editor_block>
                                                                    @else
                                                                        {{ __('Верификация адреса') }}
                                                                    @endif
                                                                </h4>
                                                                <p>
                                                                    @if(canEditLang() && checkRequestOnEdit())
                                                                        <editor_block data-name='Загрузите документ подтверждающий ваш адрес проживания' contenteditable="true">{{ __('Загрузите документ подтверждающий ваш адрес проживания') }}</editor_block>
                                                                    @else
                                                                        {{ __('Загрузите документ подтверждающий ваш адрес проживания') }}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-step-fields card-innr" style="">
                                                        <div class="mb-1"></div>
                                                        <div class="note note-plane note-light-alt note-md pdb-0-5x">
                                                            <em class="fa fa-info-circle"></em>
                                                            <p>
                                                                @if(canEditLang() && checkRequestOnEdit())
                                                                    <editor_block data-name='Это обязательный пункт для прохождения полной верификации' contenteditable="true">{{ __('Это обязательный пункт для прохождения полной верификации') }}</editor_block>
                                                                @else
                                                                    {{ __('Это обязательный пункт для прохождения полной верификации') }}
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="gaps-2x"></div>
                                                        <h5 class="font-mid">
                                                            @if(canEditLang() && checkRequestOnEdit())
                                                                <editor_block data-name='Загрузите документ подтверждающий ваш адрес' contenteditable="true">{{ __('Загрузите документ подтверждающий ваш адрес') }}</editor_block>
                                                            @else
                                                                {{ __('Загрузите документ подтверждающий ваш адрес') }}
                                                            @endif
                                                        </h5>
                                                        <div class="row align-items-center">
                                                            <div class="col-sm-8">
                                                                <div class="upload-box">
                                                                    <div data-value="address" class="upload-zone dropzone dz-clickable">
                                                                        <div class="dz-message">
                                                                            <div>
                                                                                <button type="button" class="btn btn-primary" id="uploadAddressImage">
                                                                                    @if(canEditLang() && checkRequestOnEdit())
                                                                                        <editor_block data-name='Выбрать' contenteditable="true">{{ __('Выбрать') }}</editor_block>
                                                                                    @else
                                                                                        {{ __('Выбрать') }}
                                                                                    @endif
                                                                                </button>
                                                                            </div>
                                                                            <div>
                                                                                <input type="file" class="hidden" name="address_image" id="address_image" accept="image/jpeg','image/gif','image/png','image/bmp','image/svg+xml">
                                                                                <img class="preview mt-3" id="addressImagePreview">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($errors->has('address_image'))
                                                                        <div class="error">{{ $errors->first('address_image') }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 d-none d-sm-block">
                                                                <div class="mx-md-4">
                                                                    <img src="{{ asset('accountPanel/verification/images/vector-passport.png') }}" alt="vector">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-step form-step3 name-verification-wrapper">
                                                    <div class="form-step-head card-innr">
                                                        <div class="step-head">
                                                            <div class="step-number">04</div>
                                                            <div class="step-head-text">
                                                                <h4>
                                                                    @if(canEditLang() && checkRequestOnEdit())
                                                                        <editor_block data-name='Селфи с документом удостоверяющим личность' contenteditable="true">{{ __('Селфи с документом удостоверяющим личность') }}</editor_block>
                                                                    @else
                                                                        {{ __('Селфи с документом удостоверяющим личность') }}
                                                                    @endif
                                                                </h4>
                                                                <p>
                                                                    @if(canEditLang() && checkRequestOnEdit())
                                                                        <editor_block data-name='Для верификации необходимо предоставить селфи с документом удостоверяющим личность. Документ должен совпадать с указанным в шаге "2".' contenteditable="true">{{ __('Для верификации необходимо предоставить селфи с документом удостоверяющим личность. Документ должен совпадать с указанным в шаге "2".') }}</editor_block>
                                                                    @else
                                                                        {{ __('Для верификации необходимо предоставить селфи с документом удостоверяющим личность. Документ должен совпадать с указанным в шаге "2".') }}
                                                                    @endif
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-step-fields card-innr" style="">
                                                        <div class="mb-1"></div>
                                                        <div class="note note-plane note-light-alt note-md pdb-0-5x">
                                                            <em class="fa fa-info-circle"></em>
                                                            <p>
                                                                @if(canEditLang() && checkRequestOnEdit())
                                                                    <editor_block data-name='Так же на фото должен быть размещен лист бумаги с указанием вашего текущего логина' contenteditable="true">{{ __('Так же на фото должен быть размещен лист бумаги с указанием вашего текущего логина') }}</editor_block>
                                                                @else
                                                                    {{ __('Так же на фото должен быть размещен лист бумаги с указанием вашего текущего логина') }}
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <div class="gaps-2x"></div>
                                                        <h5 class="font-mid">
                                                            @if(canEditLang() && checkRequestOnEdit())
                                                                <editor_block data-name='Загрузите ваше фото' contenteditable="true">{{ __('Загрузите ваше фото') }}</editor_block>
                                                            @else
                                                                {{ __('Загрузите ваше фото') }}
                                                            @endif
                                                        </h5>
                                                        <div class="row align-items-center">
                                                            <div class="col-sm-8">
                                                                <div class="upload-box">
                                                                    <div data-value="photo" class="upload-zone dropzone dz-clickable">
                                                                        <div class="dz-message">
                                                                            <div>
                                                                                <button type="button" class="btn btn-primary" id="uploadSelfie">
                                                                                    @if(canEditLang() && checkRequestOnEdit())
                                                                                        <editor_block data-name='Выбрать' contenteditable="true">{{ __('Выбрать') }}</editor_block>
                                                                                    @else
                                                                                        {{ __('Выбрать') }}
                                                                                    @endif
                                                                                </button>
                                                                            </div>
                                                                            <div>
                                                                                <input type="file" class="hidden" name="selfie_image" id="selfie_image" accept="image/jpeg','image/gif','image/png','image/bmp','image/svg+xml">
                                                                                <img class="preview mt-3" id="selfiePreview">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if($errors->has('selfie_image'))
                                                                        <div class="error">{{ $errors->first('selfie_image') }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 d-none d-sm-block">
                                                                <div class="mx-md-4">
                                                                    <img src="{{ asset('accountPanel/verification/images/vector-passport.png') }}" alt="vector">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-step form-step-final">
                                                    <div class="form-step-fields card-innr">
                                                        <div class="input-item">
                                                            <input type="hidden" name="confirmation_of_correctness" value="0">
                                                            <input id="info-currect" type="checkbox" class="input-checkbox input-checkbox-md" name="confirmation_of_correctness" value="1">
                                                            <label for="info-currect">
                                                                @if(canEditLang() && checkRequestOnEdit())
                                                                    <editor_block data-name='Вся внесенная мной информация правильная.' contenteditable="true">{{ __('Вся внесенная мной информация правильная.') }}</editor_block>
                                                                @else
                                                                    {{ __('Вся внесенная мной информация правильная.') }}
                                                                @endif
                                                            </label>
                                                            @if($errors->has('confirmation_of_correctness'))
                                                                <div class="error">{{ $errors->first('confirmation_of_correctness') }}</div>
                                                            @endif
                                                        </div>
                                                        <div class="gaps-1x"></div>
                                                        <button class="btn btn-primary">
                                                            @if(canEditLang() && checkRequestOnEdit())
                                                                <editor_block data-name='Отправить данные на проверку' contenteditable="true">{{ __('Отправить данные на проверку') }}</editor_block>
                                                            @else
                                                                {{ __('Отправить данные на проверку') }}
                                                            @endif
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-xl-12" style="margin-top:50px;">
                        <div class="card bg-img">
                            @if($user->verifiedDocuments->count() && $user->verifiedDocuments()->first()->accepted)
                                <div class="card-body">
                                    <div class="body-bottom">
                                        <div class="status status-verified">
                                            <div class="status-icon">
                                                <em class="ti ti-files"></em>
                                                <div class="status-icon-sm">
                                                    <em class="ti ti-check"></em>
                                                </div>
                                            </div>
                                            @if(canEditLang() && checkRequestOnEdit())
                                                <editor_block data-name='Спасибо! Вы успешно прошли верификацию личности.' contenteditable="true">{{ __('Спасибо! Вы успешно прошли верификацию личности.') }}</editor_block>
                                            @else
                                                <span class="status-text">{{ __('Спасибо! Вы успешно прошли верификацию личности.') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="card-body">
                                    <div class="body-bottom">
                                        <div class="status status-warnning">
                                            <div class="status-icon">
                                                <em class="ti ti-files"></em>
                                                <div class="status-icon-sm">
                                                    <em class="ti ti-alarm-clock"></em>
                                                </div>
                                            </div>
                                            @if(canEditLang() && checkRequestOnEdit())
                                                <editor_block data-name='Ваши данные проверяются специалистами компании.' contenteditable="true">{{ __('Ваши данные проверяются специалистами компании.') }}</editor_block>
                                                <br>
                                            @else
                                                <span class="status-text">{{ __('Ваши данные проверяются специалистами компании.') }}</span>
                                            @endif
                                            @if(canEditLang() && checkRequestOnEdit())
                                                <editor_block data-name='Ожидайте, ближайшее время ваши данные будут проверены.' contenteditable="true">{{ __('Ожидайте, ближайшее время ваши данные будут проверены.') }}</editor_block>
                                            @else
                                                <p>{{ __('Ожидайте, ближайшее время ваши данные будут проверены.') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <style>
        .media {
            align-items: flex-start !important;
        }

        .user-image {
            position: relative;
        }

        .hidden {
            display: none;
        }

        .preview {
            width: 50%;
            height: 50%;
        }
    </style>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.nav-link').click(function () {
                let tab = $(this).attr('href');
                if (tab) {
                    $('input[name="document_type"]').val(tab.replace('#', ''))
                    $('.tab-pane').removeClass('show').removeClass('active')
                    $(tab).addClass('show').addClass('active')
                }
                $('.nav-link').removeClass('active').removeClass('show')
                $(this).addClass('active').addClass('show')
                return false;
            })
            $('#uploadPassportImage').click(function () {
                document.getElementById('passportImage').click()
            })

            $('#selfie_image').change(function () {
                let input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#selfiePreview').attr('src', e.target.result).removeClass('hidden');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            })

            $('#uploadSelfie').click(function () {
                document.getElementById('selfie_image').click()
            })

            $('#passportImage').change(function () {
                let input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#passportImagePreview').attr('src', e.target.result).removeClass('hidden');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            })

            $("#id_card_back_image").change(function () {
                let input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#idCardBackImagePreview').attr('src', e.target.result).removeClass('hidden');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#uploadIdCardBackImage').click(function () {
                document.getElementById('id_card_back_image').click()
            })

            $("#id_card_front_image").change(function () {
                let input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#idCardFrontImagePreview').attr('src', e.target.result).removeClass('hidden');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#uploadIdCardFrontImage').click(function () {
                document.getElementById('id_card_front_image').click()
            })

            $("#driver_license_image").change(function () {
                let input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#driverLicenseImagePreview').attr('src', e.target.result).removeClass('hidden');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#uploadDriverLicenseImage').click(function () {
                document.getElementById('driver_license_image').click()
            })

            $("#address_image").change(function () {
                let input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#addressImagePreview').attr('src', e.target.result).removeClass('hidden');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });

            $('#uploadAddressImage').click(function () {
                document.getElementById('address_image').click()
            })

            $('input').click(function () {
                $(this).removeClass('has-error')
                $(this).closest('.input-item').find('.error').hide()
                $(this).closest('.upload-box').find('.error').hide()
            })
        });
    </script>
@endpush
