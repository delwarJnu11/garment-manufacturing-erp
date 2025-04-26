@extends('layout.backend.main')
@php
    use Carbon\Carbon;
@endphp

@section('page_content')
    <x-page-header :pdf="isset($bom) ? route('bom.show', ['bom' => $bom->id, 'download' => true]) : null" heading="Bill Of materials" btnText="BOM" href="{{ route('bom.create') }}" />
    <div class="flex-fill">
        <h2 class="mb-4 text-center">Bill Of Material for Order <strong
                class="text-primary">#{{ $order->order_number }}</strong></h2>
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

        @foreach ($data as $sizeData)
            <h4 class="my-2 bg-secondary">Size: {{ $sizeData['size'] }}</h4>
            <table class="table table-striped table-bordered my-4">
                <thead>
                    <tr>
                        <th>Material Name</th>
                        <th>Quantity Used</th>
                        <th>Unit Price</th>
                        <th>Wastage (%)</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalMaterialCost = array_sum(array_column($sizeData['materials'], 'total_price'));
                    @endphp
                    @foreach ($sizeData['materials'] as $material)
                        <tr>
                            <td>{{ $material['material_name'] }}</td>
                            <td>{{ $material['quantity_used'] }}</td>
                            <td>{{ $material['unit_price'] }}</td>
                            <td>{{ $material['wastage'] }}</td>
                            <td>{{ ceil($material['total_price']) }}
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-end"><strong>Material Cost</strong></td>
                        <td>{{ ceil($totalMaterialCost) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Operating Cost</strong></td>
                        <td><strong>{{ ceil($bom->labour_cost + $bom->overhead_cost + $bom->utility_cost) }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Total Cost for {{ $sizeData['size'] }}</strong>
                        </td>
                        <td><strong>{{ ceil($sizeData['total_cost'] + $bom->labour_cost + $bom->overhead_cost + $bom->utility_cost) }}</strong>
                        </td>
                    </tr>
                </tbody>
                {{-- <tfoot>
                    
                </tfoot> --}}
            </table>
        @endforeach
    </div>
@endsection
