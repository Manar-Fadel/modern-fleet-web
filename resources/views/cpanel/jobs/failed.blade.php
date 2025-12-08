@extends('cpanel.layout.default')
@section('content')
    <!-- Content -->
    <main class="grow content pt-5" id="content" role="content">
        <!-- Container -->
        <div class="container-fixed" id="content_container">
        </div>
        <!-- End of Container -->
        <!-- Container -->
        <div class="container-fixed">
            <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
                <div class="flex flex-col justify-center gap-2">
                    <h1 class="text-xl font-medium leading-none text-gray-900">
                        ALL Failed Jobs In System
                    </h1>

                    <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                        <a href="{{ route("admin.jobs.index") }}" class="btn btn-primary">
                            Scheduled Jobs
                        </a>
                        @include("cpanel.includes.alerts")
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Container -->

        <!-- Container -->
        <div class="container-fixed">
            <span class="grid gap-5 lg:gap-7.5">
                <span class="flex gap-5 lg:gap-7.5">
                    @if(count($models) > 0)
                        <table class="table table-auto table-border" data-datatable-table="true">
                            <thead>
                                <tr>
                                    <th class="min-w-[200px]">
                                         ID
                                    </th>
                                    <th class="min-w-[100px]">
                                         uuid
                                    </th>
                                    <th class="min-w-[100px]">
                                        connection
                                    </th>
                                    <th class="min-w-[200px]">
                                         queue
                                    </th>
                                    <th class="min-w-[200px]">
                                         payload
                                    </th>
                                    <th class="min-w-[50px]">
                                         exception
                                    </th>
                                    <th class="min-w-[250px]">
                                        failed_at
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($models as $model)
                                <tr>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->id }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                         {{ $model->uuid }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                       {{ print_r($model->connection) }}
                                    </td>

                                    <td class="text-gray-800 font-normal">
                                        {{ print_r($model->queue) }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ print_r($model->payload) }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ print_r(substr($model->exception, 0, 500)) }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->failed_at }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>There is no failed jobs in system yet,,</p>
                    @endif
                </span>
            </span>
        </div>

        <div class="grid gap-5 mt-5 d-flex justify-content-between align-items-center">
            <div class="pagination pagination-sm justify-content-end">
                {{ $models->links() }}
            </div>
        </div>

    </main>
@endsection
