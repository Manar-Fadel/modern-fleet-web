@extends('web.layout.default')
@section('content')
<style>
    div.radio-with-Icon {
        display: block;
    }
    div.radio-with-Icon p.radioOption-Item {
        display: inline-block;
        width: 100px;
        height: 80px;
        box-sizing: border-box;
        margin: 0 15px;
        border: none;
    }
    div.radio-with-Icon p.radioOption-Item label {
        display: block;
        height: 100%;
        width: 100%;
        padding: 10px;
        border-radius: 10px;
        border: 1px solid #25285f;
        color: #25285f;
        cursor: pointer;
        opacity: .8;
        transition: none;
        font-size: 10px;
        padding-top: 5px;
        text-align: center;
        margin: 0 !important;
    }
    .radio-btn-icon{
        background-color: #25285f;
        color: #fff !important;
        margin: 0 !important;
    }
    .radio-btn-icon label{
        color: white !important;
    }
    div.radio-with-Icon p.radioOption-Item label:hover, div.radio-with-Icon p.radioOption-Item label:focus, div.radio-with-Icon p.radioOption-Item label:active {
        background-color: #25285f;
        color: #fff;
        margin: 0 !important;
    }
    div.radio-with-Icon p.radioOption-Item label::after, div.radio-with-Icon p.radioOption-Item label:after, div.radio-with-Icon p.radioOption-Item label::before, div.radio-with-Icon p.radioOption-Item label:before {

    }
    div.radio-with-Icon p.radioOption-Item label i.fa {
        display: block;
        font-size: 50px;
    }
    div.radio-with-Icon p.radioOption-Item input[type="radio"] {
        opacity: 0 !important;
        width: 0 !important;
        height: 0 !important;
    }
    div.radio-with-Icon p.radioOption-Item input[type="radio"]:active ~ label {
        opacity: 1;
    }
    div.radio-with-Icon p.radioOption-Item input[type="radio"]:checked ~ label {
        opacity: 1;
        border: none;
        background-color: #237093;
        color: #fff;
    }
    div.radio-with-Icon p.radioOption-Item input[type="radio"]:hover, div.radio-with-Icon p.radioOption-Item input[type="radio"]:focus, div.radio-with-Icon p.radioOption-Item input[type="radio"]:active {
        margin: 0 !important;
    }
    div.radio-with-Icon p.radioOption-Item input[type="radio"] + label:before, div.radio-with-Icon p.radioOption-Item input[type="radio"] + label:after {
        margin: 0 !important;
    }
</style>

<div class="rts-wrapper">
    <div class="rts-wrapper-inner">

        <!-- header area start -->
        @include("web.includes.header")
        <!-- header area end -->

        <!-- Contact Start -->
        <div class="rts-category-area rts-contact-page-form-area rts-section-gapNew rts-section-gap account" style="margin-top: 0; padding-top: 30px; background: white;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <div class="mian-wrapper-form">
                            <div class="title-mid-wrapper-home-two sal-animate" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800">
                                <h3 class="title text-center mb-5">
                                    {{ __('web.Registration') }}
                                </h3>
                                @include('cpanel.includes.alerts')
                            </div>
                            <form id="contact-form-contact"  enctype="multipart/form-data"
                                  action="{{ route('register') }}" method="post">
                                @csrf

                                <div class="row">
                                    <p class="text-center">{{ __('web.User Type, what account type?') }}</p>

                                    <div class="col-lg-12 radio-with-Icon text-center">
                                        <p class="radioOption-Item" id="customer_type">
                                            <label for="BannerType1" class="radio-btn-icon">
                                                <i class="fa fa-user"></i>
                                                {{ __('web.Individual') }}
                                            </label>
                                            <input type="radio" checked name="type" id="BannerType1" value="CUSTOMER" class="ng-valid ng-dirty ng-touched ng-empty" aria-invalid="false" style="">
                                        </p>
                                        <p class="radioOption-Item" id="company_type">
                                            <label for="BannerType2">
                                                <i class="fa fa-institution"></i>
                                                {{ __('web.Company') }}
                                            </label>
                                            <input type="radio" name="type" id="BannerType2" value="COMPANY" class="ng-valid ng-dirty ng-touched ng-empty" aria-invalid="false" style="">
                                        </p>
                                    </div>
                                </div>

                                <input type="text" name="full_name" id="full_name"
                                       value="{{ old('full_name') }}"
                                       placeholder="{{ __('web.Full Name') }}" required="">

                                <input type="email" name="email" id="email"
                                       value="{{ old('email') }}"
                                       placeholder="{{ __('web.Email Address') }}" required="">

                                <input type="text" name="phone_number" id="phone_number"
                                       value="{{ old('phone_number') }}"
                                       placeholder="{{ __('web.Mobile Number') }}" required="">

                                <input type="password" name="password" id="password"
                                       placeholder="{{ __('web.New Password') }}" required="">

                                <input class="mb-5" type="password" name="password_confirmation" id="password_confirmation"
                                       placeholder="{{ __('web.Confirm Password') }}" required="">

                                <div class="row col-12">
                                    <div class="col-12 row company_type_div hidden">
                                        <input class="mb-5" type="text" name="tax_number" id="tax_number"
                                               placeholder="{{ __('web.Company tax number') }}" />

                                    </div>
                                    <label for="trade_license_file" class="p-0 col-6 mb-5 custom-file-upload company_type_div hidden">
                                        <span id="trade_license_file_icon" class="file-uploaded-icon">
                                            <i class="fa fa-check-circle"></i>
                                        </span>
                                        <i class="fa fa-cloud-upload"></i>
                                        {{ __('web.Trade License Image') }}
                                    </label>
                                    <input id="trade_license_file" name="trade_license_file" type="file"
                                           class="file_upload" style="display: none !important;"/>

                                    <label for="vat_certificate_file" class="p-0 col-6 mb-5 custom-file-upload company_type_div hidden">
                                        <span id="vat_certificate_file_icon" class="file-uploaded-icon">
                                            <i class="fa fa-check-circle"></i>
                                        </span>
                                        <i class="fa fa-cloud-upload"></i>
                                        {{ __('web.Vat Certificate Image') }}
                                    </label>
                                    <input id="vat_certificate_file" name="vat_certificate_file" type="file"
                                           class="file_upload" style="display: none !important;"/>

                                </div>
                                <button type="submit" class="m-auto rts-btn btn-primary radius-small">
                                    {{ __('web.Register') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-shape-area">
                <img src="{{ URL::asset("assets/web/images/category/shape/shape-01.svg") }}" alt="">
                <img src="{{ URL::asset("assets/web/images/category/shape/shape-02.svg") }}" alt="">
            </div>
        </div>
        <!-- Contact End -->
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('click', '#company_type', function() {
                $(".company_type_div").removeClass("hidden");
            });

            $('body').on('click', '#customer_type', function() {
                $(".company_type_div").addClass("hidden");
            });

            $('body').on('click', '.radioOption-Item label', function() {
                $('.radioOption-Item label').removeClass("radio-btn-icon");
                $(this).addClass("radio-btn-icon");
            });
        });
        document.getElementById('trade_license_file').addEventListener('change', function(event) {
            const icon = document.getElementById('trade_license_file_icon');
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                icon.style.display = 'inline';
            } else {
                icon.style.display = 'none';
            }
        });
        document.getElementById('vat_certificate_file').addEventListener('change', function(event) {
            const icon = document.getElementById('vat_certificate_file_icon');
            const file = event.target.files[0];
            if (file && file.type.startsWith('image/')) {
                icon.style.display = 'inline';
            } else {
                icon.style.display = 'none';
            }
        });
    </script>
@endpush
