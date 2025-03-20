@extends('layout.backend.main')

@php
    use Carbon\Carbon;
@endphp


@section('page_content')
    <x-page-header heading="Bill Of materials" btnText="BOM" href="{{ route('orders.create') }}" />
    <div class="flex-fill">
        <h2 class="mb-4 text-center">Order Details <strong class="text-primary">#{{ $order->order_number }}</strong></h2>
        <div class="d-flex justify-content-between align-items-center py-4">
            <div>
                <h4 class="mb-2">Buyer Details</h3>
                    <p class="my-1"><strong>Name: </strong>{{ $buyer->first_name . ' ' . $buyer->last_name }}</p>
                    <p class="my-1"><strong>Email: </strong>{{ $buyer->email }}</p>
                    <p class="my-1"><strong>Phone: </strong>{{ $buyer->phone }}</p>
                    <p class="my-1"><strong>Address: </strong>{{ $buyer->shipping_address . ',' . $buyer->country }}</p>
            </div>
            <div>
                <h4 class="mb-2">Order Details</h3>
                    <p class="my-1"><strong>Order Number : </strong>{{ $order->order_number }}</p>
                    <p class="my-1"><strong>Order Date :
                        </strong>{{ Carbon::parse($order->created_at)->format('d M, Y') }}</p>
                    <p class="my-1"><strong>Delivery Date :
                        </strong>{{ Carbon::parse($order->delivery_date)->format('d M, Y') }}</p>
                    <p class="my-1"><strong>Current Date: </strong> {{ Carbon::parse(now())->format('d M, Y') }} </p>
            </div>
        </div>

        <table class="table table-striped table-bordered my-4">
            <thead class="thead-primary">
                <tr>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Unit Cost</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total = 0;
                @endphp
                @foreach ($orderDetails as $detail)
                    @php
                        $sizeId = $detail->size->id;
                        $materialCost = $sizeData[$sizeId]['material_cost'] ?? 0;
                        $operatingCost = $sizeData[$sizeId]['operating_cost'] ?? 0;
                        $subTotal = ($materialCost + $operatingCost) * $detail->qty;
                        $total += $subTotal;
                    @endphp
                    <tr>
                        <td>{{ $detail->product->name ?? 'N/A' }}</td>
                        <td>{{ $detail->size->name ?? 'N/A' }}</td>
                        <td>{{ $detail->color->name ?? 'N/A' }}</td>
                        <td>{{ $detail->qty }} (pcs)</td>
                        <td>{{ $materialCost + $operatingCost ?? 0 }}</td>
                        <td>{{ number_format($subTotal, 2) }}</td>
                    </tr>
                @endforeach
                @php
                    $vat = $total * 0.05;
                @endphp
                <tr>
                    <td class="text-end" colspan="5">Total</td>
                    <td>{{ number_format($total, 2) }}</td>
                </tr>
                <tr>
                    <td class="text-end" colspan="5">Vat (5%)</td>
                    <td>{{ number_format($vat, 2) }}</td>
                </tr>
            </tbody>
        </table>




    </div>
@endsection
