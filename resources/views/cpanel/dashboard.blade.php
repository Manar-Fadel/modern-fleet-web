@extends('cpanel.layout.default')
@section('content')
    <!-- Content -->
    <main id="app" class="grow content pt-5" role="content">
        <!-- Container -->
        <div class="container-fixed" id="content_container">
        </div>
        <!-- End of Container -->
        <!-- Container -->
        <div class="container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-gray-900">
                        Insights
                    </h1>
                </div>
            </div>
        </div>
        <!-- End of Container -->

        <div class="container-fixed mt-7">

            <div class="grid grid-cols-3 xl:grid-cols-4 gap-5 lg:gap-7.5 mb-5">

                <div class="col-span-1 border-2 text-center p-2" style="border-radius: 5px;">
                    <div class="stat-title">
                        <i class="ki-filled ki-users"></i>
                        Dealers Accounts Count
                    </div>
                    <div class="stat-value" style="color: darkblue">
                        {{ $dealers_count }}
                    </div>
                </div>
                <div class="col-span-1 border-2 text-center p-2" style="border-radius: 5px;">
                    <div class="stat-title">
                        <i class="ki-filled ki-user-square"></i>
                        Bank Delegates Accounts Count
                    </div>
                    <div class="stat-value" style="color: darkblue">
                        {{ $bank_delegates_count }}
                    </div>
                </div>

                <div class="col-span-1 border-2 text-center p-2" style="border-radius: 5px;">
                    <div class="stat-title">
                        <i class="ki-filled ki-security-user"></i>
                        Pending Orders Count
                    </div>
                    <div class="stat-value" style="color: darkblue">
                        {{ $pending_orders_count }}
                    </div>
                </div>

                <div class="col-span-1 border-2 text-center p-2" style="border-radius: 5px;">
                    <div class="stat-title">
                        <i class="ki-filled ki-security-user"></i>
                        Accepted Orders Count
                    </div>
                    <div class="stat-value" style="color: darkblue">
                        {{ $accepted_orders_count }}
                    </div>
                </div>

                <div class="col-span-1 border-2 text-center p-2" style="border-radius: 5px;">
                    <div class="stat-title">
                        <i class="ki-filled ki-security-user"></i>
                        Pending Offers Count
                    </div>
                    <div class="stat-value" style="color: darkblue">
                        {{ $pending_offers_count }}
                    </div>
                </div>

                <div class="col-span-1 border-2 text-center p-2" style="border-radius: 5px;">
                    <div class="stat-title">
                        <i class="ki-filled ki-security-user"></i>
                        Accepted Offers Count
                    </div>
                    <div class="stat-value" style="color: darkblue">
                        {{ $accepted_offers_count }}
                    </div>
                </div>

            </div>
        </div>
    </main>



@endsection




