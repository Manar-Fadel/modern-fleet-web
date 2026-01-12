@extends('web.layout.default')
@section('content')

<div class="rts-wrapper">
    <div class="rts-wrapper-inner">
        <!-- header area start -->
        @include("web.includes.header")
        <!-- header area end -->

        <!-- Banner area start -->
        <section class="rts-banner-area-three">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="section-title-area">
                            <p class="sub-title wow fadeInUp" data-wow-delay=".1s" data-wow-duration=".8s">
                                {{ __('web.Shop With Confidence – Quality Vehicles') }}
                            </p>
                            <h1 class="section-title wow move-right">
                                {{ __('web.Where Your Choice Meets the Road — Discover Your Next Car Today') }}
                            </h1>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <p class="right-desc">
                            {{ __('web.Welcome to Modern Fleet, where innovation powers every journey. Discover a range of vehicles and fleet solutions designed to move you forward.') }}
                        </p>
                    </div>
                    <div class="col-lg-12">
                        <div class="select-inner">
                            <div class="select-area-down wow fadeInUp" data-wow-delay=".8s" data-wow-duration="1s">
                                <form action="#" method="get" accept-charset="utf-8">
                                    <div class="one-search-input">
                                        <select name="category_id" id="category_id" class="mySelect">
                                        <option value="" selected>{{ __('web.Category') }}</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @selected(request('category_id') == $category->id)>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>

                                    <div class="one-search-input">
                                        <select name="brand_id" id="brand_id" class="my_select2">
                                        <option value="" selected>{{ __('web.Brand') }}</option>
                                        @foreach($brands_list as $brand)
                                            <option value="{{ $brand->id }}"
                                                @selected(request('brand_id') == $brand->id)>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>

                                    <div class="one-search-input">
                                        <select name="my_select2" class="my_select2" id="brand_models_select">
                                            <option value="" selected>{{ __('web.Car Model') }}</option>
                                        </select>
                                    </div>

                                    <div class="one-search-input">
                                        <select name="year_id" id="year_id" class="my_select2">
                                        <option value="" selected>{{ __('web.Manufacturing Year') }}</option>
                                        @foreach($years as $year)
                                            <option value="{{ $year->id }}"
                                                @selected(request('year_id') == $year->id)>
                                                {{ $year->year }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>

                                    <button type="submit" class="rts-btn radius-small icon btn-primary">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.69 10.69L13 13M12.3333 6.68575C12.3333 9.826 9.796 12.3715 6.667 12.3715C3.53725 12.3715 1 9.826 1 6.6865C1 3.54475 3.53725 1 6.66625 1C9.796 1 12.3333 3.5455 12.3333 6.68575Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        {{ __('web.Search') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-hero">
            </div>
        </section>
        <!-- Banner area end -->

        <!-- Portfolio Area Start -->
        <section class="rts-portfolio-area2 area-3 rts-section-gapBottom">
            <div class="container">
                <div class="section-inner wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                    <div class=" tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="new-cars" role="tabpanel" aria-labelledby="new-cars-tab">
                            <div class="row g-5">
                                @foreach($models as $index => $model)
                                <div class="col-lg-4 col-md-6">
                                    <div class="project-wrapper2">
                                        <div class="image-area">
                                            <a href="{{ route('heavy-vehicles.view', ['id' => $model->id]) }}">
                                                @if(isset($model->mainImage))
                                                    <img src="{{ $model->mainImage->url }}" alt="{{ $model->description }}">
                                                @else
                                                    <img src="{{ URL::asset("assets/web/images/car-vector.png") }}" alt="{{ $model->description }}">
                                                @endif
                                            </a>
                                            <span class="tag">{{ __('web.New') }}</span>
                                            <a href="#" class="wishlist">
                                                <i class="fa-regular fa-heart"></i>
                                            </a>
                                            <a href="#" class="gallery-image">
                                                <img src="{{ asset('assets/web/images/icon/image.svg') }}" alt="">
                                                7
                                            </a>
                                        </div>
                                        <span class="price">
                                            {{ $model->price }} {{ __('web.SAR') }}
                                        </span>
                                        <div class="content-area">
                                            <h6 class="title ">
                                                <a href="{{ route('heavy-vehicles.view', ['id' => $model->id]) }}">
                                                    {{ $model->brand->name }} / {{ $model->brandModel->name }} / {{ $model->year->year }}
                                                </a>
                                            </h6>
                                            <ul class="feature-area">
                                                <li>
                                                    <i class="fa fa-car active-icon" style="font-size: 15px;"></i>
                                                    100 Miles
                                                </li>
                                                <li>
                                                    <i class="fa fa-car-mechanic active-icon" style="font-size: 15px;"></i>
                                                    Petrol
                                                </li>
                                                <li>
                                                    <i class="fa fa-info-circle active-icon" style="font-size: 15px;"></i>
                                                    Automatic
                                                </li>
                                            </ul>
                                            <div class="button-area">
                                                <p class="">{{ $model->price }} {{ __('web.SAR') }}</p>
                                                <a href="{{ route('heavy-vehicles.view', ['id' => $model->id]) }}" class="rts-btn btn-primary radius-small">
                                                    {{ __('web.View Details') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                   </div>

                    <div class="d-flex justify-content-center mt-5">
                        {{ $models->links() }}
                    </div>
                </div>
            </div>
            <div class="bg-shape-area">
                <img src="{{ asset('assets/web/images/category/shape/shape-01.svg') }}" alt="">
            </div>
        </section>
        <!-- Portfolio Area End -->
    </div>
</div>
@endsection
