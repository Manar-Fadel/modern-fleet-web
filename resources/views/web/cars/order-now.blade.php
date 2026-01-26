@extends('web.layout.default')
@section('content')
<div id="app" class="rts-wrapper">
    <div class="rts-wrapper-inner">

        <!-- header area start -->
        @include("web.includes.header")
        <!-- header area end -->

        <section class="order-now-area rts-calculator-area" style="padding-top: 60px;">
            <div class="container">
                <div class="calculator-form-inner">
                    <h4 class="text-center mb--30">
                        {{ __('web.Order Cars You Need') }}
                    </h4>
                    <p class="text-center mb-3" style="color: #b36761">
                        <i class="far fa-info-circle"></i>
                        {{ __('web.You can order multiple brands in same order by clicking on Add another brand') }}
                    </p>
                    @include('cpanel.includes.vuejs-alerts')

                    <div class="row col-12">
                        <div class="col-9"></div>
                        <div class="col-3 mt-2 mb-2">
                            <button class="btn rts-btn btn-primary" @click="addNewRequest">
                                <i class="fa fa-plus" style="margin-left: 5px;"></i>
                                {{ __('web.Add Another Brand') }}
                            </button>
                        </div>
                    </div>

                    <input type="hidden" name="authed_user_id" id="authed_user_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="type" id="type" :value="'car'">

                    <div v-for="(request, index) in requests" :key="index" class="calculator-form-inner mb-10 border p-5">

                        <h6 class="text-center mb-3">
                            {{ __('web.Brand Request no.') }} @{{ index + 1 }}
                        </h6>

                        <div class="row col-12 single-wrapper-r">

                            <select class="col-6 col-lg-6 select-input" v-model="request.brand_id"
                                    @change="onBrandChange(index)">
                                <option value="">
                                    {{ __('web.Select Brand') }}
                                </option>
                                <option v-for="brand in brands" :value="brand.id">
                                    @{{ brand.name }}
                                </option>
                            </select>

                            <select class="select-input col-6 col-lg-6"
                                    v-model="request.model_id">
                                <option value="">
                                    {{ __('web.Select Car Model') }}
                                </option>
                                <option v-for="model in request.models" :value="model.id">
                                    @{{ model.name }}
                                </option>
                            </select>
                        </div>
                        <div class="row col-12 single-wrapper-r">
                             <select class="select-input col-6 col-lg-6"
                                     v-model="request.manufacturing_year_id">
                                <option value="">
                                    {{ __('web.Select Make Year') }}
                                </option>
                                <option v-for="year in years" :value="year.id">
                                    @{{ year.value }}
                                </option>
                            </select>

                            <input type="number" placeholder=" {{ __('web.Quantity') }}"
                                   class="text-input col-6 col-lg-6"
                                   v-model="request.quantity" />
                        </div>

                        <div class="row col-12 single-wrapper-r">
                            <div class="one-item"
                                 @if(app()->getLocale() == 'ar')
                                     style="width: 96% !important;margin-right: 1%;"
                                @else
                                     style="width: 96% !important;"
                                @endif>
                                <textarea rows="3" v-model="request.description"
                                          class="textarea-input"
                                          placeholder="{{ __('web.Description') }}"></textarea>
                            </div>
                        </div>

                        <div class="single-wrapper-r mt-3">
                            <div class="one-item"
                                 @if(app()->getLocale() == 'ar')
                                     style="width: 94% !important;margin-right: 2%;"
                                 @else
                                     style="width: 94% !important;"
                                @endif>

                                <label :for="`files-${index}`" class="p-0 col-6 mb-5 custom-file-upload">
                                    <i class="fa fa-cloud-upload active"></i>
                                    {{ __('web.Upload one or multi images') }}
                                </label>
                                <input type="file" :name="`files-${index}`" :id="`files-${index}`"
                                       multiple @change="onFileChange($event, index)" style="display: none !important;"/>
                            </div>
                            <div class="jumbotron">
                                <div class="row col-12">
                                    <div v-for="(image, key) in request.images" class="col-md-3" :id="key">
                                        <i class="far fa-trash eye-active" @click="removeImage(key)" style="position:relative;top:30px;right:25px;"></i>
                                        <img class="preview img-thumbnail" v-bind:ref="'image' +parseInt( key )" alt="" />
                                        @{{ image.name }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Remove Row -->
                        <button v-if="requests.length > 1"
                                class="btn btn-danger btn-sm mt-3 font-size-12"
                                @click="removeRequest(index)">
                            <i class="fa fa-trash"></i>
                            {{ __('web.Remove This Brand') }}
                        </button>

                    </div>

                    <div class="single-wrapper mt-5">
                        <button type="button" class="rts-btn radius-small btn-primary mb--20 m-auto"
                                @click="saveOrder()" :disabled="loading">
                            <img v-if="loading" style="width: 40px;height: 20px;" src="{{ asset("assets/media/images/spinning-dots.svg") }}" alt="" />
                            {{ __('web.Order Now') }}
                        </button>
                    </div>

                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/vue@3"></script>
    <script src="{{ asset("assets/web/vuejs/order-now.js") }}"></script>
@endpush
