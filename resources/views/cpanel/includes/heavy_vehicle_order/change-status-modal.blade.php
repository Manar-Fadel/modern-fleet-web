<div v-if="changeStatusModal != null" class="modal" role="dialog" data-modal="true" aria-modal="true"
     :id="changeStatusModal.change_status_model_id">
    <div class="modal-content max-w-[600px] top-[15%]">
        <div class="modal-header py-4 px-5">
            Update Order

            @include("cpanel.includes.vuejs-alerts")
            <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0 close-link" data-modal-dismiss="true">
                <i class="ki-filled ki-cross">
                </i>
            </button>
        </div>
        <div class="modal-body p-0 pb-5">
            <div class="card-body flex flex-col gap-5 p-10">
                @csrf
                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Status
                        </label>
                        <select type="text" class="select"
                                v-model="changeStatusModal.status"
                                :name="changeStatusModal.status" :id="changeStatusModal.status">
                            <option value=""> -- Choose -- </option>
                            @foreach($order_statuses as $order_status)
                            <option value="{{ $order_status->name }}">{{ $order_status->value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div v-if="changeStatusModal.status == 'ACCEPTED' || changeStatusModal.status == 'CONFIRMED'" class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Offer
                        </label>
                        <select type="text" class="select"
                                v-model="changeStatusModal.offer_id"
                                :name="changeStatusModal.offer_id" :id="changeStatusModal.offer_id">
                            <option value=""> -- Choose -- </option>
                            <option v-for="offer in offers" :value="offer.id">
                                @{{ offer.offer_number }}, @{{ offer.dealer_name }}, @{{ offer.price }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <button @click="postChangeStatus(changeStatusModal, key, index)" class="btn btn-success">
                            update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
