@extends('layout.backend.main')

@section('page_content')
    <x-message-banner />

    <div class="card flex-fill">
        <x-page-header heading="Confirmed Purchase Orders" btnText="Back" href="{{ url('purchase') }}" />

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
                        <td>{{ $order->inv_supplier->first_name.' '. $order->inv_supplier->last_name ?? 'N/A' }}</td>
                        <td>{{ $order->product_lot->id ?? 'N/A' }}</td>
                        <td>
                            @if ($order->status_id == 2)
                                <span class="badge badge-success">{{ $order->purchase_status->name }}</span>
                            @else
                                {{ $order->purchase_status->name ?? 'N/A' }}
                            @endif
                        </td>
                        <td>{{ $order->delivery_date ?? 'N/A' }}</td>
                        <td>{{ $order->shipping_address ?? 'N/A' }}</td>
                        <td class="action-table-data">
                            <a href="{{ route('purchase.show', $order->id) }}">
                                <i data-feather="eye" class="feather-eye"></i>
                            </a>
                            <form action="{{ route('purchase.destroy', $order->id) }}" method="POST" style="margin-bottom: 0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="confirm-text" style="padding: 2px; background: transparent; border: none; width: 30px; color: red">
                                    <i data-feather="trash-2" class="feather-trash-2 delete_icon"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No confirmed purchase orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{ $purchase_orders->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
