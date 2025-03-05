@extends('layout.backend.main')

@section('page_content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <h2 class="mb-4">Purchase Report</h2>

                        <form method="POST" action="{{ url('/purchase-report') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="start_date" class="form-label">Start Date</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control"
                                        value="{{ $startDate ?? '' }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="end_date" class="form-label">End Date</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control"
                                        value="{{ $endDate ?? '' }}" required>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary">Generate Report</button>
                                </div>
                            </div>
                        </form>

                        @if(isset($purchases) && count($purchases) > 0)
                            <table class="table table-bordered mt-4">
                                <thead class="thead-primary">
                                    <tr>
                                        <th>ID</th>
                                        <th>Supplier</th>
                                        <th>Purchase Date</th>
                                        <th>Total Purchase</th>
                                        <th>Paid Amount</th>
                                        <th>Pending Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchases as $purchase)
                                        <tr>
                                            <td>{{ $purchase->id }}</td>
                                            <td>{{ $purchase->inv_supplier->first_name . ' ' .$purchase->inv_supplier->last_name  ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d M Y') }}</td>
                                            <td>{{ number_format($purchase->total_amount, 2) }}</td>
                                            <td>{{ number_format($purchase->paid_amount, 2) }}</td>
                                            <td>{{ number_format($purchase->pending_amount, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="mt-4 text-center text-muted">No purchases found for the selected date range.</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
