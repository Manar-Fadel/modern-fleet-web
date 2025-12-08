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
                        Offers By Date (Weekly)
                    </h1>
                    @include("cpanel.includes.vuejs-alerts")
                </div>
            </div>
        </div>
        <!-- End of Container -->

        @include("cpanel.includes.order.offer.filters")

        <!-- Container -->
        @include("cpanel.includes.order.offer.details")
        @include("cpanel.includes.order.offer.edit-modal")

        <!-- Order Pop Up Modal -->
        @include("cpanel.includes.order.one-order")
    </main>
@endsection

@push('scripts')
    <script src="https://unpkg.com/vue@3"></script>
    <script src="{{ asset("assets/cpanel/vuejs/offers.js") }}"></script>
@endpush

