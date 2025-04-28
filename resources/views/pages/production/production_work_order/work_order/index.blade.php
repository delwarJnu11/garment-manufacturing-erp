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
                    <th>QC</th>
                    <th>Packaging</th>
                    <th>Wastage</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workOrders as $order)
                    <tr>
                        <td>{{ $order->order->order_number }}</td>
                        <td>{{ $order->assignedUser->name }}</td>
                        <td>{{ $order->total_pieces }} (pcs)</td>
                        <td>
                            <span
                                class="badge 
                                    @if ($order->cutting_status == 'Pending') badge-soft-danger
                                    @elseif ($order->cutting_status == 'In Progress')
                                        badg-soft-warning
                                    @elseif ($order->cutting_status == 'Completed')
                                        badge-soft-success @endif">
                                {{ $order->cutting_status }}
                            </span>
                        </td>
                        <td>
                            <span
                                class="badge 
                                    @if ($order->sewing_status == 'Pending') badge-soft-danger
                                    @elseif ($order->sewing_status == 'In Progress')
                                        badge-soft-warning
                                    @elseif ($order->sewing_status == 'Completed')
                                        badge-soft-success @endif">
                                {{ $order->sewing_status }}
                            </span>
                        </td>
                        <td>
                            <span
                                class="badge 
                                    @if ($order->qc_status == 'Pending') badge-soft-danger
                                    @elseif ($order->qc_status == 'In Progress')
                                        badge-soft-warning
                                    @elseif ($order->qc_status == 'Completed')
                                        badge-soft-success @endif">
                                {{ $order->qc_status }}
                            </span>
                        </td>
                        <td>
                            <span
                                class="badge 
                                    @if ($order->packaging_status == 'Pending') badge-soft-danger
                                    @elseif ($order->packaging_status == 'In Progress')
                                        badge-soft-warning
                                    @elseif ($order->packaging_status == 'Completed')
                                        badge-soft-success @endif">
                                {{ $order->packaging_status }}
                            </span>
                        </td>
                        <td>{{ $order->wastage }}(pcs)</td>
                        <td>
                            @if ($order->cutting_status == 'Pending' || $order->cutting_status == 'In Progress')
                                <button data-id="{{ encrypt($order->id) }}" class="btn btn-warning cutting">Cutting
                                    {{ $order->cutting_status }}</button>
                            @endif
                            @if ($order->sewing_status == 'Pending' || $order->sewing_status == 'In Progress')
                                <button data-id="{{ encrypt($order->id) }}" class="btn btn-info sweing">Sweing
                                    {{ $order->sewing_status }}</button>
                            @endif
                            @if ($order->qc_status == 'Pending' || $order->qc_status == 'In Progress')
                                <button data-id="{{ encrypt($order->id) }}" class="btn btn-success finishing">QC
                                    {{ $order->qc_status }}</button>
                            @endif
                            @if ($order->packaging_status == 'Pending' || $order->packaging_status == 'In Progress')
                                <button data-id="{{ encrypt($order->id) }}" class="btn btn-success finishing">Packaging
                                    {{ $order->packaging_status }}</button>
                            @endif
                            @if ($order->packaging_status == 'Completed')
                                <button data-id="{{ $order->id }}" class="btn btn-secondary production-ready">Add
                                    In Stock</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination Links -->
        <div class="d-flex justify-content-end p-3">
            {{ $workOrders->links('vendor.pagination.custom') }}
        </div>
        <!-- Add In Stock Modal -->
        <div class="modal fade" id="addInStock" tabindex="-1" role="dialog" aria-labelledby="addInStockLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="addInStockForm" method="POST" action="">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addInStockLabel">Add Product In Stock</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">

                            <input type="hidden" name="order_id" id="order_id">

                            <div class="form-group">
                                <label for="profit_rate">Profit Rate (%)</label>
                                <input type="text" class="form-control" name="profit_rate" id="profit_rate" required>
                            </div>

                            <div class="form-group mt-2">
                                <label for="warehouse_id">Warehouse</label>
                                <select class="form-control" name="warehouse_id" id="warehouse_id">
                                    <option value="">Select Warehouse</option>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="product-type">Product Type</label>
                                <input type="text" class="form-control" name="product_type" value="Finished Goods"
                                    id="product-type" readonly>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="confirm_sell">Confirm Sell</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
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

            // Added in The products, ProductLot and Stock Table
            $('tbody').on('click', '.production-ready', function() {
                const orderId = $(this).data('id');

                $('#order_id').val(orderId);
                $('#profit_rate').val('');
                $('#addInStock').modal('show');

            });

            // Add In the Stock
            $('#addInStockForm').submit(function(e) {
                e.preventDefault();

                const formData = $(this).serialize();
                console.log(formData)
                // $.ajax({
                //     url: "{{ url('/api/product') }}",
                //     type: 'POST',
                //     data: formData,
                //     success: function(response) {
                //         // console.log(response)
                //         $('#processSellModal').modal('hide');
                //         alert('Wastage sold successfully!');
                //         window.location.href = "{{ url('stock/products') }}";
                //     },
                //     error: function(e) {
                //         console.log(e)
                //     }
                // });
            });


        });
    </script>
@endsection
