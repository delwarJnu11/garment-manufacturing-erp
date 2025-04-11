@extends('layout.backend.main')

@section('page_content')
<div class="container mt-5">
    <div class="card">
        <div>
            <h3 class="card-header text-center bg-primary text-white">Sales Invoice Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Order Details:</h5>
                    <p><strong>Order Number:</strong>
                        {{ $salesInvoiceDetails->salesInvoiceDetails->first()->order->order_number ?? 'N/A' }}
                    </p>
                    
                    <p><strong>Buyer Name:</strong> {{ $salesInvoiceDetails->buyer->first_name . ' '. $salesInvoiceDetails->buyer->last_name ?? 'N/A' }}</p>
                </div>
                <div class="col-md-6 text-end">
                    <h5>Invoice Details:</h5>
                    <p><strong>Invoice ID:</strong> #INV-{{ str_pad($salesInvoiceDetails->id, 6, '0', STR_PAD_LEFT) }}</p>
                    <p><strong>Sale Date:</strong> {{ $salesInvoiceDetails->sale_date->format('d M, Y') ?? 'N/A' }}</p>
                    <p><strong>Status:</strong> {{ $salesInvoiceDetails->invoice_status->name ?? 'N/A' }}</p>
                </div>
            </div>
            <hr>
            <h5>Product Details</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>VAT</th>
                        <th>Discount</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($salesInvoiceDetails->salesInvoiceDetails->groupBy('order_detail.size_id') as $sizeGroup)
            @foreach ($sizeGroup as $item)
                <tr>
                    <!-- Access the product and size for each item -->
                    <td>{{ $item->orderDetail->product->name ?? 'N/A' }}</td>
                    <td>{{ $item->orderDetail->size->name ?? 'N/A' }}</td>
                    <td>{{ $item->qty ?? 0 }}</td>
                    <td>{{ number_format($item->unit_price, 2) }}</td> <!-- Access unit_price from sales_invoice_details -->
                    <td>{{ number_format($item->vat, 2) }}</td>
                    <td>{{ number_format($item->discount, 2) }}</td>
                    <td>{{ number_format(($item->unit_price * $item->qty) - $item->discount, 2) }}</td> <!-- Total calculation -->
                </tr>
            @endforeach
        @endforeach --}}

        @foreach ($salesInvoiceDetails->salesInvoiceDetails->groupBy(function($item) {
            return $item->orderDetail->size_id;
        }) as $sizeGroup)
            @foreach ($sizeGroup as $item)
            {{-- @dd($item->orderDetail->size->name); --}}
                <tr>
                    <td>{{ $item->orderDetail->product->name ?? 'N/A' }}</td>
                    <td>{{ $item->orderDetail->size->name ?? 'N/A' }}</td>
                    <td>{{ $item->qty ?? 0 }}</td>
                    <td>{{ number_format($item->unit_price, 2) }}</td>
                    <td>{{ number_format($item->vat ?? 0, 2) }}</td>
                    <td>{{ number_format($item->discount ?? 0, 2) }}</td>
                    <td>{{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
        @endforeach
        


        
                </tbody>
            </table>

            <div class="row">
                <div class="col-md-6">
                    <p><strong>Total Amount:</strong> {{ number_format($salesInvoiceDetails->total_amount, 2) }}</p>
                    <p><strong>Paid Amount:</strong> {{ number_format($salesInvoiceDetails->paid_amount, 2) }}</p>
                    {{-- <p><strong>Due Amount:</strong>{{number_format($salesInvoiceDetails->total_amount)-($salesInvoiceDetails->paid_amount)}}</p> --}}
                    <p><strong>Due Amount:</strong> {{ number_format($salesInvoiceDetails->total_amount - $salesInvoiceDetails->paid_amount, 2) }}</p>

                </div>
                <div class="col-md-6 text-end">
                    <h4>Total: {{ number_format($salesInvoiceDetails->total_amount, 2) }}</h4>
                </div>
            </div>
        </div>
        <div class="card-footer text-center">
            <a href="{{ route('sales-invoice.generatePDF', $salesInvoiceDetails->id) }}" class="btn btn-danger">Download PDF</a>
            <button class="btn btn-success" onclick="window.print();">Print Invoice</button>
        </div>
    </div>
</div>
@endsection





{{-- <table class="table table-bordered">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Size</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>VAT</th>
            <th>Discount</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach ($salesInvoice->salesInvoiceDetails ?? [] as $key => $item)
            <tr>
              
                <td>
                    {{ optional($item->order->orderDetails->first()->product)->name ?? 'N/A' }}
                </td>
                <td>
               @foreach ($item->order->orderDetails as $detail)
                   {{$detail->size->name ?? 'N/A'}}
               @endforeach
            </td>
               
                <td>{{ $item->qty }}</td>
                <td>{{ number_format($item->unit_price, 2) }}</td>
                <td>{{ number_format($item->vat, 2) }}</td>
                <td>{{ number_format($item->discount, 2) }}</td>
                <td>{{ number_format(($item->unit_price * $item->qty) - $item->discount, 2) }}</td>
            </tr>
        @endforeach
    </tbody>

    
</table>
<div class="row">
    <div class="col-md-6">
        <p><strong>Total Amount:</strong> {{ number_format($salesInvoice->total_amount, 2) }}</p>
        <p><strong>Paid Amount:</strong> {{ number_format($salesInvoice->paid_amount, 2) }}</p>
    </div>
    <div class="col-md-6 text-end">
        <h4>Total: {{ number_format($salesInvoice->total_amount, 2) }}</h4>
    </div>
</div> --}}
