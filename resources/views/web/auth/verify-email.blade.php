@extends('web.layout.default')
@section('content')

<!-- progress area end -->
<div class="rts-wrapper">
    <div class="rts-wrapper-inner">
        <!-- header area start -->
        @include('web.includes.header')
        <!-- header area end -->

        <!-- Contact Start -->
        <div class="rts-category-area rts-contact-page-form-area rts-section-gapNew rts-section-gap account"
             style="padding-top: 30px;padding-bottom: 20px;margin-top: 0;background: white;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 m-auto" style="border: 1px solid #f5f5f5;border-radius: 10px;padding: 20px;box-shadow: 0px 24px 39px rgba(0, 0, 0, 0.05);">
                        <div class="mian-wrapper-form">
                            <div class="title-mid-wrapper-home-two sal-animate" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800">
                                <h4 class="title text-center">
                                    <i class="fa fa-inbox-arrow-down active"></i>
                                </h4>
                                @include('cpanel.includes.alerts')
                            </div>
                            <div id="contact-form-contact">
                                <p class="mt-5 mb-5 text-center text-1.5xl">
                                    {{ __('web.Email sent to your email address, please check your inbox and verify your email now.') }}
                                </p>
                                <a href="{{ route('verification.send') }}" class="rts-btn btn-black radius-small m-auto">
                                    {{ __('web.Resend') }}
                                </a>
                            </div>
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
