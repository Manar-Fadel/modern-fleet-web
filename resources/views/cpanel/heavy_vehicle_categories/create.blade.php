@extends('cpanel.layout.default')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Add Category</h3>
        </div>
        <div class="card-body">
            <form method="POST"
                  action="{{ route('admin.heavy-vehicle-categories.store') }}">
                @include('cpanel.heavy_vehicle_categories._form')
            </form>
        </div>
    </div>
@endsection
