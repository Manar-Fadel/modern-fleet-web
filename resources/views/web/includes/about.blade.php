<section class="rts-about-area two rts-section-gap" id="abountUsSection">
    <div class="container">
        <div class="section-inner">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-image-area-two">
                        <div class="left wow scaleIn" data-wow-delay=".5s" data-wow-duration="1s">
                            <img src="{{ asset("assets/web/images/about/04.webp") }}" width="339" alt="">
                        </div>
                        <div class="right wow scaleIn" data-wow-delay=".5s" data-wow-duration="1s">
                            <img src="{{ asset("assets/web/images/about/05.webp") }}" width="280" alt="">
                            <div class="counter-area">
                                <h2 class="title"><span class="counter">1000</span><span>+</span></h2>
                                <p class="desc">
                                    {{ __('web.Car Sold Already') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content-area">
                        <div class="section-title-area">
                            <p class="sub-title wow fadeInUp" data-wow-delay=".1s" data-wow-duration="1s">
                                {{ __('web.About Us') }}
                            </p>
                            <h2 class="section-title cw wow move-right">
                                {{ $about_us_title }}
                            </h2>
                        </div>
                        <p class="desc dbc wow fadeInUp" data-wow-delay=".4s" data-wow-duration="1s">
                            {{ $about_us_text }}
                        </p>
                        <a href="{{ route('about-us') }}" class="rts-btn btn-primary radius-small wow fadeInUp" data-wow-delay=".6s" data-wow-duration="1s">
                            {{ __('web.Learn More') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-shape-area">
        <img src="{{ asset("assets/web/images/category/shape/shape-01.svg") }}" alt="">
        <img src="{{ asset("assets/web/images/category/shape/shape-02.svg") }}" alt="">
    </div>
</section>
