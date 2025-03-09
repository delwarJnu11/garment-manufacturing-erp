@extends('layout.backend.main')

@section('page_content')
<div class="container">
    <h2 class="mb-4">New Stock Adjustment</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('stock_adjustments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="stock_id" class="form-label">Select Stock</label>
            <select name="stock_id" id="stock_id" class="form-control">
                @foreach($stocks as $stock)
                    <option value="{{ $stock->id }}">
                        {{ $stock->product->name }} (Lot: {{ $stock->lot_id }}) - {{ $stock->lot->qty }} Available
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="adjustment_type_id" class="form-label">Adjustment Type</label>
            <select name="adjustment_type_id" id="adjustment_type_id" class="form-control">
                @foreach($adjustmentTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="adjusted_qty" class="form-label">Quantity</label>
            <input type="number" name="adjusted_qty" id="adjusted_qty" class="form-control" required min="1">
        </div>

        <div class="mb-3">
            <label for="reason" class="form-label">Reason (Optional)</label>
            <textarea name="reason" id="reason" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit Adjustment</button>
    </form>
</div>
@endsection
