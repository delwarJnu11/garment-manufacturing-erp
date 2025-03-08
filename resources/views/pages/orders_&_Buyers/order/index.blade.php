@extends('layout.backend.main')

{{-- @php
    echo '<pre>';
    print_r($orders[0]);
    die();
@endphp --}}

@section('page_content')
    <x-message-banner />

    <x-page-header heading="Orders" btnText="Order" href="{{ route('orders.create') }}" />
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
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
                        <td>{{ $order->status->name ?? 'N/A' }}</td>
                        <td class="action-table-data">
                            <div class="edit-delete-action">
                                <a class="me-2 p-2 mb-0" href="javascript:void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-eye action-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <a class="me-2 p-2" href="">
                                    <i data-feather="edit" class="feather-edit"></i>
                                </a>
                                <x-delete />
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-end">
            {{ $orders->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
