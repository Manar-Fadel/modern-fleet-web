<table v-if="offers != null && offers.length > 0" class="table table-auto table-border" data-datatable-table="true">
    <thead>
    <tr>
        <th class="min-w-[20px]">
            Actions
        </th>
        <th class="min-w-[100px]">
            #
        </th>
        <th class="min-w-[150px]">
            Total
        </th>
        <th class="min-w-[150px]">
            Vat
        </th>
        <th class="min-w-[300px]">
            Total with Vat
        </th>
        <th class="min-w-[100px]">
            Status
        </th>
        <th class="min-w-[180px]">
            Date/Time
        </th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(offer, offerIndex) in offers" :key="offerIndex">
        <td class="text-center">
            <div class="menu flex-inline" data-menu="true">
                <div class="menu-item" data-menu-item-offset="0, 10px" data-menu-item-placement="bottom-end" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                    <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
                        <i class="ki-filled ki-dots-vertical">
                        </i>
                    </button>
                    <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true">
                        <div class="menu-item">
                            <a class="menu-link"
                               :href="'/admin/car-quotations/edit/' + offer.id + '?type=heavy_vehicle' ">
                                    <span class="menu-icon">
                                     <i class="ki-filled ki-pencil">
                                     </i>
                                    </span>
                                <span class="menu-title">
                                     Edit
                                    </span>
                            </a>
                        </div>

                        <div class="menu-separator">
                        </div>
                        <div class="menu-item">
                            <a class="menu-link"
                               :href="'/admin/car-quotations/delete/' + offer.id ">
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
        <td class="text-gray-800 font-normal">
            @{{ offer.id }}
        </td>
        <td class="text-gray-800 font-normal">
            @{{ offer.total_amount }} SAR
        </td>
        <td class="text-gray-800 font-normal">
            @{{ offer.vat_amount }} SAR
        </td>
        <td class="text-gray-800 font-normal">
            @{{ offer.total_with_vat }} SAR
        </td>
        <td>
                <span v-if="offer.status == 'PENDING' || offer.status == 'DECLINED'" class="badge badge-danger badge-outline rounded-[30px]">
                    <span class="size-1.5 rounded-full bg-danger me-1.5">
                    </span>
                     @{{ offer.status }}
               </span>
            <span v-else-if="offer.status == 'ACCEPTED'" class="badge badge-primary badge-outline rounded-[30px]">
                    <span class="size-1.5 rounded-full bg-danger me-1.5">
                    </span>
                     @{{ offer.status }}
               </span>
            <span v-else class="badge badge-success badge-outline rounded-[30px]">
                    <span class="size-1.5 rounded-full bg-danger me-1.5">
                    </span>
                     @{{ offer.status }}
               </span>
        </td>
        <td class="text-gray-800 font-normal">
            @{{ offer.created_at }}
        </td>
    </tr>
    </tbody>
</table>
