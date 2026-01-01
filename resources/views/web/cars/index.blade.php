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
                                Shop With Confidence – Quality Vehicles</p>
                            <h1 class="section-title wow move-right">
                                Where Meets the Road: Discover Next
                                <span>Car</span> Today
                            </h1>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <p class="right-desc">
                            Welcome to Autovault where innovation drives every journey. Discover a range of designed
                            to elevate your driving experience.
                        </p>
                    </div>
                    <div class="col-lg-12">
                        <div class="select-inner">
                            <div class="select-area-down wow fadeInUp" data-wow-delay=".8s" data-wow-duration="1s">
                                <form action="#" method="get" accept-charset="utf-8">
                                    @csrf
                                    <select name="category_id" id="category_id" class="mySelect">
                                        <option value="2" selected>{{ __('web.Category') }}</option>
                                        @foreach($heavy_vehicles_categories as $car_category)
                                            <option value="{{ $car_category->id }}"
                                                @selected(request('category_id') == $car_category->id)>
                                                {{ $car_category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <select name="brand_id" id="brand_id" class="my_select2">
                                        <option value="2" selected>{{ __('web.Brand') }}</option>
                                        @foreach($heavy_vehicles_brands_list as $brand)
                                            <option value="{{ $brand->id }}"
                                                @selected(request('brand_id') == $brand->id)>
                                                {{ $brand->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <select name="my_select2" class="my_select2" id="brand_models_select">
                                        <option value="" selected>{{ __('web.Car Model') }}</option>
                                    </select>

                                    <select name="year_id" id="year_id" class="my_select2">
                                        <option value="" selected>{{ __('web.Manufacturing Year') }}</option>
                                        @foreach($years as $year)
                                            <option value="{{ $year->id }}"
                                                @selected(request('year_id') == $year->id)>
                                                {{ $year->year }}
                                            </option>
                                        @endforeach
                                    </select>

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
                <img class="wow slideInRight" data-wow-delay=".5s" data-wow-duration="2s" src="assets/images/portfolio/10.webp" width="1555" alt="">
            </div>
        </section>
        <!-- Banner area end -->

        <!-- Portfolio Area Start -->
        <section class="rts-portfolio-area2 area-3 rts-section-gapBottom">
            <div class="container">
                <div class="section-top d-flex justify-content-between align-items-end">
                    <div class="section-title-area">
                        <p class="sub-title wow fadeInUp" data-wow-delay=".1s" data-wow-duration=".8s">
                            {{ __('web.Search Results') }}
                        </p>
                        <h2 class="section-title wow move-right">
                            {{ __('web.Choose your dream car') }}
                        </h2>
                    </div>
                </div>
                <div class="section-inner mt--80 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
                    <div class=" tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="new-cars" role="tabpanel" aria-labelledby="new-cars-tab">
                            <div class="row g-5">
                                <div class="col-lg-4 col-md-6">
                                    <div class="project-wrapper2">
                                        <div class="image-area">
                                            <a href="portfolio-details.html"><img src="assets/images/portfolio/04.webp" alt=""></a>
                                            <span class="tag">New</span>
                                            <a href="wishlist.html" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                            <a href="assets/images/portfolio/04.webp" class="gallery-image">
                                                <img src="assets/images/icon/image.svg" alt="">
                                                7
                                            </a>
                                        </div>
                                        <span class="price">14,000$</span>
                                        <div class="content-area">
                                            <h6 class="title "><a href="portfolio-details.html">Thunderbolt Car</a>
                                            </h6>
                                            <ul class="feature-area">
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/01.svg" alt="">
                                                    100 Miles
                                                </li>
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/02.svg" alt="">
                                                    Petrol
                                                </li>
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/03.svg" alt="">
                                                    Autometic
                                                </li>

                                            </ul>
                                            <div class="button-area">
                                                <p class="">$400</p>
                                                <a href="portfolio-details.html" class="rts-btn btn-primary radius-small">View
                                                    Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="project-wrapper2">
                                        <div class="image-area">
                                            <a href="portfolio-details.html"><img src="assets/images/portfolio/05.webp" alt=""></a>
                                            <span class="tag">Stocks</span>
                                            <a href="wishlist.html" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                            <a href="assets/images/portfolio/05.webp" class="gallery-image">
                                                <img src="assets/images/icon/image.svg" alt="">
                                                7
                                            </a>
                                        </div>
                                        <span class="price">14,000$</span>
                                        <div class="content-area">
                                            <h6 class="title "><a href="portfolio-details.html">Mercedes-Benz
                                                    E-Class</a>
                                            </h6>
                                            <ul class="feature-area">
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/01.svg" alt="">
                                                    100 Miles
                                                </li>
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/02.svg" alt="">
                                                    Petrol
                                                </li>
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/03.svg" alt="">
                                                    Autometic
                                                </li>

                                            </ul>
                                            <div class="button-area">
                                                <p class="">$400</p>
                                                <a href="portfolio-details.html" class="rts-btn btn-primary radius-small">View
                                                    Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="project-wrapper2">
                                        <div class="image-area">
                                            <a href="portfolio-details.html"><img src="assets/images/portfolio/06.webp" alt=""></a>
                                            <span class="tag">Featured</span>
                                            <a href="wishlist.html" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                            <a href="assets/images/portfolio/06.webp" class="gallery-image">
                                                <img src="assets/images/icon/image.svg" alt="">
                                                7
                                            </a>
                                        </div>
                                        <span class="price">14,000$</span>
                                        <div class="content-area">
                                            <h6 class="title "><a href="portfolio-details.html">Ford Mustang
                                                    Convertible</a>
                                            </h6>
                                            <ul class="feature-area">
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/01.svg" alt="">
                                                    100 Miles
                                                </li>
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/02.svg" alt="">
                                                    Petrol
                                                </li>
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/03.svg" alt="">
                                                    Autometic
                                                </li>

                                            </ul>
                                            <div class="button-area">
                                                <p class="">$400</p>
                                                <a href="portfolio-details.html" class="rts-btn btn-primary radius-small">View
                                                    Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="project-wrapper2">
                                        <div class="image-area">
                                            <a href="portfolio-details.html"><img src="assets/images/portfolio/07.webp" alt=""></a>
                                            <span class="tag">Trending</span>
                                            <a href="wishlist.html" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                            <a href="assets/images/portfolio/07.webp" class="gallery-image">
                                                <img src="assets/images/icon/image.svg" alt="">
                                                7
                                            </a>
                                        </div>
                                        <span class="price">14,000$</span>
                                        <div class="content-area">
                                            <h6 class="title "><a href="portfolio-details.html">Mazda MX-5 Miata</a>
                                            </h6>
                                            <ul class="feature-area">
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/01.svg" alt="">
                                                    100 Miles
                                                </li>
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/02.svg" alt="">
                                                    Petrol
                                                </li>
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/03.svg" alt="">
                                                    Autometic
                                                </li>

                                            </ul>
                                            <div class="button-area">
                                                <p class="">$400</p>
                                                <a href="portfolio-details.html" class="rts-btn btn-primary radius-small">View
                                                    Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="project-wrapper2">
                                        <div class="image-area">
                                            <a href="portfolio-details.html"><img src="assets/images/portfolio/08.webp" alt=""></a>
                                            <span class="tag">Trending</span>
                                            <a href="wishlist.html" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                            <a href="assets/images/portfolio/08.webp" class="gallery-image">
                                                <img src="assets/images/icon/image.svg" alt="">
                                                5
                                            </a>
                                        </div>
                                        <span class="price">14,000$</span>
                                        <div class="content-area">
                                            <h6 class="title "><a href="portfolio-details.html">Honda Civic
                                                    Hatchback</a>
                                            </h6>
                                            <ul class="feature-area">
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/01.svg" alt="">
                                                    100 Miles
                                                </li>
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/02.svg" alt="">
                                                    Petrol
                                                </li>
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/03.svg" alt="">
                                                    Autometic
                                                </li>

                                            </ul>
                                            <div class="button-area">
                                                <p class="">$400</p>
                                                <a href="portfolio-details.html" class="rts-btn btn-primary radius-small">View
                                                    Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="project-wrapper2">
                                        <div class="image-area">
                                            <a href="portfolio-details.html"><img src="assets/images/portfolio/09.webp" alt=""></a>
                                            <span class="tag">Stocks</span>
                                            <a href="wishlist.html" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                            <a href="assets/images/portfolio/09.webp" class="gallery-image">
                                                <img src="assets/images/icon/image.svg" alt="">
                                                7
                                            </a>
                                        </div>
                                        <span class="price">14,000$</span>
                                        <div class="content-area">
                                            <h6 class="title "><a href="portfolio-details.html">Hyundai Veloster</a>
                                            </h6>
                                            <ul class="feature-area">
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/01.svg" alt="">
                                                    100 Miles
                                                </li>
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/02.svg" alt="">
                                                    Petrol
                                                </li>
                                                <li>
                                                    <img src="assets/images/portfolio/feature-icon/03.svg" alt="">
                                                    Autometic
                                                </li>

                                            </ul>
                                            <div class="button-area">
                                                <p class="">$400</p>
                                                <a href="portfolio-details.html" class="rts-btn btn-primary radius-small">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
