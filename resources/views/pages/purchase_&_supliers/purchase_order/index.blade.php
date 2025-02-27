@extends('layout.backend.main')

@section('page_content')
@if (session('error'))
<div class="alert alert-danger">
    <strong>Error!</strong> {{ session('error') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Purchase Orders</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Supplier</th>
                        <th>Lot ID</th>
                        <th>Status</th>
                        <th>Order Total</th>
                        <th>Paid Amount</th>
                        <th>Discount</th>
                        <th>VAT</th>
                        <th>Delivery Date</th>
                        <th>Shipping Address</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($purchase_orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->supplier->name ?? 'N/A' }}</td>
                        <td>{{ $order->lot_id ?? 'N/A' }}</td>
                        <td>{{ $order->status_id }}</td>
                        <td>{{ number_format($order->order_total, 2) }}</td>
                        <td>{{ number_format($order->paid_amount, 2) }}</td>
                        <td>{{ number_format($order->discount, 2) }}</td>
                        <td>{{ number_format($order->vat, 2) }}</td>
                        <td>{{ $order->delivery_date ?? 'N/A' }}</td>
                        <td>{{ $order->shipping_address ?? 'N/A' }}</td>
                        <td>{{ $order->description ?? 'N/A' }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->created_at }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="13" class="text-center">No purchase orders found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
