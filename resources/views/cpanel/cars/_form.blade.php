@csrf

@php
    // Ensure $car exists as object
    $car = $car ?? new \App\Models\Car();
@endphp

{{-- Brand / Model / Year --}}
<div class="row mb-5">

    <div class="col-4">
        <label class="form-label">Brand</label>
        <select name="brand_id" class="form-select" required>
            <option value="">Select Brand</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}"
                    @selected(old('brand_id', $car->brand_id ?? '') == $brand->id)>
                    {{ $brand->name_en }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-4">
        <label class="form-label">Model</label>
        <select name="model_id" class="form-select" required>
            <option value="">Select Model</option>
            @foreach($models as $model)
                <option value="{{ $model->id }}"
                    @selected(old('model_id', $car->model_id ?? '') == $model->id)>
                    {{ $model->name_en }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-4">
        <label class="form-label">Manufacturing Year</label>
        <select name="manufacturing_year_id" class="form-select">
            <option value="">Select Year</option>
            @foreach($years as $year)
                <option value="{{ $year->id }}"
                    @selected(old('manufacturing_year_id', $car->manufacturing_year_id ?? '') == $year->id)>
                    {{ $year->year }}
                </option>
            @endforeach
        </select>
    </div>

</div>

{{-- Category / Condition --}}
<div class="row mb-5">

    <div class="col-4">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-select">
            <option value="">Select Category</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    @selected(old('category_id', $car->category_id ?? '') == $cat->id)>
                    {{ $cat->name_en }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-4">
        <label class="form-label">Condition</label>
        <select name="condition" class="form-select" required>
            @foreach(['new','used','refurbished'] as $c)
                <option value="{{ $c }}"
                    @selected(old('condition', $car->condition ?? 'used') == $c)>
                    {{ ucfirst($c) }}
                </option>
            @endforeach
        </select>
    </div>

</div>

{{-- Specs --}}
<div class="row mb-5">

    <div class="col-4">
        <label class="form-label">Fuel Type</label>
        <select name="fuel_type" class="form-select">
            <option value="">Select</option>
            @foreach(['petrol','diesel','hybrid','electric'] as $fuel)
                <option value="{{ $fuel }}"
                    @selected(old('fuel_type', $car->fuel_type ?? '') == $fuel)>
                    {{ ucfirst($fuel) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-4">
        <label class="form-label">Transmission</label>
        <select name="transmission" class="form-select">
            <option value="">Select</option>
            @foreach(['automatic','manual'] as $t)
                <option value="{{ $t }}"
                    @selected(old('transmission', $car->transmission ?? '') == $t)>
                    {{ ucfirst($t) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-4">
        <label class="form-label">Drive Type</label>
        <select name="drive_type" class="form-select">
            <option value="">Select</option>
            @foreach(['FWD','RWD','AWD'] as $d)
                <option value="{{ $d }}"
                    @selected(old('drive_type', $car->drive_type ?? '') == $d)>
                    {{ $d }}
                </option>
            @endforeach
        </select>
    </div>
</div>

{{-- Engine --}}
<div class="row mb-5">
    <div class="col-4">
        <label class="form-label">Engine Capacity (CC)</label>
        <input type="number" name="engine_capacity"
               value="{{ old('engine_capacity', $car->engine_capacity ?? '') }}"
               class="form-control">
    </div>

    <div class="col-4">
        <label class="form-label">Engine Power (HP)</label>
        <input type="number" name="engine_power"
               value="{{ old('engine_power', $car->engine_power ?? '') }}"
               class="form-control">
    </div>

    <div class="col-4">
        <label class="form-label">Mileage (KM)</label>
        <input type="number" name="mileage"
               value="{{ old('mileage', $car->mileage ?? '') }}"
               class="form-control">
    </div>
</div>

{{-- Structure --}}
<div class="row mb-5">

    <div class="col-4">
        <label class="form-label">Doors</label>
        <input type="number" name="doors"
               value="{{ old('doors', $car->doors ?? '') }}"
               class="form-control">
    </div>

    <div class="col-4">
        <label class="form-label">Seats</label>
        <input type="number" name="seats"
               value="{{ old('seats', $car->seats ?? '') }}"
               class="form-control">
    </div>

    <div class="col-4">
        <label class="form-label">Color</label>
        <input type="text" name="color"
               value="{{ old('color', $car->color ?? '') }}"
               class="form-control">
    </div>

</div>

{{-- Origin / Location --}}
<div class="row mb-5">

    <div class="col-6">
        <label class="form-label">Origin</label>
        <input type="text" name="origin"
               value="{{ old('origin', $car->origin ?? '') }}"
               class="form-control">
    </div>

    <div class="col-6">
        <label class="form-label">Location</label>
        <input type="text" name="location"
               value="{{ old('location', $car->location ?? '') }}"
               class="form-control">
    </div>

</div>

{{-- Pricing --}}
<div class="row mb-5">
    <div class="col-6">
        <label class="form-label">Price (SAR)</label>
        <input type="number" step="0.01" name="price"
               value="{{ old('price', $car->price ?? '') }}"
               class="form-control">
    </div>

    <div class="col-6">
        <label class="form-label">VAT Included?</label>
        <select name="is_with_vat" class="form-select">
            <option value="0" @selected(old('is_with_vat', $car->is_with_vat ?? 0) == 0)>
                Without VAT
            </option>
            <option value="1" @selected(old('is_with_vat', $car->is_with_vat ?? 0) == 1)>
                With VAT
            </option>
        </select>
    </div>
</div>

{{-- Description --}}
<div class="mb-5">
    <label class="form-label">Description</label>
    <textarea name="description" rows="4" class="form-control">{{ old('description', $car->description ?? '') }}</textarea>
</div>

{{-- Upload Images --}}
<div class="mb-5">
    <label class="form-label">Car Images</label>
    <input type="file" name="images[]" class="form-control" multiple>
    <div class="form-text">
        You can upload multiple images. Allowed types: jpg, jpeg, png, webp.
    </div>
</div>

{{-- Gallery --}}
@if($car && $car->exists && $car->images?->count())
    <div class="mb-5">
        <label class="form-label">Current Images</label>

        <div class="d-flex flex-wrap gap-4">
            @foreach($car->images as $img)
                <div class="position-relative">

                    <div class="symbol symbol-150px">
                        <img src="{{ asset('storage/' . $img->path) }}" alt="">
                    </div>

                    {{-- MAIN BADGE / Set main --}}
                    @if($img->is_main)
                        <span class="badge bg-success position-absolute top-0 start-0 m-2">
                            Main
                        </span>
                    @else
                        <form method="POST"
                              action="{{ route('admin.car-images.set-main', $img) }}"
                              class="position-absolute bottom-0 start-0 m-2">
                            @csrf
                            <button class="btn btn-sm btn-light-primary">
                                Set Main
                            </button>
                        </form>
                    @endif

                    {{-- Delete --}}
                    <form method="POST"
                          action="{{ route('admin.car-images.destroy', $img) }}"
                          class="position-absolute top-0 end-0 m-2"
                          onsubmit="return confirm('Delete this image?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-light-danger">
                            X
                        </button>
                    </form>

                </div>
            @endforeach
        </div>
    </div>
@endif

{{-- Submit --}}
<div class="text-end">
    <button type="submit" class="btn btn-primary px-5">
        Save
    </button>
</div>
