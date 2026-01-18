<div class="row mb-5">

    <div class="col-6">
        <label class="col-lg-3 col-form-label fw-semibold required">Name (EN)</label>
        <div class="col-lg-9">
            <input type="text"
                   name="name_en"
                   class="form-control form-control-solid @error('name_en') is-invalid @enderror"
                   value="{{ old('name_en', $type->name_en) }}"
                   placeholder="e.g. GPS Tracker">
            @error('name_en')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-6">
        <label class="col-lg-3 col-form-label fw-semibold required">Name (AR)</label>
        <div class="col-lg-9">
            <input type="text"
                   name="name_ar"
                   class="form-control form-control-solid @error('name_ar') is-invalid @enderror"
                   value="{{ old('name_ar', $type->name_ar) }}"
                   placeholder="مثال: جهاز تتبع">
            @error('name_ar')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>


<div class="row mb-5">
    <div class="col-6">
        <label class="col-lg-3 col-form-label fw-semibold">Icon</label>
        <div class="col-lg-9">
            <input type="file"
                   name="icon"
                   class="form-control form-control-solid @error('icon') is-invalid @enderror"
                   accept="image/*">
            @error('icon')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="mt-4">
                <div class="symbol symbol-100px">
                    <img src="{{ $type->icon_url }}" alt="icon">
                </div>
                <div class="text-muted mt-2">Upload a small icon image (optional).</div>
            </div>
        </div>
    </div>
</div>
