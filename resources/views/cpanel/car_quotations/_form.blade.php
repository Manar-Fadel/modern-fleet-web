@csrf

<div class="row mb-5">
    <div class="col-6">
        <label class="form-label">Request</label>
        <select name="request_id" class="form-select">
            @foreach($requests as $req)
                <option value="{{ $req->id }}"
                    @selected(old('request_id', $carQuotation->request_id ?? '') == $req->id)>
                    RFQ #{{ $req->id }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-6">
        <label class="form-label">User</label>
        <select name="user_id" class="form-select">
            @foreach($users as $user)
                <option value="{{ $user->id }}"
                    @selected(old('user_id', $carQuotation->user_id ?? '') == $user->id)>
                    {{ $user->full_name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="row mb-5">
    <div class="col-4">
        <label class="form-label">Unit Price</label>
        <input type="number" step="0.01" name="unit_price"
               value="{{ old('unit_price', $carQuotation->unit_price ?? '') }}"
               class="form-control" required>
    </div>

    <div class="col-4">
        <label class="form-label">Total Price</label>
        <input type="number" step="0.01" name="total_price"
               value="{{ old('total_price', $carQuotation->total_price ?? '') }}"
               class="form-control" required>
    </div>

    <div class="col-4">
        <label class="form-label">VAT</label>
        <select name="is_with_vat" class="form-select">
            <option value="1" @selected(old('is_with_vat', $carQuotation->is_with_vat ?? '') == 1)>
                With VAT
            </option>
            <option value="0" @selected(old('is_with_vat', $carQuotation->is_with_vat ?? '') == 0)>
                Without VAT
            </option>
        </select>
    </div>
</div>

<div class="mb-5">
    <label class="form-label">Status</label>
    <select name="status" class="form-select">
        @foreach($statuses as $s)
            <option value="{{ $s->name }}"
                @selected(old('status', $carQuotation->status ?? '') === $s->name)>
                {{ ucfirst($s->value) }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-5">
    <label class="form-label">Description</label>
    <textarea name="description"
              rows="3"
              class="form-control">{{ old('description', $carQuotation->description ?? '') }}</textarea>
</div>

<div class="text-end">
    <button class="btn btn-primary">Save</button>
</div>
