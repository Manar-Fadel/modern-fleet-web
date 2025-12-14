@extends('cpanel.layout.default')
@section('content')
    <div class="card  ml-5">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3 class="fw-bold">Car Categories</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('admin.car-categories.create') }}"
                   class="btn btn-primary">
                    + Add Category
                </a>
            </div>
        </div>

        <div class="card-body pt-5">
            <div class="table-responsive">
                <table class="table table-row-bordered align-middle">
                    <thead>
                    <tr class="fw-bold text-muted">
                        <th>#</th>
                        <th>Name (EN)</th>
                        <th>Name (AR)</th>
                        <th>Description</th>
                        <th class="text-end">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name_en }}</td>
                            <td>{{ $category->name_ar }}</td>
                            <td class="text-muted">
                                {{ Str::limit($category->description, 50) }}
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.car-categories.edit', $category) }}"
                                   class="btn btn-sm btn-light-primary">
                                    Edit
                                </a>

                                <form action="{{ route('admin.car-categories.destroy', $category) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-light-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                No categories found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{ $categories->links() }}
        </div>
    </div>
@endsection
