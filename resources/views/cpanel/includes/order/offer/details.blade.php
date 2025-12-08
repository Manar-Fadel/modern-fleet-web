<div class="container-fixed">
    <div v-if="loading" class="flex flex-col gap-2.5">
        <img src="{{ asset("assets/media/images/3-dots-bounce.svg") }}" width="60px" height="60px" style="margin: 100px auto;">
    </div>

    <div class="grid gap-5 lg:gap-7.5">
        <!-- begin: activity -->
        <div class="flex gap-5 lg:gap-7.5 scrollable-x-auto scrollable-x-hover scroll">

            <p v-if="lists.length == 0 && !loading">There is no offers in selected filters (year, month, others)</p>

            <div :class="{displayactive:!loading}" id="dates-div" class="flex flex-col gap-2.5 hidden" style="min-width: 120px;" data-tabs="true">
                <button v-for="(offers, key, iteration) in lists"
                        class="activity-link btn btn-sm text-gray-600 hover:text-primary tab-active:bg-primary-light tab-active:text-primary"
                        :class="{active:iteration==0}"
                        :data-tab-toggle="key"
                        @click="showOffers(key);">
                    @{{ key }} (@{{ offers.length }})
                </button>
            </div>

            <div :class="{displayactive:!loading}" class="hidden" id="dates-offers-div">
                <div v-for="(offers, key, iteration) in lists" class="activity-content card grow"
                     :class="{hidden:iteration>0}" :id="key">
                    <div class="card-header">
                        <h3 class="card-title">
                            Offers in @{{ key }} (@{{ offers.length }} offer)
                        </h3>
                    </div>

                    <div class="card card-grid min-w-full">
                        <div class="card-body">
                           @include("cpanel.includes.order.offer.table")
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- end: activity -->
    </div>
</div>

