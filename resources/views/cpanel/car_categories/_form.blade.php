@csrf

<div class="row mb-5">
    <div class="col-6">
        <label class="form-label">Name (English)</label>
        <input type="text"
               name="name_en"
               value="{{ old('name_en', $carCategory->name_en ?? '') }}"
               class="form-control @error('name_en') is-invalid @enderror"
               required>
        @error('name_en')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-6">
        <label class="form-label">Name (Arabic)</label>
        <input type="text"
               name="name_ar"
               value="{{ old('name_ar', $carCategory->name_ar ?? '') }}"
               class="form-control @error('name_ar') is-invalid @enderror"
               required>
        @error('name_ar')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row mb-5">
    <div class="col-6">
        <label class="form-label">Description (English)</label>
        <textarea name="description_en"
                  rows="3"
                  class="form-control">{{ old('description_en', $carCategory->description_en ?? '') }}</textarea>
    </div>

    <div class="col-6">
        <label class="form-label">Description (Arabic)</label>
        <textarea name="description_ar"
                  rows="3"
                  class="form-control">{{ old('description_ar', $carCategory->description_ar ?? '') }}</textarea>
    </div>
</div>

<div class="text-end">
    <button class="btn btn-primary">Save</button>
</div>
