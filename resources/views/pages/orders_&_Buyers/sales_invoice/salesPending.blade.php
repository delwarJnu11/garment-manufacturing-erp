@extends('layout.backend.main')

@section('page_content')
    <x-message-banner />

    <div class="card flex-fill">
        <x-page-header heading="Sales Invoices" btnText="Back" href="{{ url('sales-invoice/create') }}" />

        <table class="table ">
            <thead class="thead thead-primary">
                <tr>
                    <th>#</th>
                    <th>Order No</th>
                    <th>Buyer Name</th>
                    <th>Total Amount</th>
                    <th>Invoice Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salesInvoices as $key=> $invoice)
                <tr>
                    <td>{{$key + 1}}</td>
                    
                    <td>
                        @if($invoice->salesInvoiceDetails->isNotEmpty())
                            {{ $invoice->salesInvoiceDetails->first()->order->order_number ?? 'N/A' }}
                        @else
                            N/A
                        @endif
                    </td>
                    
                    <td>{{$invoice->buyer->first_name. ' '. $invoice->buyer->first_name}}</td>
                    <td>{{$invoice->total_amount}}</td>
                    <td>
                        <select class="status-dropdown form-control select-form" data-id="{{ $invoice->id }}">
                            @foreach($invoiceStatuses as $status)
                                <option value="{{ $status->id }}" {{ $invoice->invoice_status_id == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <button class="update-status btn btn-primary" data-id="{{ $invoice->id }}">Update</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
     @section('script')

        <script>
            $(document).on('click', '.update-status', function() {
                var invoiceId = $(this).data('id');
                var statusId = $(this).closest('tr').find('.status-dropdown').val();
        
                $.ajax({
                    url: '/sales-invoice/update-status/' + invoiceId,
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        invoice_status_id: statusId
                    },
                    success: function(response) {
                        alert(response.message);
                        // location.reload(); // Refresh the page to see the updated status
                        window.location.href='/salesPayments'
                    },
                    error: function(xhr) {
                        alert('Error updating status');
                    }
                });
            });
        </script>
                 
     @endsection