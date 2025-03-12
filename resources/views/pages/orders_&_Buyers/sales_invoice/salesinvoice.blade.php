@extends('layout.backend.main')

@section('page_content')
    <x-message-banner />

    <div class="card flex-fill">
        <x-page-header heading="Sales Invoices" btnText="Back" href="{{ url('sales-invoice/create') }}" />

        <table class="table table-striped table-bordered">
            <thead class="thead-primary">
                <tr>
                    <th>#</th>
                    <th>Buyer</th>
                    <th>Sale Date</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Discount</th>
                    <th>VAT</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sales_invoices as $invoice)
                    <tr>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->buyer->first_name . ' ' . $invoice->buyer->last_name ?? 'N/A' }}</td>
                        <td>{{ $invoice->sale_date ?? 'N/A' }}</td>
                        <td>{{ number_format($invoice->total_amount, 2) ?? 'N/A' }}</td>
                        <td>{{ number_format($invoice->paid_amount, 2) ?? 'N/A' }}</td>
                        <td>{{ number_format($invoice->discount, 2) ?? 'N/A' }}</td>
                        <td>{{ number_format($invoice->vat, 2) ?? 'N/A' }}</td>
                        <td>
                            @if ($invoice->invoice_status_id == 1)
                                <span class="badge badge-warning">{{ $invoice->invoice_status->name }}</span>
                            @else
                                {{ $invoice->invoice_status->name ?? 'N/A' }}
                            @endif
                        </td>
                        <td class="action-table-data">
                            <a href="">
                                <i data-feather="eye" class="feather-eye"></i>
                            </a>
                            {{-- <form action="{{ route('sales.destroy', $invoice->id) }}" method="POST" style="margin-bottom: 0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="confirm-text" style="padding: 2px; background: transparent; border: none; width: 30px; color: red">
                                    <i data-feather="trash-2" class="feather-trash-2 delete_icon"></i>
                                </button>
                            </form> --}}
                            <x-delete />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No sales invoices found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{ $sales_invoices->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
