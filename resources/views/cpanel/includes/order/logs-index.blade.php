  <table v-if="logs.length > 0" class="table table-auto table-border" data-datatable-table="true">
    <thead>
    <tr>
        <th class="min-w-[100px]">
             ID
        </th>
        <th class="min-w-[250px]">
             Action
        </th>
        <th class="min-w-[150px]">
             User
        </th>
        <th class="min-w-[150px]">
            Part
        </th>
        <th class="min-w-[250px]">
            Part User
        </th>
        <th class="min-w-[250px]">
            Offer Number
        </th>
        <th class="min-w-[250px]">
            Code
        </th>
        <th class="min-w-[250px]">
            Date
        </th>
        <th class="min-w-[250px]">
            Time
        </th>
    </tr>
    </thead>
    <tbody>
        <tr v-for="log in logs">
            <td class="text-gray-800 font-normal">
                @{{ log.id }}
            </td>
            <td class="text-gray-800 font-normal">
                @{{ log.description_ar }}
            </td>
            <td class="text-gray-800 font-normal">
                @{{ log.user_name }}, @{{ log.user_mobile }}
                <span class="badge badge-primary badge-outline rounded-[30px]">
                     @{{ log.user_type }}
               </span>
            </td>
            <td class="text-gray-800 font-normal">
                <button class="text-sm font-medium text-gray-900 hover:text-primary-active mb-px" style="color: blue"
                        :data-modal-toggle="log.view_model_id_toggle" @click="viewModal(log.part)">
                    @{{ log.part_info }}
                </button>
            </td>
            <td class="text-gray-800 font-normal">
                @{{ log.part_user_info }}
            </td>
            <td class="text-gray-800 font-normal">
                @{{ log.offer_info }}
            </td>
            <td class="text-gray-800 font-normal">
                @{{ log.operation_code }}
            </td>
            <td class="text-gray-800 font-normal">
                @{{ log.created_at_date }}
            </td>
            <td class="text-gray-800 font-normal">
                @{{ log.created_at_time }}
            </td>
        </tr>
    </tbody>
</table>
