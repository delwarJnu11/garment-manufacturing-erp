@extends('layout.backend.main')

@section('page_content')
<div class="container">
    <h2 class="mb-4">Stock Adjustments</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <x-page-header heading="Stock Adjustment" btnText="Stock Adjustment" href="{{url('stock/stock_adjustments/create')}}"/>
    <table class="table table-striped table-bordered ">
        <thead class="thead-primary">
            <tr>
                <th>Stock ID</th>
                <th>Product</th>
                <th>Adjustment Type</th>
                <th>Adjusted Qty</th>
                <th>Remaining Qty</th>
                <th>Reason</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adjustments as $adjustment)
            <tr>
                <td>{{ $adjustment->stock_id }}</td>
                <td>{{ $adjustment->stock->product->name }}</td>
                <td>{{ $adjustment->adjustmentType->name }}</td>
                <td>{{ $adjustment->adjusted_qty }}</td>
                <td>{{ $adjustment->remaining_qty }}</td>
                <td>{{ $adjustment->reason }}</td>
                <td>{{ $adjustment->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
