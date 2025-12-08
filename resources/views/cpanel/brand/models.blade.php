<!-- Start of Model -->
@foreach($brands as $brand)
<div class="modal" role="dialog" data-modal="true" aria-modal="true" id="show_brand_models_{{$brand->id}}">
    <div class="modal-content top-[15%]" style="max-width: 1200px;">
        <div class="modal-header py-4 px-5">
            Brand {{ $brand->id }} / {{ $brand->name }} Models List
            <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
                <i class="ki-filled ki-cross">
                </i>
            </button>
        </div>
        <div class="modal-body scrollable-y py-0 mb-5 pl-6 pr-3 mr-3">
            <div class="flex grow gap-5 lg:gap-7.5">
                <div class="flex flex-col items-stretch grow gap-5 lg:gap-7.5">
                    <div class="card-body grid gap-5">
                        <div data-datatable="true" data-datatable-page-size="20">
                            <div class="scrollable-x-auto">
                                @if(count($brand->models) > 0)
                                    <table class="table table-auto table-border" data-datatable-table="true">
                                        <thead>
                                        <tr>
                                            <th class="min-w-[100px]">
                                               <span class="sort">
                                                <span class="sort-label font-normal text-gray-700">
                                                 #
                                                </span>
                                               </span>
                                            </th>
                                            <th class="min-w-[150px]">
                                               <span class="sort">
                                                <span class="sort-label font-normal text-gray-700">
                                                 ID
                                                </span>
                                               </span>
                                            </th>
                                            <th class="min-w-[180px]">
                                               <span class="sort">
                                                <span class="sort-label font-normal text-gray-700">
                                                 Name EN
                                                </span>
                                               </span>
                                            </th>
                                            <th class="min-w-[180px]">
                                               <span class="sort">
                                                <span class="sort-label font-normal text-gray-700">
                                                 Name AR
                                                </span>
                                               </span>
                                            </th>
                                            <th class="min-w-[180px]">
                                               <span class="sort">
                                                <span class="sort-label font-normal text-gray-700">
                                                 Created At
                                                </span>
                                               </span>
                                            </th>
                                            <th class="min-w-[100px]">
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                        @foreach($brand->models as $model)
                                            <tr>
                                                <td class="text-gray-800 font-normal">
                                                    {{ $i }}
                                                </td>
                                                <td class="text-gray-800 font-normal">
                                                    {{ $model->id }}
                                                </td>
                                                <td class="text-gray-800 font-normal">
                                                    {{ $model->model_name_en }}
                                                </td>
                                                <td class="text-gray-800 font-normal">
                                                    {{ $model->model_name_ar }}
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
                                                                    <a class="menu-link" href="{{ route("admin.brands.delete-model", ['id' => $model->id] ) }}">
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
                                    <p>There is no models yet</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endforeach
<!-- End of Model -->
