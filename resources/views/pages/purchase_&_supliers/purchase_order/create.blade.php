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
            <h4 class="mb-0">Add New Purchase Order</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('purchase_orders.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Supplier</label>
                        <select name="supplier_id" class="form-select" required>
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Lot ID</label>
                        <input type="number" name="lot_id" class="form-control" value="{{ old('lot_id') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status_id" class="form-select" required>
                            <option value="">Select Status</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Order Total</label>
                        <input type="text" name="order_total" class="form-control" value="{{ old('order_total') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Paid Amount</label>
                        <input type="text" name="paid_amount" class="form-control" value="{{ old('paid_amount') }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Discount</label>
                        <input type="text" name="discount" class="form-control" value="{{ old('discount') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">VAT</label>
                        <input type="text" name="vat" class="form-control" value="{{ old('vat') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Delivery Date</label>
                        <input type="date" name="delivery_date" class="form-control" value="{{ old('delivery_date') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Shipping Address</label>
                        <input type="text" name="shipping_address" class="form-control" value="{{ old('shipping_address') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="{{
