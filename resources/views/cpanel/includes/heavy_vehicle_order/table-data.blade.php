<table class="table table-auto table-border" data-datatable-table="true">
    <thead>
    <tr>
        <th class="w-[60px]">
        </th>

        <th class="min-w-[180px]">
           <span class="sort">
            <span class="sort-label font-normal text-gray-700">
             Number
            </span>
           </span>
        </th>

        <th class="min-w-[250px]">
           <span class="sort asc">
                <span class="sort-label font-normal text-gray-700">
                 Items: Brand/ Model/ Year
                </span>
           </span>
        </th>

        <th class="min-w-[150px]">
           <span class="sort">
            <span class="sort-label font-normal text-gray-700">
             Status
            </span>
           </span>
        </th>

        <th class="min-w-[80px]">
           <span class="sort">
            <span class="sort-label font-normal text-gray-700">
             Offers Count
            </span>
           </span>
        </th>

        <th class="min-w-[180px]">
           <span class="sort">
            <span class="sort-label font-normal text-gray-700">
             DateTime
            </span>
           </span>
        </th>

        <th class="min-w-[250px]">
           <span class="sort">
            <span class="sort-label font-normal text-gray-700">
             Customer
            </span>
           </span>
        </th>

    </tr>
    </thead>
    <tbody>
    <tr v-for="(order, index) in orders_list" :key="index" :id="index"
        v-bind:class="order.order_color">

        <td class="text-center">
            <div class="menu flex-inline" data-menu="true">
                <div v-if="!order.is_trashed" class="menu-item" data-menu-item-offset="0, 10px" data-menu-item-placement="bottom-end" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                    <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
                        <i class="ki-filled ki-dots-vertical">
                        </i>
                    </button>
                    <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true">
                        <div class="menu-item">
                            <button class="menu-link" type="button"
                                    @click="viewModal(order)"
                                    :data-modal-toggle="order.view_model_id_toggle">
                                <span class="menu-icon">
                                     <i class="ki-filled ki-search-list">
                                     </i>
                                </span>
                                <span class="menu-title">
                                 View
                                </span>
                            </button>
                        </div>
                        <div class="menu-separator">
                        </div>
                        <div class="menu-item">
                            <button class="menu-link" :data-modal-toggle="order.change_status_model_id_toggle"
                                    @click="changeStatus(order, key, index)">
                                <span class="menu-icon">
                                     <i class="ki-filled ki-pin">
                                     </i>
                                </span>
                                <span class="menu-title">
                                 Change Status
                                </span>
                            </button>
                        </div>
                        <div class="menu-separator">
                        </div>
                        <div class="menu-item">
                            <button class="menu-link" @click="deleteOrder(order, key, index)">
                                <span class="menu-icon">
                                     <i class="ki-filled ki-trash">
                                     </i>
                                </span>
                                <span class="menu-title">
                                 Delete
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </td>

        <td class="text-gray-800 font-normal" :class="{'bg-success-light':order.is_active_last_long}">
            <button class="text-sm font-medium text-gray-900 hover:text-primary-active mb-px"
                    :data-modal-toggle="order.view_model_id_toggle" @click="viewModal(order)">
                <i v-if="order.is_trashed" class="ki-filled ki-tablet-delete" style="color: red;"></i>
                <i v-if="order.is_active_last_long == 1" class="ki-filled ki-copy-success" style="color: green;"></i>
                @{{ order.order_number }}
            </button>
        </td>
        <td class="text-gray-800 font-normal">
            <div v-for="item in order.items" class="flex items-center gap-2.5">
                <div class="flex flex-col">
                    <a class="text-sm font-medium text-gray-900 hover:text-primary-active mb-px" href="">
                        @{{ item.brand_name }} / @{{ item.model_name }} / @{{ item.manufacturing_year_value }}
                    </a>
                </div>
            </div>
        </td>

        <td  class="text-gray-800 font-normal">
            <span v-if="order.status == 'PENDING' || order.status == 'CANCELLED'"
                  class="badge badge-danger badge-outline rounded-[30px]">
                <span class="size-1.5 rounded-full bg-danger me-1.5">
                </span>
                 @{{ order.status }}
            </span>
            <span v-else-if="order.status == 'ACCEPTED'"  class="badge badge-primary badge-outline rounded-[30px]">
                <span class="size-1.5 rounded-full bg-danger me-1.5">
                    </span>
                     @{{ order.status }}
               </span>
            <span v-else class="badge badge-success badge-outline rounded-[30px]">
                <span class="size-1.5 rounded-full bg-danger me-1.5">
                </span>
                 @{{ order.status }}
           </span>
        </td>
        <td class="text-gray-800 font-normal">
            @{{ order.offers_count }}
        </td>

        <td class="text-gray-800 font-normal">
            @{{ order.created_at }}
        </td>

        <td class="text-gray-800 font-normal">
            @{{ order.user_name }} / @{{ order.user_mobile }}
        </td>

    </tr>
    </tbody>
</table>
