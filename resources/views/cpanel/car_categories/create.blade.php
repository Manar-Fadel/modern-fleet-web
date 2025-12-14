@extends('cpanel.layout.default')
@section('content')
    <div class="card  ml-5">
        <div class="card-header">
            <h3 class="card-title">Add Category</h3>
        </div>
        <div class="card-body">
            <form method="POST"
                  action="{{ route('admin.car-categories.store') }}">
                @include('cpanel.car_categories._form')
            </form>
        </div>
    </div>
@endsection
