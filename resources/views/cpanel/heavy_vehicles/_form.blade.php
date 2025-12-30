@csrf

<div class="row mb-5">
    <div class="col-4 col-md-4">
        <label class="form-label">Brand</label>
        <select name="brand_id" class="form-select @error('brand_id') is-invalid @enderror" required>
            <option value="">Select brand</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}"
                    @selected(old('brand_id', $heavyVehicle->brand_id ?? null) == $brand->id)>
                    {{ $brand->name_en }} - {{ $brand->name_ar }}
                </option>
            @endforeach
        </select>
        @error('brand_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-4 col-md-4">
        <label class="form-label">Model</label>
        <select name="model_id" class="form-select @error('model_id') is-invalid @enderror" required>
            <option value="">Select model</option>
            @foreach($models as $model)
                <option value="{{ $model->id }}"
                    @selected(old('model_id', $heavyVehicle->model_id ?? null) == $model->id)>
                    {{ $model->name_en }} - {{ $model->name_ar }}
                </option>
            @endforeach
        </select>
        @error('model_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-4 col-md-4">
        <label class="form-label">Year</label>
        <select name="manufacturing_year_id" class="form-select">
            <option value="">--</option>
            @foreach($years as $year)
                <option value="{{ $year->id }}"
                    @selected(old('manufacturing_year_id', $heavyVehicle->manufacturing_year_id ?? null) == $year->id)>
                    {{ $year->year }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="row mb-5">
    <div class="col-4 col-md-4">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
            <option value="">Select category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    @selected(old('category_id', $heavyVehicle->category_id ?? null) == $category->id)>
                    {{ $category->name_en }} - {{ $category->name_ar }}
                </option>
            @endforeach
        </select>
        @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-4 col-md-4">
        <label class="form-label">Condition</label>
        <select name="condition" class="form-select @error('condition') is-invalid @enderror" required>
            @php
                $cond = old('condition', $heavyVehicle->condition ?? 'used');
            @endphp
            <option value="new" @selected($cond === 'new')>New</option>
            <option value="used" @selected($cond === 'used')>Used</option>
            <option value="refurbished" @selected($cond === 'refurbished')>Refurbished</option>
        </select>
        @error('condition')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-4 col-md-4">
        <label class="form-label">Location</label>
        <input type="text" name="location"
               value="{{ old('location', $heavyVehicle->location ?? '') }}"
               class="form-control @error('location') is-invalid @enderror">
        @error('location')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row mb-5">
    <div class="col-4 col-md-4">
        <label class="form-label">Fuel Type</label>
        <input type="text" name="fuel_type"
               value="{{ old('fuel_type', $heavyVehicle->fuel_type ?? '') }}"
               class="form-control">
    </div>
    <div class="col-4 col-md-4">
        <label class="form-label">Engine Power (HP)</label>
        <input type="number" name="engine_power"
               value="{{ old('engine_power', $heavyVehicle->engine_power ?? '') }}"
               class="form-control">
    </div>
    <div class="col-4 col-md-4">
        <label class="form-label">Mileage (hours/km)</label>
        <input type="number" name="mileage"
               value="{{ old('mileage', $heavyVehicle->mileage ?? '') }}"
               class="form-control">
    </div>
</div>

<div class="row mb-5">
    <div class="col-4 col-md-4">
        <label class="form-label">Weight (kg)</label>
        <input type="number" name="operating_weight"
               value="{{ old('operating_weight', $heavyVehicle->weight ?? '') }}"
               class="form-control">
    </div>
    <div class="col-4 col-md-4">
        <label class="form-label">Engine Capacity</label>
        <input type="number" name="engine_capacity"
               value="{{ old('engine_capacity', $heavyVehicle->bucket_capacityengine_capacity ?? '') }}"
               class="form-control">
    </div>
    <div class="col-4 col-md-4">
        <label class="form-label">Transmission</label>
        <input type="text" name="transmission"
               value="{{ old('transmission', $heavyVehicle->transmission ?? '') }}"
               class="form-control">
    </div>
</div>

<div class="row mb-5">
    <div class="col-4 col-md-4">
        <label class="form-label">Origin</label>
        <input type="text" name="origin"
               value="{{ old('origin', $heavyVehicle->origin ?? '') }}"
               class="form-control">
    </div>

    <div class="col-4 col-md-4">
        <label class="form-label d-flex align-items-center">
            <input type="checkbox"
                   name="is_main"
                   value="1"
                   class="form-check-input me-2"
                @checked(old('is_main', $heavyVehicle->is_main ?? false))>

            <span>Vehicle is Main</span>
        </label>

        <div class="form-text text-primary">
            When Is Main checked this mean vehicle will be shown in landing page.
        </div>
    </div>
</div>

<div class="mb-5">
    <label class="form-label">Description</label>
    <textarea name="description" rows="4"
              class="form-control">{{ old('description', $heavyVehicle->description ?? '') }}</textarea>
</div>

<div class="mb-5">
    <label class="form-label">Images (multiple)</label>
    <input type="file"
           name="images[]"
           class="form-control @error('images.*') is-invalid @enderror"
           multiple>

    <div class="form-text">
        يمكنك رفع أكثر من صورة. المسموح: jpeg, png, webp | الحجم الأقصى: 4MB للصورة.
    </div>

    @error('images.*')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@if(!empty($heavyVehicle) && $heavyVehicle->images?->count())
    <div class="mb-5">
        <label class="form-label">Current Images</label>

        <div class="d-flex flex-wrap gap-4">
            @foreach($heavyVehicle->images as $img)

                <div class="position-relative">
                    <div class="symbol symbol-150px">
                        <img src="{{ asset('storage/' . $img->path) }}" alt="">
                    </div>

                    {{-- Badge: Main Image --}}
                    @if($img->is_main)
                        <span class="badge badge-success position-absolute top-0 start-0 m-2">
                            Main
                        </span>
                    @endif
                </div>

            @endforeach
        </div>
    </div>
@endif


<div class="text-end">
    <button type="submit" class="btn btn-primary">
        Save
    </button>
</div>
