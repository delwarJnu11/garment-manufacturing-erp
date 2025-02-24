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
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label class="form-label">Barcode</label>
                        <input type="text" name="barcode" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">RFID</label>
                        <input type="text" name="rfid" class="form-control">
                    </div>
                </div>

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

                {{-- <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Is Raw Material?</label>
                        <div class="d-flex">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="radio" name="is_raw_material" value="1" id="raw_material_yes">
                                <label class="form-check-label" for="raw_material_yes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_raw_material" value="0" id="raw_material_no" checked>
                                <label class="form-check-label" for="raw_material_no">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category Type</label>
                        <select name="category_id" class="form-select" id="category_dropdown">
                            <option value="">Select a Category</option>
                            @foreach($finished_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Unit of Measurement (UOM)</label>
                        <select name="uom_id" class="form-select">
                            <option value="">Select UOM</option>
                            @foreach($uoms as $uom)
                                <option value="{{ $uom->id }}">{{ $uom->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="col-md-6 mb-3 d-none" id="size_field">
                        <label class="form-label">Size</label>
                        <select name="size_id" class="form-select">
                            <option value="1">Small</option>
                            <option value="2">Medium</option>
                            <option value="3">Large</option>
                        </select>
                    </div> --}}
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Valuation Method</label>
                        <select name="valuation_method_id" class="form-select">
                            @foreach($valuation_methods as $method)
                                <option value="{{ $method->id }}">{{ $method->method_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Product Image</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Enter product description"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save Product</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let rawMaterialYes = document.getElementById("raw_material_yes");
        let rawMaterialNo = document.getElementById("raw_material_no");
        let categoryDropdown = document.getElementById("category_dropdown");
        let sizeField = document.getElementById("size_field");

        let rawMaterialCategories = @json($raw_material_categories);
        let finishedCategories = @json($finished_categories);

        function updateCategoryDropdown(isRawMaterial) {
            categoryDropdown.innerHTML = `<option value="">Select a Category</option>`;

            let categories = isRawMaterial ? rawMaterialCategories : finishedCategories;
            categories.forEach(category => {
                let option = document.createElement("option");
                option.value = category.id;
                option.textContent = category.name;
                categoryDropdown.appendChild(option);
            });

            if (isRawMaterial) {
                sizeField.classList.add("d-none");
            } else {
                sizeField.classList.remove("d-none");
            }
        }

        rawMaterialYes.addEventListener("change", function () {
            updateCategoryDropdown(true);
        });

        rawMaterialNo.addEventListener("change", function () {
            updateCategoryDropdown(false);
        });

        updateCategoryDropdown(false);
    });
</script>
@endsection
