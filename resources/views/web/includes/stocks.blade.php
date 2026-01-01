<section class="rts-portfolio-area2 rts-section-gap" id="ourCarsSection">
    <div class="container">
        <div class="section-top d-flex justify-content-between align-items-end">
            <div class="section-title-area">
                <p class="sub-title wow fadeInUp" data-wow-delay=".1s" data-wow-duration=".8s">Select Car</p>
                <h2 class="section-title cw wow move-right">
                    {{ __('web.Our Amazing') }}
                    <span>{{ __('web.Cars') }}</span>
                </h2>
            </div>
            <div class="tab-area">
                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">
                            {{ __('web.All') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cars-tab" data-bs-toggle="tab" data-bs-target="#cars" type="button" role="tab" aria-controls="new-cars" aria-selected="true">
                            {{ __('web.Cars') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="heavy-vehicles-tab" data-bs-toggle="tab" data-bs-target="#heavy-vehicles" type="button" role="tab" aria-controls="used" aria-selected="false">
                            {{ __('web.Heavy Vehicles') }}
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="section-inner mt--80 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
            <div class=" tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <div class="row g-5">
                        @foreach($stock_cars as $model)
                        <div class="col-lg-4 col-md-6">
                            <div class="project-wrapper2">
                                <div class="image-area">
                                    <a href="{{ route('cars.view', ['id' => $model->id]) }}">
                                        @if(isset($model->mainImage))
                                            <img src="{{ $model->mainImage->url }}" alt="">
                                        @else
                                            <img src="{{ URL::asset("assets/web/images/car-vector.png") }}" alt="">
                                        @endif
                                    </a>
                                    <span class="tag">
                                        {{ __('web.New') }}
                                    </span>
                                    <a href="#" class="wishlist">
                                        <i class="fa-regular fa-heart"></i>
                                    </a>
                                    <a href="#" class="gallery-image">
                                        <img src="{{ asset('assets/web/images/icon/image.svg') }}" alt="">
                                        5
                                    </a>
                                </div>
                                <span class="price">{{ $model->price }} {{ __('web.SAR') }}</span>
                                <div class="content-area">
                                    <h6 class="title cw">
                                        <a href="{{ route('cars.view', ['id' => $model->id]) }}">
                                            {{ $model->brand->name }} / {{ $model->brandModel->name }} / {{ $model->year->year }}
                                        </a>
                                    </h6>
                                    <ul class="feature-area">
                                        <li>
                                            <img src="{{ asset('assets/web/images/portfolio/feature-icon/01.svg') }}" alt="">
                                            100 Miles
                                        </li>
                                        <li>
                                            <img src="{{ asset('assets/web/images/portfolio/feature-icon/02.svg') }}" alt="">
                                            Petrol
                                        </li>
                                        <li>
                                            <img src="{{ asset('assets/web/images/portfolio/feature-icon/03.svg') }}" alt="">
                                            Autometic
                                        </li>
                                    </ul>
                                    <div class="button-area">
                                        <p class="cw">$5000</p>
                                        <a href="{{ route('cars.view', ['id' => $model->id]) }}" class="rts-btn btn-primary radius-small">
                                            {{ __('web.View Details') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="tab-pane fade" id="cars" role="tabpanel" aria-labelledby="cars-tab">
                    <div class="row g-5">
                        <div class="col-lg-4 col-md-6">
                            <div class="project-wrapper2">
                                <div class="image-area">
                                    <a href="portfolio-details.html"><img src="assets/images/portfolio/04.webp" alt=""></a>
                                    <span class="tag">New</span>
                                    <a href="wishlist.html" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                    <a href="assets/images/portfolio/04.webp" class="gallery-image">
                                        <img src="assets/images/icon/image.svg" alt="">
                                        5
                                    </a>
                                </div>
                                <span class="price">14,000$</span>
                                <div class="content-area">
                                    <h6 class="title cw"><a href="portfolio-details.html">Thunderbolt Car</a>
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
                                        <p class="cw">$400</p>
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
                                    <span class="tag">New</span>
                                    <a href="wishlist.html" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                    <a href="assets/images/portfolio/05.webp" class="gallery-image">
                                        <img src="assets/images/icon/image.svg" alt="">
                                        5
                                    </a>
                                </div>
                                <span class="price">14,000$</span>
                                <div class="content-area">
                                    <h6 class="title cw"><a href="portfolio-details.html">Mercedes-Benz E-Class</a>
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
                                        <p class="cw">$400</p>
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
                                    <span class="tag">New</span>
                                    <a href="wishlist.html" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                    <a href="assets/images/portfolio/06.webp" class="gallery-image">
                                        <img src="assets/images/icon/image.svg" alt="">
                                        5
                                    </a>
                                </div>
                                <span class="price">14,000$</span>
                                <div class="content-area">
                                    <h6 class="title cw"><a href="portfolio-details.html">Ford Mustang Convertible</a>
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
                                        <p class="cw">$400</p>
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
                                </div>
                                <span class="price">14,000$</span>
                                <div class="content-area">
                                    <h6 class="title cw"><a href="portfolio-details.html">Mazda MX-5 Miata</a>
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
                                        <p class="cw">$400</p>
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
                                    <span class="tag">New</span>
                                    <a href="wishlist.html" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                    <a href="assets/images/portfolio/08.webp" class="gallery-image">
                                        <img src="assets/images/icon/image.svg" alt="">
                                        5
                                    </a>
                                </div>
                                <span class="price">14,000$</span>
                                <div class="content-area">
                                    <h6 class="title cw"><a href="portfolio-details.html">Honda Civic Hatchback</a>
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
                                        <p class="cw">$400</p>
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
                                    <span class="tag">New</span>
                                    <a href="wishlist.html" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                    <a href="assets/images/portfolio/09.webp" class="gallery-image">
                                        <img src="assets/images/icon/image.svg" alt="">
                                        5
                                    </a>
                                </div>
                                <span class="price">14,000$</span>
                                <div class="content-area">
                                    <h6 class="title cw"><a href="portfolio-details.html">Hyundai Veloster</a>
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
                                        <p class="cw">$400</p>
                                        <a href="portfolio-details.html" class="rts-btn btn-primary radius-small">View
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="heavy-vehicles" role="tabpanel" aria-labelledby="heavy-vehicles-tab">
                    <div class="row g-5">
                        <div class="col-lg-4 col-md-6">
                            <div class="project-wrapper2">
                                <div class="image-area">
                                    <a href="portfolio-details.html"><img src="assets/images/portfolio/07.webp" alt=""></a>
                                    <span class="tag">Used</span>
                                    <a href="wishlist.html" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                    <a href="assets/images/portfolio/07.webp" class="gallery-image">
                                        <img src="assets/images/icon/image.svg" alt="">
                                        5
                                    </a>
                                </div>
                                <span class="price">14,000$</span>
                                <div class="content-area">
                                    <h6 class="title cw"><a href="portfolio-details.html">Mazda MX-5 Miata</a>
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
                                        <p class="cw">$6650</p>
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
                                    <span class="tag">Used</span>
                                    <a href="wishlist.html" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                    <a href="assets/images/portfolio/08.webp" class="gallery-image">
                                        <img src="assets/images/icon/image.svg" alt="">
                                        7
                                    </a>
                                </div>
                                <span class="price">14,000$</span>
                                <div class="content-area">
                                    <h6 class="title cw"><a href="portfolio-details.html">Honda Civic Hatchback</a>
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
                                        <p class="cw">$6650</p>
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
                                    <span class="tag">New</span>
                                    <a href="wishlist.html" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                    <a href="assets/images/portfolio/09.webp" class="gallery-image">
                                        <img src="assets/images/icon/image.svg" alt="">
                                        5
                                    </a>
                                </div>
                                <span class="price">14,000$</span>
                                <div class="content-area">
                                    <h6 class="title cw"><a href="portfolio-details.html">Hyundai Veloster</a>
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
                                        <p class="cw">$400</p>
                                        <a href="portfolio-details.html" class="rts-btn btn-primary radius-small">View
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="project-wrapper2">
                                <div class="image-area">
                                    <a href="portfolio-details.html"><img src="assets/images/portfolio/04.webp" alt=""></a>
                                    <span class="tag">New</span>
                                    <a href="wishlist.html" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                    <a href="assets/images/portfolio/04.webp" class="gallery-image">
                                        <img src="assets/images/icon/image.svg" alt="">
                                        5
                                    </a>
                                </div>
                                <span class="price">14,000$</span>
                                <div class="content-area">
                                    <h6 class="title cw"><a href="portfolio-details.html">Thunderbolt Car</a>
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
                                        <p class="cw">$400</p>
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
                                    <span class="tag">New</span>
                                    <a href="wishlist.html" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                    <a href="assets/images/portfolio/05.webp" class="gallery-image">
                                        <img src="assets/images/icon/image.svg" alt="">
                                        5
                                    </a>
                                </div>
                                <span class="price">14,000$</span>
                                <div class="content-area">
                                    <h6 class="title cw"><a href="portfolio-details.html">Mercedes-Benz E-Class</a>
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
                                        <p class="cw">$400</p>
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
                                    <span class="tag">New</span>
                                    <a href="wishlist.html" class="wishlist"><i class="fa-regular fa-heart"></i></a>
                                    <a href="assets/images/portfolio/06.webp" class="gallery-image">
                                        <img src="assets/images/icon/image.svg" alt="">
                                        5
                                    </a>
                                </div>
                                <span class="price">14,000$</span>
                                <div class="content-area">
                                    <h6 class="title cw"><a href="portfolio-details.html">Ford Mustang Convertible</a>
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
                                        <p class="cw">$400</p>
                                        <a href="portfolio-details.html" class="rts-btn btn-primary radius-small">View
                                            Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#" class="rts-btn radius-small btn-border load-more-btn cw">Load More</a>
        </div>
    </div>
</section>
