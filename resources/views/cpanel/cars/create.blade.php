@extends('cpanel.layout.default')
@section('content')
    <div class="card  ml-5">
        <div class="card-header">
            <h3 class="card-title">Add Car</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
                @php($car = null)
                @include('cpanel.cars._form')
            </form>
        </div>
    </div>
@endsection
