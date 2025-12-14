@extends('cpanel.layout.default')
@section('content')
<!-- Content -->
<main id="app" class="grow content pt-5" id="content" role="content">

    <!-- Container -->
    <div class="container-fixed" id="content_container">
    </div>

    <!-- End of Container -->
    <!-- Container -->
    <div class="container-fixed">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-medium leading-none text-gray-900">
                    Heavy Vehicle Requests By Date
                </h1>
                @include("cpanel.includes.vuejs-alerts")
            </div>
        </div>
    </div>
    @include("cpanel.includes.heavy_vehicle_order.filters")
    <!-- End of Container -->
    <!-- Container -->
    @include("cpanel.includes.heavy_vehicle_order.table")
    <!-- End of Container -->

    @include("cpanel.includes.heavy_vehicle_order.details")
</main>
<!-- End of Content -->

@endsection

@push('scripts')
    <script src="https://unpkg.com/vue@3"></script>
    <script src="{{ asset("assets/cpanel/vuejs/heavy-vehicle-orders-code.js") }}"></script>
@endpush
