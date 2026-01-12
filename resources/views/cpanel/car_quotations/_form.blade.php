@csrf

<h3 class="mb-5">Create Quotation for Request ID{{ $model->id }} - {{ $model->order_number }}</h3>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>Brand</th>
        <th>Model</th>
        <th>Year</th>
        <th>Qty</th>
        <th>Unit Price</th>
        <th>Total Price</th>
        <th>With VAT?</th>
        <th>VAT Amount</th>
        <th>Total With VAT</th>
    </tr>
    </thead>
    <tbody>

    @foreach($model->items as $index => $item)
        <tr class="quotation-row">
            <input type="hidden" name="items[{{ $index }}][item_id]" value="{{ $item->id }}">
            <input type="hidden" class="quantity" value="{{ $item->quantity }}">

            <td>{{ $item->brand->name_en }}</td>
            <td>{{ $item->model->name_en }}</td>
            <td>{{ $item->year?->year ?? '-' }}</td>
            <td>{{ $item->quantity }}</td>

            <td>
                <input type="number" step="0.01" class="form-control unit-price"
                       name="items[{{ $index }}][unit_price]" required>
            </td>

            <td>
                <input type="number" step="0.01" class="form-control total-price"
                       name="items[{{ $index }}][total_price]" readonly>
            </td>

            <td class="text-center">
                <input type="checkbox" class="form-check-input with-vat"
                       name="items[{{ $index }}][is_with_vat]" value="1">
            </td>

            <td>
                <input type="number" step="0.01" class="form-control vat-amount"
                       name="items[{{ $index }}][vat_amount]" readonly>
            </td>

            <td>
                <input type="number" step="0.01" class="form-control total-with-vat"
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
        <input type="number" step="0.01" class="form-control" name="total_amount" id="total_amount" readonly>
    </div>

    <div class="col-md-4">
        <label>Total VAT</label>
        <input type="number" step="0.01" class="form-control" name="vat_amount" id="vat_amount" readonly>
    </div>

    <div class="col-md-4">
        <label>Total With VAT</label>
        <input type="number" step="0.01" class="form-control" name="total_with_vat" id="total_with_vat" readonly>
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
            const totalPriceInput = row.querySelector('.total-price');
            const vatCheckbox = row.querySelector('.with-vat');
            const vatAmountInput = row.querySelector('.vat-amount');
            const totalWithVatInput = row.querySelector('.total-with-vat');

            function calculateRow() {
                const unitPrice = parseFloat(unitPriceInput.value) || 0;
                const totalPrice = qty * unitPrice;

                totalPriceInput.value = totalPrice.toFixed(2);

                let vat = 0;
                let totalWithVat = totalPrice;

                if (vatCheckbox.checked) {
                    vat = totalPrice * 0.15;
                    totalWithVat = totalPrice + vat;
                }

                vatAmountInput.value = vat.toFixed(2);
                totalWithVatInput.value = totalWithVat.toFixed(2);

                calculateTotals();
            }

            unitPriceInput.addEventListener('input', calculateRow);
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
