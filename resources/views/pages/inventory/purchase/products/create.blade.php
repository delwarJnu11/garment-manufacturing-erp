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
                <h4 class="mb-0" style="color: white">Add New Product</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">SKU</label>
                            <input type="text" name="sku" class="form-control" value="{{ old('sku') }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Barcode</label>
                            <input type="text" name="barcode" class="form-control" value="{{ old('barcode') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Unit of Measurement (UOM)</label>
                            <select name="uom_id" class="form-select">
                                <option value="">Select UOM</option>
                                @foreach($uoms as $uom)
                                    <option value="{{ $uom->id }}" {{ old('uom_id') == $uom->id ? 'selected' : '' }}>
                                        {{ $uom->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Image</label>
                            <input type="file" name="photo" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Enter product description">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Product</button>
                </form>
            </div>
        </div>
    </div>
@endsection


    {{-- <script>
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
                
                sizeField.classList.toggle("d-none", isRawMaterial);
            }

            rawMaterialYes.addEventListener("change", function () {
                updateCategoryDropdown(true);
            });

            rawMaterialNo.addEventListener("change", function () {
                updateCategoryDropdown(false);
            });

            updateCategoryDropdown(false);
        });
    </script> --}}






             

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
