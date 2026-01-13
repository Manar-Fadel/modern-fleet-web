<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Quotation #{{ $quotation->id }}</title>

    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align:center; margin-bottom:30px; }
        .title { font-size:22px; font-weight:bold; }
        .sub { color:#777; }

        table { width:100%; border-collapse: collapse; margin-top:20px; }
        th, td { border:1px solid #ddd; padding:8px; }
        th { background:#f5f5f5; }

        .totals td { font-weight:bold; }

        .footer { margin-top:40px; text-align:center; font-size:11px; color:#777; }
    </style>
</head>
<body>

<div class="header">
    <div class="title">Modern Fleet</div>
    <div class="sub">Official Quotation</div>
</div>

<hr>

<h3>Quotation #{{ $quotation->id }}</h3>
<p>
    Client: {{ $quotation->request->user->name }} <br>
    Email: {{ $quotation->request->user->email }} <br>
    Date: {{ $quotation->created_at->format('Y-m-d') }}
</p>

<h4>Requested Vehicles</h4>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Brand</th>
        <th>Model</th>
        <th>Year</th>
        <th>Qty</th>
        <th>Unit Price</th>
        <th>Total</th>
        <th>VAT</th>
        <th>Total With VAT</th>
    </tr>
    </thead>
    <tbody>
    @foreach($quotation->items as $index => $item)
        @php $reqItem = $item->requestItem; @endphp
        <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $reqItem->brand->name_en }}</td>
            <td>{{ $reqItem->model->name_en }}</td>
            <td>{{ $reqItem->year?->year ?? '-' }}</td>
            <td>{{ $reqItem->quantity }}</td>
            <td>{{ number_format($item->unit_price,2) }} SAR</td>
            <td>{{ number_format($item->total_price,2) }} SAR</td>
            <td>{{ number_format($item->vat_amount,2) }} SAR</td>
            <td>{{ number_format($item->total_with_vat,2) }} SAR</td>
        </tr>
    @endforeach
    </tbody>
</table>

<table class="totals">
    <tr>
        <td>Total Amount</td>
        <td>{{ number_format($quotation->total_amount,2) }} SAR</td>
    </tr>
    <tr>
        <td>VAT</td>
        <td>{{ number_format($quotation->vat_amount,2) }} SAR</td>
    </tr>
    <tr>
        <td>Total With VAT</td>
        <td>{{ number_format($quotation->total_with_vat,2) }} SAR</td>
    </tr>
</table>

<div class="footer">
    This quotation is generated electronically by Modern Fleet.<br>
    For inquiries contact support@modernfleet.com
</div>

</body>
</html>
