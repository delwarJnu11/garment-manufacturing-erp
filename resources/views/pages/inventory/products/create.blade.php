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
            <h4 style="color: white">Add New Product</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">SKU</label>
                        <input type="text" name="sku" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Type</label>
                        <select name="product_type_id" id="product_type" class="form-select" required>
                            <option value="">Select Product Type</option>
                            @foreach ($product_types as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category</label>
                        <select name="category_type_id" id="category_dropdown" class="form-select" required>
                            <option value="">Select Category</option>
                            <!-- Categories will be populated dynamically based on product type selection -->
                        </select>
                    </div>
                </div>

                <!-- Size & UOM Row -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" step="0.01" name="qty" class="form-control" required>
                    </div>
    
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Unit Price ($)</label>
                        <input type="number" step="0.01" name="unit_price" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Unit of Measure (UOM)</label>
                        <select name="uom_id" class="form-select">
                            <option value="">Select UOM</option>
                            @foreach ($uoms as $uom)
                                <option value="{{ $uom->id }}">{{ $uom->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3 d-none" id="size_uom_row">
                        <label class="form-label">Size</label>
                        <select name="size_id" class="form-select">
                            <option value="">Select Size</option>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save Product</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle product type selection change
        $("#product_type").on('change', function() {
            var selectType = $(this).val(); // Get the selected product type
            var categories = []; // Initialize an empty array for categories
            
            // Load categories based on selected product type
            if (selectType == 1) {  // Raw Material
                categories = @json($rawMaterialCategories);  // Assign raw material categories
            } else if (selectType == 2) {  // Finished Goods
                categories = @json($finishedGoodsCategories);  // Assign finished goods categories
            }

            // Clear the category dropdown before appending new options
            $('#category_dropdown').empty();

            // Append the default "Select Category" option
            $('#category_dropdown').append('<option value="">Select Category</option>');

            // Append the categories dynamically to the dropdown
            categories.forEach(function(category) {
                $('#category_dropdown').append('<option value="' + category.id + '">' + category.name + '</option>');
            });

            // Show/hide Size & UOM row based on product type
            if (selectType == 2) {
                $('#size_uom_row').removeClass('d-none');  // Show Size & UOM row if Finished Goods
            } else {
                $('#size_uom_row').addClass('d-none');  // Hide Size & UOM row if Raw Material
            }
        });
    });
</script>

@endsection

{