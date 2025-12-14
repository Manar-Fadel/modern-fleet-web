@extends('cpanel.layout.default')
@section('content')
    <div class="card  ml-5">
        <div class="card-header">
            <h3 class="card-title">
                Edit Category #{{ $carCategory->id }}
            </h3>
        </div>
        <div class="card-body">
            <form method="POST"
                  action="{{ route('admin.car-categories.update', $carCategory) }}">
                @method('PUT')
                @include('cpanel.car_categories._form', [
                    'carCategory' => $carCategory
                ])
            </form>
        </div>
    </div>
@endsection
