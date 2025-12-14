@extends('cpanel.layout.default')
@section('content')
    <div class="card  ml-5">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3 class="fw-bold">Heavy Vehicles Stock</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('admin.heavy-vehicles.create') }}" class="btn btn-primary">
                    + Add Heavy Vehicle
                </a>
            </div>
            <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                @include("cpanel.includes.alerts")
            </div>
        </div>

        <div class="card-body pt-5">
            {{-- Filters --}}
            <form method="GET" class="row g-3 mb-5">
                <div class="col-md-3">
                    <select name="brand_id" class="form-select">
                        <option value="">All Brands</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}"
                                @selected(request('brand_id') == $brand->id)>
                                {{ $brand->name_en }} - {{ $brand->name_ar }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="condition" class="form-select">
                        <option value="">All Conditions</option>
                        <option value="new" @selected(request('condition') == 'new')>New</option>
                        <option value="used" @selected(request('condition') == 'used')>Used</option>
                        <option value="refurbished" @selected(request('condition') == 'refurbished')>Refurbished</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary">Filter</button>
                </div>
            </form>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-row-bordered align-middle">
                    <thead>
                    <tr class="fw-bold text-muted">
                        <th>#</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Category</th>
                        <th>Condition</th>
                        <th>Location</th>
                        <th>Image</th>
                        <th class="text-end">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($heavyVehicles as $vehicle)
                        <tr>
                            <td>{{ $vehicle->id }}</td>
                            <td>{{ optional($vehicle->brand)->name_en }}</td>
                            <td>{{ optional($vehicle->model)->name_en }}</td>
                            <td>{{ optional($vehicle->year)->year }}</td>
                            <td>{{ optional($vehicle->category)->name_en }}</td>
                            <td>
                            <span class="badge badge-light-{{ $vehicle->condition === 'used' ? 'warning' : ($vehicle->condition === 'new' ? 'success' : 'info') }}">
                                {{ ucfirst($vehicle->condition) }}
                            </span>
                            </td>
                            <td>{{ $vehicle->location }}</td>
                            <td>
                                @php
                                    $img = $vehicle->mainImage ?? $vehicle->images->first();
                                @endphp

                                @if($img)
                                    <div class="symbol symbol-60px">
                                        <img src="{{ asset('storage/' . $img->path) }}" alt="">
                                    </div>
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.heavy-vehicles.edit', $vehicle) }}"
                                   class="btn btn-sm btn-light-primary">
                                    Edit
                                </a>

                                <form action="{{ route('admin.heavy-vehicles.destroy', $vehicle) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this vehicle?')">
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
                            <td colspan="8" class="text-center text-muted">
                                No heavy vehicles found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{ $heavyVehicles->links() }}
        </div>
    </div>
@endsection
