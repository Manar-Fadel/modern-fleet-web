@extends('cpanel.layout.default')
@section('content')
    <div class="card  ml-5">
        <div class="card-header">
            <h3 class="card-title">Add Quotation</h3>
        </div>
        <div class="card-body">
            <form method="POST"
                  action="{{ route('admin.car-quotations.store', ['id' => $id]) }}">
                @include('cpanel.car_quotations._form')
            </form>
        </div>
    </div>
@endsection
