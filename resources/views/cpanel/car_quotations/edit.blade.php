@extends('cpanel.layout.default')
@section('content')
    <div class="card  ml-5">
        <div class="card-header">
            <h3 class="card-title">
                Edit Quotation #{{ $carQuotation->id }}
            </h3>
        </div>
        <div class="card-body">
            <form method="POST"
                  action="{{ route('admin.car-quotations.update', $carQuotation) }}">
                @method('PUT')
                @include('cpanel.car_quotations._form', [
                    'carQuotation' => $carQuotation
                ])
            </form>
        </div>
    </div>
@endsection
