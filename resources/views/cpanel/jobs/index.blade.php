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
                        ALL Scheduled Jobs In System (In Queue to be run)
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                        <a href="{{ route("admin.jobs.failed") }}" class="btn btn-danger">
                            Failed Jobs
                        </a>

                        <a href="{{ route("admin.jobs.batches") }}" class="btn btn-primary">
                            Job Batches
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
                                         Queue
                                    </th>
                                    <th class="min-w-[100px]">
                                        Payload
                                    </th>
                                    <th class="min-w-[200px]">
                                         Attempts
                                    </th>
                                    <th class="min-w-[50px]">
                                         Available At
                                    </th>
                                    <th class="min-w-[250px]">
                                        Created At
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
                                         {{ $model->queue }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        <?php $payload_data = json_decode($model->payload); ?>
                                        @foreach($payload_data as $key => $value)
                                           <span class="text-primary">
                                               {{ $key }} /
                                           </span>  {{ print_r($value) }}
                                            <br>
                                        @endforeach
                                    </td>

                                    <td class="text-gray-800 font-normal">
                                        {{ $model->attempts }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->available_at }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->created_at }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>ALL scheduled jobs run successfully,,</p>
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
