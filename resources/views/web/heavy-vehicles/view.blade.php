@extends('web.layout.default')
@section('content')

    <!-- progress area end -->
    <div class="rts-wrapper">
        <div class="rts-wrapper-inner">

            <!-- header area start -->
            @include('web.includes.header')
            <!-- header area end -->

            <div class="rts-portfolio-area inner rts-section-gapNew">
                <div class="container">
                    <div class="row g-5">
                        <div class="col-lg-8 mb-5">
                            @include('web.includes.alerts')
                            <div class="portfolio-details-area">
                                <div class="portfolio-slider-area mb--40">
                                    <div class="swiper projectSlider4">
                                        <div class="swiper-wrapper">

                                            <div class="swiper-slide">
                                                <div class="image">
                                                    @if(isset($model->mainImage))
                                                        <img src="{{ $model->mainImage->url }}" width="662" alt="{{ $model->description }}">
                                                    @else
                                                        <img src="{{ URL::asset("assets/web/images/car-vector.png") }}" width="662" alt="{{ $model->description }}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if(count($model->images) > 0)
                                        <div class="row col-12 col-lg-12 mt-5">
                                            @foreach($model->images as $image)
                                                <a href="{{ $image->url }}" target="_blank" class="image col-2"
                                                   style="width: 150px; height: 90px;display: flex">
                                                    <img src="{{ $image->url }}" style="width: 100%;" alt="">
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <h2 class="mb--30">
                                    {{ $model->description }}
                                </h2>
                                <p class="mb--30">
                                    {{ $model->description }}
                                </p>
                            </div>

                            @if($model->status == 'PAID' && $model->acceptedOffer instanceof \App\Models\PartOffer)
                                <div class="contact side-box mt-5">
                                    <h2>
                                        <i class="far fa-info-square active" style="font-size: 25px;margin: 0 10px;"></i>
                                        {{ __('web.Tracking Order') }}
                                    </h2>
                                    <div style="padding: 0 3rem;">
                                        @if(count($model->trackingStepsLogs) == 0)
                                            <p class="text-center">
                                                {{ __('web.Working on starting shipment process.') }}
                                            </p>
                                        @endif
                                        @foreach($model->trackingStepsLogs as $index => $log)
                                            <p class="mb-5" style="color: #000000; font-size: 18px;">
                                                {{ ++$index.'- ' }}
                                                {{ app()->getLocale() == 'ar' ? $log->trackingStep->step_title_ar : $log->trackingStep->step_title_en }}
                                                @if($log->status == 'DONE')
                                                    <span class="rts-btn btn-success radius-small step-span">
                                                    <i class="far fa-box-check"></i>
                                                    {{ __('web.done') }}
                                                </span>
                                                @elseif($log->status == 'ACTIVE')
                                                    <span class="rts-btn radius-small step-span" style="color: white; background-color: #405FF2;">
                                                    <i class="far fa-circle-dot"></i>
                                                    {{ __('web.in progress') }}
                                                </span>
                                                @else
                                                    <span class="rts-btn btn-warning radius-small step-span">
                                                    <i class="far fa-warning"></i>
                                                    {{ __('web.inactive step') }}
                                                </span>
                                                @endif
                                                <span style="color: gray; font-size: 12px;margin: 0 15px;">
                                                <br>
                                                ({{ app()->getLocale() == 'ar' ? $log->trackingStep->step_description_ar : $log->trackingStep->step_description_en }})
                                            </span>
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        </div>

                        <div class="col-lg-4 mb-5">
                            <div class="sticky-top">
                                <div class="left-side-bar">

                                    <div class="overview side-box">
                                        <h2>{{ __('web.Car Overview') }}</h2>

                                        <ul class="feature-list2">
                                            @if(isset($model->brand) && isset($model->brandModel))
                                                <li>
                                                    <img src="{{ URL::asset("assets/web/images/portfolio/feature-icon/09.svg") }}" alt="">
                                                    <div class="text">
                                                        <p>
                                                            {{ __('web.Brand/ Model') }}
                                                        </p>
                                                        <p>
                                                            {{ $model->brand->name }} / {{ $model->brandModel->name }}
                                                        </p>
                                                    </div>
                                                </li>
                                            @endif
                                            @if(isset($model->year))
                                                <li>
                                                    <img src="{{ URL::asset("assets/web/images/portfolio/feature-icon/09.svg") }}" alt="">
                                                    <div class="text">
                                                        <p>
                                                            {{ __('web.Manufacturing Year') }}
                                                        </p>
                                                        <p>
                                                            {{ $model->year->year }}
                                                        </p>
                                                    </div>
                                                </li>
                                            @endif
                                            @if(!empty($model->price))
                                                <li>
                                                    <img src="{{ URL::asset("assets/web/images/portfolio/calender.svg") }}" alt="">
                                                    <div class="text">
                                                        <p>
                                                            {{ __('web.Price') }}
                                                        </p>
                                                        <p>
                                                            {{ $model->price }} {{ __('web.SAR') }}
                                                        </p>
                                                    </div>
                                                </li>
                                            @endif
                                            @if(isset($model->category))
                                            <li>
                                                <img src="{{ URL::asset("assets/web/images/portfolio/feature-icon/12.svg") }}" alt="">
                                                <div class="text">
                                                    <p>
                                                        {{ __('web.Category') }}
                                                    </p>
                                                    <p>
                                                        {{ $model->category->name  }}
                                                    </p>
                                                </div>
                                            </li>
                                            @endif

                                            @if(!empty($model->condition))
                                            <li>
                                                <img src="{{ URL::asset("assets/web/images/portfolio/calender.svg") }}" alt="">
                                                <div class="text">
                                                    <p>
                                                        {{ __('web.Condition') }}
                                                    </p>
                                                    <p>
                                                        {{ __('web.'.$model->condition) }}
                                                    </p>
                                                </div>
                                            </li>
                                            @endif

                                            @if(!empty($model->fuel_type))
                                            <li>
                                                <img src="{{ URL::asset("assets/web/images/portfolio/calender.svg") }}" alt="">
                                                <div class="text">
                                                    <p>
                                                        {{ __('web.Fuel Type') }}
                                                    </p>
                                                    <p>
                                                        {{ __('web.'.$model->fuel_type) }}
                                                    </p>
                                                </div>
                                            </li>
                                            @endif

                                            @if(!empty($model->drive_type))
                                            <li>
                                                <img src="{{ URL::asset("assets/web/images/portfolio/calender.svg") }}" alt="">
                                                <div class="text">
                                                    <p>
                                                        {{ __('web.Drive Type') }}
                                                    </p>
                                                    <p>
                                                        {{ __('web.'.$model->drive_type) }}
                                                    </p>
                                                </div>
                                            </li>
                                            @endif

                                            @if(!empty($model->engine_capacity))
                                                <li>
                                                    <img src="{{ URL::asset("assets/web/images/portfolio/calender.svg") }}" alt="">
                                                    <div class="text">
                                                        <p>
                                                            {{ __('web.Engine Capacity') }}
                                                        </p>
                                                        <p>
                                                            {{ $model->engine_capacity }}
                                                        </p>
                                                    </div>
                                                </li>
                                            @endif

                                            @if(!empty($model->engine_power))
                                                <li>
                                                    <img src="{{ URL::asset("assets/web/images/portfolio/calender.svg") }}" alt="">
                                                    <div class="text">
                                                        <p>
                                                            {{ __('web.Engine Power') }}
                                                        </p>
                                                        <p>
                                                            {{ $model->engine_power }}
                                                        </p>
                                                    </div>
                                                </li>
                                            @endif

                                            @if(!empty($model->color))
                                                <li>
                                                    <img src="{{ URL::asset("assets/web/images/portfolio/calender.svg") }}" alt="">
                                                    <div class="text">
                                                        <p>
                                                            {{ __('web.Color') }}
                                                        </p>
                                                        <p>
                                                            <span style="width: 20px;height: 20px;background-color: {{$model->color}}"></span>
                                                        </p>
                                                    </div>
                                                </li>
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

