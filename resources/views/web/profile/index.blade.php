@extends('web.layout.default')
@section('content')

<div class="rts-wrapper">
    <div class="rts-wrapper-inner">

        <!-- header area start -->
        @include('web.includes.header')
        <!-- header area end -->

        <div class="rts-category-area rts-contact-page-form-area rts-section-gapNew rts-section-gap account" style="margin-top: 0; padding-top: 30px; background: white;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <div class="mian-wrapper-form">
                            <div class="title-mid-wrapper-home-two sal-animate" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800">
                                <h3 class="title text-center mb-5">
                                    @if(!is_null(auth()->user()->email_verified_at))
                                        <i class="fa fa-check-circle text-success"  title="{{ __('web.Active Account') }}"></i>
                                    @else
                                        <i class="fa fa-check-circle text-danger" title="{{ __('web.Inactive Account') }}"></i>
                                    @endif
                                    {{ __('web.Profile Data') }}
                                </h3>
                                <p class="text-center mb-5">
                                    {{ __('web.your profile info') }}
                                </p>
                                @include('cpanel.includes.alerts')
                            </div>
                            <form id="contact-form-contact"  enctype="multipart/form-data" action="{{ route('profile') }}" method="post">
                                @csrf

                                <input type="text" name="full_name" id="full_name"
                                       value="{{  auth()->user()->full_name }}"
                                       placeholder="{{ __('web.Full name of the representative') }}" required="">

                                <input type="email" name="email" id="email" disabled="disabled"
                                       value="{{  auth()->user()->email }}"
                                       placeholder="{{ __('web.Email Address') }}" required="">

                                <input type="text" name="phone_number" id="phone_number" disabled="disabled"
                                       value="{{  auth()->user()->phone_number }}"
                                       placeholder="{{ __('web.Mobile Number') }}" required="">

                                @if(auth()->user()->type == 'COMPANY')
                                <input type="text" name="tax_number" id="tax_number"
                                       value="{{  isset($company) && !empty($company->tax_number) ? $company->tax_number: '' }}"
                                       placeholder="{{ __('web.Company tax number') }}" required="">

                                    <div class="row col-12">
                                    <label for="trade_license_file" class="p-0 col-6 mb-5 custom-file-upload">
                                        <span id="trade_license_file_icon" class="file-uploaded-icon">
                                            <i class="fa fa-check-circle"></i>
                                        </span>
                                        <i class="fa fa-cloud-upload"></i>
                                        {{ __('web.Trade License Image') }}
                                    </label>
                                    <input id="trade_license_file" name="trade_license_file" type="file"
                                           class="file_upload" style="display: none !important;"/>

                                    @if(isset($company) && !empty($company->trade_license_file))
                                        <a class="p-0 col-6 file-uploaded-download" href="{{ $company->trade_license_file }}" target="_blank">
                                            <i class="fa fa-download"></i>
                                            {{ __('web.Download Doc. Image') }}
                                        </a>
                                    @endif
                                </div>

                                <div class="row col-12">
                                    <label for="vat_certificate_file" class="p-0 col-6 mb-5 custom-file-upload">
                                        <span id="vat_certificate_file_icon" class="file-uploaded-icon">
                                            <i class="fa fa-check-circle"></i>
                                        </span>
                                        <i class="fa fa-cloud-upload"></i>
                                        {{ __('web.Vat Certificate Image') }}
                                    </label>
                                    <input id="vat_certificate_file" name="vat_certificate_file" type="file"
                                           class="file_upload" style="display: none !important;"/>

                                    @if(isset($company) && !empty($company->vat_certificate_file))
                                        <a class="p-0 col-6 file-uploaded-download" href="{{ $company->vat_certificate_file }}" target="_blank">
                                            <i class="fa fa-download"></i>
                                            {{ __('web.Download Doc. Image') }}
                                        </a>
                                    @endif
                                </div>
                                @endif

                                <button type="submit" class="m-auto rts-btn btn-primary radius-small">
                                    {{ __('web.Save') }}
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
