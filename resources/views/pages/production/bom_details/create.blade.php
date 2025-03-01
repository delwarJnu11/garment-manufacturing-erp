@extends('layout.backend.main');

{{-- @php
    dd($boms);
@endphp --}}

@section('page_content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 style="color: white">Create Bill Of Materials</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('bom_details.store') }}" method="POST" class="p-4 border rounded bg-light">
                    @csrf

                    <!-- Select Order -->
                    <div class="mb-3">
                        <label for="order_id" class="form-label">Select Order:</label>
                        <select name="order_id" id="order_id" class="form-select" required>
                            @foreach ($orders as $order)
                                <option value="{{ $order->id }}">
                                    Order #{{ $order->id }} - {{ $order->created_at->format('Y-m-d') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Select Product -->
                    <div class="mb-3">
                        <label for="product_id" class="form-label">Select Product:</label>
                        <select name="product_id" id="product_id" class="form-select" required>
                            @foreach ($orders as $order)
                                @foreach ($order->orderDetails as $detail)
                                    <option value="{{ $detail->product->id }}">
                                        {{ $detail->product->name }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>

                    <!-- Select BOM -->
                    <div class="mb-3">
                        <label for="bom_id" class="form-label">Select BOM:</label>
                        <select name="bom_id" id="bom_id" class="form-select" required>
                            @foreach ($boms as $bom)
                                <option value="{{ $bom->id }}">
                                    BOM #{{ $bom->id }} - Order #{{ $bom->order->id ?? 'N/A' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Select Material -->
                    <div class="mb-3">
                        <label for="material_id" class="form-label">Select Material:</label>
                        <select name="material_id" id="material_id" class="form-select" required>
                            @foreach ($materials as $material)
                                <option value="{{ $material->id }}">{{ $material->naterial_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Select Size -->
                    <div class="mb-3">
                        <label for="size_id" class="form-label">Select Size:</label>
                        <select name="size_id" id="size_id" class="form-select" required>
                            @foreach ($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->name }}</option>
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
