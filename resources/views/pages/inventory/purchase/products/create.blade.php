@extends('layout.backend.main')

@section('page_content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white" >
                <h4 style="color: white">Add New Product</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Product Name --}}
                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter product name" required>
                    </div>

                    {{-- SKU --}}
                    <div class="mb-3">
                        <label class="form-label">SKU</label>
                        <input type="text" name="sku" class="form-control" placeholder="Enter SKU" required>
                    </div>

                    {{-- Description --}}
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Enter product description"></textarea>
                    </div>

                    {{-- Unit Price & Offer Price --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Unit Price ($)</label>
                            <input type="number" step="0.01" name="unit_price" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Offer Price ($)</label>
                            <input type="number" step="0.01" name="offer_price" class="form-control">
                        </div>
                    </div>

                    {{-- Weight --}}
                    <div class="mb-3">
                        <label class="form-label">Weight </label>
                        <input type="number" name="weight" class="form-control" required>
                    </div>

                    {{-- Size (Dropdown) --}}
                    <div class="mb-3">
                        <label class="form-label">Size</label>
                        <select name="size_id" class="form-select">
                            <option value="1">Small</option>
                            <option value="2">Medium</option>
                            <option value="3">Large</option>
                        </select>
                    </div>

                    {{-- Is Raw Material (Radio Buttons) --}}
                    <div class="mb-3">
                        <label class="form-label">Is Raw Material?</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_raw_material" value="1">
                            <label class="form-check-label">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_raw_material" value="0" checked>
                            <label class="form-check-label">No</label>
                        </div>
                    </div>

                    {{-- Barcode & RFID --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Barcode</label>
                            <input type="text" name="barcode" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">RFID</label>
                            <input type="text" name="rfid" class="form-control">
                        </div>
                    </div>

                    {{-- Category (Dropdown from Relational Table) --}}
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category</label>
                        <select name="category_attributes_id" class="form-select">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category value</label>
                        <select name="category_attributes_id" class="form-select">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->attribute_value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                    {{-- UOM (Dropdown from Relational Table) --}}
                    <div class="mb-3">
                        <label class="form-label">Unit of Measurement (UOM)</label>
                        <select name="uom_id" class="form-select">
                            @foreach($uoms as $uom)
                                <option value="{{ $uom->id }}">{{ $uom->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Valuation Method (Dropdown from Relational Table) --}}
                    <div class="mb-3">
                        <label class="form-label">Valuation Method</label>
                        <select name="valuation_method_id" class="form-select">
                            @foreach($valuation_methods as $method)
                                <option value="{{ $method->id }}">{{ $method->method_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Photo Upload --}}
                    <div class="mb-3">
                        <label class="form-label">Product Image</label>
                        <input type="file" name="photo" class="form-control">
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn btn-primary">Save Product</button>
                </form>
            </div>
        </div>
    </div>
@endsection
