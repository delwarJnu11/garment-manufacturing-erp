@extends('layout.backend.main')

@section('page_content')

{{-- <x-page-header heading="Stock Overview" btnText=" Stock" href="{{ url('stocks/create') }}" /> --}}

<table class="table table-striped table-bordered">
    <thead class="thead-primary">
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Product Type</th>
            <th>Product Lot No.</th>
            <th>SKU</th>
            <th>Warehouse</th>
            <th>Transaction Type</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Total Value</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($stocks as $key => $stock)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $stock->product->name }}</td>
            <td>{{ $stock->product->product_type_id == 1 ? 'Raw Material' : 'Finished Goods' }}</td>
            <td>{{ $stock->lot_id }}</td>
            <td>{{ $stock->product->sku }}</td>
            <td>{{ $stock->lot->warehouse->name ?? "N/A" }}</td>
            <td>{{ $stock->TransactionType->name ?? 'N/A' }}</td>
            <td>{{ $stock->lot->qty ?? "N/A"}}</td>
            <td>${{ number_format($stock->product->unit_price, 2) }}</td>
            <td>${{ number_format($stock->lot->qty * $stock->product->unit_price, 2 ) }}</td>
            <td class="action-table-data">
                <div class="edit-delete-action">
                    <a class="me-2 p-2" href="{{ route('stocks.edit', $stock->id) }}">
                        <i data-feather="edit" class="feather-edit"></i>
                    </a>
                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" class="d-inline" style="margin-bottom: 0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="confirm-delete" onclick="return confirm('Are you sure?')" style="color: red; border: none;">
                            <i data-feather="trash-2" class="feather-trash-2 delete_icon"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-end">
    {{ $stocks->links('vendor.pagination.custom') }}
</div>

@endsection
