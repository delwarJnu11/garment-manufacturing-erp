@extends('layout.backend.main');

@section('page_content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 style="color: white">Create New Order</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Buyer Name</label>
                            <select name="buyer_id" class="form-select" id="category_dropdown">
                                <option value="">Select a Category</option>
                                <option value="">Select a Category</option>
                                <option value="">Select a Category</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Order Status</label>
                            <select name="status_id" class="form-select" id="category_dropdown">
                                <option value="">Select a Category</option>
                                <option value="">Select a Category</option>
                                <option value="">Select a Category</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Style Name</label>
                            <input type="number" step="0.01" name="style_name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fabric Type</label>
                            <select name="category_id" class="form-select" id="category_dropdown">
                                <option value="">Select a Category</option>
                                <option value="">Select a Category</option>
                                <option value="">Select a Category</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3 d-none" id="size_field">
                            <label class="form-label">Color</label>
                            <select name="size_id" class="form-select">
                                <option value="1">Small</option>
                                <option value="2">Medium</option>
                                <option value="3">Large</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3 d-none" id="finished_category_field">
                            <label class="form-label">Finished Category</label>
                            <select name="finished_category_id" class="form-select">
                                @foreach ($finished_categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Valuation Method</label>
                            <select name="valuation_method_id" class="form-select">
                                @foreach ($valuation_methods as $method)
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
