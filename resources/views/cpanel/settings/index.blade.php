@extends('cpanel.layout.default')
@section('content')

<!-- Content -->
<main class="grow content pt-5" id="content" role="content">
    <!-- Container -->
    <div class="container-fixed">
        <div class="flex flex-col items-stretch gap-5 lg:gap-7.5">
            <div class="flex flex-wrap items-center gap-5 justify-between mb-5">

                <h1 class="text-xl font-medium leading-none text-gray-900">
                    System Dynamics - Settings
                </h1>
                <div class="flex justify-end pt-2.5">
                    <a href="{{ route("admin.settings.list") }}" class="btn btn-primary">
                        <i class="ki-filled ki-plus">
                        </i>
                        List All Settings
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Container -->
    <!-- Container -->
    <div class="container-fixed">
        <div class="flex grow gap-5 lg:gap-7.5">
            <div class="hidden lg:block w-[230px] shrink-0">
                <div class="w-[230px]" data-sticky="true" data-sticky-animation="true" data-sticky-class="fixed z-[4] left-auto top-[calc(var(--tw-header-height)+1rem)]" data-sticky-name="scrollspy" data-sticky-offset="200" data-sticky-target="body">
                    <div class="flex flex-col grow relative before:absolute before:left-[11px] before:top-0 before:bottom-0 before:border-l before:border-gray-200" data-scrollspy="true" data-scrollspy-offset="80px|lg:110px" data-scrollspy-target="body">
                        <a class="flex items-center rounded-lg pl-2.5 pr-2.5 py-2.5 gap-1.5 active border border-transparent text-2sm text-gray-800 hover:text-primary hover:font-medium scrollspy-active:bg-secondary-active scrollspy-active:text-primary scrollspy-active:font-medium dark:hover:bg-coal-300 dark:hover:border-gray-100 hover:rounded-lg dark:scrollspy-active:bg-coal-300 dark:scrollspy-active:border-gray-100" data-scrollspy-anchor="true"
                           href="#basic_settings">
                           <span class="flex w-1.5 relative before:absolute before:top-0 before:size-1.5 before:rounded-full before:-translate-x-2/4 before:-translate-y-2/4 scrollspy-active:before:bg-primary">
                           </span>
                            General Settings
                        </a>
                     </div>
                </div>
            </div>
            <div class="flex flex-col items-stretch grow gap-5 lg:gap-7.5">
                <div class="card pb-2.5">
                    <div class="card-header" id="basic_settings">
                        <h3 class="card-title">
                            General Settings
                        </h3>
                    </div>
                    <div class="">
                        <form class="card-body grid gap-5" method="post" action="{{ route("admin.settings.update") }}">
                            @csrf
                            @foreach($settings as $setting)
                            @if(!in_array($setting->code_key, ['USAGE_POLICY_AR', 'USAGE_POLICY_EN',
                                        'TERM_CONDITION_AR', 'TERM_CONDITION_EN', 'SELLER_TERM_CONDITION_AR', 'SELLER_TERM_CONDITION_EN',
                                         'PRIVACY_POLICY_AR', 'PRIVACY_POLICY_EN']))
                            <div class="w-full">
                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label flex items-center gap-1 max-w-56">
                                    {{ $setting->name_en }}
                                </label>
                                @if(in_array($setting->code_key, ['SHOW_REQUEST_CITY_IN_SELLER_APP', 'CASH_PAYMENT_STATUS', 'SELLER_ACTIVATION_CONTROL_PANEL', 'CUSTOMER_ACTIVATION_CONTROL_PANEL']))
                                    <select class="select" name="{{ $setting->code_key }}" id="{{ $setting->code_key }}">
                                        <option value="active"
                                                @if($setting->value == 'active')
                                                    selected="true"
                                            @endif >Active</option>
                                        <option value="in_active"
                                                @if($setting->value == 'in_active')
                                                    selected="true"
                                            @endif >IN Active</option>
                                    </select>
                                @else
                                    <input name="{{ $setting->code_key }}" id="{{ $setting->code_key }}" class="input" type="text" value="{{ $setting->value }}" placeholder="{{ $setting->name_en }}"/>
                                @endif
                            </div>
                        </div>
                            @endif
                        @endforeach
                        <div class="flex justify-end pt-2.5">
                            <button type="submit" class="btn btn-primary">
                                Save Changes
                            </button>
                        </div>
                        </form>
                    </div>
                </div>

                <div class="card pb-2.5">
                    <div class="card-header" id="privacy_roles_settings">
                        <h3 class="card-title">
                            Privacy Roles Settings
                        </h3>
                    </div>

                    <div class="">
                        <form class="card-body grid gap-5" method="post" action="{{ route("admin.settings.update") }}">
                        @csrf
                        @foreach($settings as $setting)
                            @if(in_array($setting->code_key, ['USAGE_POLICY_AR', 'USAGE_POLICY_EN', 'TERM_CONDITION_AR',
                                        'TERM_CONDITION_EN', 'SELLER_TERM_CONDITION_AR', 'SELLER_TERM_CONDITION_EN',
                                        'PRIVACY_POLICY_AR', 'PRIVACY_POLICY_EN']))
                                    <div class="w-full">
                                        <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                            <label class="form-label flex items-center gap-1 max-w-56">
                                                {{ $setting->name_en }}
                                            </label>
                                            @if(in_array($setting->code_key, ['USAGE_POLICY_AR', 'USAGE_POLICY_EN',
                                           'TERM_CONDITION_AR', 'TERM_CONDITION_EN',
                                           'SELLER_TERM_CONDITION_AR', 'SELLER_TERM_CONDITION_EN',
                                           'PRIVACY_POLICY_AR', 'PRIVACY_POLICY_EN']))
                                                <textarea id="{{ $setting->code_key }}" class="textarea ck-content"
                                                      name="{{ $setting->code_key }}" cols="50" rows="20">
                                                    {{ $setting->value }}
                                            </textarea>
                                            @elseif( in_array($setting->code_key, []))
                                                <textarea class="textarea" name="{{ $setting->code_key }}"
                                                          id="{{ $setting->code_key }}" cols="50" rows="20">
                                                    {{ $setting->value }}
                                                </textarea>
                                            @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        <div class="flex justify-end pt-2.5">
                            <button type="submit" class="btn btn-primary">
                                Save Changes
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Container -->
</main>
<!-- End of Content -->

@endsection

@push('scripts')
    <script src="{{ URL::asset("assets/js/ckeditor/ckeditor-classic.bundle.js") }}"></script>
    <script>
        $(document).ready(function() {

            ClassicEditor.create(document.querySelector('#TERM_CONDITION_AR'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor.create(document.querySelector('#TERM_CONDITION_EN'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor.create(document.querySelector('#SELLER_TERM_CONDITION_AR'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor.create(document.querySelector('#SELLER_TERM_CONDITION_EN'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor.create(document.querySelector('#PRIVACY_POLICY_AR'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor.create(document.querySelector('#PRIVACY_POLICY_EN'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor.create(document.querySelector('#USAGE_POLICY_AR'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });

            ClassicEditor.create(document.querySelector('#USAGE_POLICY_EN'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });

        });
    </script>
@endpush
