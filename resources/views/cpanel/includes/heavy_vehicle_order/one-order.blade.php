<div v-if="order != null" class="modal" role="dialog" data-modal="true" aria-modal="true"
     :id="order.view_model_id" :data-id="order.view_model_id">
    <div class="modal-content pt-7.5 my-[3%] w-full container-fixed px-5 overflow-hidden">
        <div class="modal-header p-0 border-0">
            Car Request Details ID: @{{ order.id }} /  @{{ order.order_number }}

            @include("cpanel.includes.vuejs-alerts")

            <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
                <i class="ki-filled ki-cross">
                </i>
            </button>
        </div>
        <div class="modal-body scrollable-y py-0 mb-5 pl-6 pr-3 mr-3">
            <div class="flex grow gap-5 lg:gap-7.5">
                <div class="flex flex-col items-stretch grow gap-5 lg:gap-7.5">

                    <div class="card pb-2.5" style="max-width: 1150px;">
                        <div class="card-header" id="part_data">
                            <h3 class="card-title">
                                Order Data
                            </h3>
                        </div>
                        <div class="card-table pb-3">
                            <table class="table align-middle text-sm text-gray-500">
                                <tbody>
                                <tr>
                                    <td class="text-gray-700 text-2sm font-normal">
                                        Status:
                                        <span v-if="order.status == 'PENDING' || order.status == 'DECLINED'"
                                              class="badge badge-danger badge-outline rounded-[30px]">
                                                    <span class="size-1.5 rounded-full bg-danger me-1.5">
                                                    </span>
                                                      @{{ order.status }}
                                               </span>
                                        <span v-else-if="order.status == 'ACCEPTED' || order.status == 'CONFIRMED'" class="badge badge-primary badge-outline rounded-[30px]">
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
                                </tr>
                                <tr>
                                    <td class="text-gray-600 font-normal">
                                        Customer:
                                        @{{ order.user_name }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        Mob. @{{ order.user_mobile }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-gray-600 font-normal">
                                        Note: @{{ order.notes }}
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card pb-2.5">
                        <div class="card-header" id="offers_data">
                            <h3 class="card-title">
                                Order Items Data
                            </h3>
                        </div>

                        <div class="card-body grid gap-5">
                            <div data-datatable="true" data-datatable-page-size="20">
                                <div class="scrollable-x-auto">
                                    @include("cpanel.includes.order.items-table")
                                </div>
                            </div>
                        </div>
                    </div>

                    <div v-if="!isFromViewUser" class="card pb-2.5">
                        <div class="card-header" id="offers_data">
                            <h3 class="card-title">
                                Offers Data
                            </h3>
                        </div>

                        <div class="card-body grid gap-5">
                            <div data-datatable="true" data-datatable-page-size="20">
                                <div class="scrollable-x-auto">
                                    @include("cpanel.includes.order.offer.table")
                                    <div v-if="offersLoading" class="flex flex-col gap-2.5">
                                        <img src="{{ asset("assets/media/images/3-dots-bounce.svg") }}" width="30px" height="30px" style="margin: 20px auto;">
                                    </div>
                                    <p v-if="offers.length == 0">There is no offers yet</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

