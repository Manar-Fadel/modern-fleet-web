<section class="rts-newsletter-area rts-section-gapBottom">
    <div class="container">
        <div class="newsletter-inner">
            <h2 class="title cw mb-0">
                {{ __('web.Join Our Newsletter') }}
            </h2>
            <form action="#">
                <div class="input-wrapper">
                    <input id="email" type="email" name="email"
                           @if($local == 'ar') style="padding: 15px 24px 15px 140px;" @endif
                           placeholder="{{ __('web.Enter your email') }}" required>
                    <button type="submit" class="rts-btn btn-primary radius-small"
                    @if($local == 'ar') style="right: auto;left: 8px;" @endif>
                        {{ __('web.Subscribe') }}
                    </button>
                </div>
            </form>
            <img src="{{ asset('assets/web/images/cta/shape-01.svg') }}" alt="" class="shape one">
            <img src="{{ asset('assets/web/images/cta/shape-02.svg') }}" alt="" class="shape two">
            <img src="{{ asset('assets/web/images/cta/shape-03.svg') }}" alt="" class="shape three">
        </div>
    </div>
</section>
