@extends('web.layout.default')
@section('content')

<!-- progress area end -->
<div class="rts-wrapper">
    <div class="rts-wrapper-inner">
        <!-- header area start -->
        @include('web.includes.header')
        <!-- header area end -->

        <!-- Breadcrumb area start -->
        <!-- rts breadcrumb area start -->
        <div class="rts-breadcrumb-area portfolio-3 jarallax" style="height: 300px; padding: 3% 0;">
            <div class="container">
                <div class="breadcrumb-area-wrapper">
                    <h1 class="title">{{ __('web.Reset Password') }}</h1>
                    <div class="nav-bread-crumb">
                        <a href="{{ route('home') }}">{{ __('web.Home') }}</a>
                        <a href="#" class="current">{{ __('web.Reset Password') }}</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- rts breadcrumb area end -->
        <!-- Breadcrumb area end -->
        <!-- Contact Start -->
        <div class="rts-category-area rts-contact-page-form-area rts-section-gapNew rts-section-gap account" style="padding-top: 30px; margin-top: 0;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <div class="mian-wrapper-form">
                            <div class="title-mid-wrapper-home-two sal-animate" data-sal="slide-up" data-sal-delay="150" data-sal-duration="800">
                                <h3 class="title">
                                    {{ __('web.Reset Password') }}
                                </h3>
                                @include('cpanel.includes.alerts')
                            </div>
                            <form id="contact-form-contact" action="{{ route('password.update') }}" method="post">
                                @csrf
                                <input type="hidden" name="token" id="token" value="{{ $token }}">
                                <input type="email" name="email" id="email"
                                       placeholder="{{ __('web.Email Address') }}" required="">

                                <input type="password" name="password" id="password"
                                       placeholder="{{ __('web.Password') }}" required="">

                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       placeholder="{{ __('web.Confirm Password') }}" required="">

                                <button type="submit" class="rts-btn btn-primary radius-small" style="margin: auto;">
                                    {{ __('web.Reset Password') }}
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
