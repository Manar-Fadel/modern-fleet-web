<section class="rts-popular-car rts-section-gap" id="ourHeavyVehiclesSection">
    <div class="container">
        <div class="section-top d-flex justify-content-between align-items-end">
            <div class="section-title-area">
                <p class="sub-title wow fadeInUp" data-wow-delay=".1s" data-wow-duration=".8s">
                    {{ __('web.Order on demand') }}
                </p>
                <h2 class="section-title cw wow move-right">
                    {{ __('web.header Heavy Vehicles') }}
                </h2>
            </div>
            <div class="tab-area">
                <ul class="nav nav-tabs" id="myTab3" role="tablist">
                    <?php $i = 1; ?>
                    @foreach($heavy_vehicles_categories_with_vehicles as $category)
                    <li class="nav-item" role="presentation">
                        <button @if($i == 1)
                                    class="nav-link active"
                                @else
                                    class="nav-link"
                                @endif id="cat-{{$category->id}}-tab" data-bs-toggle="tab" data-bs-target="#cat-{{$category->id}}" type="button" role="tab" aria-controls="cat-{{$category->id}}"
                                @if($i == 1)
                                    aria-selected="true"
                                @else
                                    aria-selected="false"
                                @endif>
                            {{ $category->name }}
                        </button>
                    </li>
                    <?php $i++; ?>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="section-inner mt--80 wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
            <div class=" tab-content" id="myTabContent2">
                <?php $i = 1; ?>
                @foreach($heavy_vehicles_categories_with_vehicles as $category)
                    <div @if($i == 1)
                             class="tab-pane fade show active"
                         @else
                             class="tab-pane fade"
                         @endif id="cat-{{$category->id}}" role="tabpanel" aria-labelledby="cat-{{$category->id}}-tab">
                    <div class="row g-5">
                        @foreach($category->heavyVehicles as $index => $model)
                            @if($index == 0 || $index == 1)
                            <div class="col-lg-6">
                            @endif
                                <div @if($index == 0)
                                         class="project-wrapper2 long"
                                     @else
                                         class="project-wrapper2 list-style mb--30"
                                    @endif>
                                    <div class="image-area">
                                        <a href="{{ route('heavy-vehicles.view', ['id' => $model->id]) }}">
                                            @if(isset($model->mainImage))
                                                <img src="{{ $model->mainImage->url }}" alt="{{ $model->description }}">
                                            @else
                                                <img src="{{ URL::asset("assets/web/images/car-vector.png") }}" alt="{{ $model->description }}">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="content-area">
                                        <h6 class="title cw">
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
                                                Autometic
                                            </li>
                                        </ul>
                                        <div class="button-area">
                                            <p class="cw">{{ $model->price }} {{ __('web.SAR') }}</p>
                                            <a href="{{ route('heavy-vehicles.view', ['id' => $model->id]) }}" class="rts-btn btn-primary radius-small">
                                                {{ __('web.View Details') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @if($index == 0)
                            </div>
                            @endif
                            @if($loop->last)
                            </div>
                            @endif
                      @endforeach
                    </div>
                </div>
                <?php $i++; ?>
                @endforeach
            </div>
        </div>
    </div>
</section>
