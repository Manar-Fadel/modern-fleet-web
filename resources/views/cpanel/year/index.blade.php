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
                    All Years ({{ count($years) }})
                </h3>
                <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                    @include("cpanel.includes.alerts")
                </div>
                <div class="flex justify-end pt-2.5">
                    <button class="btn btn-primary" data-modal-toggle="#add_new_year">
                        <i class="ki-filled ki-plus">
                        </i>
                        Add New Year
                    </button>
                </div>
            </div>
            <!-- end: toolbar -->

            <!-- begin: list -->
            <div id="teams_list">
                <div class="flex flex-col gap-5 lg:gap-7.5">
                    @foreach($years as $year)
                    <div class="card p-7.5">
                        <div class="flex flex-wrap justify-between items-center gap-7">
                            <div class="flex items-center gap-4">
                                  {{ $year->value }}
                            </div>
                            <div class="flex flex-wrap items-center gap-6 lg:gap-12">
                                <div class="grid justify-end gap-3.5 lg:text-right lg:min-w-24 shrink-0 max-w-auto">
                                 <span class="text-2xs text-gray-600 uppercase">
                                      Orders Count
                                 </span>
                                 <div class="flex flex-wrap gap-1.5">
                                        {{ count($year->orders) }}
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-wrap items-center gap-6 lg:gap-12">
                                <div class="grid justify-end gap-3.5 lg:text-right lg:min-w-24 shrink-0 max-w-auto">
                                 <span class="text-2xs text-gray-600 uppercase">
                                      User Vehicles Count
                                 </span>
                                    <div class="flex flex-wrap gap-1.5">

                                    </div>
                                </div>
                            </div>

                            <div class="card-footer justify-center">
                                <a href="{{ route("admin.years.delete", ['id' => $year->id]) }}" class="btn btn-danger btn-sm">
                                    <i class="ki-filled ki-trash">
                                    </i>
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- end: list -->
        </div>
        <!-- end: works -->


        <div class="modal" role="dialog" data-modal="true" aria-modal="true" id="add_new_year">
            <div class="modal-content max-w-[600px] top-[15%]">
                <div class="modal-header py-4 px-5">
                    Add New Year
                    <button class="btn btn-sm btn-icon btn-light btn-clear shrink-0" data-modal-dismiss="true">
                        <i class="ki-filled ki-cross">
                        </i>
                    </button>
                </div>
                <div class="modal-body p-0 pb-5">
                    <form class="tabs justify-between px-5 mb-2.5 mt-2.5" method="post" action="{{ route("admin.years.store") }}">
                        @csrf
                        <div class="tabs justify-between px-5 mb-2.5 border-0" data-tabs="true">
                        <div class="flex items-center gap-5">

                            <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                                <label class="form-label max-w-56">
                                    Year Value
                                </label>
                                <input class="input" name="value" placeholder="Enter year value" type="text">
                            </div>

                            <div class="flex justify-end pt-2.5">
                                <button type="submit" class="btn btn-success">
                                   Save
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- End of Container -->
</main>
<!-- End of Content -->

@endsection
