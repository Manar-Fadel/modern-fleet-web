@extends('cpanel.layout.default')
@section('content')

<!-- Content -->
<main class="grow content pt-5" id="content" role="content">
    <!-- Container -->
    <div class="container-fixed">
        <!-- begin: works -->
        <div class="flex flex-col items-stretch gap-5 lg:gap-7.5">
            <!-- begin: toolbar -->
            <div class="flex flex-wrap items-center gap-5 justify-between">
                <h3 class="text-lg text-gray-800 font-semibold">
                    All Brands
                </h3>
                <div class="btn-tabs" data-tabs="true">
                    <a class="btn btn-icon active" data-tab-toggle="#teams_cards" href="#">
                        <i class="ki-filled ki-category">
                        </i>
                    </a>
                    <a class="btn btn-icon" data-tab-toggle="#teams_list" href="#">
                        <i class="ki-filled ki-row-horizontal">
                        </i>
                    </a>
                </div>
            </div>
            <div class="flex justify-end pt-2.5">
                <button class="btn btn-primary" data-modal-toggle="#add_new_brand">
                    <i class="ki-filled ki-plus">
                    </i>
                    Add New Brand
                </button>
            </div>
            <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                @include("cpanel.includes.alerts")
            </div>
            <!-- end: toolbar -->
            <!-- begin: cards -->
            <div id="teams_cards">
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5 lg:gap-7.5">
                    @foreach($brands as $brand)
                    <div class="card">
                        <div class="menu mt-2.5 mr-2.5" data-menu="true" style="margin-left: auto;">
                            <div class="menu-item menu-item-dropdown" data-menu-item-offset="0, 10px" data-menu-item-placement="bottom-end" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                                <button class="menu-toggle btn btn-sm btn-icon text-gray-600 menu-item-show:text-gray-800 hover:text-gray-800">
                                    <i class="ki-filled ki-setting-2">
                                    </i>
                                </button>
                                <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true">

                                    <div class="menu-item">
                                        <button class="menu-link add_new_model_btn" data-brand-id="{{ $brand->id }}"
                                                data-modal-toggle="#add_new_model" >
                                            <span class="menu-icon">
                                             <i class="ki-filled ki-plus">
                                             </i>
                                            </span>
                                            <span class="menu-title">
                                             ADD Model
                                            </span>
                                        </button>
                                    </div>

                                    <div class="menu-separator">
                                    </div>

                                    <div class="menu-item">
                                        <a class="menu-link" href="{{ route("admin.brands.delete", ["id" => $brand->id]) }}">
                                            <span class="menu-icon">
                                             <i class="ki-filled ki-trash">
                                             </i>
                                            </span>
                                            <span class="menu-title">
                                             Delete
                                            </span>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-body grid gap-7 py-7.5">
                            <div class="grid place-items-center gap-4">
                                <img class="flex justify-center items-center size-20 rounded-full ring-1 ring-gray-300 bg-gray-100"
                                     src="{{ $brand->logo_url }}" alt="{{ $brand->name }}">
                                <div class="grid place-items-center">
                                    <a class="text-base font-medium text-gray-900 hover:text-primary-active mb-px" href="#">
                                        {{ $brand->brand_name_en }}
                                    </a>
                                    <span class="text-2sm text-gray-700 text-center">
                                      {{ $brand->brand_name_en }} /  {{ $brand->brand_name_ar }}
                                    </span>
                                </div>
                            </div>
                            <div class="grid">
                                <div class="flex items-center justify-between flex-wrap mb-3.5 gap-2">
                                 <span class="text-2xs text-gray-600 uppercase">
                                  Models
                                 </span>
                                <div class="flex flex-wrap gap-1.5">
                                    @if(count($brand->models) > 0)
                                        <?php $i = 1; ?>
                                        @foreach($brand->models as $model)
                                            @if($i > 3)
                                                @break
                                            @endif
                                          <span class="badge badge-sm badge-outline">
                                           {{ $model->name }}
                                          </span>
                                        <?php $i++ ?>
                                        @endforeach
                                    @endif
                                </div>
                                </div>
                                <div class="border-t border-gray-300 border-dashed">
                                </div>
                                <div class="flex items-center justify-between flex-wrap gap-2">
                                     <span class="text-2xs text-gray-600 uppercase">
                                      Models Count
                                     </span>
                                    <div class="flex flex-wrap gap-1.5">
                                        {{ count($brand->models) }} model
                                    </div>
                                </div>
                                <div class="border-t border-gray-300 border-dashed mb-3.5">
                                </div>
                                <div class="flex items-center justify-between flex-wrap my-2.5 gap-2">
                                     <span class="text-2xs text-gray-600 uppercase">
                                      Orders Count
                                     </span>
                                    <div class="flex flex-wrap gap-1.5">
                                        {{ count($brand->orders) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer justify-center">
                            <button class="btn btn-primary btn-sm" data-modal-toggle="#show_brand_models_{{$brand->id}}">
                                <i class="ki-filled ki-eye">
                                </i>
                                View Models
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="grid gap-5 mt-5 d-flex justify-content-between align-items-center">
                    <div class="pagination pagination-sm justify-content-end">
                        {{ $brands->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
            <!-- end: cards -->
            <!-- begin: list -->
            <div class="hidden" id="teams_list">
                <div class="flex flex-col gap-5 lg:gap-7.5">
                    @foreach($brands as $brand)
                    <div class="card p-7.5">
                        <div class="flex flex-wrap justify-between items-center gap-7">
                            <div class="flex items-center gap-4">
                                <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}" class="flex justify-center items-center size-14 shrink-0 rounded-full ring-1 ring-gray-300 bg-gray-100">
                                <div class="grid grid-col gap-1">
                                    <a class="text-base font-medium text-gray-900 hover:text-primary-active mb-px" href="#">
                                        {{ $brand->brand_name_en }}
                                    </a>
                                    <span class="text-2sm text-gray-700">
                                      {{ $brand->brand_name_en }} / {{ $brand->brand_name_ar }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex flex-wrap items-center gap-6 lg:gap-12">
                                <div class="grid gap-5 justify-end lg:text-right">
                                 <span class="text-2xs text-gray-600 uppercase">
                                  Models
                                 </span>
                                    <div class="flex gap-1.5">
                                        <?php $i = 1; ?>
                                        @foreach($brand->models as $model)
                                            @if($i > 3)
                                                @break
                                            @endif
                                            <span class="badge badge-sm badge-outline">
                                               {{ $model->model_name_en }}
                                            </span>
                                      <?php $i++ ?>
                                      @endforeach
                                    </div>
                                </div>
                                <div class="grid justify-end gap-6 lg:text-right">
                                    <div class="text-2xs text-gray-600 uppercase">
                                        Models Count
                                    </div>
                                    <div class="flex flex-wrap gap-1.5"> {{ count($brand->models) }} model </div>
                                </div>
                                <div class="grid justify-end gap-3.5 lg:text-right lg:min-w-24 shrink-0 max-w-auto">
                                 <span class="text-2xs text-gray-600 uppercase">
                                      Orders Count
                                 </span>
                                 <div class="flex flex-wrap gap-1.5">
                                        {{ count($brand->orders) }}
                                    </div>
                                </div>
                                <div class="grid justify-end min-w-20">
                                    <button class="btn btn-light btn-sm">
                                        <i class="ki-filled ki-eye">
                                        </i>
                                        View Models
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="grid gap-5 mt-5 d-flex justify-content-between align-items-center">
                    <div class="pagination pagination-sm justify-content-end">
                        {{ $brands->links() }}
                    </div>
                </div>
            </div>
            <!-- end: list -->
        </div>
        <!-- end: works -->
    </div>
    <!-- End of Container -->

    <!-- Start of Model -->
    <div class="modal" role="dialog" data-modal="true" aria-modal="true" id="add_new_brand">
        <div class="modal-content max-w-[600px] top-[15%]">
            <div class="modal-header py-4 px-5">
                Add New Brand
                <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
                    <i class="ki-filled ki-cross">
                    </i>
                </button>
            </div>
            <div class="modal-body p-0 pb-5">
                <form class="card-body flex flex-col gap-5 p-10" enctype="multipart/form-data"
                      method="post" action="{{ route("admin.brands.store") }}">
                    @csrf
                    <div class="flex flex-col gap-5">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Brand Name (AR)
                            </label>
                            <input class="input" name="name_ar" id="name_ar" placeholder="Enter brand name in arabic.." type="text">
                        </div>
                    </div>

                    <div class="flex flex-col gap-5">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Brand Name (EN)
                            </label>
                            <input class="input" name="name_en" id="name_en" placeholder="Enter brand name in english.." type="text">
                        </div>
                    </div>

                    <div class="flex flex-col gap-5">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Brand Image
                            </label>
                            <input type="file" class="image-input" id="image" name="image">
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
    <!-- End of Model -->

    <!-- Start of Model -->
    <div class="modal" role="dialog" data-modal="true" aria-modal="true" id="add_new_model">
        <div class="modal-content max-w-[600px] top-[15%]">
            <div class="modal-header py-4 px-5">
                Add New Model
                <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
                    <i class="ki-filled ki-cross">
                    </i>
                </button>
            </div>
            <div class="modal-body p-0 pb-5">
                <form class="card-body flex flex-col gap-5 p-10"
                      method="post" action="{{ route("admin.brands.store-model") }}">
                    @csrf
                    <input type="hidden" name="brand_id" id="brand_id">
                    <div class="flex flex-col gap-5">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Model Name (AR)
                            </label>
                            <input class="input" name="name_ar" id="name_ar" placeholder="Enter model name in arabic.." type="text">
                        </div>
                    </div>

                    <div class="flex flex-col gap-5">
                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                            <label class="form-label max-w-56">
                                Model Name (EN)
                            </label>
                            <input class="input" name="name_en" id="name_en" placeholder="Enter model name in english.." type="text">
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
    <!-- End of Model -->
</main>
<!-- End of Content -->
@include("cpanel.brand.models")
@endsection

@push('scripts')
    <script>
        $(".add_new_model_btn").click(function () {
            var brand_id =  $(this).attr('data-brand-id');
            $("#brand_id").val(brand_id);

        });
    </script>
@endpush


