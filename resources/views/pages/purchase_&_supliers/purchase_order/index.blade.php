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
                    <option value="">All States</option>
                    @foreach ($purchase_status as $state)
                        <option value="{{ $state->id }}" {{ $state->id == $selectedState ? 'selected' : '' }}>
                            {{ $state->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <!-- Bulk Update Form -->
        {{-- <form action="{{ url('purchase/updateStatus') }}" method="POST">
            @csrf
            <table class="table table-striped table-bordered">
                <thead class="thead-primary">
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>#</th>
                        <th>Supplier</th>
                        <th>Lot</th>
                        <th>Status</th>
                        <th>Delivery Date</th>
                        <th>Shipping Address</th>
                        <th>Update Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($purchaseStates as $order)
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_orders[]" value="{{ $order->id }}">
                            </td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->inv_supplier->first_name ?? 'N/A' }} {{ $order->inv_supplier->last_name ?? '' }}</td>
                            <td>{{ $order->product_lot->id ?? 'N/A' }}</td>
                            <td>
                                <span class="badge 
                                    {{ $order->purchase_status->name == 'Pending' ? 'badge-warning' : '' }}
                                    {{ $order->purchase_status->name == 'Confirmed' ? 'badge-success' : '' }}
                                    {{ $order->purchase_status->name == 'Cancelled' ? 'badge-danger' : '' }}">
                                    {{ $order->purchase_status->name ?? 'No Status' }}
                                </span>
                            </td>
                            <td>{{ $order->delivery_date ?? 'N/A' }}</td>
                            <td>{{ $order->shipping_address ?? 'N/A' }}</td>
                            <td>
                                <select name="statuses[{{ $order->id }}]" class="form-control">
                                    <option value="">Select</option>
                                    <option value="Confirmed">Confirm</option>
                                    <option value="Cancelled">Cancel</option>
                                </select>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No purchase orders found for the selected state.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Update Selected</button>
                <a href="{{ url('purchase') }}" class="btn btn-success">Go to Purchase Confirm Page</a>
            </div>
        </form> --}}

        <form action="{{ route('purchase.updateStatus') }}" method="POST">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>#</th>
                        <th>Supplier</th>
                        
                        <th>Total Purchase</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchaseStates as $order)
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_orders[]" value="{{ $order->id }}">
                            </td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->inv_supplier->first_name . ' ' .$order->inv_supplier->last_name ?? 'N/A' }}</td>
                          
                            <td>{{ $order->total_amount ?? 'N/A' }}</td>
                            <td>
                                @if ($order->status_id == 1)
                                    <span class="badge badge-warning">Pending</span>
                                @elseif ($order->status_id == 2)
                                    <span class="badge badge-success">Confirmed</span>
                                @else
                                    <span class="badge badge-danger">Cancelled</span>
                                @endif
                            </td>
                            <td>
                                <select name="statuses[{{ $order->id }}]" class="form-control">
                                    <option value="">Select Status</option>
                                    @foreach ($purchase_status as $status)
                                        <option value="{{ $status->id }}" {{ $order->status_id == $status->id ? 'selected' : '' }}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Update Status</button>
        </form>
        

        <div class="d-flex justify-content-end">
            {{ $purchaseStates->links('vendor.pagination.custom') }}
        </div>
    </div>

    <!-- JavaScript to Select All Checkboxes -->
    <script>
        document.getElementById('select-all').addEventListener('click', function() {
            let checkboxes = document.querySelectorAll('input[name="selected_orders[]"]');
            checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        });
    </script>
@endsection
