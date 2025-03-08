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
            <h4 class="mb-0" style="color: white">Add New Purchase Order</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('purchase_orders.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Supplier</label>
                        <div class="input-group">
                            <select name="supplier_id" class="form-control form-select" required>
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->first_name. ' '.$supplier->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
                                + Add Supplier
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Item</label>
                        <div class="input-group">
                            <select name="product_variant_id" class="form-control form-select" required>
                                <option value="">Select Product Variant</option>
                                @foreach($product_variants as $product_variant)
                                    <option value="{{ $product_variant->id }}" {{ old('product_variant_id') == $product_variant->id ? 'selected' : '' }}>
                                        {{ $product_variant->name }}
                                    </option>
                                @endforeach
                            </select>
                            <a href="{{Route('product_variants.create')}}" class="btn btn-primary">+ Add Prodcut</a>
                        </div>
                    </div>
                    
                    
                </div>
                
                

                <div class="row">
                  
                    <div class="col-md-6 mb-3">
                        <label class="form-label">product Lot</label>
                        <select name="product_lot_id" class="form-select" required>
                            <option value="">Select product_lot</option>
                            @foreach($lots as $lot)
                                <option value="{{ $lot->id }}" {{ old('product_lot_id') == $lot->id ? 'selected' : '' }}>
                                    {{ $lot->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Purchase Status</label>
                        <select name="status_id" class="form-select" required>
                            <option value="">Select status</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}" {{ old('status_id') == $status->id ? 'selected' : '' }}>
                                    {{ $status->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Delivery Date</label>
                        {{-- <input name="delivery_date" class="form-control" type="date">{{ old('delivery_date') }} --}}
                        <input name="delivery_date" class="form-control" type="date" value="{{ old('delivery_date') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Shippment Address</label>
                        <textarea name="shipping_address" class="form-control" rows="3" placeholder="Enter product shipping address">{{ old('shipping_address') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save Purchase order</button>
            </form>
        </div>
    </div>
</div>
@endsection
