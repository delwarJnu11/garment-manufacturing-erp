@extends('layout.backend.main')

@section('page_content')
    <x-message-banner />

    @if ($errors->any())
    <div class="alert alert-danger" id="error-message">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    <script>
        setTimeout(function () {
            document.getElementById('error-message').style.display = 'none';
        }, 4000); 
    </script>
@endif


    <div class="card flex-fill">
        {{-- <x-page-header heading="Payment Report" /> --}}

        <table class="table table-striped table-bordered">
            <thead class="thead-primary">
                <tr>
                    <th>#</th>
                    <th>Invoice No</th>
                    <th>Order Number</th>
                    <th>Buyer</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Due Amount</th>
                    <th>Payment Status</th>
                    <th>Payment Method</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    // Group by unique sales invoice IDs
                    $uniqueSalesPayments = $salesPayments->unique(function ($payment) {
                        return $payment->sales_invoice_id . '-' . $payment->order_id;
                    });
                @endphp
            
                @forelse ($uniqueSalesPayments as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>#000{{ optional($payment->salesInvoice)->id ?? 'N/A' }}</td>
                        <td>{{ optional($payment->order)->order_number ?? 'N/A' }}</td>
                        <td>{{ optional($payment->order->buyer)->first_name . ' ' . optional($payment->order->buyer)->last_name ?? 'N/A' }}</td>
                        <td>{{ number_format(optional($payment->salesInvoice)->total_amount ?? 0, 2) }}</td>
                        <td>{{ number_format(optional($payment->salesInvoice)->paid_amount ?? 0, 2) }}</td>
                        <td>{{ number_format((optional($payment->salesInvoice)->total_amount ?? 0) - (optional($payment->salesInvoice)->paid_amount ?? 0), 2) }}</td>
                        <td>
                            @php
                                $dueAmount = optional($payment->salesInvoice)->total_amount - optional($payment->salesInvoice)->paid_amount;
                            @endphp
                            {{-- {{ $dueAmount > 0 ? 'Due' : 'Paid' }} --}}
                            @if ($dueAmount === 0)
                            <span class="badge badge-success">Paid</span>
                                
                            @elseif ($dueAmount > 0 && $dueAmount < optional($payment->salesInvoice)->total_amount)
                            <span class="badge badge-warning">Partially paid</span>
                                @else
                                <span class="badge badge-danger">Due</span>
                            @endif
                        </td>
                        <td>Cash</td>
                        <td class="action-table-data">
                            <a href="{{ route('salesPayments.edit', optional($payment->salesInvoice)->id ?? 0) }}">
                                <i data-feather="edit" class="feather-edit"></i>
                            </a>
                            
                        </td>
                    </tr>
                @empty

                    <tr>
                        <td colspan="10" class="text-center">No payments found.</td>
                    </tr>

                @endforelse
            </tbody>
            
            {{-- <tbody>
                @forelse ($salesPayments as $payment)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>#000{{ optional($payment->salesInvoice)->id ?? 'N/A' }}</td>
                        <td>{{ optional($payment->order->first())->order_number ?? 'N/A' }}</td>
                        <td>{{ optional(optional($payment->order)->buyer)->first_name . ' ' . optional(optional($payment->order)->buyer)->last_name ?? 'N/A' }}</td>
                        <td>{{ number_format(optional($payment->salesInvoice)->total_amount ?? 0, 2) }}</td>
                        <td>{{ number_format(optional($payment->salesInvoice)->paid_amount ?? 0, 2) }}</td>
                        <td>{{ number_format((optional($payment->salesInvoice)->total_amount ?? 0) - (optional($payment->salesInvoice)->paid_amount ?? 0), 2) }}</td>
                        <td>
                            @php
                                $dueAmount = optional($payment->salesInvoice)->total_amount - optional($payment->salesInvoice)->paid_amount;
                            @endphp
                        
                            @if ($dueAmount == 0)
                                <span class="badge badge-success">Paid</span>
                            @elseif ($dueAmount > 0 && $dueAmount < optional($payment->salesInvoice)->total_amount)
                                <span class="badge badge-warning">Partially Paid</span>
                            @else
                                <span class="badge badge-danger">Due</span>
                            @endif
                        </td>
                        
                        <td>{{ optional(optional($payment->salesInvoice)->payment_method)->name ?? 'N/A' }}</td>
                        <td class="action-table-data">
                            <a href="{{ route('salesPayments.edit', optional($payment->salesInvoice)->id ?? 0) }}">
                                <i data-feather="edit" class="feather-edit"></i>
                            </a>
                            
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No payment records found.</td>
                    </tr>
                @endforelse
            </tbody> --}}
            
        </table>

        <div class="d-flex justify-content-end">
            {{-- {{ $salesPayments->links('vendor.pagination.custom') }} --}}
        </div>
    </div>
@endsection
