@extends('cpanel.layout.default')
@section('content')
    <style>
        .symbol img{
            border: 1px solid #ddd;
            border-radius: 10px;
        }
    </style>
    <main class="grow content pt-5" id="content" role="content">
        <!-- Container -->
        <div class="container-fixed" style="margin-left: 0;">
            <div class="container-xxl">
                @include('cpanel.includes.alerts')
                <div class="card ml-5">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <h3 class="fw-bold m-0">Attachment Types</h3>
                        </div>

                        <div class="card-toolbar">
                            <a href="{{ route('admin.attachment-types.create') }}" class="btn btn-primary">
                                <i class="ki-duotone ki-plus fs-2"></i>
                                Add Attachment Type
                            </a>
                        </div>
                    </div>

                    <div class="card-body py-4">

                        <form method="GET" class="mb-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="flex-grow-1">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                           class="form-control form-control-solid"
                                           placeholder="Search by Arabic/English name...">
                                </div>
                                <button class="btn btn-light-primary" type="submit">
                                    <i class="ki-duotone ki-magnifier fs-2"></i> Search
                                </button>
                                <a href="{{ route('admin.attachment-types.index') }}" class="btn btn-light">
                                    Reset
                                </a>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5">
                                <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th>Icon</th>
                                    <th>Name (EN)</th>
                                    <th>Name (AR)</th>
                                    <th>Created At</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                                </thead>

                                <tbody class="text-gray-600 fw-semibold">
                                @forelse($types as $type)
                                    <tr>
                                        <td>
                                            <div class="symbol symbol-50px">
                                                <img src="{{ $type->icon_url }}" alt="icon">
                                            </div>
                                        </td>

                                        <td>{{ $type->name_en }}</td>
                                        <td>{{ $type->name_ar }}</td>

                                        <td>{{ $type->created_at?->format('Y-m-d') }}</td>

                                        <td class="text-end">
                                            <a href="{{ route('admin.attachment-types.edit', $type->id) }}"
                                               class="btn btn-sm btn-light-primary">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.attachment-types.destroy', $type->id) }}"
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this item?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-light-danger" type="submit">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-10">
                                            No attachment types found.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6">
                            {{ $types->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

@endsection
