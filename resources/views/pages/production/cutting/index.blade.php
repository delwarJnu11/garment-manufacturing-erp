@extends('layout.backend.main')

@section('page_content')
    <x-message-banner />

    <div class="card flex-fill">
        <table class="table table-striped table-bordered">
            <thead class="thead-primary">
                <tr>
                    <th>Order Number</th>
                    <th>Total Pieces</th>
                    <th>Total Fabrics Used (m)</th>
                    <th>Wastage (m)</th>
                    <th>Target Quantity</th>
                    <th>Actual Quantity</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cuttingOrders as $cutting)
                    <tr>
                        <td>Todo</td>
                        <td>{{ $cutting->total_quantity }} (pcs)</td>
                        <td>{{ $cutting->total_fabric_used }} (m)</td>
                        <td>{{ $cutting->wastage }} (m)</td>
                        <td>{{ $cutting->target_quantity }} (pcs)</td>
                        <td>{{ $cutting->actual_quantity }} (pcs)</td>
                        <td>{{ $cutting->cutting_start_date }}</td>
                        <td>{{ $cutting->cutting_end_date }}</td>
                        <td>{{ $cutting->cutting_status }}</td>
                        <td>
                            edit
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
