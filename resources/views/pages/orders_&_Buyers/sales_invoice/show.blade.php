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
                            @foreach ($salesInvoice->salesInvoiceDetails as $detail)
                            @endforeach
                            {{ $detail->order->order_number ?? 'N/A' }}
                        </p>
                        <p><strong>Name:</strong>
                            {{ $salesInvoice->buyer->first_name . ' ' . $salesInvoice->buyer->last_name ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <h5>Invoice Details:</h5>
                        <p><strong>Invoice ID:</strong> #INV-{{ str_pad($salesInvoice->id, 6, '0', STR_PAD_LEFT) }}</p>
                        <p><strong>Sale Date:</strong> {{ $salesInvoice->sale_date->format('d M, Y') ?? 'N/A' }}</p>
                        <p><strong>Status:</strong>
                            @if ($salesInvoice->invoice_status_id == 1)
                                <span class="badge badge-warning">{{ $salesInvoice->invoice_status->name }}</span>
                            @else
                                {{ $salesInvoice->invoice_status->name ?? 'N/A' }}
                            @endif
                        </p>
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

                    {{-- <tbody>
                        @foreach ($salesInvoice->salesInvoiceDetails ?? [] as $key => $item)
                            @php
                                // Get the product name for the first order detail in this salesInvoiceDetail.
                                $product_name = optional($item->order->orderDetails->first()->product)->name ?? 'N/A';
                                $unit_price = $item->unit_price; // Unit price for the current invoice detail
                                $vat = $item->vat; // VAT for the current invoice detail
                                $discount = $item->discount; // Discount for the current invoice detail
                            @endphp
                    
                            @foreach ($item->order->orderDetails->groupBy('size_id') as $sizeGroup)
                                <tr>
                                    <!-- Product Name should only be displayed once per group of sizes -->
                                    @if ($loop->first)
                                        <td rowspan="{{ count($sizeGroup) }}">
                                            {{ $product_name }}
                                        </td>
                                    @endif
                    
                                    <!-- Display Size for this group -->
                                    <td>{{ optional($sizeGroup->first()->size)->name ?? 'N/A' }}</td>
                    
                                    <!-- Total Quantity for this size -->
                                    <td>{{ $sizeGroup->sum('quantity') }}</td>
                    
                                    <!-- Unit Price, VAT, and Discount -->
                                    <td>{{ number_format($unit_price, 2) }}</td>
                                    <td>{{ number_format($vat, 2) }}</td>
                                    <td>{{ number_format($discount, 2) }}</td>
                    
                                    <!-- Total (Unit Price * Quantity - Discount) -->
                                    <td>{{ number_format(($unit_price * $sizeGroup->sum('quantity')) - $discount, 2) }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody> --}}
                
                    {{-- <tbody>
                        @php
                            $productSizes = [];
                        @endphp
                    
                        @foreach ($salesInvoice->salesInvoiceDetails as $item)
                            @foreach ($item->order->orderDetails as $orderDetail)
                                @php
                                    $key = $orderDetail->product->name . '-' . $orderDetail->size->name;
                    
                                    if (!isset($productSizes[$key])) {
                                        $productSizes[$key] = [
                                            'product_name' => $orderDetail->product->name,
                                            'size' => $orderDetail->size->name,
                                            'quantity' => $orderDetail->quantity ?? 0,
                                            'unit_price' => $item->unit_price,
                                            'vat' => $item->vat,
                                            'discount' => $item->discount,
                                            'total' => ($orderDetail->quantity * $item->unit_price),
                                        ];
                                    }
                                @endphp
                            @endforeach
                        @endforeach
                    
                        @foreach ($productSizes as $product)
                            <tr>
                                <td>{{ $product['product_name'] }}</td>
                                <td>{{ $product['size'] }}</td>
                                <td>{{ $product['quantity'] }}</td>
                                <td>{{ number_format($product['unit_price'], 2) }}</td>
                                <td>{{ number_format($product['vat'], 2) }}</td>
                                <td>{{ number_format($product['discount'], 2) }}</td>
                                <td>{{ number_format($product['total'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody> --}}
                </table>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Total Amount:</strong> {{ number_format($salesInvoice->total_amount, 2) }}</p>
                        <p><strong>Paid Amount:</strong> {{ number_format($salesInvoice->paid_amount, 2) }}</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <h4>Total: {{ number_format($salesInvoice->total_amount, 2) }}</h4>
                    </div>
                </div>

                
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('sales-invoice.generatePDF', $salesInvoice->id) }}" class="btn btn-danger">Download PDF</a>
                <button class="btn btn-success" onclick="window.print();">Print Invoice</button>
            </div>
            {{-- <div>
            <button class="btn btn-primary" onclick="window.print()">Print Invoice</button> --}}
        </div>
        </div>
    </div>
@endsection
