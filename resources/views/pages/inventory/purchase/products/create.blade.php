@extends('layout.backend.main')

@section('page_content')
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
                            <label class="form-label">Unit Price ($)</label>
                            <input type="number" step="0.01" name="unit_price" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Offer Price ($)</label>
                            <input type="number" step="0.01" name="offer_price" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Weight</label>
                            <input type="number" name="weight" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Size</label>
                            <select name="size_id" class="form-select">
                                <option value="1">Small</option>
                                <option value="2">Medium</option>
                                <option value="3">Large</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Is Raw Material?</label>
                            <div class="d-flex">
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="radio" name="is_raw_material" value="1">
                                    <label class="form-check-label">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_raw_material" value="0" checked>
                                    <label class="form-check-label">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Barcode</label>
                            <input type="text" name="barcode" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">RFID</label>
                            <input type="text" name="rfid" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Raw Category</label>
                            <select name="category_attributes_id" class="form-select">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Finished Category</label>
                            <select name="category_attributes_id" class="form-select">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->finished_category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">UOM</label>
                            <select name="uom_id" class="form-select">
                                @foreach($uoms as $uom)
                                    <option value="{{ $uom->id }}">{{ $uom->name }}</option>
                                @endforeach
                            </select>
                        </div>
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
@endsection


<script>
    document.addEventListener("DOMContentLoaded", function () {
        let inputs = document.querySelectorAll(".form-control, .form-select");
        
        // Autofocus first input
        if (inputs.length > 0) {
            inputs[0].focus();
        }

        // Move focus to next input on Enter
        inputs.forEach((input, index) => {
            input.addEventListener("keydown", function (event) {
                if (event.key === "Enter") {
                    event.preventDefault(); // Prevent form submission
                    let nextInput = inputs[index + 1];
                    if (nextInput) {
                        nextInput.focus();
                    }
                }
            });
        });
    });
</script>
