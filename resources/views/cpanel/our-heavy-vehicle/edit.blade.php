@extends('cpanel.layout.default')
@section('content')
    <!-- Content -->
    <main class="grow content pt-5" id="content" role="content">
        <!-- Container -->
        <div class="container-fixed" id="content_container">
        </div>
        <!-- End of Container -->
        <!-- Container -->
        <div class="container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-gray-900">
                        Edit News/Adv. properties
                    </h1>
                    <p class="text-center p-2">
                        <i class="ki ki-filled ki-information"></i>
                        All required inputs marked with red <span class="text-danger">*</span>
                    </p>
                    <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                        @include("cpanel.includes.alerts")
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Container -->

        <!-- Container -->
        <div class="container-fixed">
        <span class="grid gap-5 lg:gap-7.5">
            <span class="flex gap-5 lg:gap-7.5">
                 <form class="card-body flex flex-col gap-5 p-10" enctype="multipart/form-data"
                       method="post" action="{{ route("admin.cars.update", ["id" => $model->id]) }}">

                        <input type="hidden" name="current_model_id" id="current_model_id" value="{{ $model->model_id }}">
                        @csrf
                        <div class="flex flex-col gap-5">
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-48">
                                    Description (English)
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea class="textarea" rows="5" cols="100" placeholder="English Content of news as text, or description of advertisement if adv."
                                          name="description_en" id="description_en">{{ $model->description_en }}</textarea>
                            </div>
                        </div>

                        <div class="flex flex-col gap-5">
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-48">
                                    Description (Arabic) <span class="text-danger">*</span>
                                </label>
                                <textarea class="textarea"  rows="5" cols="100" placeholder="محتوى ونص الخبر باللغة العربية, او وصف الاعلان لو كان اعلان باللغة العربية ايضا"
                                          name="description_ar" id="description_ar">{{ $model->description_ar }}</textarea>
                            </div>
                        </div>

                        <div class="flex flex-col gap-5">

                             <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-48">
                                    Make Year <span class="text-danger">*</span>
                                </label>
                                <select type="text" class="select" name="year_id" id="year_id">
                                    <option value=""> -- Choose -- </option>
                                    @foreach($years as $key => $year)
                                        <option value="{{ $key }}"
                                                @if($key == $model->year_id)
                                                    selected="selected"
                                                @endif>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-48">
                                    Brand <span class="text-danger">*</span>
                                </label>
                                <select type="text" class="select" name="brand_id" id="brand_id">
                                    <option value=""> -- Choose -- </option>
                                    @foreach($brands as $key => $brand)
                                        <option value="{{ $key }}"
                                                @if($key == $model->brand_id)
                                                    selected="selected"
                                                @endif>
                                            {{ $brand }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-48">
                                Model <span class="text-danger">*</span>
                            </label>
                            <select type="text" class="select" name="model_id" id="model_id">
                                <option></option>
                            </select>
                        </div>

                        <div class="flex flex-col gap-5">
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-48">
                                    Price (In SAR) <span class="text-danger">*</span>
                                </label>
                                <input type="number" class="input" name="price" id="price" value="{{ $model->price }}">
                            </div>
                        </div>

                        <div class="flex flex-col gap-5">
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-48">
                                    Fuel Type
                                </label>
                                <input type="text" placeholder="Enter fuel type as text e.g Petrol" class="input"
                                       name="fuel_type" id="fuel_type" value="{{ $model->fuel_type }}">
                            </div>
                        </div>

                        <div class="flex flex-col gap-5">
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-48">
                                    Transmission
                                </label>
                                <input type="text" placeholder="Enter transmission as text e.g Automatic" class="input"
                                       name="transmission" id="transmission" value="{{ $model->transmission }}">
                            </div>
                        </div>

                        <div class="flex flex-col gap-5">
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-48">
                                    Engine
                                </label>
                                <input type="text" placeholder="Enter engine as text e.g Mazda RX-7" class="input"
                                       name="engine" id="engine" value="{{ $model->engine }}">
                            </div>
                        </div>

                        <div class="flex flex-col gap-5">
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-48">
                                    Drive Type
                                </label>
                                <input type="text" placeholder="Enter drive type as text e.g Race Car Drivers" class="input"
                                       name="drive_type" id="drive_type" value="{{ $model->drive_type }}">
                            </div>
                        </div>

                        <div class="flex flex-col gap-5">
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-48">
                                    Person
                                </label>
                                <input type="text" placeholder="Enter person as number e.g 5" class="input"
                                       name="person" id="person" value="{{ $model->person }}">
                            </div>
                        </div>

                        <div class="flex flex-col gap-5">
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-48">
                                    Main Image (size 2width X 1height, eg. 700X400) <span class="text-danger">*</span>
                                </label>
                                <input type="file" class="image-input" name="main_image" id="main_image">
                            </div>
                        </div>

                        <div class="flex flex-col gap-5">
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-48">
                                    Slider Image (size 2width X 1height, eg. 1500X800)
                                </label>
                                <input type="file" class="image-input" name="slider_image" id="slider_image">
                            </div>
                        </div>

                        <div class="flex flex-col gap-5">
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <input class="checkbox checkbox-sm" type="checkbox" value="1"
                                       @if($model->is_slider_banner)
                                           checked="checked"
                                       @endif
                                       name="is_slider_banner" id="is_slider_banner" />
                                <span class="checkbox-label">
                                   Is Slider Banner
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-5">
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <input class="checkbox checkbox-sm" type="checkbox" value="1"
                                       @if($model->is_best_car)
                                           checked="checked"
                                       @endif
                                       name="is_best_car" id="is_best_car" />
                                <span class="checkbox-label">
                                   Is Main News
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-col gap-5">
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <button type="submit" class="btn btn-success">
                                    Save
                                </button>
                            </div>
                        </div>

                    </form>
            </span>
        </span>
        </div>
    </main>
@endsection
@push('scripts')
    <script>
        var model_id = $("#model_id");
        var current_model_id = $("#current_model_id").val();

        $("#brand_id").change(function () {
            var brand_id = $("#brand_id").val();
            $.ajax({
                type: "GET",
                url: "/admin/brands/models/" + brand_id,
                success: function (response) {
                    var models = response;
                    model_id.html("");
                    $.each(models, function (index, item) {
                        var optionHtml = '';
                        if(current_model_id == item.id){
                            optionHtml = '<option selected="true" value="' + item.id + '">' + item.name + '</option>';
                        }else{
                            optionHtml = '<option value="' + item.id + '">' + item.name + '</option>';
                        }
                        model_id.append(optionHtml);
                    });
                }
            });
        });

        $("#brand_id").change();
    </script>
@endpush
