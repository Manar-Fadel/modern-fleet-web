<div v-if="editModal != null" class="modal" role="dialog" data-modal="true" aria-modal="true"
     :id="editModal.edit_model_id">
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
                            Number
                        </label>
                        <input type="text" class="input" v-model="editModal.number" :name="editModal.number" :id="editModal.number">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Brand
                        </label>
                        <select type="text" class="select" @change="onBrandChange($event)"
                                v-model="editModal.brand_id" :name="editModal.brand_id" :id="editModal.brand_id">
                            <option value=""> -- Choose -- </option>
                            <option v-for="brand in brands" :value="brand.id">@{{ brand.name }}</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Description
                        </label>
                        <input v-model="editModal.description" :name="editModal.description" :id="editModal.description"
                               placeholder="Enter order description" type="text" class="input">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <button @click="storeOrder(editModal, key, index)" class="btn btn-success">
                            update
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
