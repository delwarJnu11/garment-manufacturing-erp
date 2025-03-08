@extends('layout.backend.main')

@section('page_content')
    <x-message-banner />
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card flex-fill">
        {{-- <x-page-header heading="Payment Report" /> --}}

        <table class="table table-striped table-bordered">
            <thead class="thead-primary">
                <tr>
                    <th>#</th>
                    <th>Invoice No</th>
                    <th>Supplier</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Due Amount</th>
                    <th>Payment Status</th>
                    <th>Payment Method</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>PO-{{ $payment->id }}</td>
                        <td>{{ $payment->inv_supplier->first_name . ' ' . $payment->inv_supplier->last_name ?? 'N/A' }}</td>
                        <td>${{ number_format($payment->total_amount, 2) }}</td>
                        <td>${{ number_format($payment->paid_amount, 2) }}</td>
                        <td>${{ number_format($payment->due_amount, 2) }}</td>
                        <td>
                            @if ($payment->payment_status == 'Paid')
                                <span class="badge badge-success">Paid</span>
                            @elseif ($payment->payment_status == 'Partially Paid')
                                <span class="badge badge-warning">Partially Paid</span>
                            @else
                                <span class="badge badge-danger">Due</span>
                            @endif
                        </td>
                        <td>{{ $payment->payment_method ?? 'N/A' }}</td>
                        <td class="action-table-data">
                            <a href="{{ route('payments.edit', $payment->id) }}">
                                <i data-feather="edit" class="feather-edit"></i>
                            </a>
                        
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No payment records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{ $payments->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
