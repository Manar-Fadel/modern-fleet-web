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
                        Slider Banners ({{ count($cars) }})
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                        @include("cpanel.includes.alerts")
                    </div>
                </div>
                <div class="flex justify-end pt-2.5">
                    <button class="btn btn-primary" data-modal-toggle="#add_new_banner">
                        <i class="ki-filled ki-plus">
                        </i>
                        Add New Slider Banner
                    </button>
                </div>
            </div>
        </div>
        <!-- End of Container -->

        <!-- Container -->
        <div class="container-fixed">
            <span class="grid gap-5 lg:gap-7.5">
                <span class="flex gap-5 lg:gap-7.5">
                    @if(count($cars) > 0)
                        <table class="table table-auto table-border" data-datatable-table="true">
                            <thead>
                                <tr>
                                    <th class="min-w-[50px]">
                                       <span class="sort">
                                        <span class="sort-label font-normal text-gray-700">
                                         #
                                        </span>
                                       </span>
                                    </th>
                                    <th class="min-w-[150px]">
                                       <span class="sort">
                                        <span class="sort-label font-normal text-gray-700">
                                            Image
                                        </span>
                                       </span>
                                    </th>
                                    <th class="min-w-[150px]">
                                       <span class="sort">
                                        <span class="sort-label font-normal text-gray-700">
                                         Brand/Model
                                        </span>
                                       </span>
                                    </th>
                                    <th class="min-w-[100px]">
                                       <span class="sort">
                                        <span class="sort-label font-normal text-gray-700">
                                            Fuel Type/ Transmission
                                        </span>
                                       </span>
                                    </th>
                                     <th class="min-w-[150px]">
                                       <span class="sort">
                                        <span class="sort-label font-normal text-gray-700">
                                            Price
                                        </span>
                                       </span>
                                    </th>
                                    <th class="min-w-[100px]">
                                       <span class="sort">
                                        <span class="sort-label font-normal text-gray-700">
                                         Description (AR)
                                        </span>
                                       </span>
                                    </th>
                                     <th class="min-w-[150px]">
                                       <span class="sort">
                                        <span class="sort-label font-normal text-gray-700">
                                            Banner Image
                                        </span>
                                       </span>
                                    </th>
                                    <th class="min-w-[150px]">
                                       <span class="sort">
                                        <span class="sort-label font-normal text-gray-700">
                                         Created At
                                        </span>
                                       </span>
                                    </th>
                                    <th class="min-w-[150px]">
                                       <span class="sort">
                                        <span class="sort-label font-normal text-gray-700">
                                         Action
                                        </span>
                                       </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($cars as $model)
                                <tr>
                                    <td class="text-gray-800 font-normal">
                                        {{ $i }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        <img alt="{{ $model->title_en }}" src="{{ $model->main_image_url }}" width="400px" height="200px;">
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->brand->name }} / {{ $model->carModel->name }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                       {{ $model->fuel_type }} / {{ $model->transmission }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->price }} SAR
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->description_ar }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        <img alt="{{ $model->title_en }}" src="{{ $model->slider_image_url }}" width="400px" height="200px;">
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->created_at }}
                                    </td>
                                     <td class="text-center">
                                        <div class="menu flex-inline" data-menu="true">
                                            <div class="menu-item" data-menu-item-offset="0, 10px" data-menu-item-placement="bottom-end" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                                                <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
                                                    <i class="ki-filled ki-dots-vertical">
                                                    </i>
                                                </button>
                                                <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true">
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route("admin.cars.edit", ['id' => $model->id] ) }}">
                                                            <span class="menu-icon">
                                                             <i class="ki-filled ki-pin">
                                                             </i>
                                                            </span>
                                                            <span class="menu-title">
                                                             Edit
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="menu-item">
                                                        <a class="menu-link" href="{{ route("admin.cars.delete-slider", ['id' => $model->id] ) }}">
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
                                    </td>
                                </tr>
                                <?php $i++ ?>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>There is no slider banners yet</p>
                    @endif
                </span>
            </span>
        </div>

        <!-- START OF MODAL -->
        @include('cpanel.includes.add-car-modal')

        <!-- End of Container -->
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
                        if(current_model_id === item.id){
                            optionHtml = '<option selected="true" value="' + item.id + '">' + item.name + '</option>';
                        }else{
                            optionHtml = '<option value="' + item.id + '">' + item.name + '</option>';
                        }
                        model_id.append(optionHtml);
                    });
                }
            });
        });
    </script>
@endpush
