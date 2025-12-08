<div class="modal" role="dialog" data-modal="true" aria-modal="true" id="update_profile_info">
    <div class="modal-content max-w-[600px] top-[15%]">
        <div class="modal-header py-4 px-5">
            Update Profile Info
            <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
                <i class="ki-filled ki-cross">
                </i>
            </button>
        </div>
        <div class="modal-body p-0 pb-5">
            <form class="card-body flex flex-col gap-5 p-10" enctype="multipart/form-data"
                  method="post" action="{{ route("admin.users.update", ['id' => $model->id]) }}">
                @csrf

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Full Name
                        </label>
                        <input type="text" class="input" name="full_name" id="full_name"
                               value="{{ $model->full_name }}" placeholder="Enter user full name">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Shop Name
                        </label>
                        <input type="text" class="input" name="shop_name" id="shop_name"
                               value="{{ $model->shop_name }}" placeholder="Enter shop name">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-48" for="document_url">
                            Representative National ID Image
                        </label>
                        <input type="file" class="image-input" name="document_url" id="document_url">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-48" for="commercial_registry_doc">
                            Commercial Registry Document
                        </label>
                        <input type="file" class="image-input" name="commercial_registry_doc" id="commercial_registry_doc">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-48">
                            Showroom license
                        </label>
                        <input type="file" class="image-input" name="" id="showroom_doc">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-48" for="tax_certificate_doc">
                            Tax certificate
                        </label>
                        <input type="file" class="image-input" name="tax_certificate_doc" id="tax_certificate_doc">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-48" for="national_address_certificate_doc">
                            National address certificate
                        </label>
                        <input type="file" class="image-input" name="national_address_certificate_doc" id="national_address_certificate_doc">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-48" for="representative_authorization_doc">
                            Representative authorization Document
                        </label>
                        <input type="file" class="image-input" name="representative_authorization_doc" id="representative_authorization_doc">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
