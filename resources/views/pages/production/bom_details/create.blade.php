@extends('layout.backend.main');



@section('page_content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 style="color: white">Create Bill Of Materials</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('bom_details.store') }}" method="POST" class="p-4 border rounded bg-light">
                    @csrf
                    <!-- Select Product -->
                    <div class="mb-3">
                        <label for="product_id" class="form-label">Select Product:</label>
                        <select name="product_id" id="product_id" class="form-select" required>
                            @foreach ($boms as $bom)
                                @foreach ($bom->orderDetails as $orderDetail)
                                    <option value="{{ $bom->id }}">{{ $orderDetail->product->name }}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <!-- Quantity -->
                    <div class="mb-3">
                        <label for="quantity_used" class="form-label">Quantity Used:</label>
                        <input type="number" step="0.01" name="quantity_used" id="quantity_used" class="form-control"
                            required>
                    </div>

                    <!-- Unit Cost -->
                    <div class="mb-3">
                        <label for="unit_cost" class="form-label">Unit Cost:</label>
                        <input type="number" step="0.01" name="unit_cost" id="unit_cost" class="form-control" required>
                    </div>

                    <!-- Wastage -->
                    <div class="mb-3">
                        <label for="wastage" class="form-label">Wastage (%):</label>
                        <input type="number" step="0.01" name="wastage" id="wastage" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Save BOM Details</button>
                </form>

            </div>
        </div>
    </div>
@endsection
