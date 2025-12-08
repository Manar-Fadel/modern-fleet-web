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
                        ALL Batches Jobs In System
                    </h1>

                    <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                        <a href="{{ route("admin.jobs.index") }}" class="btn btn-primary">
                            Scheduled Jobs
                        </a>
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
                                         Name
                                    </th>
                                    <th class="min-w-[100px]">
                                        Total Jobs
                                    </th>
                                    <th class="min-w-[200px]">
                                         Pending Jobs
                                    </th>
                                    <th class="min-w-[200px]">
                                         Failed Jobs
                                    </th>
                                    <th class="min-w-[50px]">
                                         Failed Job ID's
                                    </th>
                                    <th class="min-w-[250px]">
                                        options
                                    </th>
                                    <th class="min-w-[250px]">
                                        options
                                    </th>
                                    <th class="min-w-[250px]">
                                        Cancelled At
                                    </th>
                                    <th class="min-w-[250px]">
                                        Created At
                                    </th>
                                    <th class="min-w-[250px]">
                                        Finished At
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
                                         {{ $model->name }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                       {{ $model->total_jobs }}
                                    </td>

                                    <td class="text-gray-800 font-normal">
                                        {{ $model->pending_jobs }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->failed_jobs }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ print_r($model->failed_job_ids) }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ print_r($model->options) }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->cancelled_at }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->created_at }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->finished_at }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>There is no batches jobs in system yet,,</p>
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
