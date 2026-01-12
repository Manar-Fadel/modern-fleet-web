<section class="rts-portfolio-area2 rts-section-gap" id="ourCarsSection">
    <div class="container">
        <div class="section-top d-flex justify-content-between align-items-end">
            <div class="section-title-area">
                <p class="sub-title wow fadeInUp" data-wow-delay=".1s" data-wow-duration=".8s">
                    {{ __('web.Order on demand') }}
                </p>
                <h2 class="section-title cw wow move-right">
                    {{ __('web.header Cars') }}
                </h2>
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
                                            <i class="fa fa-car active-icon" style="font-size: 15px;"></i>
                                            100 Miles
                                        </li>
                                        <li>
                                            <i class="fa fa-car-mechanic active-icon" style="font-size: 15px;"></i>
                                            Petrol
                                        </li>
                                        <li>
                                            <i class="fa fa-info-circle active-icon" style="font-size: 15px;"></i>
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
            </div>
            <a href="{{ route('results', ['type' => 'cars']) }}" class="rts-btn radius-small btn-border load-more-btn cw">
                {{ __('web.Load More') }}
            </a>
        </div>
    </div>
</section>
