<div class="container-fixed">

    <div v-if="loading" class="flex flex-col gap-2.5">
        <img src="{{ asset("assets/media/images/3-dots-bounce.svg") }}" width="60px" height="60px" style="margin: 100px auto;">
    </div>

    <div class="grid gap-5 lg:gap-7.5">
        <!-- begin: activity -->
        <div class="flex gap-5 lg:gap-7.5">

            <p v-if="lists.length == 0 && !loading" style="margin: 50px auto;">
                There is no orders in selected filters (year, month, others)
            </p>

            <div :class="{displayactive:!loading}" id="dates-div" class="flex flex-col gap-2.5 hidden" style="min-width: 120px;" data-tabs="true">
                <button v-for="(orders_list, key, index) in lists"
                   class="activity-link btn btn-sm text-gray-600 hover:text-primary tab-active:bg-primary-light tab-active:text-primary"
                   :class="{active:index==0}"
                   :data-tab-toggle="key" type="button"
                   @click="showOrders(key);">
                    @{{ key }} (@{{ orders_list.length }})
                </button>
            </div>

            <div :class="{displayactive:!loading}" class="hidden" id="dates-orders-div">
                <div v-for="(orders_list, key, index) in lists" class="activity-content card grow"
                     :class="{hidden:index>0}" :id="key">
                    <div class="card-header">
                        <h3 class="card-title">
                            Order in @{{ key }} ( @{{ orders_list.length }} orders)
                        </h3>
                    </div>

                    <div class="card card-grid min-w-full">
                        <div class="card-body">
                            @include("cpanel.includes.order.table-data")
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end: activity -->
    </div>
</div>

@include("cpanel.includes.order.edit-modal")
@include("cpanel.includes.order.change-status-modal")

