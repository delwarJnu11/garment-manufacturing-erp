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
                    <div class="col-md-6 mb-3">
                        <select name="product_id" id="product" class="form-select" >
                            <option value="">Select Product Name</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" data-qty="{{ $product->qty }}" data-unit-price="{{ $product->unit_price }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <select name="warehouse_id" id="warehouse_id" class="form-select" >
                            <option value="">Select Warehouse</option>
                            @foreach ($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row" id="column-append"></div>

                <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Total Price ($)</label>
                    <input type="number" step="0.01" id="total_value" name="total_value" class="form-control" readonly>
                </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" id="qty" name="qty" class="form-control" value="" >
            </div>

                <button type="submit" class="btn btn-primary">Save Product</button>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
      
            $('#product').on('change', function (e) {
                e.preventDefault();

                // Get the selected option's data attributes for qty and unit price
                let selectedOption = $(this).find('option:selected');
                let qty = selectedOption.data('qty');
                let unitPrice = selectedOption.data('unit-price');

                // Clear previous appended fields
                $('#column-append').empty();

                // Append new input fields for qty and unit price
                let row = `
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" id="qty" name="qty" class="form-control" value="${qty}" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Unit Price</label>
                        <input type="number" id="unit_price" name="unit_price" class="form-control" value="${unitPrice}" >
                    </div>
                `;
                $('#column-append').append(row);

                // Calculate total value when qty or unit price changes
                $('#qty, #unit_price').on('input', function () {
                    let qtyValue = $('#qty').val();
                    let unitPriceValue = $('#unit_price').val();
                    let totalValue = qtyValue * unitPriceValue;
                    $('#total_value').val(totalValue.toFixed(2));  // Display total value in the Total Price field
                });

                // Calculate total value initially
                let initialTotalValue = qty * unitPrice;
                $('#total_value').val(initialTotalValue.toFixed(2));
            });
        });
    </script>
@endsection
