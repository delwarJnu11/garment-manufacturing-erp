@extends('layout.backend.main')

@section('page_content')
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
            <h4 style="color: white">Add New Stock</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('stocks.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3 ">
                    <select name="product_variant_id" id="product_variant_id" class="form-select" required>
                        <option value="">Select Product Name</option>
                        @foreach ($product_variants as $product_variant)
                            <option value="{{ $product_variant->id }}">{{ $product_variant->name }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="col-md-6 mb-3 ">
                        <select name="warehouse_id" id="warehouse_id" class="form-select" required>
                            <option value="">Select Warehouse</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Size & UOM Row -->
             
                        {{-- <div class="col-md-6 mb-3 ">
                            <label class="form-label">Unit Price ($)</label>
                            <input type="number" step="0.01" name="unit_price" class="form-control" required>
                        </div> --}}
                {{-- </div>
                <div class="row">
                
            </div> --}}
                </div>

                <button type="submit" class="btn btn-primary">Save Product</button>
            </form>
        </div>
    </div>
</div>


@endsection
