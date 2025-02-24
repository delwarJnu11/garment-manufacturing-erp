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
            <h4 class="mb-0" style="color: white">Add New Product Lot</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('product_lots.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Raw Material</label>
                        <select name="raw_material_id" class="form-select" required>
                            <option value="">Select Raw Material</option>
                            @foreach($raw_materials as $material)
                                <option value="{{ $material->id }}" {{ old('raw_material_id') == $material->id ? 'selected' : '' }}>
                                    {{ $material->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="{{ old('quantity') }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Cost Price</label>
                        <input type="text" name="cost_price" class="form-control" value="{{ old('cost_price') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Warehouse</label>
                        <select name="warehouse_id" class="form-select" required>
                            <option value="">Select Warehouse</option>
                            @foreach($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}" {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                    {{ $warehouse->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Enter lot description">{{ old('description') }}</textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save Product Lot</button>
            </form>
        </div>
    </div>
</div>
@endsection
