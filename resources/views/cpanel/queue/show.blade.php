@extends('cpanel.layout.default')
@section('content')

    <div class="card  ml-5">
        <div class="card-header">
            <h3 class="card-title">Job Details #{{ $monitor->id }}</h3>
        </div>

        <div class="card-body">

            <dl class="row">
                <dt class="col-sm-3">Job Class</dt>
                <dd class="col-sm-9">{{ $monitor->job_class }}</dd>

                <dt class="col-sm-3">Queue</dt>
                <dd class="col-sm-9">{{ $monitor->queue }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">{{ ucfirst($monitor->status) }}</dd>

                <dt class="col-sm-3">Attempts</dt>
                <dd class="col-sm-9">{{ $monitor->attempts }}</dd>

                <dt class="col-sm-3">Related</dt>
                <dd class="col-sm-9">
                    {{ $monitor->related_type }} #{{ $monitor->related_id }}
                </dd>

                <dt class="col-sm-3">Payload</dt>
                <dd class="col-sm-9">
                <pre class="bg-light p-4 rounded">
{{ $monitor->payload }}
                </pre>
                </dd>

                @if($monitor->error)
                    <dt class="col-sm-3 text-danger">Error</dt>
                    <dd class="col-sm-9 text-danger">
                        <pre>{{ $monitor->error }}</pre>
                    </dd>
                @endif
            </dl>

        </div>
    </div>

@endsection
