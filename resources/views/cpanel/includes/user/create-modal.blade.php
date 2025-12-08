<div class="modal" role="dialog" data-modal="true" aria-modal="true" id="add_new_dealer">
    <div class="modal-content max-w-[600px] top-[15%]">
        <div class="modal-header py-4 px-5">
            Add New Dealer
            <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
                <i class="ki-filled ki-cross">
                </i>
            </button>
        </div>
        <div class="modal-body p-0 pb-5">
            <form class="card-body flex flex-col gap-5 p-10" enctype="multipart/form-data"
                  method="post" action="{{ route("admin.users.store") }}">
                @csrf
                <input type="hidden" name="type" id="name" value="DEALER">

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Full Name
                        </label>
                        <input type="text" class="input" name="full_name" id="full_name" placeholder="Enter user full name ">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Phone Number
                        </label>
                        <input type="text" class="input" name="phone_number" id="phone_number" placeholder="Enter Phone Number eg. 966591111111">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Email
                        </label>
                        <input type="text" class="input" name="email" id="email" placeholder="Enter email">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Password
                        </label>
                        <input type="password" class="input" name="password" id="password">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Password Confirmation
                        </label>
                        <input type="password" class="input" name="password_confirmation" id="password_confirmation">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-56">
                            Identity Number
                        </label>
                        <input type="text" class="input" name="id_number" id="id_number"
                               placeholder="Enter identity number">
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <input class="checkbox checkbox-sm" type="checkbox" value="1"
                               name="is_trusted" id="is_trusted" />
                        <span class="checkbox-label">
                           Is Trusted Dealer
                        </span>
                    </div>
                </div>

                <div class="flex flex-col gap-5">
                    <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                        <label class="form-label max-w-48">
                            showroom Doc
                        </label>
                        <input type="file" class="image-input" name="showroom_doc" id="showroom_doc">
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
