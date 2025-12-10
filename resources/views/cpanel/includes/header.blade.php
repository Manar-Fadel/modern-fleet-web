<!-- Header -->
<header class="header fixed top-0 z-10 left-0 right-0 flex items-stretch shrink-0 bg-[--tw-page-bg] dark:bg-[--tw-page-bg-dark]" data-sticky="true" data-sticky-class="shadow-sm" data-sticky-name="header" id="header">
    <!-- Container -->
    <div class="container-fixed flex justify-between items-stretch lg:gap-4" id="header_container">
        <!-- Breadcrumbs -->
        <div class="flex [.header_&]:below-lg:hidden items-center gap-1.25 text-xs lg:text-sm font-medium mb-2.5 lg:mb-0" data-reparent="true" data-reparent-mode="prepend|lg:prepend" data-reparent-target="#content_container|lg:#header_container">
       <span class="text-gray-700">
        Modern Fleet
       </span>
        </div>
        <!-- End of Breadcrumbs -->
        <!-- Topbar -->
        <div class="flex items-center gap-2 lg:gap-3.5">
           <div class="dropdown" data-dropdown="true" data-dropdown-offset="70px, 10px" data-dropdown-placement="bottom-end" data-dropdown-trigger="click|lg:click">
                <button class="dropdown-toggle btn btn-icon btn-icon-lg relative cursor-pointer size-9 rounded-full hover:bg-primary-light hover:text-primary dropdown-open:bg-primary-light dropdown-open:text-primary text-gray-500">
                    <i class="ki-filled ki-notification-on">
                    </i>
                    <span class="badge badge-dot badge-success size-[5px] absolute top-0.5 right-0.5 transform translate-y-1/2">
                    </span>
                </button>
                <div class="dropdown-content light:border-gray-300 w-full max-w-[460px]">
                    <div class="flex items-center justify-between gap-2.5 text-sm text-gray-900 font-semibold px-5 py-2.5 border-b border-b-gray-200" id="notifications_header">
                        Notifications
                        <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-dropdown-dismiss="true">
                            <i class="ki-filled ki-cross">
                            </i>
                        </button>
                    </div>
                    <div class="tabs justify-between px-5 mb-2" data-tabs="true" id="notifications_tabs">
                        <div class="flex items-center gap-5">
                            <button class="tab active" data-tab-toggle="#notifications_tab_all">
                                All
                            </button>
                            <button class="tab relative" data-tab-toggle="#notifications_tab_inbox">
                                Inbox
                                <span class="badge badge-dot badge-success size-[5px] absolute top-2 right-0 transform translate-y-1/2 translate-x-full">
                            </span>
                            </button>
                        </div>
                    </div>
                    <div class="grow" id="notifications_tab_all">
                        <div class="flex flex-col">
                            <div class="scrollable-y-auto" data-scrollable="true" data-scrollable-dependencies="#header" data-scrollable-max-height="auto" data-scrollable-offset="200px">
                                <div class="flex flex-col gap-5 pt-3 pb-4 divider-y divider-gray-200">
                                    <div class="flex grow gap-2.5 px-5">
                                        <div class="relative shrink-0 mt-0.5">
                                            <span class="size-1.5 badge badge-circle badge-success absolute top-7 end-0.5 ring-1 ring-light transform -translate-y-1/2">
                                            </span>
                                        </div>
                                        <div class="flex flex-col gap-3.5">
                                            <div class="flex flex-col gap-1">
                                                <div class="text-2sm font-medium">
                                                    <a class="hover:text-primary-active text-gray-900 font-semibold" href="#">
                                                        Joe Lincoln
                                                    </a>
                                                    <span class="text-gray-700">
                                                      mentioned you in
                                                     </span>
                                                    <a class="hover:text-primary-active text-primary" href="#">
                                                        Latest Trends
                                                    </a>
                                                    <span class="text-gray-700">
                                                  topic
                                                 </span>
                                                </div>
                                                <span class="flex items-center text-2xs font-medium text-gray-500">
                                                 18 mins ago
                                                 <span class="badge badge-circle bg-gray-500 size-1 mx-1.5">
                                                 </span>
                                                 Web Design 2024
                                                </span>
                                            </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-b border-b-gray-200">
                            </div>
                            <div class="grid grid-cols-2 p-5 gap-2.5" id="notifications_all_footer">
                                <button class="btn btn-sm btn-light justify-center">
                                    Archive all
                                </button>
                                <button class="btn btn-sm btn-light justify-center">
                                    Mark all as read
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="grow hidden" id="notifications_tab_inbox">
                        <div class="flex flex-col">
                            <div class="scrollable-y-auto" data-scrollable="true" data-scrollable-dependencies="#header" data-scrollable-max-height="auto" data-scrollable-offset="200px">
                                <div class="flex flex-col gap-5 pt-3 pb-4">
                                    <div class="flex grow gap-2.5 px-5" id="notification_request_13">
                                        <div class="relative shrink-0 mt-0.5">
                                            <img alt="" class="rounded-full size-8"
                                                 src="{{ URL::asset("assets/cpanel/admin-user.png") }}" style="padding: 2px;"/>
                                            <span class="size-1.5 badge badge-circle badge-success absolute top-7 end-0.5 ring-1 ring-light transform -translate-y-1/2">
                                            </span>
                                        </div>
                                        <div class="flex flex-col gap-3.5 grow">
                                            <div class="flex flex-col gap-1">
                                                <div class="text-2sm font-medium mb-px">
                                                    <a class="hover:text-primary-active text-gray-900 font-semibold" href="#">
                                                        Samuel Lee
                                                    </a>
                                                    <span class="text-gray-700">
                  requested to add user to
                 </span>
                                                    <a class="hover:text-primary-active text-primary font-semibold" href="#">
                                                        TechSynergy
                                                    </a>
                                                </div>
                                                <span class="flex items-center text-2xs font-medium text-gray-500">
                 22 hours ago
                 <span class="badge badge-circle bg-gray-500 size-1 mx-1.5">
                 </span>
                 Dev Team
                </span>
                                            </div>
                                            <div class="card shadow-none flex items-center flex-row justify-between gap-1.5 px-2.5 py-2 rounded-lg bg-light-active">
                                                <div class="flex flex-col">
                                                    <a class="hover:text-primary-active font-medium text-gray-900 text-xs" href="#">
                                                        Ronald Richards
                                                    </a>
                                                    <a class="hover:text-primary-active text-gray-500 font-medium text-3xs" href="#">
                                                        ronald.richards@gmail.com
                                                    </a>
                                                </div>
                                                <a class="hover:text-primary-active text-gray-700 font-medium text-xs" href="#">
                                                    Go to profile
                                                </a>
                                            </div>
                                            <div class="flex flex-wrap gap-2.5">
                                                <button class="btn btn-light btn-sm" data-dismiss="#notification_request_13">
                                                    Decline
                                                </button>
                                                <button class="btn btn-dark btn-sm" data-dismiss="#notification_request_13">
                                                    Accept
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-b border-b-gray-200">
                                    </div>
                                </div>
                            </div>
                            <div class="border-b border-b-gray-200">
                            </div>
                            <div class="grid grid-cols-2 p-5 gap-2.5" id="notifications_inbox_footer">
                                <button class="btn btn-sm btn-light justify-center">
                                    Archive all
                                </button>
                                <button class="btn btn-sm btn-light justify-center">
                                    Mark all as read
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="menu" data-menu="true">
                <div class="menu-item" data-menu-item-offset="20px, 10px" data-menu-item-placement="bottom-end" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                    <div class="menu-toggle btn btn-icon rounded-full">
                        <img alt="" class="size-9 rounded-full border-2 border-success shrink-0" style="padding: 2px;"
                             src="{{ URL::asset("assets/cpanel/admin-user.png") }}">
                        </img>
                    </div>
                    <div class="menu-dropdown menu-default light:border-gray-300 w-screen max-w-[250px]">
                        <div class="flex items-center justify-between px-5 py-1.5 gap-1.5">
                            <div class="flex items-center gap-2">
                                <img alt="" class="size-9 rounded-full border-2 border-success" style="padding: 2px;"
                                     src="{{ URL::asset("assets/cpanel/admin-user.png") }}">
                                <div class="flex flex-col gap-1.5">
                                  <span class="text-sm text-gray-800 font-semibold leading-none">
                                      <?php $user = auth()->user(); ?>
                                   {{  $user->user_name }}
                                  </span>
                                    <a class="text-xs text-gray-600 hover:text-primary font-medium leading-none" href="html/demo1/account/home/get-started.html">
                                        {{  $user->email }}
                                    </a>
                                </div>
                                </img>
                            </div>
                            <span class="badge badge-xs badge-primary badge-outline">
                            Pro
                           </span>
                        </div>
                        <div class="menu-separator">
                        </div>
                        <div class="flex flex-col">
                            <div class="menu-item">
                                <a class="menu-link" href="#">
                                 <span class="menu-icon">
                                  <i class="ki-filled ki-badge">
                                  </i>
                                </span>
                                    <span class="menu-title">
                                  Public Profile
                                 </span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link" href="#">
                                 <span class="menu-icon">
                                  <i class="ki-filled ki-profile-circle">
                                  </i>
                                 </span>
                                    <span class="menu-title">
                                  My Profile
                                 </span>
                                </a>
                            </div>
                            <div class="menu-item" data-menu-item-offset="-10px, 0" data-menu-item-placement="left-start" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:hover">
                                <div class="menu-link">
                                     <span class="menu-icon">
                                      <i class="ki-filled ki-icon">
                                      </i>
                                     </span>
                                    <span class="menu-title">
                                      Language
                                     </span>
                                    <div class="flex items-center gap-1.5 rounded-md border border-gray-300 text-gray-600 p-1.5 text-2xs font-medium shrink-0">
                                        English
                                    </div>
                                </div>
                                <div class="menu-dropdown menu-default light:border-gray-300 w-full max-w-[170px]">
                                    <div class="menu-item active">
                                        <a class="menu-link h-10" href="#">
                                            <span class="menu-title">
                                            English
                                           </span>
                                            <span class="menu-badge">
                                            <i class="ki-solid ki-check-circle text-success text-base">
                                            </i>
                                           </span>
                                        </a>
                                    </div>
                                    <div class="menu-item">
                                        <a class="menu-link h-10" href="#">
                                            <span class="menu-title">
                                            Arabic
                                           </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="menu-separator">
                        </div>
                        <div class="flex flex-col">
                            <div class="menu-item mb-0.5">
                                <div class="menu-link">
                                     <span class="menu-icon">
                                      <i class="ki-filled ki-moon">
                                      </i>
                                     </span>
                                    <span class="menu-title">
                                      Dark Mode
                                     </span>
                                    <label class="switch switch-sm">
                                        <input data-theme-state="dark" data-theme-toggle="true" name="check" type="checkbox" value="1">
                                        </input>
                                    </label>
                                </div>
                            </div>
                            <div class="menu-item px-4 py-1.5">
                                <a class="btn btn-sm btn-light justify-center"
                                   href="{{ route("admin.logout") }}">
                                    Log out
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Topbar -->
    </div>
    <!-- End of Container -->
</header>
<!-- End of Header -->
