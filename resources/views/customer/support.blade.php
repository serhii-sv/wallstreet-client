@extends('layouts.customer')
@section('title', __('Support'))
@section('content')
    <div class="et_pb_section  et_pb_section_2 et_pb_with_background et_section_regular">


        <div class=" et_pb_row et_pb_row_1">
            <div class="et_pb_column et_pb_column_4_4  et_pb_column_1 et-last-child">


                <div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left et_animated et_pb_text_0">


                    <div class="et_pb_text_inner">

                        <h2 style="text-align: center;"><strong>{{ __('Support') }}</strong></h2>

                    </div>
                </div> <!-- .et_pb_text -->
                <div class="et_pb_module et_pb_image et_pb_image_0 et_always_center_on_mobile">


                    <span class="et_pb_image_wrap"><img src="/images/ao.png" alt=""/></span>

                </div>
            </div> <!-- .et_pb_column -->


        </div> <!-- .et_pb_row -->
        <div class=" et_pb_row et_pb_row_2">
            <div class="et_pb_column et_pb_column_1_2  et_pb_column_2">
                <div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left  et_pb_text_1">
                    <div class="et_pb_text_inner">
                        <ul class="list-group">
                            <li class="list-group-item">{{ __('Contact phone') }}
                                : {{ \App\Models\Setting::getValue('phone') }}</li>
                            <li class="list-group-item">{{ __('Support email') }}
                                : {{ \App\Models\Setting::getValue('email') }}</li>
                            <li class="list-group-item">{{ __('Telegram') }}
                                : {{ \App\Models\Setting::getValue('telegram') }}</li>
                            <li class="list-group-item">{{ __('WhatsApp') }}
                                : {{ \App\Models\Setting::getValue('whatsapp') }}</li>
                        </ul>
                    </div>
                    <hr>
                    <p style="margin-left:20px;">
                        {{ __('Company name') }}:
                        <strong>{{ \App\Models\Setting::getValue('company_name') }}</strong><br>
                        {{ __('Address') }}: <strong>{{ \App\Models\Setting::getValue('address') }}</strong><br>
                        {{ __('Working time') }}: <strong>{{ \App\Models\Setting::getValue('working_time') }}</strong>
                    </p>
                </div> <!-- .et_pb_text -->
            </div> <!-- .et_pb_column -->

            <div class="et_pb_column et_pb_column_1_2  et_pb_column_3 et-last-child">


                <div class="et_pb_module et_pb_image et-waypoint et_animated et_pb_image_1 et_always_center_on_mobile">

                    @include('partials.inform')
                    <form class="form-control" method="POST" target="_top" action="{{ route('customer.support') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>{{ __('Your email') }}</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>{{ __('Your text') }}</label>
                            <textarea class="form-control" name="text"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-3">
                                    <?= captcha_img() ?>
                                </div>
                                <div class="col-lg-9">
                                    <input type="text" name="captcha" class="form-control" placeholder="Another input">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="text-align: right;">
                            <input type="submit" value="{{ __('Send') }}" class="btn btn-success" style="width:50%;">
                        </div>
                    </form>

                </div>
            </div> <!-- .et_pb_column -->


        </div> <!-- .et_pb_row -->

    </div> <!-- .et_pb_section -->
@endsection