@extends('cpanel.layout.default')
@section('content')
    <div class="card  ml-5">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3 class="fw-bold">Cars</h3>
            </div>
            <div class="card-toolbar">
                <a href="{{ route('admin.cars.create') }}" class="btn btn-primary">
                    + Add Car
                </a>
            </div>
        </div>

        <div class="card-body pt-5">

            {{-- Filters --}}
            <form method="GET" class="row mb-5">

                <div class="col-2">
                    <label class="form-label">Brand</label>
                    <select name="brand_id" class="form-select">
                        <option value="">All</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}"
                                @selected(request('brand_id') == $brand->id)>
                                {{ $brand->name_en }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-2">
                    <label class="form-label">Model</label>
                    <select name="model_id" class="form-select">
                        <option value="">All</option>
                        @foreach($models as $model)
                            <option value="{{ $model->id }}"
                                @selected(request('model_id') == $model->id)>
                                {{ $model->name_en }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-2">
                    <label class="form-label">Year</label>
                    <select name="manufacturing_year_id" class="form-select">
                        <option value="">All</option>
                        @foreach($years as $year)
                            <option value="{{ $year->id }}"
                                @selected(request('manufacturing_year_id') == $year->id)>
                                {{ $year->year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-2">
                    <label class="form-label">Condition</label>
                    <select name="condition" class="form-select">
                        <option value="">All</option>
                        @foreach(['new','used','refurbished'] as $c)
                            <option value="{{ $c }}"
                                @selected(request('condition') === $c)>
                                {{ ucfirst($c) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-2">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">All</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                @selected(request('category_id') == $cat->id)>
                                {{ $cat->name_en }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-2 d-flex align-items-end mt-5">
                    <button class="btn btn-light-primary me-2">Filter</button>
                    <a href="{{ route('admin.cars.index') }}" class="btn btn-color-muted">
                        Reset
                    </a>
                </div>
            </form>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-row-bordered align-middle">
                    <thead>
                    <tr class="fw-bold text-muted">
                        <th>#</th>
                        <th>Image</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Condition</th>
                        <th>Category</th>
                        <th>Price (SAR)</th>
                        <th>Location</th>
                        <th class="text-end">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($cars as $car)
                        <tr>
                            <td>{{ $car->id }}</td>
                            <td>
                                @php
                                    $img = $car->mainImage ?? $car->images->first();
                                @endphp
                                @if($img)
                                    <div class="symbol symbol-60px">
                                        <img src="{{ asset('storage/' . $img->path) }}" alt="">
                                    </div>
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>{{ $car->brand->name_en ?? '-' }}</td>
                            <td>{{ $car->brandModel->name_en ?? '-' }}</td>
                            <td>{{ $car->year->year ?? '-' }}</td>
                            <td>
                            <span class="badge badge-light-{{ $car->condition === 'used' ? 'warning' : ($car->condition === 'new' ? 'success' : 'info') }}">
                                {{ ucfirst($car->condition) }}
                            </span>
                            </td>
                            <td>{{ $car->category->name_en ?? '-' }}</td>
                            <td>
                                @if(!is_null($car->price))
                                    {{ number_format($car->price, 2) }} <span class="text-muted">SAR</span>
                                    @if($car->is_with_vat)
                                        <span class="badge badge-light-success ms-1">VAT</span>
                                    @endif
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $car->location ?? '-' }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.cars.edit', $car) }}"
                                   class="btn btn-sm btn-light-primary">
                                    Edit
                                </a>

                                <form action="{{ route('admin.cars.destroy', $car) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this car?')">
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
                            <td colspan="10" class="text-center text-muted">
                                No cars found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{ $cars->links() }}
        </div>
    </div>
@endsection

