@csrf

<h3 class="mb-5">Create Quotation for Request #{{ $model->id }} - {{ $model->order_number }}</h3>
<input type="hidden" name="type" value="heavy_vehicle">
<table class="table table-bordered align-middle">
    <thead>
    <tr class="text-center">
        <th>Brand</th>
        <th>Model</th>
        <th>Year</th>
        <th>Qty</th>
        <th>Unit Price</th>
        <th>Attachment</th>
        <th>Attachment Price</th>
        <th>Total Price</th>
        <th>With VAT?</th>
        <th>VAT</th>
        <th>Total With VAT</th>
    </tr>
    </thead>
    <tbody>

    @foreach($model->items as $index => $item)
        <tr class="quotation-row">

            <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $item->id }}">
            <input type="hidden" class="quantity" value="{{ $item->quantity }}">
            <input type="hidden" class="attachments-enabled" value="{{ $item->is_attachments_enabled }}">

            <td>{{ $item->brand->name_en }}</td>
            <td>{{ $item->model->name_en }}</td>
            <td>{{ $item->year?->year ?? '-' }}</td>
            <td class="text-center">{{ $item->quantity }}</td>

            <!-- Unit price -->
            <td>
                <input type="number" step="0.01"
                       class="form-control unit-price"
                       name="items[{{ $index }}][unit_price]" required>
            </td>

            <!-- Attachment info -->
            <td>
                @if($item->is_attachments_enabled)
                    <div class="text-success fw-bold">
                        {{ $item->attachmentType?->name_en }}
                    </div>
                    <small class="text-muted">
                        {{ $item->attachment_description }}
                    </small>
                @else
                    <span class="badge bg-light-secondary">No Attachment</span>
                @endif
            </td>

            <!-- Attachment price -->
            <td>
                @if($item->is_attachments_enabled)
                    <input type="number" step="0.01"
                           class="form-control attachment-price"
                           name="items[{{ $index }}][attachment_price]"
                           placeholder="Attachment price">
                @else
                    <input type="hidden" class="attachment-price" value="0"
                           name="items[{{ $index }}][attachment_price]">
                    <span class="text-muted">—</span>
                @endif
            </td>

            <!-- Total -->
            <td>
                <input type="number" step="0.01"
                       class="form-control total-price"
                       name="items[{{ $index }}][total_price]" readonly>
            </td>

            <!-- VAT -->
            <td class="text-center">
                <input type="checkbox"
                       class="form-check-input with-vat"
                       name="items[{{ $index }}][is_with_vat]" value="1">
            </td>

            <td>
                <input type="number" step="0.01"
                       class="form-control vat-amount"
                       name="items[{{ $index }}][vat_amount]" readonly>
            </td>

            <td>
                <input type="number" step="0.01"
                       class="form-control total-with-vat"
                       name="items[{{ $index }}][total_with_vat]" readonly>
            </td>

        </tr>
    @endforeach

    </tbody>
</table>

<hr>

<!-- Totals -->
<div class="row mt-5">
    <div class="col-md-4">
        <label>Total Amount</label>
        <input type="number" class="form-control" id="total_amount" name="total_amount" readonly>
    </div>

    <div class="col-md-4">
        <label>Total VAT</label>
        <input type="number" class="form-control" id="vat_amount" name="vat_amount" readonly>
    </div>

    <div class="col-md-4">
        <label>Total With VAT</label>
        <input type="number" class="form-control" id="total_with_vat" name="total_with_vat" readonly>
    </div>
</div>

<div class="text-end mt-5">
    <button class="btn btn-primary">Submit Quotation</button>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const rows = document.querySelectorAll('.quotation-row');

            rows.forEach(row => {

                const qty = parseFloat(row.querySelector('.quantity').value);
                const unitPriceInput = row.querySelector('.unit-price');
                const attachmentPriceInput = row.querySelector('.attachment-price');
                const totalPriceInput = row.querySelector('.total-price');
                const vatCheckbox = row.querySelector('.with-vat');
                const vatAmountInput = row.querySelector('.vat-amount');
                const totalWithVatInput = row.querySelector('.total-with-vat');

                function calculateRow() {

                    const unitPrice = parseFloat(unitPriceInput.value) || 0;
                    const attachmentPrice = parseFloat(attachmentPriceInput?.value) || 0;

                    const vehicleTotal = qty * unitPrice;
                    const rowTotal = vehicleTotal + attachmentPrice;

                    totalPriceInput.value = rowTotal.toFixed(2);

                    let vat = 0;
                    let totalWithVat = rowTotal;

                    if (vatCheckbox.checked) {
                        vat = rowTotal * 0.15;
                        totalWithVat = rowTotal + vat;
                    }

                    vatAmountInput.value = vat.toFixed(2);
                    totalWithVatInput.value = totalWithVat.toFixed(2);

                    calculateTotals();
                }

                unitPriceInput.addEventListener('input', calculateRow);
                if (attachmentPriceInput) {
                    attachmentPriceInput.addEventListener('input', calculateRow);
                }
                vatCheckbox.addEventListener('change', calculateRow);
            });

            function calculateTotals() {

                let totalAmount = 0;
                let totalVat = 0;
                let totalWithVat = 0;

                document.querySelectorAll('.total-price').forEach(el => {
                    totalAmount += parseFloat(el.value) || 0;
                });

                document.querySelectorAll('.vat-amount').forEach(el => {
                    totalVat += parseFloat(el.value) || 0;
                });

                document.querySelectorAll('.total-with-vat').forEach(el => {
                    totalWithVat += parseFloat(el.value) || 0;
                });

                document.getElementById('total_amount').value = totalAmount.toFixed(2);
                document.getElementById('vat_amount').value = totalVat.toFixed(2);
                document.getElementById('total_with_vat').value = totalWithVat.toFixed(2);
            }

        });
    </script>
@endpush
