@extends('cpanel.layout.default')
@section('content')
    <div class="container-xxl">
        @include('cpanel.includes.alerts')

        <div class="card ml-5">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="fw-bold m-0">Add Attachment Type</h3>
                </div>
                <div class="card-toolbar">
                    <a href="{{ route('admin.attachment-types.index') }}" class="btn btn-light">
                        Back
                    </a>
                </div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.attachment-types.store') }}" enctype="multipart/form-data">
                    @csrf

                    @include('cpanel.attachment-types.partials.form', ['type' => $type])

                    <div>
                        <button class="btn btn-primary" type="submit">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
