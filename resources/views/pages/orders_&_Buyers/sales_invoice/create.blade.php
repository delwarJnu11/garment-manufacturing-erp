@extends('layout.backend.main')

@section('page_content')
    @if (session('error'))
        <div class="alert alert-danger">
            <strong>Error!</strong> {{ session('error') }}
        </div>
    @endif

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 style="color: white">Sales Invoice</h3>
                    </div>
                    <div class="card-body">
                        <!-- Buyer & Invoice Details -->
                        <div class="row">
                            <!-- Buyer Details -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Buyer Details:</strong></label>
                                <div class="input-group">
                                    <select name="buyer_id" class="form-select" required id="buyer_id">
                                        <option value="">Select Buyer</option>
                                        @foreach ($buyers as $buyer)
                                            <option value="{{ $buyer->id }}">
                                                {{ $buyer->first_name . ' ' . $buyer->last_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <a href="{{ route('buyers.create') }}" class="btn btn-primary">+</a>
                                </div>

                                <p class="mt-2"><strong>Buyer ID:</strong> #BUY-<span class="buyer_id"></span></p>
                                <p><strong>Address: </strong><span class="address"></span></p>
                                <p><strong>Email: </strong><span class="email"></span></p>
                            </div>

                            <!-- Invoice Details -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Invoice Details</strong></label>
                                <div class="border p-3 bg-light">
                                    <p class="mb-1"><strong>Invoice ID: </strong>#<span class="invoice_id"></span></p>
                                    <p class="mb-1"><strong>Sale Date:</strong><span class="sale_date"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <td>
                        <div class="row mx-2">
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Order Select:</strong></label>
                                <div class="input-group">
                                    <select class="form-control" id="order_id" name="order_id">
                                        <option value="">Select Order</option>
                                        @foreach ($orders as $order)
                                            <option value="{{ $order->id }}">
                                                {{ $order->order_number }} - {{ $order->buyer->first_name }}
                                                {{ $order->buyer->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- <a href="{{ route('products.create') }}" class="btn btn-primary">+</a> --}}
                </div>
            </div>

            <!-- Sales Details Table -->
            <div class="container mt-5">
                <div class="row">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-primary">
                            <tr>
                                <th>Product</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Discount (%)</th>
                                <th>VAT (%)</th>
                                <th>Subtotal</th>
                                <th><button class="btn btn-danger clearAll">Clear All</button></th>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control product"></td>

                                <td><input type="number" class="form-control unit_price" placeholder="0.00"></td>
                                <td><input type="number" class="form-control qty" placeholder="0"></td>
                                <td><input type="number" class="form-control discount" placeholder="0"></td>
                                <td><input type="number" class="form-control vat" placeholder="0"></td>
                                <td><input type="text" class="form-control subtotal" disabled></td>
                                <td><button class="btn btn-primary add-item-btn">Add</button></td>
                            </tr>
                        </thead>
                        <tbody class="sales-details-table-body">
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Invoice Summary -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <p><strong>Notes:</strong> <span>Urgent delivery required.</span></p>
                </div>
                <div class="col-md-6 text-end">
                    <h5>Invoice Summary:</h5>
                    <p><strong>Total Amount:</strong> <span class="total_amount">0.00</span></p>
                    <p><strong>Discount:</strong> <span class="total_discount">0.00</span></p>
                    <p><strong>VAT:</strong> <span class="total_vat">0.00</span></p>
                    <hr>
                    <h4><strong>Grand Total: <span class="grand_total">0.00</span></strong></h4>
                </div>
            </div>
        </div>

        <!-- Footer with Action Buttons -->
        <div class="card-footer text-center">
            <button class="btn btn-primary process-btn">Process Invoice</button>
            <button class="btn btn-success" onclick="window.print();">Print Invoice</button>
            <button class="btn btn-primary">Save</button>
            <button class="btn btn-danger">Cancel</button>
        </div>
    </div>
    </div>
@endsection

@section('script')

    <script>
        $(document).ready(function() {
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            $('#buyer_id').on('change', function() {
                    let buyer_id = $(this).val();

                    $.ajax({
                        url: "{{ url('find_buyer') }}",
                        type: 'post',
                        data: {
                            id: buyer_id,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(res) {
                            console.log(res.buyer);
                            $(".email").text(res.buyer?.email);
                            $(".address").text(res.buyer?.shipping_address);
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error: ", error);
                            console.log(xhr.responseText);
                        }
                    });
                });

        });
    </script>
@endsection
