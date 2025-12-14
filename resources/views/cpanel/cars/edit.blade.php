@extends('cpanel.layout.default')
@section('content')
    <div class="card  ml-5">
        <div class="card-header">
            <h3 class="card-title">
                Edit Car #{{ $car->id }}
            </h3>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.cars.update', $car) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('cpanel.cars._form')
            </form>
        </div>
    </div>
@endsection
