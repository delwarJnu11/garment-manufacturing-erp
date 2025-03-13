@extends('layout.backend.main')

@section('page_content')
    <x-message-banner />
    <x-page-header heading="Production Cutting" btnText="Cutting Section"
        href="{{ route('production-work-orders.create') }}" />
    <div class="card flex-fill">
        <table class="table table-striped table-bordered">
            <thead class="thead-primary">
                <tr>
                    <th>Order No.</th>
                    <th>Total Qty</th>
                    <th>Fabrics Used (m)</th>
                    <th>Wastage (m)</th>
                    <th>Target Qty</th>
                    <th>Actual Qty</th>
                    <th>Completed</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($completedCuttings as $cutting)
                    <tr>
                        <td>{{ $cutting->workOrder && $cutting->workOrder->order ? $cutting->workOrder->order->order_number : 'N/A' }}
                        </td>
                        <td id="qty">{{ $cutting->total_quantity }} (pcs)</td>
                        <td>{{ $cutting->total_fabric_used }} (m)</td>
                        <td>{{ $cutting->wastage }} (m)</td>
                        <td>{{ $cutting->target_quantity }} (pcs)</td>
                        <td>{{ $cutting->actual_quantity }} (pcs)</td>
                        <td>{{ $cutting->created_at }}</td>
                        <td>
                            <span class="badge badges-success">
                                {{ $cutting->cutting_status }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
