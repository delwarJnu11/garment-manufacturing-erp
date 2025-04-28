@extends('layout.backend.main')

<?php use Carbon\Carbon; ?>

@section('page_content')
    <x-message-banner />
    <x-page-header href="{{ route('wastage.create') }}" heading="Wastage List" btnText="Wasatge" />
    <div class="card">
        <div class="card-body">
            <div class="table-responsive dataview">
                <table class="table table-striped table-bordered">
                    <thead class="thead-primary">
                        <tr>
                            <th>Order Number</th>
                            <th>Product Name</th>
                            <th>Wastage Type</th>
                            <th>Sell Status</th>
                            <th>Section</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Created Date</th>
                            <th class="no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($wastageProducts as $wastage)
                            <tr>
                                <td>{{ $wastage->order->order_number }}</td>
                                <td>{{ $wastage->product->name }}</td>
                                <td>{{ $wastage->wastageType->name }}</td>
                                <td>{{ $wastage->is_sellable ? 'Yes' : 'No' }}</td>
                                <td>{{ $wastage->section }}</td>
                                <td>{{ $wastage->quantity }} (pcs)</td>
                                <td>{{ $wastage->unit_price }}</td>
                                <td>{{ $wastage->unit_price * $wastage->quantity }}</td>
                                <td>{{ Carbon::parse($wastage->created_at)->format('d M, Y') }}</td>
                                <td class="action-table-data">
                                    <button
                                        style="{{ $wastage->is_sellable ? 'cursor: not-allowed !important; background-color: #878584 !important; pointer-events: none;!important' : '' }}"
                                        class="btn btn-secondary process-sell-button" data-wastage-id="{{ $wastage->id }}"
                                        data-order-id="{{ $wastage->order->id }}"
                                        data-unit-price="{{ $wastage->unit_price }}"
                                        data-quantity="{{ $wastage->quantity }}"
                                        data-product-name="{{ $wastage->product->name }}"
                                        data-wastage-type="{{ $wastage->wastageType->name }}">{{ $wastage->is_sellable ? 'Processed' : 'Process Sell' }}</button>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-danger">
                                <th colspan="5" class="text-danger">No wastage found</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-end mt-3">
                    {{ $wastageProducts->links('vendor.pagination.custom') }}
                </div>
            </div>
        </div>

        <!-- Process Sell Modal -->
        <div class="modal fade" id="processSellModal" tabindex="-1" role="dialog" aria-labelledby="processSellModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="processSellForm" method="POST" action="">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="processSellModalLabel">Process Wastage Sell</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <input type="hidden" name="wastage_id" id="wastage_id">
                            <input type="hidden" name="order_id" id="order_id">
                            <input type="hidden" name="product_name" id="product_name">
                            <input type="hidden" name="quantity" id="quantity">
                            <input type="hidden" name="unit_price" id="unit_price">
                            {{-- <input type="hidden" name="ware_id" id="ware_id"> --}}

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
                                <label for="wastage-type">Wastage Type</label>
                                <input type="text" class="form-control" name="wastage_type" id="wastage-type" readonly>
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
    @endsection

    @section('script')
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            $(document).ready(function() {
                $('tbody').on('click', '.process-sell-button', function() {
                    const wastageId = $(this).data('wastage-id');
                    const orderId = $(this).data('order-id');
                    const productName = $(this).data('product-name');
                    const quantity = $(this).data('quantity');
                    const unitPrice = $(this).data('unit-price');
                    const wastageType = $(this).data('wastage-type');
                    const warehouseId = $('#warehouse_id option:selected').val();

                    // Set values into hidden fields
                    $('#wastage_id').val(wastageId);
                    $('#order_id').val(orderId);
                    $('#product_name').val(productName);
                    $('#quantity').val(quantity);
                    $('#unit_price').val(unitPrice);
                    $('#wastage-type').val(wastageType);
                    // $('#ware_id').val(warehouseId);

                    $('#profit_rate').val('');
                    // Open the modal
                    $('#processSellModal').modal('show');
                });

                // When click Confirm Sell button
                $('#processSellForm').submit(function(e) {
                    e.preventDefault();

                    const formData = $(this).serialize();

                    $.ajax({
                        url: "{{ url('/api/product') }}",
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            // console.log(response)
                            $('#processSellModal').modal('hide');
                            alert('Wastage sold successfully!');
                            window.location.href = "{{ url('stock/products') }}";
                        },
                        error: function(e) {
                            console.log(e)
                        }
                    });
                });

            });
        </script>
    @endsection
