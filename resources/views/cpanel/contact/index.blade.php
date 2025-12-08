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
                        ALL Contact Messages ({{ count($models) }})
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
                    @if(count($models) > 0)
                        <table class="table table-auto table-border" data-datatable-table="true">
                            <thead>
                                <tr>
                                    <th class="min-w-[50px]">
                                       #
                                    </th>
                                    <th class="min-w-[150px]">
                                      Full name
                                    </th>
                                    <th class="min-w-[150px]">
                                       Email
                                    </th>
                                    <th class="min-w-[100px]">
                                       Mobile
                                    </th>
                                     <th class="min-w-[150px]">
                                      Message
                                    </th>
                                    <th class="min-w-[150px]">
                                       Sent AT
                                    </th>
                                    <th>
                                       <span class="sort">
                                        <span class="sort-label font-normal text-gray-700">
                                         Action
                                        </span>
                                       </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($models as $model)
                                <tr>
                                    <td class="text-gray-800 font-normal">
                                        {{ $i }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->name }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->email }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->mobile }}
                                    </td>
                                    <td class="text-gray-800 font-normal">
                                        {{ $model->message }}
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
                                                        <a class="menu-link" href="{{ route("admin.contact.delete", ['id' => $model->id] ) }}">
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
                                    <?php $i++ ?>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>There is no contact messages yet</p>
                    @endif
                </span>

                <div class="flex grow justify-center pt-5 lg:pt-7.5">
                    <div class="grid gap-5 mt-5 d-flex justify-content-between align-items-center">
                        <div class="pagination pagination-sm justify-content-end">
                            {{ $models->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </span>
        </div>

        <!-- End of Container -->
    </main>
@endsection

