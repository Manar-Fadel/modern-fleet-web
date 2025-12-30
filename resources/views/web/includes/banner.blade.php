<section class="rts-banner-area two bg_image_two jarallax">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="banner-area-two">
                    <div class="banner-content-area">
                        <h1 class="title wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s">
                            {{ __('web.Unleash the Road: Discover Your Perfect') }}
                            <span>{{ __('web.cars') }}</span>
                            {{ __('web.Ride Today') }}
                        </h1>
                        <a href="{{ route('order-now') }}" class="rts-btn radius-small btn-primary wow fadeInUp" data-wow-delay=".6s" data-wow-duration="1s">
                            {{ __('web.Order Now') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="banner-right-side-two wow fadeInRight" data-wow-delay=".8s" data-wow-duration="1s">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="new-car-tab" data-bs-toggle="tab" data-bs-target="#new-car" type="button" role="tab" aria-controls="new-car" aria-selected="true">
                                {{ __('web.Cars') }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="used-car-tab" data-bs-toggle="tab" data-bs-target="#used-car" type="button" role="tab" aria-controls="used-car" aria-selected="false">
                                {{ __('web.Heavy Vehicles') }}
                            </button>
                        </li>
                    </ul>
                    <div class="tab-pane fade show active" id="new-car" role="tabpanel" aria-labelledby="new-car-tab">
                        <div class="select-area-down">
                            <form action="{{ route('cars.index') }}" method="get" accept-charset="utf-8">
                                <select name="brand_id" class="mySelect  mb-5">
                                    <option value="2" selected>{{ __('web.Brand') }}</option>
                                   @foreach($brands_list as $brand)
                                       <option value="{{ $brand->id }}">
                                           {{ $brand->name }}
                                       </option>
                                   @endforeach
                                </select>
                                <select name="my_select2" class="my_select2 mb-5">
                                    <option value="2" selected>Car Model</option>
                                    <option value="10">155</option>
                                    <option value="1">151</option>
                                    <option value="13">150</option>
                                    <option value="14">152</option>
                                    <option value="15">156</option>
                                </select>
                                <select name="my_select2" class="my_select2 mb-5">
                                    <option value="2" selected>Price</option>
                                    <option value="10">22,000$</option>
                                    <option value="1">27,000$</option>
                                    <option value="13">30,000$</option>
                                    <option value="14">32,000$</option>
                                    <option value="15">38,000$</option>
                                </select>
                                <select name="my_select2" class="my_select2 mb-5">
                                    <option value="2" selected>Location</option>
                                    <option value="10">USA</option>
                                    <option value="1">UK</option>
                                    <option value="13">Canada</option>
                                    <option value="14">Australia</option>
                                    <option value="15">China</option>
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
                    <div class="tab-pane fade" id="used-car" role="tabpanel" aria-labelledby="used-car-tab">
                        <div class="select-area-down">
                            <form action="{{ route('heavy-vehicles.index') }}" method="get" accept-charset="utf-8">
                                <select name="my_select" class="mySelect mb-5">
                                    <option value="2" selected>Car Make</option>
                                    <option value="10">Mazda</option>
                                    <option value="1">Citroen</option>
                                    <option value="13">Honda</option>
                                    <option value="14">Mitsubishi</option>
                                    <option value="15">Peugeot</option>
                                </select>
                                <select name="my_select2" class="my_select2 mb-5">
                                    <option value="2" selected>Car Model</option>
                                    <option value="10">155</option>
                                    <option value="1">151</option>
                                    <option value="13">150</option>
                                    <option value="14">152</option>
                                    <option value="15">156</option>
                                </select>
                                <select name="my_select2" class="my_select2 mb-5">
                                    <option value="2" selected>Price</option>
                                    <option value="10">22,000$</option>
                                    <option value="1">27,000$</option>
                                    <option value="13">30,000$</option>
                                    <option value="14">32,000$</option>
                                    <option value="15">38,000$</option>
                                </select>
                                <select name="my_select2" class="my_select2 mb-5">
                                    <option value="2" selected>Location</option>
                                    <option value="10">USA</option>
                                    <option value="1">UK</option>
                                    <option value="13">Canada</option>
                                    <option value="14">Australia</option>
                                    <option value="15">China</option>
                                </select>
                                <button type="submit" class="rts-btn radius-small icon btn-primary">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.69 10.69L13 13M12.3333 6.68575C12.3333 9.826 9.796 12.3715 6.667 12.3715C3.53725 12.3715 1 9.826 1 6.6865C1 3.54475 3.53725 1 6.66625 1C9.796 1 12.3333 3.5455 12.3333 6.68575Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                Search
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
