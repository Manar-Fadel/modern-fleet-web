@extends('cpanel.layout.default')
@section('content')
    <div class="card  ml-5">
        <div class="card-header pt-6">
            <div class="card-title">
                <h3 class="fw-bold">Car Quotations</h3>
            </div>
        </div>

        <div class="card-body pt-5">

            {{-- Filters --}}
            <form method="GET" class="row mb-5">
                <div class="col-2">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status->name }}" @selected(request('status') === $status->name)>
                                {{ $status->value }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-2">
                    <select name="is_with_vat" class="form-select">
                        <option value="">VAT?</option>
                        <option value="1" @selected(request('is_with_vat') === '1')>
                            With VAT
                        </option>
                        <option value="0" @selected(request('is_with_vat') === '0')>
                            Without VAT
                        </option>
                    </select>
                </div>

                <div class="col-2">
                    <input type="date"
                           name="from_date"
                           value="{{ request('from_date') }}"
                           class="form-control">
                </div>

                <div class="col-2">
                    <input type="date"
                           name="to_date"
                           value="{{ request('to_date') }}"
                           class="form-control">
                </div>

                <div class="col-2">
                    <button class="btn btn-light-primary">
                        Filter
                    </button>
                </div>
            </form>

            {{-- Table --}}
            <div class="table-responsive">
                <table class="table table-row-bordered align-middle">
                    <thead>
                    <tr class="fw-bold text-muted">
                        <th>#</th>
                        <th>Request</th>
                        <th>User</th>
                        <th>Total Price</th>
                        <th>VAT</th>
                        <th>Total With VAT</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th class="text-end">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quotations as $q)
                        <tr>
                            <td>{{ $q->id }}</td>
                            <td>ID: {{ $q->car_request_id }} - No. {{ $q->request->order_number }}</td>
                            <td>{{ $q->request->user->full_name ?? '-' }}</td>
                            <td>{{ number_format($q->total_amount, 2) }}</td>
                            <td>{{ number_format($q->vat_amount, 2) }}</td>
                            <td>{{ number_format($q->total_with_vat, 2) }}</td>
                            <td>
                            <span class="badge badge-light-primary">
                                {{ ucfirst($q->status) }}
                            </span>
                            </td>
                            <td>{{ $q->created_at->format('Y-m-d') }}</td>
                            <td class="text-end">
                                @if($q->status == 'PENDING')
                                <a href="{{ route('admin.car-quotations.edit', $q) }}"
                                   class="btn btn-sm btn-light-primary">
                                    Edit
                                </a>
                                @endif

                                <form method="POST"
                                      action="{{ route('admin.car-quotations.destroy', $q) }}"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete this quotation?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-light-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{ $quotations->links() }}
        </div>
    </div>
@endsection
