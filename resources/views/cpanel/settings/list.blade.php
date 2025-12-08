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
            <div class="flex flex-col items-stretch gap-5 lg:gap-7.5">
                <div class="flex flex-wrap items-center gap-5 justify-between mb-5">

                    <h1 class="text-xl font-medium leading-none text-gray-900">
                        ALL Dynamic Settings In System
                    </h1>
                    <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
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
                    <table class="table table-auto table-border" data-datatable-table="true">
                            <thead>
                                <tr>
                                    <th class="min-w-[200px]">
                                         ID
                                    </th>
                                    <th class="min-w-[100px]">
                                         Code Key
                                    </th>
                                    <th class="min-w-[100px]">
                                        Name (AR)
                                    </th>
                                    <th class="min-w-[200px]">
                                         Name (EN)
                                    </th>
                                    <th class="min-w-[250px]">
                                        Created At
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($models as $model)
                                <tr>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->id }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                         {{ $model->code_key }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                       {{ $model->name_ar }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->name_en }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->created_at }}
                                    </td>

                                    <td class="text-center">
                                    <div class="menu flex-inline" data-menu="true">
                                        <div class="menu-item" data-menu-item-offset="0, 10px" data-menu-item-placement="bottom-end" data-menu-item-toggle="dropdown" data-menu-item-trigger="click|lg:click">
                                            <button class="menu-toggle btn btn-sm btn-icon btn-light btn-clear">
                                                <i class="ki-filled ki-dots-vertical">
                                                </i>
                                            </button>
                                            <div class="menu-dropdown menu-default w-full max-w-[175px]" data-menu-dismiss="true">
                                                <div class="menu-item">
                                                    <a class="menu-link" href="{{ route("admin.settings.delete", ['id' => $model->id]) }}">
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
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
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
