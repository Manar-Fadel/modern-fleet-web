<div class="modal" role="dialog" data-modal="true" aria-modal="true" id="add_new_banner">
    <div class="modal-content max-w-[600px] top-[15%]">
        <div class="modal-header py-4 px-5">
           <h2>
               Add New News / Adv.
           </h2>
            <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
                <i class="ki-filled ki-cross">
                </i>
            </button>
        </div>
        <div class="modal-body p-0 pb-5">
            <p class="text-center p-2">
                <i class="ki ki-filled ki-information"></i>
                All required inputs marked with red <span class="text-danger">*</span>
            </p>

            <form class="card-body flex flex-col gap-5 p-10" enctype="multipart/form-data"
                  method="post" action="{{ route("admin.cars.store") }}">
                @csrf

                <div class="flex flex-col gap-5">

                    <div class="flex flex-col gap-5">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-48">
                                Description (English) <span class="text-danger">*</span>
                            </label>
                            <textarea rows="5" cols="100" placeholder="English Content of news as text, or description of advertisement if adv."
                                      name="description_en" id="description_en" class="textarea"></textarea>
                        </div>
                    </div>

                    <div class="flex flex-col gap-5">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-48">
                                Description (Arabic) <span class="text-danger">*</span>
                            </label>
                            <textarea rows="5" cols="100" placeholder="محتوى ونص الخبر باللغة العربية, او وصف الاعلان لو كان اعلان باللغة العربية ايضا"
                                      name="description_ar" id="description_ar" class="textarea"></textarea>
                        </div>
                    </div>

                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-48">
                            Make Year <span class="text-danger">*</span>
                        </label>
                        <select type="text" class="select" name="year_id" id="year_id">
                            <option value=""> -- Choose -- </option>
                            @foreach($years as $key => $year)
                                <option value="{{ $key }}">
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
                                <option value="{{ $key }}">
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
                        <input type="number" class="input" name="price" id="price">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-48">
                            Fuel Type
                        </label>
                        <input type="text" placeholder="Enter fuel type as text e.g Petrol" class="input"
                               name="fuel_type" id="fuel_type" value="Petrol">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-48">
                            Transmission
                        </label>
                        <input type="text" placeholder="Enter transmission as text e.g Automatic" class="input"
                               name="transmission" id="transmission" value="Automatic">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-48">
                            Engine
                        </label>
                        <input type="text" placeholder="Enter engine as text e.g Mazda RX-7" class="input"
                               name="engine" id="engine">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-48">
                            Drive Type
                        </label>
                        <input type="text" placeholder="Enter drive type as text e.g Race Car Drivers" class="input"
                               name="drive_type" id="drive_type">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-48">
                            Person
                        </label>
                        <input type="text" placeholder="Enter person as number e.g 5" class="input"
                               name="person" id="person">
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
                               name="is_slider_banner" id="is_slider_banner" />
                        <span class="checkbox-label">
                           Is Slider Banner
                        </span>
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <input class="checkbox checkbox-sm" type="checkbox" value="1"
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
        </div>
    </div>
</div>
