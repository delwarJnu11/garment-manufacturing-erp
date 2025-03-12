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
                            @if ($order->cutting_status == 'Pending' || $order->cutting_status == 'In Progress')
                                <button data-id="{{ encrypt($order->id) }}" class="btn btn-warning cutting">Cutting
                                    {{ $order->cutting_status }}</button>
                            @endif
                            @if ($order->sewing_status == 'Pending' || $order->sewing_status == 'In Progress')
                                <button data-id="{{ encrypt($order->id) }}" class="btn btn-info sweing">Sweing
                                    {{ $order->sewing_status }}</button>
                            @endif
                            @if ($order->finishing_status == 'Pending' || $order->finishing_status == 'In Progress')
                                <button data-id="{{ encrypt($order->id) }}" class="btn btn-success finishing">Finishing
                                    {{ $order->finishing_status }}</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('tbody').on('click', '.cutting', function() {
                const encryptedWorkOrderId = $(this).data('id');
                const url = "{{ route('cutting.create') }}?work-order-id=" + encodeURIComponent(
                    encryptedWorkOrderId);
                window.location.href = url;
            });
        });
    </script>
@endsection
