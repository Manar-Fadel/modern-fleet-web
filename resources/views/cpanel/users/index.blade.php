@extends('cpanel.layout.default')
@section('content')

    <!-- Content -->
    <main class="grow content pt-5" id="content" role="content">
        <!-- Container -->
        <div class="container-fixed">
            <!-- begin: works -->
            <div class="flex flex-col items-stretch gap-5 lg:gap-7.5">
                <!-- begin: toolbar -->
                <div class="flex flex-wrap items-center gap-5 justify-between">
                    <h3 class="text-lg text-gray-800 font-semibold">
                        Dealers Accounts ({{ count($models) }})
                    </h3>
                    <button class="btn btn-sm btn-primary" data-modal-toggle="#add_new_dealer">
                        <i class="ki-filled ki-plus">
                        </i>
                        Add Dealer
                    </button>
                </div>
                @include("cpanel.includes.alerts")

                <form class="flex flex-wrap gap-2.5 lg:gap-5" method="get" action="{{ route("admin.users.index") }}">
                    <div class="flex flex-wrap gap-2 lg:gap-5">
                        <input name="search_word" id="search_word"
                               value="{{ isset($_GET['search_word']) ? $_GET['search_word'] : '' }}"
                               placeholder="Search by showroom name or delegate name, mobile or email" class="input"
                               style="width: 450px;"/>

                        <select name="trusted_status" id="trusted_status" class="select select-sm w-36">
                            <option value="">IS Trusted Dealer</option>
                            @foreach($trusted_statuses as $key => $trusted_status)
                                <option value="{{ $key }}"
                                    {{ isset($_GET['trusted_status']) && $_GET['trusted_status'] == $key ? "selected" : "" }}>
                                    {{ $trusted_status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-wrap gap-2 lg:gap-5">
                        <select name="year" id="year" class="select select-sm w-28">
                            <option value="">
                                Year
                            </option>
                            @foreach($years as $year)
                                <option
                                    value="{{ $year }}" {{ isset($_GET['year']) && $_GET['year'] == $year ? "selected":"" }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>

                        <select name="month" id="month" class="select select-sm w-28">
                            <option value="">
                                Month
                            </option>
                            @foreach($months as $key => $month)
                                <option
                                    value="{{ $key }}" {{ isset($_GET['month']) && $_GET['month'] == $key ? "selected":"" }}>
                                    {{ $month }}
                                </option>
                            @endforeach
                        </select>

                        <select name="week" id="week" class="select select-sm w-28">
                            <option value="">
                                Week
                            </option>
                            @foreach($weeks as $key => $week)
                                <option
                                    value="{{ $key }}" {{ isset($_GET['week']) && $_GET['week'] == $key ? "selected":"" }}>
                                    {{ $week }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-sm btn-outline btn-primary">
                            <i class="ki-filled ki-setting-4">
                            </i>
                            Filters
                        </button>

                    </div>
                </form>
                <!-- end: toolbar -->

                <!-- begin: cards -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 lg:gap-7.5">
                    @foreach($models as $model)
                        <div class="card">
                            <div
                                class="card-header card-rounded-t flex justify-end items-start relative p-0 bg-no-repeat bg-cover bg-center h-[120px]"
                                style="background-image: url({{ URL::asset('assets/media/avatars/bg-7.png') }})">
                                <div class="menu mt-2.5 mr-2.5" data-menu="true">
                                    <div class="menu-item" data-menu-item-offset="0, 10px"
                                         data-menu-item-placement="bottom-end" data-menu-item-toggle="dropdown"
                                         data-menu-item-trigger="click|lg:click">
                                        <button
                                            class="menu-toggle btn btn-sm btn-icon text-gray-600 menu-item-show:text-gray-800 hover:text-gray-800">
                                            <i class="ki-filled ki-setting-2">
                                            </i>
                                        </button>
                                        <div class="menu-dropdown menu-default w-full max-w-[175px]"
                                             data-menu-dismiss="true">
                                            <div class="menu-item">
                                                <a class="menu-link"
                                                   href="{{ route("admin.users.view", ["id" => $model->id]) }}">
                                            <span class="menu-icon">
                                             <i class="ki-filled ki-document">
                                             </i>
                                            </span>
                                                    <span class="menu-title">
                                             View
                                            </span>
                                                </a>
                                            </div>

                                            @if(is_null($model->email_verified_at))
                                                <div class="menu-item">
                                                    <a class="menu-link"
                                                       href="{{ route("admin.activate-email", ["id" => $model->id]) }}">
                                            <span class="menu-icon">
                                             <i class="ki-filled ki-book">
                                             </i>
                                            </span>
                                                        <span class="menu-title">
                                                Activate Email
                                            </span>
                                                    </a>
                                                </div>
                                            @else
                                                <div class="menu-item">
                                                    <a class="menu-link"
                                                       href="{{ route("admin.activate-email", ["id" => $model->id]) }}">
                                            <span class="menu-icon">
                                             <i class="ki-filled ki-book">
                                             </i>
                                            </span>
                                                        <span class="menu-title">
                                                Deactivate Email
                                            </span>
                                                    </a>
                                                </div>
                                            @endif

                                            @if(!$model->is_account_active)
                                                <div class="menu-item">
                                                    <a class="menu-link"
                                                       href="{{ route("admin.activate-account", ["id" => $model->id]) }}">
                                            <span class="menu-icon">
                                             <i class="ki-filled ki-book">
                                             </i>
                                            </span>
                                                        <span class="menu-title">
                                                Activate Account
                                            </span>
                                                    </a>
                                                </div>
                                            @else
                                                <div class="menu-item">
                                                    <a class="menu-link"
                                                       href="{{ route("admin.activate-account", ["id" => $model->id]) }}">
                                            <span class="menu-icon">
                                             <i class="ki-filled ki-book">
                                             </i>
                                            </span>
                                                        <span class="menu-title">
                                                Deactivate Account
                                            </span>
                                                    </a>
                                                </div>
                                            @endif

                                            @if(!$model->is_trusted)
                                                <div class="menu-item">
                                                    <a class="menu-link"
                                                       href="{{ route("admin.users.enable-trusted", ["id" => $model->id]) }}">
                                            <span class="menu-icon">
                                             <i class="ki-filled ki-book">
                                             </i>
                                            </span>
                                                        <span class="menu-title">
                                                Mark As Trusted
                                            </span>
                                                    </a>
                                                </div>
                                            @else
                                                <div class="menu-item">
                                                    <a class="menu-link"
                                                       href="{{ route("admin.users.enable-trusted", ["id" => $model->id]) }}">
                                            <span class="menu-icon">
                                             <i class="ki-filled ki-book">
                                             </i>
                                            </span>
                                                        <span class="menu-title">
                                                Mark As Not Trusted
                                            </span>
                                                    </a>
                                                </div>
                                            @endif

                                            <div class="menu-item">
                                                <a class="menu-link"
                                                   href="{{ route("admin.users.delete", ["id" => $model->id]) }}">
                                            <span class="menu-icon">
                                             <i class="ki-filled ki-trash">
                                             </i>
                                            </span>
                                                    <span class="menu-title">
                                             Delete
                                            </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="flex justify-center transform -translate-y-1/2">
                                    <div
                                        class="flex items-center justify-center relative text-1.5xl text-primary size-20 ring-1 ring-primary-clarity bg-primary-light rounded-full">
                                        Dealer
                                    </div>
                                </div>
                                <div class="flex items-center justify-center gap-1.5 mb-px -mt-7.5">
                                    @if($model->is_account_active == 1)
                                        <svg title="Active Account" class="text-primary" fill="none" height="16"
                                             viewbox="0 0 15 16" width="15" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14.5425 6.89749L13.5 5.83999C13.4273 5.76877 13.3699 5.6835 13.3312 5.58937C13.2925 5.49525 13.2734 5.39424 13.275 5.29249V3.79249C13.274 3.58699 13.2324 3.38371 13.1527 3.19432C13.0729 3.00494 12.9565 2.83318 12.8101 2.68892C12.6638 2.54466 12.4904 2.43073 12.2998 2.35369C12.1093 2.27665 11.9055 2.23801 11.7 2.23999H10.2C10.0982 2.24159 9.99722 2.22247 9.9031 2.18378C9.80898 2.1451 9.72371 2.08767 9.65249 2.01499L8.60249 0.957487C8.30998 0.665289 7.91344 0.50116 7.49999 0.50116C7.08654 0.50116 6.68999 0.665289 6.39749 0.957487L5.33999 1.99999C5.26876 2.07267 5.1835 2.1301 5.08937 2.16879C4.99525 2.20747 4.89424 2.22659 4.79249 2.22499H3.29249C3.08699 2.22597 2.88371 2.26754 2.69432 2.34731C2.50494 2.42709 2.33318 2.54349 2.18892 2.68985C2.04466 2.8362 1.93073 3.00961 1.85369 3.20013C1.77665 3.39064 1.73801 3.5945 1.73999 3.79999V5.29999C1.74159 5.40174 1.72247 5.50275 1.68378 5.59687C1.6451 5.691 1.58767 5.77627 1.51499 5.84749L0.457487 6.89749C0.165289 7.19 0.00115967 7.58654 0.00115967 7.99999C0.00115967 8.41344 0.165289 8.80998 0.457487 9.10249L1.49999 10.16C1.57267 10.2312 1.6301 10.3165 1.66878 10.4106C1.70747 10.5047 1.72659 10.6057 1.72499 10.7075V12.2075C1.72597 12.413 1.76754 12.6163 1.84731 12.8056C1.92709 12.995 2.04349 13.1668 2.18985 13.3111C2.3362 13.4553 2.50961 13.5692 2.70013 13.6463C2.89064 13.7233 3.0945 13.762 3.29999 13.76H4.79999C4.90174 13.7584 5.00275 13.7775 5.09687 13.8162C5.191 13.8549 5.27627 13.9123 5.34749 13.985L6.40499 15.0425C6.69749 15.3347 7.09404 15.4988 7.50749 15.4988C7.92094 15.4988 8.31748 15.3347 8.60999 15.0425L9.65999 14C9.73121 13.9273 9.81647 13.8699 9.9106 13.8312C10.0047 13.7925 10.1057 13.7734 10.2075 13.775H11.7075C12.1212 13.775 12.518 13.6106 12.8106 13.3181C13.1031 13.0255 13.2675 12.6287 13.2675 12.215V10.715C13.2659 10.6132 13.285 10.5122 13.3237 10.4181C13.3624 10.324 13.4198 10.2387 13.4925 10.1675L14.55 9.10999C14.6953 8.96452 14.8104 8.79176 14.8887 8.60164C14.9671 8.41152 15.007 8.20779 15.0063 8.00218C15.0056 7.79656 14.9643 7.59311 14.8847 7.40353C14.8051 7.21394 14.6888 7.04197 14.5425 6.89749ZM10.635 6.64999L6.95249 10.25C6.90055 10.3026 6.83864 10.3443 6.77038 10.3726C6.70212 10.4009 6.62889 10.4153 6.55499 10.415C6.48062 10.4139 6.40719 10.3982 6.33896 10.3685C6.27073 10.3389 6.20905 10.2961 6.15749 10.2425L4.37999 8.44249C4.32532 8.39044 4.28169 8.32793 4.25169 8.25867C4.22169 8.18941 4.20593 8.11482 4.20536 8.03934C4.20479 7.96387 4.21941 7.88905 4.24836 7.81934C4.27731 7.74964 4.31999 7.68647 4.37387 7.63361C4.42774 7.58074 4.4917 7.53926 4.56194 7.51163C4.63218 7.484 4.70726 7.47079 4.78271 7.47278C4.85816 7.47478 4.93244 7.49194 5.00112 7.52324C5.0698 7.55454 5.13148 7.59935 5.18249 7.65499L6.56249 9.05749L9.84749 5.84749C9.95296 5.74215 10.0959 5.68298 10.245 5.68298C10.394 5.68298 10.537 5.74215 10.6425 5.84749C10.6953 5.90034 10.737 5.96318 10.7653 6.03234C10.7935 6.1015 10.8077 6.1756 10.807 6.25031C10.8063 6.32502 10.7908 6.39884 10.7612 6.46746C10.7317 6.53608 10.6888 6.59813 10.635 6.64999Z"
                                                fill="currentColor">
                                            </path>
                                        </svg>
                                    @else
                                        <svg title="Inactive Account" class="text-danger" fill="none" height="16"
                                             viewbox="0 0 15 16" width="15" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M14.5425 6.89749L13.5 5.83999C13.4273 5.76877 13.3699 5.6835 13.3312 5.58937C13.2925 5.49525 13.2734 5.39424 13.275 5.29249V3.79249C13.274 3.58699 13.2324 3.38371 13.1527 3.19432C13.0729 3.00494 12.9565 2.83318 12.8101 2.68892C12.6638 2.54466 12.4904 2.43073 12.2998 2.35369C12.1093 2.27665 11.9055 2.23801 11.7 2.23999H10.2C10.0982 2.24159 9.99722 2.22247 9.9031 2.18378C9.80898 2.1451 9.72371 2.08767 9.65249 2.01499L8.60249 0.957487C8.30998 0.665289 7.91344 0.50116 7.49999 0.50116C7.08654 0.50116 6.68999 0.665289 6.39749 0.957487L5.33999 1.99999C5.26876 2.07267 5.1835 2.1301 5.08937 2.16879C4.99525 2.20747 4.89424 2.22659 4.79249 2.22499H3.29249C3.08699 2.22597 2.88371 2.26754 2.69432 2.34731C2.50494 2.42709 2.33318 2.54349 2.18892 2.68985C2.04466 2.8362 1.93073 3.00961 1.85369 3.20013C1.77665 3.39064 1.73801 3.5945 1.73999 3.79999V5.29999C1.74159 5.40174 1.72247 5.50275 1.68378 5.59687C1.6451 5.691 1.58767 5.77627 1.51499 5.84749L0.457487 6.89749C0.165289 7.19 0.00115967 7.58654 0.00115967 7.99999C0.00115967 8.41344 0.165289 8.80998 0.457487 9.10249L1.49999 10.16C1.57267 10.2312 1.6301 10.3165 1.66878 10.4106C1.70747 10.5047 1.72659 10.6057 1.72499 10.7075V12.2075C1.72597 12.413 1.76754 12.6163 1.84731 12.8056C1.92709 12.995 2.04349 13.1668 2.18985 13.3111C2.3362 13.4553 2.50961 13.5692 2.70013 13.6463C2.89064 13.7233 3.0945 13.762 3.29999 13.76H4.79999C4.90174 13.7584 5.00275 13.7775 5.09687 13.8162C5.191 13.8549 5.27627 13.9123 5.34749 13.985L6.40499 15.0425C6.69749 15.3347 7.09404 15.4988 7.50749 15.4988C7.92094 15.4988 8.31748 15.3347 8.60999 15.0425L9.65999 14C9.73121 13.9273 9.81647 13.8699 9.9106 13.8312C10.0047 13.7925 10.1057 13.7734 10.2075 13.775H11.7075C12.1212 13.775 12.518 13.6106 12.8106 13.3181C13.1031 13.0255 13.2675 12.6287 13.2675 12.215V10.715C13.2659 10.6132 13.285 10.5122 13.3237 10.4181C13.3624 10.324 13.4198 10.2387 13.4925 10.1675L14.55 9.10999C14.6953 8.96452 14.8104 8.79176 14.8887 8.60164C14.9671 8.41152 15.007 8.20779 15.0063 8.00218C15.0056 7.79656 14.9643 7.59311 14.8847 7.40353C14.8051 7.21394 14.6888 7.04197 14.5425 6.89749ZM10.635 6.64999L6.95249 10.25C6.90055 10.3026 6.83864 10.3443 6.77038 10.3726C6.70212 10.4009 6.62889 10.4153 6.55499 10.415C6.48062 10.4139 6.40719 10.3982 6.33896 10.3685C6.27073 10.3389 6.20905 10.2961 6.15749 10.2425L4.37999 8.44249C4.32532 8.39044 4.28169 8.32793 4.25169 8.25867C4.22169 8.18941 4.20593 8.11482 4.20536 8.03934C4.20479 7.96387 4.21941 7.88905 4.24836 7.81934C4.27731 7.74964 4.31999 7.68647 4.37387 7.63361C4.42774 7.58074 4.4917 7.53926 4.56194 7.51163C4.63218 7.484 4.70726 7.47079 4.78271 7.47278C4.85816 7.47478 4.93244 7.49194 5.00112 7.52324C5.0698 7.55454 5.13148 7.59935 5.18249 7.65499L6.56249 9.05749L9.84749 5.84749C9.95296 5.74215 10.0959 5.68298 10.245 5.68298C10.394 5.68298 10.537 5.74215 10.6425 5.84749C10.6953 5.90034 10.737 5.96318 10.7653 6.03234C10.7935 6.1015 10.8077 6.1756 10.807 6.25031C10.8063 6.32502 10.7908 6.39884 10.7612 6.46746C10.7317 6.53608 10.6888 6.59813 10.635 6.64999Z"
                                                fill="currentColor">
                                            </path>
                                        </svg>
                                    @endif
                                    <a class="hover:text-primary-active text-base leading-5 font-medium text-gray-900"
                                       href="{{ route("admin.users.view", ["id" => $model->id]) }}">
                                        {{ $model->shop_name }} / {{ $model->full_name }}
                                    </a>
                                    @if($model->is_trusted)
                                        <img src="{{ asset("assets/web/images/star-green.svg") }}" alt="Trusted Account"
                                             title="Trusted Account" style="width: 15px;height: 15px;"/>
                                    @endif
                                </div>
                                <div class="flex flex-wrap justify-center items-center gap-3.5 mb-5 mt-5">
                                    <button class="text-xs text-gray-700 hover:text-primary-active">
                                        @if(!is_null($model->email_verified_at))
                                            <i class="ki-check-circle ki-filled text-success" title="Email Active"></i>
                                        @else
                                            <i class="ki-filled ki-check-circle text-danger" title="Email Inactive"></i>
                                        @endif
                                        {{ $model->email }} , {{ $model->phone_number }}
                                    </button>
                                </div>
                                <div class="flex flex-wrap justify-center items-center gap-3.5 mb-1">
                                    <div class="flex items-center text-xs font-medium text-primary">
                                        {{ $model->created_at }}
                                        <i class="ki-filled ki-calendar ml-1 text-gray-400 text-md">
                                        </i>
                                    </div>
                                </div>

                                <div class="flex flex-wrap justify-center items-center gap-3.5 mb-7">
                                    <div class="flex items-center text-xs font-medium text-success">
                                        {{ $model->id_number }}
                                        <i class="ki-filled ki-phone ml-1 text-gray-400 text-md">
                                        </i>
                                    </div>
                                </div>


                                <div class="flex items-center justify-center flex-wrap gap-2 lg:gap-5 mb-3">
                                    <div
                                        class="grid grid-cols-1 gap-1.5 border-[0.5px] border-dashed border-gray-400 rounded-md px-2.5 py-2 shrink-0 max-w-auto">
                                 <span class="text-gray-900 text-sm leading-none font-medium">
                                  {{ count($model->orders) }}
                                 </span>
                                        <span class="text-gray-700 text-xs">
                                  Orders
                                 </span>
                                    </div>
                                    <div
                                        class="grid grid-cols-1 gap-1.5 border-[0.5px] border-dashed border-gray-400 rounded-md px-2.5 py-2 shrink-0 max-w-auto">
                                 <span class="text-gray-900 text-sm leading-none font-medium">
                                  {{ count($model->offers) }}
                                 </span>
                                        <span class="text-gray-700 text-xs">
                                  Offers
                                </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer justify-center">
                                <a class="btn btn-link" href="{{ route("admin.users.view", ["id" => $model->id]) }}">
                                    View
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>


                <div class="flex grow justify-center pt-5 lg:pt-7.5">
                    <div class="grid gap-5 mt-5 d-flex justify-content-between align-items-center">
                        <div class="pagination pagination-sm justify-content-end">
                            {{ $models->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
                <!-- end: cards -->
            </div>
            <!-- end: works -->
        </div>
        <!-- End of Container -->

        @include("cpanel.includes.user.create-modal")
    </main>
    <!-- End of Content -->
@endsection
