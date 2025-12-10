@extends('cpanel.layout.default')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Heavy Vehicle #{{ $heavyVehicle->id }}</h3>
            <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                @include("cpanel.includes.alerts")
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.heavy-vehicles.update', $heavyVehicle) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @php($hv = $heavyVehicle)
                @include('cpanel.heavy_vehicles._form', ['heavyVehicle' => $hv])
            </form>
        </div>
    </div>
@endsection
