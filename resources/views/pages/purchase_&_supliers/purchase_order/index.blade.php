@extends('layout.backend.main')

@section('page_content')
    <x-message-banner />

    <div class="card flex-fill">
        <x-page-header heading="Purchase Orders (State)" btnText="Create Purchase Order" href="{{ url('purchase/create') }}" />

        <!-- Dropdown to filter purchase states -->
        <form action="{{ url('purchaseState') }}" method="GET" class="mb-4">
            <div class="form-group">
                <label for="state">Filter by State:</label>
                <select name="state" id="state" class="form-control" onchange="this.form.submit()">
                    @foreach ($states as $state)
                        <option value="{{ $state->id }}" {{ $state->id == $selectedState ? 'selected' : '' }}>
                            {{ $state->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <table class="table table-striped table-bordered">
            <thead class="thead-primary">
                <tr>
                    <th>#</th>
                    <th>Supplier</th>
                    <th>Lot</th>
                    <th>Status</th>
                    <th>Delivery Date</th>
                    <th>Shipping Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($purchase_orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->inv_supplier->first_name . ' ' . $order->inv_supplier->last_name ?? 'N/A' }}</td>
                        <td>{{ $order->product_lot->id ?? 'N/A' }}</td>

                        <!-- Display status with badge CSS -->
                        <td>
                            @if ($order->purchase_status->name == 'Pending')
                                <span class="badge badge-warning">{{ $order->purchase_status->name }}</span>
                            @elseif ($order->purchase_status->name == 'Confirmed')
                                <span class="badge badge-success">{{ $order->purchase_status->name }}</span>
                            @elseif ($order->purchase_status->name == 'Cancelled')
                                <span class="badge badge-danger">{{ $order->purchase_status->name }}</span>
                            @else
                                <span class="badge badge-secondary">Unknown</span>
                            @endif
                        </td>

                        <td>{{ $order->delivery_date ?? 'N/A' }}</td>
                        <td>{{ $order->shipping_address ?? 'N/A' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No purchase orders found for the selected state.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{ $purchase_orders->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
