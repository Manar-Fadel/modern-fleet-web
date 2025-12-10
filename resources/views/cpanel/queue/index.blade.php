@extends('cpanel.layout.default')
@section('content')

    <div class="card mb-5">
        <div class="card-header">
            <h3 class="card-title">Queue Jobs Monitor</h3>
        </div>

        <div class="card-body">

            {{-- Filters --}}
            <form method="GET" class="row g-3 mb-5">
                <div class="row col-12 flex gap-6">
                    <div class="col-3 col-md-3">
                        <select name="status" class="select select-sm w-36">
                            <option value="">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="running">Running</option>
                            <option value="completed">Completed</option>
                            <option value="failed">Failed</option>
                        </select>
                    </div>

                    <div class="col-3 col-md-3">
                        <input type="text" name="job_class" class="input w-36" placeholder="Job Class">
                    </div>

                    <div class="col-2 col-md-2">
                        <button class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-row-bordered align-middle">
                    <thead>
                    <tr class="fw-bold text-muted">
                        <th>ID</th>
                        <th>Job</th>
                        <th>Status</th>
                        <th>Attempts</th>
                        <th>Related</th>
                        <th>Started</th>
                        <th>Finished</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($monitors as $monitor)
                        <tr>
                            <td>{{ $monitor->id }}</td>
                            <td class="text-gray-800">{{ class_basename($monitor->job_class) }}</td>
                            <td>
                            <span class="badge badge-light-{{
                                $monitor->status === 'failed' ? 'danger' :
                                ($monitor->status === 'running' ? 'info' : 'success')
                            }}">
                                {{ ucfirst($monitor->status) }}
                            </span>
                            </td>
                            <td>{{ $monitor->attempts }}</td>
                            <td>
                                {{ $monitor->related_type }}
                                #{{ $monitor->related_id }}
                            </td>
                            <td>{{ optional($monitor->started_at)->diffForHumans() }}</td>
                            <td>{{ optional($monitor->finished_at)->diffForHumans() }}</td>
                            <td>
                                <a href="{{ route('admin.queue.show', $monitor) }}"
                                   class="btn btn-sm btn-light-primary">
                                    View
                                </a>

                                @if($monitor->status === 'failed')
                                    <form method="POST"
                                          action="{{ route('admin.queue.retry', $monitor) }}"
                                          class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-light-warning">
                                            Retry
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{ $monitors->links() }}

        </div>
    </div>

@endsection
