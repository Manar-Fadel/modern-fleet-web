<table v-if="part_logs.length > 0" class="table table-auto table-border" data-datatable-table="true">
    <thead>
    <tr>
        <th class="min-w-[100px]">
           <span class="sort">
            <span class="sort-label font-normal text-gray-700">
             ID
            </span>
           </span>
        </th>
        <th class="min-w-[250px]">
           <span class="sort">
            <span class="sort-label font-normal text-gray-700">
             Created At
            </span>
           </span>
        </th>
        <th class="min-w-[150px]">
           <span class="sort">
            <span class="sort-label font-normal text-gray-700">
             Description AR
            </span>
           </span>
        </th>
        <th class="min-w-[150px]">
           <span class="sort asc">
            <span class="sort-label font-normal text-gray-700">
             Description EN
            </span>
           </span>
        </th>
        <th class="min-w-[150px]">
           <span class="sort">
            <span class="sort-label font-normal text-gray-700">
             Operation Code
            </span>
           </span>
        </th>
        <th class="min-w-[250px]">
           <span class="sort">
            <span class="sort-label font-normal text-gray-700">
             Customer Name
            </span>
           </span>
        </th>
    </tr>
    </thead>
    <tbody>
        <tr v-for="(log, index) in part_logs">
            <td class="text-gray-800 font-normal">
                @{{ log.id }}
            </td>
            <td class="text-gray-800 font-normal">
                @{{ log.created_at }}
            </td>
            <td class="text-gray-800 font-normal">
                @{{ log.description_ar }}
            </td>
            <td class="text-gray-800 font-normal">
                @{{ log.description_en }}
            </td>
            <td class="text-gray-800 font-normal">
                @{{ log.operation_code }}
            </td>
            <td class="text-gray-800 font-normal">
                @{{ log.user_name }} - @{{ log.user_mobile }}
                <span class="badge badge-primary badge-outline rounded-[30px]">
                     @{{ log.user_type }}
               </span>
            </td>
        </tr>
    </tbody>
</table>
