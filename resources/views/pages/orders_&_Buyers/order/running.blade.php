@extends('layout.backend.main')

@section('page_content')
    <x-message-banner />

    <x-page-header heading="Orders In Progress" btnText="Order" href="{{ route('orders.create') }}" />
    <div class="card flex-fill">

        <table class="table table-striped table-bordered">
            <thead class="thead-primary">
                <tr>
                    <th>Order ID</th>
                    <th>Buyer Name</th>
                    <th>Product Name</th>
                    <th>Color Name</th>
                    @foreach ($sizes as $size)
                        <th>{{ $size }}</th>
                    @endforeach
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->buyer->first_name . ' ' . $order->buyer->last_name ?? 'N/A' }}</td>
                        <td>
                            {{ $order->orderDetails->pluck('product.name')->unique()->implode(', ') }}
                        </td>
                        <td>
                            {{ $order->orderDetails->pluck('color.name')->unique()->implode(', ') }}
                        </td>

                        @foreach ($sizes as $size)
                            <td>
                                {{ $order->orderDetails->where('size.name', $size)->sum('qty') ?? 0 }}
                                ({{ $order->orderDetails->pluck('uom.name')->unique()->implode(', ') }})
                            </td>
                        @endforeach
                        <td>
                            <span class="badge badges-success">{{ $order->status->name ?? 'N/A' }}</span>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td class="text-danger" colspan="8">No running orders found!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{ $orders->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
