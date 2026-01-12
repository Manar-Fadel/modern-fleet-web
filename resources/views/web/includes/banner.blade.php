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
                            <form action="{{ route('results', ['type' => 'cars']) }}" method="get" accept-charset="utf-8">
                                <select name="category_id" class="select-input mb-5">
                                    <option value="" selected>{{ __('web.Category') }}</option>
                                    @foreach($car_categories as $car_category)
                                        <option value="{{ $car_category->id }}">
                                            {{ $car_category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <select name="brand_id" id="car_brand_id" class="select-input  mb-5">
                                    <option value="" selected>{{ __('web.Brand') }}</option>
                                   @foreach($cars_brands_list as $brand)
                                       <option value="{{ $brand->id }}">
                                           {{ $brand->name }}
                                       </option>
                                   @endforeach
                                </select>

                                <select name="model_id" id="car_model_id" class="select-input mb-5">
                                    <option value="" selected>{{ __('web.Car Model') }}</option>
                                </select>

                                <select name="manufacturing_year_id" class="select-input mb-5">
                                    <option value="" selected>{{ __('web.Manufacturing Year') }}</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year->id }}">{{ $year->year }}</option>
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
                    <div class="tab-pane fade" id="used-car" role="tabpanel" aria-labelledby="used-car-tab">
                        <div class="select-area-down">
                            <form action="{{ route('results', ['type' => 'heavy_vehicles']) }}" method="get" accept-charset="utf-8">
                                <select name="category_id" class="select-input mb-5">
                                    <option value="" selected>{{ __('web.Category') }}</option>
                                    @foreach($heavy_vehicle_categories as $heavy_vehicle_category)
                                        <option value="{{ $heavy_vehicle_category->id }}">
                                            {{ $heavy_vehicle_category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <select name="brand_id" id="heavy_vehicle_brand_id" class="select-input mb-5">
                                    <option value="" selected>{{ __('web.Brand') }}</option>
                                    @foreach($heavy_vehicles_brands_list as $brand)
                                        <option value="{{ $brand->id }}">
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <select name="model_id" class="select-input mb-5" id="heavy_vehicle_model_id">
                                    <option value="" selected>{{ __('web.Car Model') }}</option>
                                </select>

                                <select name="manufacturing_year_id" class="select-input mb-5">
                                    <option value="" selected>{{ __('web.Manufacturing Year') }}</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year->id }}">{{ $year->year }}</option>
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
    </div>
</section>

@push('scripts')
<script>
    $(document).ready(function() {
        const carBrandSelect = document.getElementById('car_brand_id');
        const carModelSelect = document.getElementById('car_model_id');
        $('body').on('change', '#car_brand_id', function() {
            const brandId = this.value;
            carModelSelect.innerHTML = `<option value="">{{ __('web.Car Model') }}</option>`;
            if (!brandId) return;
            fetch(`/api/brands/${brandId}/models`)
                .then(response => response.json())
                .then(models => {
                    models.forEach(model => {
                        const option = document.createElement('option');
                        option.value = model.id;
                        option.textContent = model.name_en;
                        carModelSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error loading models:', error);
                });

            $("#car_model_id").trigger('change');
        });

        const brandSelect = document.getElementById('heavy_vehicle_brand_id');
        const modelSelect = document.getElementById('heavy_vehicle_model_id');
        brandSelect.addEventListener('change', function () {
            const brandId = this.value;
            modelSelect.innerHTML = `<option value="">{{ __('web.Car Model') }}</option>`;
            if (!brandId) return;
            fetch(`/api/brands/${brandId}/models`)
                .then(response => response.json())
                .then(models => {
                    models.forEach(model => {
                        const option = document.createElement('option');
                        option.value = model.id;
                        option.textContent = model.name_en;
                        modelSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error loading models:', error);
                });
        });

    });
</script>
@endpush
