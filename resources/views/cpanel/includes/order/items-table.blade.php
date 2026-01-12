<table v-if="items != null && items.length > 0" class="table table-auto table-border" data-datatable-table="true">
    <thead>
        <tr>
            <th class="min-w-[100px]">
                 #
            </th>
            <th class="min-w-[150px]">
                Brand/ Model/ Year
            </th>
            <th class="min-w-[150px]">
                Quantity
            </th>
            <th class="min-w-[300px]">
               Description
            </th>
            <th class="min-w-[180px]">
                Images
            </th>

            <th class="min-w-[180px]">
              DateTime
            </th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="(item, itemIndex) in items" :key="itemIndex">
            <td class="text-gray-800 font-normal">
                @{{ item.id }}
            </td>
            <td class="text-gray-800 font-normal">
                @{{ item.brand_name }} / @{{ item.model_name }} / @{{ item.manufacturing_year_value }}
            </td>
            <td class="text-gray-800 font-normal">
                @{{ item.quantity }}
            </td>
            <td class="text-gray-800 font-normal">
                @{{ item.description }}
            </td>

            <td class="flex text-gray-800 font-normal" style="overflow: hidden;min-height: 60px;">
                <div class="mr-2.5" v-for="image in item.images" style="width: 100px;max-height: 60px;">
                    <a :href="image.url" target="_blank" style="width: 100px;max-height: 60px;">
                        <img :src="image.url" width="100px">
                    </a>
                </div>
            </td>
            <td class="text-gray-800 font-normal">
                @{{ item.created_at }}
            </td>
        </tr>
    </tbody>
</table>
