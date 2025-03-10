@extends('layout.backend.main')

@section('page_content')
    <x-message-banner />

    <x-page-header heading="Production Work Orders" btnText="Production Work Order"
        href="{{ route('production-work-orders.create') }}" />
    <div class="card flex-fill">
        <table class="table table-striped table-bordered">
            <thead class="thead-primary">
                <tr>
                    <th>Order Number</th>
                    <th>Manager</th>
                    <th>Total Pieces</th>
                    <th>Cutting</th>
                    <th>Sewing</th>
                    <th>Finishing</th>
                    <th>Packaging</th>
                    <th>Wastage</th>
                    <th>Order Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workOrders as $order)
                    <tr>
                        <td>{{ $order->order->order_number }}</td>
                        <td>{{ $order->assignedUser->name }}</td>
                        <td>{{ $order->total_pieces }} (pcs)</td>
                        <td>{{ $order->cutting_status }}</td>
                        <td>{{ $order->sewing_status }}</td>
                        <td>{{ $order->finishing_status }}</td>
                        <td>{{ $order->packaging_status }}</td>
                        <td>{{ $order->wastage }}</td>
                        <td>{{ $order->workStatus->name }}</td>
                        <td>
                            <a class="btn btn-success" href="">Cutting</a>
                            <input class="btn btn-primary" type="submit" value="Sweing">
                            <input class="btn btn-info" type="submit" value="Finishing">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
