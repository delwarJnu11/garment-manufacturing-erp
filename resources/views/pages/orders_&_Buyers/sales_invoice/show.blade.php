@extends('layout.backend.main')

@section('page_content')
    <x-page-header heading="Sales Invoice Details" btnText="Back" href="{{ route('sales-invoice.index') }}" />

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Invoice ID</th>
                    <td>{{ $salesInvoice->id }}</td>
                </tr>
                <tr>
                    <th>Buyer Name</th>
                    <td>{{ $salesInvoice->buyer->first_name . ' ' . $salesInvoice->buyer->last_name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Sale Date</th>
                    <td>{{ $salesInvoice->sale_date->format('d M, Y') ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Total Amount</th>
                    <td>{{ number_format($salesInvoice->total_amount, 2) }}</td>
                </tr>
                <tr>
                    <th>Paid Amount</th>
                    <td>{{ number_format($salesInvoice->paid_amount, 2) }}</td>
                </tr>
                <tr>
                    <th>Discount</th>
                    <td>{{ number_format($salesInvoice->discount, 2) }}</td>
                </tr>
                <tr>
                    <th>VAT</th>
                    <td>{{ number_format($salesInvoice->vat, 2) }}</td>
                </tr>
                <tr>
                    <th>Invoice Status</th>
                    <td>
                        @if ($salesInvoice->invoice_status_id == 1)
                            <span class="badge badge-warning">{{ $salesInvoice->invoice_status->name }}</span>
                        @else
                            {{ $salesInvoice->invoice_status->name ?? 'N/A' }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $salesInvoice->created_at->format('d M, Y h:i A') }}</td>
                </tr>
            </table>

            <h5 class="mt-4">Invoice Products</h5>
            <table class="table table-bordered mt-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>VAT</th>
                        <th>Discount</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salesInvoice->salesInvoiceDetails as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->product->name ?? 'N/A' }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ number_format($item->unit_price, 2) }}</td>
                            <td>{{ number_format($item->vat, 2) }}</td>
                            <td>{{ number_format($item->discount, 2) }}</td>
                            <td>{{ number_format(($item->unit_price * $item->qty) - $item->discount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
