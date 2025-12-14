@extends('cpanel.layout.default')
@section('content')
    <div class="card  ml-5">
        <div class="card-header">
            <h3 class="card-title">
                Edit Category #{{ $heavyVehicleCategory->id }}
            </h3>
        </div>
        <div class="card-body">
            <form method="POST"
                  action="{{ route('admin.heavy-vehicle-categories.update', $heavyVehicleCategory) }}">
                @method('PUT')
                @include('cpanel.heavy_vehicle_categories._form', [
                    'heavyVehicleCategory' => $heavyVehicleCategory
                ])
            </form>
        </div>
    </div>
@endsection
