@extends('cpanel.layout.default')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Heavy Vehicle</h3>
            <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
                @include("cpanel.includes.alerts")
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.heavy-vehicles.store') }}" method="POST" enctype="multipart/form-data">
                @php($heavyVehicle = null)
                @include('cpanel.heavy_vehicles._form')
            </form>
        </div>
    </div>
@endsection
