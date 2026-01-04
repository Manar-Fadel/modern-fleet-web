@extends('web.layout.default')
@section('content')

<style>
    .preview{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 150px;
        width: 90%;
        margin: auto;
    }
    .rts-calculator-area .calculator-form-inner .single-wrapper span textarea,
    .rts-calculator-area .calculator-form-inner .single-wrapper span input,
    .rts-calculator-area .calculator-form-inner .single-wrapper span select {
        background: var(--color-white);
        padding: 10px 55px;
        border-radius: 4px;
        border: 1px solid rgba(85, 85, 85, 0.15);
    }
    .nice-select{
        display: none !important;
    }
    .select-input, .text-input{
        display: inline !important;
        width: 46% !important;
        height: 48px !important;
        margin-right: 2%;
        margin-bottom: 10px;
        line-height: 48px !important;
        padding: 0 15px !important;
        border: 1px solid rgba(85, 85, 85, 0.15) !important;
        border-radius: 0 !important;
    }
    .textarea-input{
        display: inline !important;
        margin-bottom: 10px;
        padding: 0 15px !important;
        border: 1px solid rgba(85, 85, 85, 0.15) !important;
        border-radius: 0 !important;
    }
</style>
<div id="app" class="rts-wrapper">
    <div class="rts-wrapper-inner">
        <!-- header area start -->
        <!-- header area start -->
        @include('web.includes.index-header')
        <section class="rts-calculator-area" style="padding-top: 60px;">
            <div class="container">
                <div class="calculator-form-inner">
                    <h4 class="text-center mb--30">
                        {{ __('web.Request the Vehicles You Need') }}
                    </h4>
                    <p class="text-center mb-5" style="color: #b36761">
                        <i class="far fa-info-circle"></i>
                        {{ __('web.Specify either Vehicle brand, model & manufacturing year and add quantity you need') }}
                    </p>
                    @include('cpanel.includes.vuejs-alerts')
                    <input type="hidden" name="authed_user_id" id="authed_user_id" value="{{ auth()->id() }}">
                    <div class="single-wrapper-r">
                         <input class="text-input" type="hidden" v-model="addModal.type" :name="addModal.type" :id="addModal.type" />

                        <select class="select-input" name="brand_id" style="display: block !important;"
                                v-model="addModal.brand_id"
                                :name="addModal.brand_id" :id="addModal.brand_id"
                                @change="onBrandChange($event)">
                            <option value="">
                                {{ __('web.Select Brand') }}
                            </option>
                            <option v-for="brand in brands" :value="brand.id">
                                @{{ brand.name }}
                            </option>
                        </select>

                        <select name="model_id" class="select-input"
                                v-model="addModal.model_id"
                                :name="addModal.model_id" :id="addModal.model_id">
                            <option value="">
                                {{ __('web.Select Car Model') }}
                            </option>
                            <option v-for="model in models" :value="model.id">
                                @{{ model.name }}
                            </option>
                        </select>
                    </div>
                    <div class="single-wrapper-r">
                         <select name="manufacturing_year_id" class="select-input"
                                 v-model="addModal.manufacturing_year_id"
                                 :name="addModal.manufacturing_year_id" :id="addModal.manufacturing_year_id">
                            <option value="">
                                {{ __('web.Select Make Year') }}
                            </option>
                            <option v-for="year in years" :value="year.id">
                                @{{ year.value }}
                            </option>
                        </select>

                        <input type="number" name="quantity" v-model="addModal.quantity"
                                :name="addModal.quantity" :id="addModal.quantity" />
                    </div>

                    <div class="single-wrapper-r">
                        <div class="one-item"
                             @if(app()->getLocale() == 'ar')
                                 style="width: 94% !important;margin-right: 2%;"
                            @else
                                 style="width: 94% !important;"
                            @endif>
                            <textarea rows="3" v-model="addModal.description" class="textarea-input"
                                      :name="addModal.description" :id="addModal.description"
                                      placeholder="{{ __('web.part description') }}"></textarea>
                        </div>
                    </div>

                    <div class="single-wrapper-r mt-3">
                        <div class="one-item"
                             @if(app()->getLocale() == 'ar')
                                 style="width: 94% !important;margin-right: 2%;"
                             @else
                                 style="width: 94% !important;"
                            @endif>

                            <label for="files" class="p-0 col-6 mb-5 custom-file-upload">
                                <i class="fa fa-cloud-upload active"></i>
                                {{ __('web.Upload one or multi images') }}
                            </label>
                            <input type="file" multiple @change="onFileChange" name="files" id="files" style="display: none !important;"/>
                        </div>
                        <div class="jumbotron">
                            <div class="row col-12">
                                <div v-for="(image, key) in images" class="col-md-3" :id="key">
                                    <i class="far fa-trash eye-active" @click="removeImage(key)" style="position:relative;top:30px;right:25px;"></i>
                                    <img class="preview img-thumbnail" v-bind:ref="'image' +parseInt( key )" alt="" />
                                    @{{ image.name }}
                                </div>
                            </div>
                        </div>
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
